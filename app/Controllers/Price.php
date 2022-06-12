<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductPriceModel;
use App\Models\ProductCategoriesModel;
use App\Models\SalesOptionsModel;
class Price extends BaseController
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

        if (! empty($this->configIonAuth->templates['errors']['list']))
		{
			$this->validationListTemplate = $this->configIonAuth->templates['errors']['list'];
		}
	}

    public function list($showModal=0)
    {

        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}
        if (!in_array($showModal, [1,0]))
		{
            return redirect()->back()->with("message", "Erreur : Accès illégal !")->with("code", 0);
		}
        $data['product_prices'] =$this->modelProductPrice->get_product_price_list();
        $data['products'] =$this->modelProduct->get()->getResult();
        $data['categories'] = $this->modelProductCategory->get()->getResult();
        $data['sales_options'] = $this->modelSalesOptions->get()->getResult();
        if($showModal==1){
            if($data['categories']==null)
                return redirect()->to("product_category/list")->with('message', 'Veuillez enregistrer les catégories de produits !')->with('code',0);
            if($data['products']==null)
                return redirect()->to("product/list")->with('message', 'Veuillez enregistrer les produits !')->with('code',0);
            if($data['sales_options']==null)
                return redirect()->to("sales_option/list")->with('message', 'Veuillez enregistrer les options de vente !')->with('code',0);
        }
        $data['products'] = [];
        $data['sales_options'] = [];
        $data['auth'] = $this->ionAuth;
        $data['showModal'] = $showModal;
        return view('product_prices/list',$data);
    }
    
    /**
	 * Create a new client|provider|delivery_men
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function create()
	{
		
		if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			return redirect()->to('/');
		}

        if (!$this->request->getPost())
		 {
			 return redirect()->back()->with("message2", "Erreur : Accès illégal !")->with("code", 0);
		}
		
        $data = [];
		// validate form input
		$rules = [
                    'product_prices_product_id'=> 'trim|required',
                    'product_prices_sales_option_id'=> 'trim|required|unique_price[product_prices_sales_option_id,product_prices_product_id]',
                    'product_prices_price'=> 'trim|required',
                   
                ];
        $errors = [
                    "product_prices_product_id"=>[
                        "required"=>"Choisissez un produit",
                        ],
                    "product_prices_sales_option_id"=>[
                        "required"=>"Choisissez une option de vente",
                        "unique_price"=>"Cette option de vente était déjà attribuée au produit",
                        ],
                    "product_prices_price"=>[
                        "required"=>"Renseignez le prix de vente",
                        ],
                ]; 
        $this->validation->setRules($rules, $errors);         
		if ($this->validation->withRequest($this->request)->run())
		{
            $data['product_prices_product_id'] = $this->request->getPost('product_prices_product_id');
            $data['product_prices_sales_option_id'] = $this->request->getPost('product_prices_sales_option_id');
            $data['product_prices_price'] = $this->request->getPost('product_prices_price');

            //dd( $data['product_prices_price']);
            
            if($this->modelProductPrice->insert($data))
            {
                return redirect()->to("price/list")->with('message', 'Prix de vente ajouté avec succès !')->with('code',1);
            }
        }
		//We find some error
		$this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
		$this->session->setFlashdata('message2', $this->data['message']);
		return redirect()->to("/price/list_create")->withInput();		
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
        $data = [];
        $product = $this->modelProductPrice->find($id);
       // dd($product);
        //dd($user);
        if(count($product) >= 1){
           // $product = $product[0];
            $rules = [
               'product_prices_price'=> 'trim|required',
            ];
            $errors = [
                        "product_prices_price"=>[
                            "required"=>"Renseignez le prix de vente",
                            ],
                    ]; 
            $this->validation->setRules($rules, $errors);

		if ($this->validation->withRequest($this->request)->run())
		{
           // $data['product_prices_product_id'] = $this->request->getPost('product_prices_product_id');
            //$data['product_prices_sales_option_id'] = $this->request->getPost('product_prices_sales_option_id');
            $data['product_prices_price'] = $this->request->getPost('product_prices_price');
            
            if($this->modelProductPrice->update($id, $data))
                return redirect()->to("price/list")->with('message', 'Le prix de vente  à été mise à jour avec succès !')->with('code',1);
            else
                return redirect()->back()->with("message2", "Impossible de mettre à jour ce prix de vente!")->with("code", 0);
        }
        //We find some error
        $this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
        $this->session->setFlashdata('message2', $this->data['message']);
        return redirect()->to("/price/list_create")->withInput();
    }else{
        return redirect()->back()->with("message2", "Le produit que vous essayez de modifier n'existe pas!")->with("code", 0);

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
            if($this->modelProductPrice->delete($id))
                return redirect()->to("/price/list")->with("message", "Le prix de vente est supprimé avec succès !")->with("code", 1);
            else
                return redirect()->to("/price/list")->with("message", "Vous ne pouvez pas supprimer ce prix de vente!")->with("code", 0);
		}
		else
		{
			 return redirect()->back()->with("message2", "Erreur : Accès illégal !")->with("code", 0);
		}

	}

}
