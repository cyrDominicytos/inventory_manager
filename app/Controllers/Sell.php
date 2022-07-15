<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductPriceModel;
use App\Models\ProductCategoriesModel;
use App\Models\SalesOptionsModel;
use App\Models\ClientModel;
use App\Models\DeliveryMenModel;
use App\Models\SaleModel;
use App\Models\SellDetailsModel;
use App\Models\BillModel;
use App\Models\OrdersModel;
class Sell extends BaseController
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
    protected $modelDeliveryMen = null;
    protected $modelSale = null;
    protected $modelOrder = null;
    protected $modelSellDetails = null;
    protected $modelBill = null;

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
        $this->modelDeliveryMen = new DeliveryMenModel();
        $this->modelSale = new SaleModel();
        $this->modelSellDetails = new SellDetailsModel();
        $this->modelBill = new BillModel();
        $this->modelOrder = new OrdersModel();

        if (! empty($this->configIonAuth->templates['errors']['list']))
		{
			$this->validationListTemplate = $this->configIonAuth->templates['errors']['list'];
		}
	}

    public function test(){
        $billingController = new Billing();
        $bill_code = $billingController->generateBill(9);
        if(!$billingController->certifyBill($bill_code, \Swagger\Client\Model\InvoiceTypeEnum::FV))
        {
            return redirect()->to("sell/list")->with('message', 'Error lors de la normalisation de la facture, veuillez réessayer la normalisation !')->with('code',0);
        }
        return redirect()->to("sell/list")->with('message', 'La vente est enregistrée avec succès !')->with('code',1);
                
    }

    //normalize bill
    public function normalize($id){
        $billingController = new Billing();
        $bill = $this->modelBill->where("bill_sales_id", $id)->get()->getResult();
        if($bill){
            if(!$billingController->certifyBill($bill[0]->bill_code, "FV"))
                return redirect()->to("sell/list")->with('message', 'Error lors de la normalisation de la facture, veuillez réessayer la normalisation !')->with('code',0);
            return redirect()->to("sell/list")->with('message', 'La facture est normalisée avec succès !')->with('code',1);
        }else
            return redirect()->to("sell/list")->with('message', 'La facture que vous désirez normalisée n\'existe pas !')->with('code',0);                
    }

    //View bill
    public function vue($id){
        $billingController = new Billing();
        $bill = $this->modelBill->where("bill_sales_id", $id)->get()->getResult();
        if($bill){
            $data['product_price'] = getProductPriceArray();
            $data['auth'] = $this->ionAuth;
            $data['invoice_type'] = "FV";
            $data['bill'] = $bill[0];
            $data['sellDetails'] = $this->modelSellDetails->get_sell_detail($id);
            $data['sale'] = $this->modelSale->where("sales_id", $id)->get()->getResult()[0];
          //  dd( $data['sellDetails']);
           // $data['sellDetailss'] = [];
            $data['configList'] = getConfigList();
            return view('bills/show_single_invoice',$data);
        }else
            return redirect()->to("sell/list")->with('message', 'La facture que vous désirez visualisée n\'existe pas!')->with('code',0);                
    }

    //invoice sale
    public function invoice($id){
        $billingController = new Billing();
        $sale = $this->modelSale->where("sales_id", $id)->get()->getResult();
        if($sale){
           $billingController->generateBill($id,"FV");
           return redirect()->to("sell/list")->with('message', 'La vente est facturée avec succès !')->with('code',1);
        }else{
            return redirect()->to("sell/list")->with('message', 'La vente que vous essayez de facturée n\'existe pas !')->with('code',0);
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
       
        $data['clients'] = $this->modelClient->where("clients_isActive", 1)->whereNotIn("clients_id", [0])->get()->getResult();
        $data['delivery_mens'] = $this->modelDeliveryMen->where("delivery_mens_isActive", 1)->get()->getResult();
        $data['products'] = [];
        $data['sales_options'] = [];
        $data['product_price'] = getProductPriceArray();
        $data['inventory_product_quantity'] = getExistingProductQuantity();
        if(count( $data['inventory_product_quantity'])==0)
            return redirect()->to("supply/list")->with('message', 'Aucun produit en stock, Veuillez mettre à jour le stock des produits !')->with('code',0);

        $data['auth'] = $this->ionAuth;
        return view('sell/create',$data);
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
       
        $data['clients'] = $this->modelClient->where("clients_isActive", 1)->get()->getResult();
        $data['order'] = $this->modelSale->where("sales_id", $id)->get()->getResult();
        if(count($data['order']) > 0)
        $data['order'] = $data['order'][0];
        $data['order_detail'] = $this->modelSaleDetails->get_order_detail($id);
        $data['products'] = [];
        $data['sales_options'] = [];
        $data['product_price'] = getProductPriceArray();
        $data['auth'] = $this->ionAuth;
        return view('sell/create',$data);
    }


    public function list()
    {

        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}
       
        $data['sales'] =$this->modelSale->get_sale_list();
        $data['auth'] = $this->ionAuth;
        return view('sell/list',$data);
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
		
       // dd($this->request);
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
           // dd($this->request->getPost("bill_service"));
            if($id = insertSales($this->request, $this->ionAuth, true))
            {
                //delete order and details
                $orderId = (int) $this->request->getPost("id");
                if($orderId > 0)
                    $this->modelOrder->delete($orderId);

                //check if need to bill
                if($this->request->getPost("bill_service"))
                {
                    $bill_type = $this->request->getPost("bill_type");
                    $billingController = new Billing();
                    $bill_code = $billingController->generateBill($id,"FV");
                    if(!$billingController->certifyBill($bill_code,"FV"))
                    {
                        return redirect()->to("sell/list")->with('message', 'Error lors de la normalisation de la facture, veuillez réessayer la normalisation !')->with('code',0);
                    }
                }
                return redirect()->to("sell/list")->with('message', 'La vente est enregistrée avec succès !')->with('code',1);

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
        $order = $this->modelSale->find($id);
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
                return redirect()->to("sell/list")->with('message', 'Commande editée avec succès !')->with('code',1);
            }else{
                return redirect()->to("sell/list")->with('message', 'Impossible d\'editer cette commande!')->with('code',0);
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
            if($this->modelSale->delete($id))
                return redirect()->to("/sell/list")->with("message", "La commande est supprimée avec succès !")->with("code", 1);
            else
                return redirect()->to("/sell/list")->with("message", "Vous ne pouvez pas supprimer cette commande !")->with("code", 0);
		}
		else
		{
			 return redirect()->back()->with("message2", "Erreur : Accès illégal !")->with("code", 0);
		}

	}

}
