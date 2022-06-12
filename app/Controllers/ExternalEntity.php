<?php

namespace App\Controllers;

class ExternalEntity extends BaseController
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
        if (!in_array($type, [1,2,3]))
		{
            return redirect()->back()->with("message", "Erreur : Accès illégal !")->with("code", 0);
		}
		
        
            $data['external'] =externalModel($type)->get()->getResultArray();
            if(in_array($type, [1,2]))
            $data['external'] =externalModel($type)->whereNotIn(externalParams()[$type]['table']."_id", [1])->get()->getResultArray();
            $data['auth'] = $this->ionAuth;
            $data['type'] = $type;
            $data['showModal'] = $showModal;
            $data['tables'] = externalParams()[$type]['table'];
            return view('external/list',$data);
       
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
		$tables = externalParams()[$this->request->getPost('type')]['table'];
        $data = [];
		// validate form input
		$rules = [
                    'company'=> 'trim|required',
                    'phone_number'=> "trim|required|is_unique[".$tables.".".$tables."_phone_number]",
                ];
        $errors =  [
                        "company"=>["required"=>"Renseignez le nom du ".externalParams()[$this->request->getPost('type')]["externalName"]],
                        "phone_number"=>[
                            "required"=>"Renseignez le téléphone du ".externalParams()[$this->request->getPost('type')]["externalName"],
                            "is_unique"=>"Le téléphone ".$this->request->getPost('phone_number')." existe déjà"
                        ],
                    ];
        if ($this->request->getPost('ifu')  && !empty($this->request->getPost('ifu')))
        {
            $rules['ifu'] = "trim|exact_length[13]|numeric|is_unique[".$tables.".".$tables."_ifu]";
            $errors["ifu"] = [
                                    "is_unique"=>"L'IFU : ".$this->request->getPost('ifu')." existe déjà",
                                    "exact_length"=>"Le numéro IFU doit comporter extactement 13 chiffres",
                                    "numeric"=>"Le numéro IFU ne peut contenir que des chiffres",
            ];
            $data[$tables."_ifu"] = $this->request->getPost('ifu');
        }   

        if ($this->request->getPost('email')  && !empty($this->request->getPost('email')))
        {
            
            $rules['email'] = "trim|valid_email|is_unique[".$tables.".".$tables."_email]";
                
            $errors["email"] = [
                                "is_unique"=>"L'email : ".$this->request->getPost('email')." existe déjà",
                                "valid_email"=>"L'email : ".$this->request->getPost('email')." n'est pas valide",
            ];

                $data[$tables."_email"] = strtolower($this->request->getPost('email'));
        }  
        
        if ($this->request->getPost('address')  && !empty($this->request->getPost('address')))
            $data[$tables."_address"] = $this->request->getPost('address');
        
            $this->validation->setRules($rules, $errors);
                     
		if ($this->validation->withRequest($this->request)->run())
		{
            $data[$tables.'_company'] = $this->request->getPost('company');
            $data[$tables.'_phone_number'] = $this->request->getPost('phone_number');

            if(externalInsert($this->request->getPost('type'), $data))
            {
                return redirect()->to("/".externalParams()[$this->request->getPost('type')]['externalName']."/list")->with('message', 'Nouveau client créé avec succès !')->with('code',1);
            }
            
        }
         //We find some error

         $this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
         $this->session->setFlashdata('message2', $this->data['message']);
         return redirect()->back()->withInput();		
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
		$tables = externalParams()[$type]['table'];
        $data = [];
        $user = externalModel($type)->where($tables.'_id',$id)->get()->getResultArray();
        //dd($user);
        if(count($user) >= 1){
            $user = $user[0];
		// validate form input
		$rules = [
                    'company'=> 'trim|required',
                    'phone_number'=> "trim|required|".($user[$tables.'_phone_number'] == $this->request->getPost('phone_number') ? ('') : ('is_unique['.$tables.'.'.$tables.'_phone_number]')),
                ];
        $errors =  [
                        "company"=>["required"=>"Renseignez le nom du ".externalParams()[$this->request->getPost('type')]["externalName"]],
                        "phone_number"=>[
                            "required"=>"Renseignez le téléphone du ".externalParams()[$this->request->getPost('type')]["externalName"],
                            "is_unique"=>"Le téléphone ".$this->request->getPost('phone_number')." existe déjà"
                        ],
                    ];
        if ($this->request->getPost('ifu')  && !empty($this->request->getPost('ifu')))
        {
            $rules['ifu'] = "trim|exact_length[13]|numeric|".($user[$tables.'_ifu'] == $this->request->getPost('ifu') ? ('') : ('is_unique['.$tables.'.'.$tables.'_ifu]'));
            $errors["ifu"] = [
                                    "is_unique"=>"L'IFU : ".$this->request->getPost('ifu')." existe déjà",
                                    "exact_length"=>"Le numéro IFU doit comporter extactement 13 chiffres",
                                    "numeric"=>"Le numéro IFU ne peut contenir que des chiffres",
            ];
            $data[$tables."_ifu"] = $this->request->getPost('ifu');
        }   

        if ($this->request->getPost('email')  && !empty($this->request->getPost('email')))
        {
            
            $rules['email'] = "trim|valid_email|".($user[$tables.'_email'] == $this->request->getPost('email') ? ('') : ('is_unique['.$tables.'.'.$tables.'_email]'));
                
            $errors["email"] = [
                                "is_unique"=>"L'email : ".$this->request->getPost('email')." existe déjà",
                                "valid_email"=>"L'email : ".$this->request->getPost('email')." n'est pas valide",
            ];

                $data[$tables."_email"] = strtolower($this->request->getPost('email'));
        }  
        
        if ($this->request->getPost('address')  && !empty($this->request->getPost('address')))
            $data[$tables."_address"] = $this->request->getPost('address');
        
            $this->validation->setRules($rules, $errors);
                     
		if ($this->validation->withRequest($this->request)->run())
		{
            $data[$tables.'_company'] = $this->request->getPost('company');
            $data[$tables.'_phone_number'] = $this->request->getPost('phone_number');

            if(externalModel($type)->update($id, $data))
                return redirect()->back()->with("message", "Les informations du ".externalParams()[$type]['externalName']." sont mises à jour avec succès !")->with("code", 1);
            else
                return redirect()->back()->with("message2", "Le ".externalParams()[$type]['externalName']." que vous essayez d'éditer n'existe pas !")->with("code", 0);
        }
        //We find some error
        $this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
        $this->session->setFlashdata('message2', $this->data['message']);
        return redirect()->back()->withInput();
    }else{
        return redirect()->back()->with("message2", "Le ".externalParams()[$type]['externalName']." que vous essayez de modifier n'existe pas!")->with("code", 0);

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
		if (in_array($type,[1,2,3]))
		{
            $tables = externalParams()[$type]['table'];
            if(externalModel($type)->update($id,[$tables."_isActive"=>1]))
                return redirect()->back()->with("message", externalParams()[$type]['externalName']." activé avec succès !")->with("code", 1);
            else
                return redirect()->back()->with("message", "Le ".externalParams()[$type]['externalName']." que vous essayez d'activer n'existe pas !")->with("code", 0);
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
            $tables = externalParams()[$type]['table'];
            $data = [$tables."_isActive"=>0];
            if(externalModel($type)->update($id, $data))
                return redirect()->back()->with("message", externalParams()[$type]['externalName']." désactivé avec succès !")->with("code", 1);
            else
                return redirect()->back()->with("message", "Le ".externalParams()[$type]['externalName']." que vous essayez de désactiver n'existe pas !")->with("code", 0);
		}
		else
		{
            return redirect()->back()->with("message", "Désolé cet utilisateur n'est pas valide !")->with("code", 0);
		}

	}

}
