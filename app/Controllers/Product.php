<?php

namespace App\Controllers;

use App\Models\ProductCategoriesModel;
use App\Models\ProductModel;
use App\Models\ExonerationModel;
class Product extends BaseController
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
    protected $modelProduct = null;
    protected $modelProductCategory = null;
    protected $modelExoneration = null;

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
        $this->modelProductCategory = new ProductCategoriesModel();
        $this->modelExoneration = new ExonerationModel();

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
        $data['products'] =$this->modelProduct->get_product_list();
        $data['categories'] = $this->modelProductCategory->get()->getResult();
        $data['exonerations'] = $this->modelExoneration->get()->getResult();
		if($showModal==1){
		if($data['categories']==null)
			return redirect()->to("product_category/list")->with('message', 'Veuillez enregistrer les catégories de produits !')->with('code',0);
		
		if($data['exonerations']==null)
			return redirect()->back()->with('message', 'Les catégories d\'exaunération ne sont pas renseignées. Veuillez contacter l\'administrateur!')->with('code',0);
		
		}
        $data['auth'] = $this->ionAuth;
        $data['showModal'] = $showModal;
        return view('product/list',$data);
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
                    'name'=> 'trim|required|is_unique[products.products_name]',
                    'description'=> "trim",
                ];
        $errors =  [
                        "name"=>[
                            "required"=>"Renseignez la désignation du produit",
                            "is_unique"=>"La désignation ".$this->request->getPost('name')." existe déjà"
                            ],
                        
                    ]; 
        $this->validation->setRules($rules, $errors);
        //dd($this->request);
		if ($this->validation->withRequest($this->request)->run())
		{
            $data['products_name'] = $this->request->getPost('name');
            $data['products_product_categorie_id'] = $this->request->getPost('product_categories_id');
            $data['products_exonerations_id'] = $this->request->getPost('products_exonerations_id');
            $data['products_description'] = $this->request->getPost('description');

            if($this->modelProduct->insert($data))
            {
                return redirect()->to("product/list")->with('message', 'Nouveau produit créé avec succès !')->with('code',1);
            }
            
        }
		//We find some error
		$this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
		$this->session->setFlashdata('message2', $this->data['message']);
		return redirect()->to("/product/list_create")->withInput();		
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
        $product = $this->modelProduct->where('products_id',$id)->get()->getResultArray();
        //dd($user);
        if(count($product) >= 1){
            $product = $product[0];
		// validate form input
		$rules = [
                    'name'=> "trim|required|".($product['products_name'] == $this->request->getPost('name') ? ('') : ('is_unique[products.products_name]')),
                ];
        $errors =  [
                       "name"=>[
                            "required"=>"Renseignez la désignation du produit",
                            "is_unique"=>"La désignation ".$this->request->getPost('name')." existe déjà"
                        ],
                    ];
            $this->validation->setRules($rules, $errors);
		if ($this->validation->withRequest($this->request)->run())
		{
            $data['products_name'] = $this->request->getPost('name');
            $data['products_product_categorie_id'] = $this->request->getPost('product_categories_id');
            $data['products_exonerations_id'] = $this->request->getPost('products_exonerations_id');
            $data['products_description'] = $this->request->getPost('description');

            if($this->modelProduct->update($id, $data))
                return redirect()->to("product/list")->with("message", "Les informations du produit sont mises à jour avec succès !")->with("code", 1);
            else
                return redirect()->back()->with("message2", " Le produit que vous essayez d'éditer n'existe pas !")->with("code", 0);
        }
        //We find some error
        $this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
        $this->session->setFlashdata('message2', $this->data['message']);
        return redirect()->to("/product/list_create")->withInput();
    }else{
        return redirect()->back()->with("message2", "Le produit que vous essayez de modifier n'existe pas!")->with("code", 0);

    }
         		
}


    /**
	 * Activate the user
	 *
	 * @param integer $id   The user ID
	 * @param integer  $type the user type : client,provider, etc.
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function activate(int $id): \CodeIgniter\HTTP\RedirectResponse
	{
        if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			// redirect them to the home page because they must be an administrator to view this
            return redirect()->back()->with("message", "Cette page est reservée aux administrateurs du sytème!")->with("code", 0);
		}
        $id = (int) $id;
		if ($id >0)
		{
            if($this->modelProduct->update($id,["products_isActive"=>1]))
                return redirect()->to("/product/list")->with("message", "Produit activé avec succès !")->with("code", 1);
            else
                return redirect()->to("/product/list")->with("message", "Le produit que vous essayez d'activer n'existe pas !")->with("code", 0);
		}
		else
		{
			 return redirect()->back()->with("message2", "Erreur : Accès illégal !")->with("code", 0);
		}
	}

	/**
	 * Deactivate the user
	 *
	 * @param integer $id   The user ID
	 * @param integer  $type the user type : client,provider, etc.
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function deactivate(int $id)
	{
		if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			// redirect them to the home page because they must be an administrator to view this
            return redirect()->back()->with("message", "Cette page est reservée aux administrateurs du sytème!")->with("code", 0);
		}
        $id = (int) $id;
		if ($id >0)
		{
            if($this->modelProduct->update($id,["products_isActive"=>0]))
                return redirect()->to("/product/list")->with("message", "Produit désactivé avec succès !")->with("code", 1);
            else
                return redirect()->to("/product/list")->with("message", "Le produit que vous essayez d'désactiver n'existe pas !")->with("code", 0);
		}
		else
		{
			 return redirect()->back()->with("message2", "Erreur : Accès illégal !")->with("code", 0);
		}

	}

}
