<?php

namespace App\Controllers;

class ProductCategory extends BaseController
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

        if (! empty($this->configIonAuth->templates['errors']['list']))
		{
			$this->validationListTemplate = $this->configIonAuth->templates['errors']['list'];
		}
	}

    public function create()
    {
        return view('external/create');
    }

    public function list($type=0, $showModal=0)
    {

        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}
        if (!in_array($type, [1,2]))
		{
            return redirect()->back()->with("message", "Erreur : Accès illégal !")->with("code", 0);
		}
		
        
            $data['external'] =productModel($type)->get()->getResultArray();
            $data['auth'] = $this->ionAuth;
            $data['type'] = $type;
            $data['showModal'] = $showModal;
            $data['tables'] = productParams()[$type]['table'];
            return view('category/list',$data);
       
    }
    
    /**
	 * Create a new client|provider|delivery_men
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function create_external()
	{
		
		if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			return redirect()->to('/');
		}

        if (!$this->request->getPost())
		 {
			 return redirect()->back()->with("message2", "Erreur : Accès illégal !")->with("code", 0);
		}
		$tables = productParams()[$this->request->getPost('type')]['table'];
		$type =  $this->request->getPost('type');
		$name = ($type == 1) ? ("la ".productParams()[$type]['externalName']) : ("l' ".productParams()[$type]['externalName'])  ;
        $CreateRoute = ($type == 1) ? ("/product_category/list_create") : ("/sales_option/list_create");
        $data = [];
		// validate form input
		$rules = [
                    'name'=> "trim|required|is_unique[".$tables.".".$tables."_name]",
                    'description'=> "trim",
                ];
        $errors =  [
                        "name"=>[
                            "required"=>"Renseignez la désignation de ".$name,
                            "is_unique"=>"La désignation ".$this->request->getPost('name')." existe déjà"
                            ],
                        
                    ]; 
        $this->validation->setRules($rules, $errors);
                     
		if ($this->validation->withRequest($this->request)->run())
		{
            $data[$tables.'_name'] = $this->request->getPost('name');
            $data[$tables.'_description'] = $this->request->getPost('description');

            if(productInsert($this->request->getPost('type'), $data))
            {
                return redirect()->to("/".productParams()[$this->request->getPost('type')]['externalNewRoute']."/list")->with('message', 'Nouvelle '.(productParams()[$type]["externalName"]).' créée avec succès !')->with('code',1);
            }
            
        }
		//We find some error
		$this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
		$this->session->setFlashdata('message2', $this->data['message']);
		return redirect()->to($CreateRoute)->withInput();		
	}
    /**
	 * Create a new client|provider|delivery_men
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function edit_external()
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
        $type =  $this->request->getPost('type');
		$tables = productParams()[$type]['table'];
        $name = ($type == 1) ? ("la ".productParams()[$type]['externalName']) : ("l' ".productParams()[$type]['externalName'])  ;
        $CreateRoute = ($type == 1) ? ("/product_category/list_create") : ("/sales_option/list_create");
        $data = [];
        $user = productModel($type)->where($tables.'_id',$id)->get()->getResultArray();
        //dd($user);
        if(count($user) >= 1){
            $user = $user[0];
		// validate form input
		$rules = [
                    'name'=> "trim|required|".($user[$tables.'_name'] == $this->request->getPost('name') ? ('') : ('is_unique['.$tables.'.'.$tables.'_name]')),
                ];
        $errors =  [
                       "name"=>[
                            "required"=>"Renseignez la désignation de ".productParams()[$this->request->getPost('type')]["externalName"],
                            "is_unique"=>"La désignation ".$this->request->getPost('name')." existe déjà"
                        ],
                    ];
            $this->validation->setRules($rules, $errors);
		if ($this->validation->withRequest($this->request)->run())
		{
            $data[$tables.'_name'] = $this->request->getPost('name');
            $data[$tables.'_description'] = $this->request->getPost('description');

            if(productModel($type)->update($id, $data))
                return redirect()->to("/".productParams()[$this->request->getPost('type')]['externalNewRoute']."/list")->with("message", "Les informations de ".$name ." sont mises à jour avec succès !")->with("code", 1);
            else
                return redirect()->back()->with("message2", $name ." que vous essayez d'éditer n'existe pas !")->with("code", 0);
        }
        //We find some error
        $this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
        $this->session->setFlashdata('message2', $this->data['message']);
        return redirect()->to($CreateRoute)->withInput();
    }else{
        return redirect()->back()->with("message2", $name." que vous essayez de modifier n'existe pas!")->with("code", 0);

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
	public function activate(int $id, int $type): \CodeIgniter\HTTP\RedirectResponse
	{
        if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			// redirect them to the home page because they must be an administrator to view this
            return redirect()->back()->with("message", "Cette page est reservée aux administrateurs du sytème!")->with("code", 0);
		}
        $id = (int) $id;
        $type = (int) $type;
		if (in_array($type,[1,2]))
		{
            $tables = productParams()[$type]['table'];
            if(productModel($type)->update($id,[$tables."_isActive"=>1]))
                return redirect()->back()->with("message", productParams()[$type]['externalName']." activé avec succès !")->with("code", 1);
            else
                return redirect()->back()->with("message", "Le ".productParams()[$type]['externalName']." que vous essayez d'activer n'existe pas !")->with("code", 0);
		}
		else
		{
            return redirect()->back()->with("message", "Désolé cet utilisateur n'est pas valide !")->with("code", 0);
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
	public function deactivate(int $id, int $type)
	{
		if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			// redirect them to the home page because they must be an administrator to view this
            return redirect()->back()->with("message", "Cette page est reservée aux administrateurs du sytème!")->with("code", 0);
		}
        $id = (int) $id;
		if (in_array($type,[1,2,3]))
		{
            //dd(externalModel($type)->find($id));
            $tables = productParams()[$type]['table'];
            $data = [$tables."_isActive"=>0];
            if(productModel($type)->update($id, $data))
                return redirect()->back()->with("message", productParams()[$type]['externalName']." désactivée avec succès !")->with("code", 1);
            else
                return redirect()->back()->with("message", "Le ".productParams()[$type]['externalName']." que vous essayez de désactiver n'existe pas !")->with("code", 0);
		}
		else
		{
            return redirect()->back()->with("message", "Désolé cet utilisateur n'est pas valide !")->with("code", 0);
		}

	}

}
