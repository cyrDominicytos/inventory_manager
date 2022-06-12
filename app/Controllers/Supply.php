<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductPriceModel;
use App\Models\ProductCategoriesModel;
use App\Models\SalesOptionsModel;
use App\Models\ClientModel;
use App\Models\OrdersModel;
use App\Models\OrdersDetailsModel;
use App\Models\ProviderModel;
use App\Models\SupplyModel;
class Supply extends BaseController
{
    public  $ionAuth = null;
    public  $validation = null;
    public  $session = null;
    public  $configIonAuth = null;

    /**
	 * Validation list template.
	 *
	 * @var string
	 * @see https://bcit-ci.github.io/CodeIgniter4/libraries/validation.html#configuration
	 */
	protected $validationListTemplate = 'list';
	protected $validationSigneTemplate = 'single';
    protected $modelPrice = null;
    protected $modelProduct = null;
    protected $modelProductCategory = null;
    protected $modelSalesOptions = null;
    protected $modelClient = null;
    protected $modelOrder = null;
    protected $modelOrderDetails = null;
    protected $modelProvider = null;
    protected $modelSupply  = null;

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->ionAuth    = new \IonAuth\Libraries\IonAuth();
        $this->validation = \Config\Services::validation();
        helper(['form', 'url']);
		$this->configIonAuth = config('IonAuth');
		$this->session       = \Config\Services::session();
        $this->modelProduct = new ProductModel();
        $this->modelProductPrice = new ProductPriceModel();
        $this->modelProductCategory = new ProductCategoriesModel();
        $this->modelSalesOptions = new SalesOptionsModel();
        $this->modelClient = new ClientModel();
        $this->modelOrder = new OrdersModel();
        $this->modelOrderDetails = new OrdersDetailsModel();
        $this->modelProvider = new ProviderModel();
        $this->modelSupply  = new SupplyModel();

