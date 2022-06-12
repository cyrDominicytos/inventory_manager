<?php

namespace App\Controllers;
use App\Models\ConfigModel;

class Config extends BaseController
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
    protected $modelConfig = null;

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
		$this->modelConfig = new ConfigModel();

        if (! empty($this->configIonAuth->templates['errors']['list']))
		{
			$this->validationListTemplate = $this->configIonAuth->templates['errors']['list'];
		}
	}

    public function config()
    {
        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}
        
        $data['auth'] = $this->ionAuth;
        $data['configList'] = getConfigList();
        return view('config/config',$data);
    }
    
    /**
	 * Create a new client|provider|delivery_men
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function save()
	{
		
		if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			return redirect()->to('/');
		}

        if (!$this->request->getPost())
		 {
			 return redirect()->back()->with("message2", "Erreur : Accès illégal !")->with("code", 0);
		}
		
		// validate form input
		$rules = [
                    'company_name'=> 'trim|required',
                    'company_ifu'=> 'trim|required',
                    'company_email'=> 'trim|required|valid_email',
                    'company_phone_number'=> 'trim|required',
                    'company_address'=> 'trim|required',
                    'company_product_identity'=> 'trim|required',
                    'company_identity'=> 'trim|required',
                    'company_created_at'=> 'trim',
                    'company_site_url'=> 'trim',
                    'company_rccm'=> 'trim',
                    'company_logo'=> 'is_image[company_logo]|mime_in[company_logo,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                ];
        $errors =  [
                        "company_name"=>[
                            "required"=>"Renseignez le nom de l'entreprise",
                            "is_unique"=>"La désignation ".$this->request->getPost('name')." existe déjà"
                            ],
                        "company_ifu"=>[
                            "required"=>"Renseignez l'IFU de l'entreprise",
                            ],
                        "company_email"=>[
                            "required"=>"Renseignez l'email de l'entreprise",
                            "valid_email"=>"Le texte ".$this->request->getPost('company_email')." n'est pas un email valid"
                            ],
                        "company_phone_number"=>[
                            "required"=>"Renseignez le téléphone de l'entreprise",
                            ],
                        "company_address"=>[
                            "required"=>"Renseignez l'adresse de l'entreprise",
                            ],
                        "company_product_identity"=>[
                            "required"=>"Renseignez l'identificateur des produit l'entreprise",
                            ],
                        "company_identity"=>[
                            "required"=>"Renseignez l'identifiant de connexion de l'entreprise",
                            ],
                        "company_logo"=>[
                            "is_image"=>"Désolé, le fichier envoyé n'est pas une image",
                            "mime_in"=>"Désolé, vous ne pouvez envoyer qu'une : image/jpg, image/jpeg, image/gif, image/png ou image/webp",
                            ],
                    ]; 
        $this->validation->setRules($rules, $errors);
		if ($this->validation->withRequest($this->request)->run())
		{			
			$this->modelConfig->where("config_code", 1)->set(['config_value'=>$this->request->getPost('company_name')])->update();
			$this->modelConfig->where("config_code", 2)->set(['config_value'=>$this->request->getPost('company_ifu')])->update();
			$this->modelConfig->where("config_code", 3)->set(['config_value'=>$this->request->getPost('company_email')])->update();
			$this->modelConfig->where("config_code", 4)->set(['config_value'=>$this->request->getPost('company_phone_number')])->update();
			$this->modelConfig->where("config_code", 5)->set(['config_value'=>$this->request->getPost('company_address')])->update();
			$this->modelConfig->where("config_code", 6)->set(['config_value'=>$this->request->getPost('company_product_identity')])->update();
			$this->modelConfig->where("config_code", 7)->set(['config_value'=>$this->request->getPost('company_identity')])->update();
			$this->modelConfig->where("config_code", 8)->set(['config_value'=>$this->request->getPost('company_created_at')])->update();
			$this->modelConfig->where("config_code", 9)->set(['config_value'=>$this->request->getPost('company_site_url')])->update();
			$this->modelConfig->where("config_code", 10)->set(['config_value'=>$this->request->getPost('company_rccm')])->update();
            
            //Upload new image
            if($this->request->getFile('company_logo')->isValid())
            {
                $img = $this->request->getFile('company_logo');
                $filepath = 'uploads/logo/company_logo.'.$img->getExtension();
                unlink(WRITEPATH.$filepath);
                $img->move(WRITEPATH . 'uploads/logo', "company_logo.".$img->getExtension());  
                $this->modelConfig->where("config_code", 11)->set(['config_value'=> $filepath])->update();
            }
            return redirect()->to("/config")->with('message', 'Configuration mise à jour avec succès!')->with('code',1);            
        }
		//We find some error
		$this->data['error'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('error'));
		$this->session->setFlashdata('error', $this->data['error']);
		return redirect()->to("/config")->withInput();		
	}

   
}
