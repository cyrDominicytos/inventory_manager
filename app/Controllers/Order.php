<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductPriceModel;
use App\Models\ProductCategoriesModel;
use App\Models\SalesOptionsModel;
use App\Models\ClientModel;
use App\Models\OrdersModel;
use App\Models\OrdersDetailsModel;
use App\Models\DeliveryMenModel;
class Order extends BaseController
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
    protected $modelDeliveryMen = null;

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
        $this->modelDeliveryMen = new DeliveryMenModel();

        if (! empty($this->configIonAuth->templates['errors']['list']))
		{
			$this->validationListTemplate = $this->configIonAuth->templates['errors']['list'];
		}
	}

    public function new()
    {
        $this->modelOrder->delete(6);

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
       
        $data['clients'] = $this->modelClient->where("clients_isActive", 1)->whereNotIn("clients_id", [1])->get()->getResult();
        $data['delivery_mens'] = $this->modelDeliveryMen->where("delivery_mens_isActive", 1)->get()->getResult();
        $data['products'] = [];
        $data['sales_options'] = [];
        $data['product_price'] = getProductPriceArray();
        $data['inventory_product_quantity'] = getExistingProductQuantity();
        $data['auth'] = $this->ionAuth;
        return view('order/create',$data);
    }
    public function new2()
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
       
        $data['clients'] = $this->modelClient->where("clients_isActive", 1)->whereNotIn("clients_id", [1])->get()->getResult();
        $data['products'] = [];
        $data['sales_options'] = [];
        $data['product_price'] = getProductPriceArray();
        $data['auth'] = $this->ionAuth;
        return view('order/create',$data);
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
       
        $data['clients'] = $this->modelClient->where("clients_isActive", 1)->whereNotIn("clients_id", [1])->get()->getResult();
        $data['delivery_mens'] = $this->modelDeliveryMen->where("delivery_mens_isActive", 1)->get()->getResult();
        $data['products'] = [];
        $data['sales_options'] = [];
        $data['product_price'] = getProductPriceArray();
        $data['inventory_product_quantity'] = getExistingProductQuantity();
       
        $data['order'] = $this->modelOrder->where("orders_id", $id)->get()->getResult();
        if(count($data['order']) > 0)
        $data['order'] = $data['order'][0];
        $data['order_detail'] = $this->modelOrderDetails->get_order_detail($id);
        $data['auth'] = $this->ionAuth;
        return view('order/create',$data);
    }
    public function sale($id=0)
    {

        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}

        if($id <= 0)
		{
            return redirect()->back()->with("message", "Erreur : Accès illégal !")->with("code", 0);
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
       
        $data['clients'] = $this->modelClient->where("clients_isActive", 1)->whereNotIn("clients_id", [1])->get()->getResult();
        $data['delivery_mens'] = $this->modelDeliveryMen->where("delivery_mens_isActive", 1)->get()->getResult();
        $data['products'] = [];
        $data['sales_options'] = [];
        $data['product_price'] = getProductPriceArray();
        $data['inventory_product_quantity'] = getExistingProductQuantity();
       
        $data['order'] = $this->modelOrder->where("orders_id", $id)->get()->getResult();
        if(count($data['order']) > 0)
        $data['order'] = $data['order'][0];
        $data['order_detail'] = $this->modelOrderDetails->get_order_detail($id);
        //dd($data['order_detail']);
        foreach ($data['order_detail'] as $key => $value){
            $indexId = $value->orders_details_products_id.$value->orders_details_sales_options_id;
            if((int) $data['inventory_product_quantity'][$indexId] < (int) $value->orders_details_quantity){
                return redirect()->to("order/list")->with('message', 'Désolé, le stock disponible actuellement n\'est pas assez pour régler cette commande !')->with('code',0);
            }
            $data['inventory_product_quantity'][$indexId] -=  (int) $value->orders_details_quantity;
        }
        $data['auth'] = $this->ionAuth;
        return view('sell/create',$data);
    }


    public function list()
    {

        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}
       
        $data['orders'] =$this->modelOrder->get_order_list();
        $data['auth'] = $this->ionAuth;
        return view('order/list',$data);
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
		
        //dd($this->request->getVar("product_list"));
       // $data = [];
		// validate form input
		$rules = [
                    'client'=> 'required',
                    'product_list'=> 'required',
                   
                ];
        $errors = [
                    "client"=>[
                        "required"=>"Choisissez le client",
                        ],
                    "product_list"=>[
                        "required"=>"Ajouter le(s) produit(s) au panier",
                        ],
                ]; 
        $this->validation->setRules($rules, $errors);         
		if ($this->validation->withRequest($this->request)->run())
		{            
            if(insertOrder($this->request, $this->ionAuth))
            {
                return redirect()->to("order/list")->with('message', 'Commande enregistrée avec succès !')->with('code',1);
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
        $order = $this->modelOrder->find($id);
        if(count($order) >= 1){
           // $product = $product[0];
           $rules = [
            'client'=> 'required',
            'product_list'=> 'required',
           
        ];
        $errors = [
                    "client"=>[
                        "required"=>"Choisissez le client",
                        ],
                    "product_list"=>[
                        "required"=>"Ajouter le(s) produit(s) au panier",
                        ],
                ]; 
        $this->validation->setRules($rules, $errors);         
        if ($this->validation->withRequest($this->request)->run())
        {            
            if(updateOrder($this->request, $id))
            {
                return redirect()->to("order/list")->with('message', 'Commande editée avec succès !')->with('code',1);
            }else{
                return redirect()->to("order/list")->with('message', 'Impossible d\'editer cette commande!')->with('code',0);
            }
        }
        //We find some error
        $this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
        $this->session->setFlashdata('message', $this->data['message']);
        return redirect()->back()->withInput();
    }else{
        return redirect()->back()->with("message", "La commande que vous essayez d'éditer n'existe pas!")->with("code", 0);

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
            if($this->modelOrder->delete($id))
                return redirect()->to("/order/list")->with("message", "La commande est supprimée avec succès !")->with("code", 1);
            else
                return redirect()->to("/order/list")->with("message", "Vous ne pouvez pas supprimer cette commande !")->with("code", 0);
		}
		else
		{
			 return redirect()->back()->with("message2", "Erreur : Accès illégal !")->with("code", 0);
		}

	}

    public function vue($id=0)
    {

        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}

        if($id <= 0)
		{
            return redirect()->back()->with("message", "Erreur : Accès illégal !")->with("code", 0);
		}
        $data['order'] = $this->modelOrder->where("orders_id", $id)->get()->getResult();
        if(count($data['order']) > 0)
        $data['order'] = $data['order'][0];
        $data['order_detail'] = $this->modelOrderDetails->get_order_detail($id);
        $data['auth'] = $this->ionAuth;
        $data['configList'] = getConfigList();
        return view('bills/order/proforma',$data);
    }

}