        if (! empty($this->configIonAuth->templates['errors']['list']))
		{
			$this->validationListTemplate = $this->configIonAuth->templates['errors']['list'];
		}
	}

    public function new()
    {

        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}
       
        $data['product_prices'] =$this->modelProductPrice->get_product_price_list();
        $data['products'] =$this->modelProduct->get()->getResult();
        $data['categories'] = $this->modelProductCategory->get()->getResult();
        $data['sales_options'] = $this->modelSalesOptions->get()->getResult();
        if($data['categories']==null)
            return redirect()->to("product_category/list")->with('message', 'Veuillez enregistrer les catégories de produits !')->with('code',0);
        if($data['products']==null)
            return redirect()->to("product/list")->with('message', 'Veuillez enregistrer les produits !')->with('code',0);
        if($data['sales_options']==null)
            return redirect()->to("sales_option/list")->with('message', 'Veuillez enregistrer les options de vente !')->with('code',0);
       
        $data['providers'] = $this->modelProvider->where("providers_isActive", 1)->whereNotIn("providers_id", [1])->get()->getResult();
        $data['products'] = [];
        $data['sales_options'] = [];
        $data['product_price'] = getProductPriceArray();
        $data['auth'] = $this->ionAuth;
       // dd(getProductByCategory(1));
        return view('supply/create',$data);
    }

    public function update($id=0)
    {

        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}

        if($id <= 0)
		{
            return redirect()->back()->with("message", "Erreur : Accès illégal !")->with("code", 0);
		}

        $data['supply'] = $this->modelSupply->get_supply($id);
        if(count($data['supply']) > 0)
            $data['supply'] = $data['supply'][0];
        else
            return redirect()->back()->with("message", "Erreur : Accès illégal !")->with("code", 0);
        $data['product_prices'] =$this->modelProductPrice->get_product_price_list();
        $data['products'] =$this->modelProduct->get()->getResult();
        $data['categories'] = $this->modelProductCategory->get()->getResult();
        $data['sales_options'] = $this->modelSalesOptions->get()->getResult();
        if($data['categories']==null)
            return redirect()->to("product_category/list")->with('message', 'Veuillez enregistrer les catégories de produits !')->with('code',0);
        if($data['products']==null)
            return redirect()->to("product/list")->with('message', 'Veuillez enregistrer les produits !')->with('code',0);
        if($data['sales_options']==null)
            return redirect()->to("sales_option/list")->with('message', 'Veuillez enregistrer les options de vente !')->with('code',0);
       
        $data['providers'] = $this->modelProvider->where("providers_isActive", 1)->whereNotIn("providers_id", [1])->get()->getResult();
        $data['product_price'] = getProductPriceArray();
        $data['auth'] = $this->ionAuth;
        return view('supply/create',$data);
    }


    public function list()
    {

        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}
       
        $data['supplies'] =$this->modelSupply->get_supply_list();
        $data['auth'] = $this->ionAuth;
        return view('supply/list',$data);
    }
    
    /**
	 * Create a new client|provider|delivery_men
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function create()
	{
		
		if (! $this->ionAuth->loggedIn())
		{
			return redirect()->to('/');
		}

        if (!$this->request->getPost())
		 {
			 return redirect()->back()->with("message2", "Erreur : Accès illégal !")->with("code", 0);
		}
		
		$rules = [
                    'product_list'=> 'required',
                   
                ];
        $errors = [
                    "product_list"=>[
                        "required"=>"Ajouter le(s) produit(s) au panier",
                        ],
                ]; 
        $this->validation->setRules($rules, $errors);         
		if ($this->validation->withRequest($this->request)->run())
		{            
            if(insertSupply($this->request))
            {
                return redirect()->to("supply/list")->with('message', 'Produits approvisionnés avec succès !')->with('code',1);
            }
        }
		//We find some error
		$this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
		$this->session->setFlashdata('message', $this->data['message']);
		return redirect()->back()->withInput();		
	}
    /**
	 * Create a new client|provider|delivery_men
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function edit()
	{
		
		if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			return redirect()->to('/');
		}

        if (!$this->request->getPost())
		 {
			 return redirect()->back()->with("message2", "Erreur : Accès illégal !")->with("code", 0);
		 }
        $id = (int) $this->request->getPost('id');
        $supply = $this->modelSupply->find($id);
        if(count($supply) >= 1){
           // $product = $product[0];
           $rules = [
                        'product_list'=> 'required',
                    
                    ];
           $errors = [
                    "product_list"=>[
                        "required"=>"Ajouter le(s) produit(s) au panier",
                        ],
                ]; 
        $this->validation->setRules($rules, $errors);         
        if ($this->validation->withRequest($this->request)->run())
        {            
            if(updateSupply($this->request, $id))
            {
                return redirect()->to("supply/list")->with('message', 'Approvisionnement édité avec succès !')->with('code',1);
            }else{
                return redirect()->to("supply/list")->with('message', 'Impossible d\'editer ce approvisionnement!')->with('code',0);
            }
        }
        //We find some error
        $this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
        $this->session->setFlashdata('message', $this->data['message']);
        return redirect()->back()->withInput();
    }else{
        return redirect()->back()->with("message", "L'approvisionnement que vous essayez d'éditer n'existe pas!")->with("code", 0);

    }
         		
}


	/**
	 * Deactivate the user
	 *
	 * @param integer $id   The user ID
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function delete(int $id)
	{
		if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			// redirect them to the home page because they must be an administrator to view this
            return redirect()->back()->with("message", "Cette page est reservée aux administrateurs du sytème!")->with("code", 0);
		}
        $id = (int) $id;
		if ($id >0)
		{
            if($this->modelSupply->delete($id))
                return redirect()->to("/order/list")->with("message", "La commande est supprimée avec succès !")->with("code", 1);
            else
                return redirect()->to("/order/list")->with("message", "Vous ne pouvez pas supprimer cette commande !")->with("code", 0);
		}
		else
		{
			 return redirect()->back()->with("message2", "Erreur : Accès illégal !")->with("code", 0);
		}

	}

}
