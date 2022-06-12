<?php

namespace App\Controllers;

use App\Models\PermissionModel;
use App\Models\GroupPermissionModel;
use App\Models\UserGroupModel;
use App\Models\GroupModel;
use App\Models\ClientModel;
use App\Models\ProviderModel;
use App\Models\DeliveryMenModel;
use App\Models\ProductModel;
use App\Models\ProductCategoriesModel;
use App\Models\SalesOptionsModel;
use App\Models\OrdersModel;

class Auth extends \IonAuth\Controllers\Auth
{

	/**
	 *
	 * @var array
	 */
	public $data = [];
    protected $helpers = ["app"];

	/**
	 * Configuration
	 *
	 * @var \IonAuth\Config\IonAuth
	 */
	protected $configIonAuth;

	/**
	 * IonAuth library
	 *
	 * @var \IonAuth\Libraries\IonAuth
	 */
	protected $ionAuth;

	/**
	 * Session
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * Validation library
	 *
	 * @var \CodeIgniter\Validation\Validation
	 */
	protected $validation;

	/**
	 * Validation list template.
	 *
	 * @var string
	 * @see https://bcit-ci.github.io/CodeIgniter4/libraries/validation.html#configuration
	 */
	protected $validationListTemplate = 'list';
	protected $validationSigneTemplate = 'single';

	/**
	 * Views folder
	 * Set it to 'auth' if your views files are in the standard application/Views/auth
	 *
	 * @var string
	 */
	protected $viewsFolder = 'Views/auth';

    protected $modelPermission = null;
	protected $modelGroupPermission = null;
	protected $modelUserGroup = null;
	protected $modelGroup = null;

	protected $modelClient = null;
	protected $modelProvider = null;
	protected $modelDeliveryMen = null;
	protected $modelProductCategory = null;
	protected $modelProduct = null;
	protected $modelSalesOptions = null;
	protected $modelOrder = null;
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

        //Personal models
        $this->modelPermission = new PermissionModel();
        $this->modelGroupPermission = new GroupPermissionModel();
        $this->modelUserGroup = new UserGroupModel();
        $this->modelGroup = new GroupModel();

        $this->modelClient = new ClientModel();
        $this->modelDeliveryMen = new DeliveryMenModel();
        $this->modelProvider = new ProviderModel();
        $this->modelProduct = new ProductModel();
        $this->modelSalesOptions = new SalesOptionsModel();
        $this->modelProductCategory = new ProductCategoriesModel();
        $this->modelOrder = new OrdersModel();


		if (! empty($this->configIonAuth->templates['errors']['list']))
		{
			$this->validationListTemplate = $this->configIonAuth->templates['errors']['list'];
		}
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function index()
	{
		if (!$this->ionAuth->loggedIn())
		{
            return view('auth/login');
		}
        elseif($this->ionAuth->isAdmin()){
			return redirect()->to('/dashboard')->with("message", session()->get("message"))->with("code", session()->get("code"));
        }
		else 
		{
			return redirect()->to('/dashboard')->with("message", session()->get("message"))->with("code", session()->get("code"));

           // echo "<p style='font-weight:bold;color:red; font-size:20px;text-align:center'> Cette page est en cours de développement. Merci.<p>";
			//return redirect()->to('/users/list')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}
	}


	public function back(){
		return redirect()->back()->back();
	}
	public function dashboard(){

		if (!$this->ionAuth->loggedIn())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}
		else 
		{

            $data['users'] = $this->ionAuth->users()->result();
            $data['users_count'] = count($this->ionAuth->users()->result());
            $data['client_count'] = count($this->modelClient->get()->getResult()) -1;
            $data['provider_count'] = count($this->modelProvider->get()->getResult()) -1;
            $data['deliver_men_count'] = count($this->modelDeliveryMen->get()->getResult());
            $data['category_product_count'] = count($this->modelProductCategory->get()->getResult());
            $data['product_count'] = count($this->modelProduct->get()->getResult());
            $data['sale_options_count'] = count($this->modelSalesOptions->get()->getResult());
            $data['order_count'] = count($this->modelOrder->get()->getResult());
            $data['auth'] = $this->ionAuth;
            return view('dashboard/dashboard',$data);
		}
	}
	/**
	 * Log the user in
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function login()
	{
		$this->data['title'] = lang('Auth.login_heading');

		// validate form input
		$this->validation->setRule('email', "email", 'required');
		$this->validation->setRule('password', "password", 'required');

		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run())
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool)$this->request->getVar('remember');
            $identity = strtolower($this->request->getVar('email'));
            $password = strtolower($this->request->getVar('password'));
            
			if ($this->ionAuth->login($identity, $password, $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->setFlashdata('message', $this->ionAuth->messages());
				return redirect()->to('/')->withCookies();
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->setFlashdata('message', $this->ionAuth->errors($this->validationListTemplate));
				// use redirects instead of loading views for compatibility with MY_Controller libraries
				return redirect()->back()->withInput();
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : $this->session->getFlashdata('message');
			return view('auth/login',$this->data);
		}
	}

	/**
	 * Log the user out
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function logout()
	{
		$this->data['title'] = 'Logout';

		// log the user out
		$this->ionAuth->logout();
		// redirect them to the login page
		$this->session->setFlashdata('message', $this->ionAuth->messages());
		return redirect()->to('/')->withCookies();
	}

    public function register()
    {
        if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			return redirect()->to('/auth');
		}
        $data['groups'] = $this->ionAuth->groups()->result();
        return view('auth/register',$data);
    }
    public function update_user($id=null)
    {
        if (! $this->ionAuth->loggedIn() || (! $this->ionAuth->isAdmin() && $this->ionAuth->user($id)->row() && $this->ionAuth->user($id)->row()->id != $id) )
		{
			return redirect()->to('/');
		}
        if($id== null){
            return redirect()->back();
        }
        $data['groups'] = $this->ionAuth->groups()->result();
        $data['user'] = $this->ionAuth->user($id)->row();
        $data['userGroup'] = $this->ionAuth->getUsersGroups($data['user']->id)->getResult()[0]->id;
        return view('auth/register',$data);
    }
    public function role_permission()
    {
        $data['groups'] = $this->ionAuth->groups()->result();
        $data['assignedGroups'] = groups_array($this->modelUserGroup->getAssignedGroups());
        $data['permission_list_foreach_group'] = permission_list_foreach_Group() ;
		//dd( $data['permission_list_foreach_group']);
        $data['auth'] = $this->ionAuth;
        return view('role_permission/list',$data);
    }
    public function new_Group()
    {
        $data['groups'] = $this->ionAuth->groups()->result();
        $data['permissions'] = getPermissionByModule();
        $data['auth'] = $this->ionAuth;
        return view('role_permission/create',$data);
    }

    public function update_group($id=null)
    {
        if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			return redirect()->to('/');
		}
        if($id== null){
            return redirect()->back();
        }
        $data['groups'] = $this->ionAuth->groups()->result();
		//dd( $data['groups']);

        $data['group'] = $this->ionAuth->group($id)->row();
        $data['group_permission'] = permission_array($this->modelGroupPermission->get_goupId($id)) ;
	//	dd( $data['group_permission']);
        $data['permissions'] = getPermissionByModule();
        $data['auth'] = $this->ionAuth;
        return view('role_permission/create',$data);
    } 
    public function view_group($id=null)
    {
        if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			return redirect()->to('/');
		}
        if($id== null){
            return redirect()->back();
        }
        $data['group'] = $this->ionAuth->group($id)->row();
        $data['users'] = $this->ionAuth->users($id)->result();
        $data['permissions'] = retrivePermissionByModule(permission_list_group($id));
		//dd( $data['permissions']);
        $data['auth'] = $this->ionAuth;

        return view('role_permission/view',$data);
    } 
    public function delete_group($id)
    {
        if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			return redirect()->to('/');
		}
        if($id && $this->ionAuth->group($id)->row()!=null){
            $rep = $this->modelGroup->delete([$id]);
            if($rep)
                return redirect()->to("/groups/list")->with("message", "Le rôle a été supprimé avec succès !")->with("code", 1);
            else           
                return redirect()->to("/groups/list")->with("message", "Erreur lors de la suppression du rôle ou rôle inexistant !")->with("code", 0);
        }else{
            return redirect()->to("/groups/list")->with("message", "Le rôle que vous essayez de supprimer n'existe pas !")->with("code", 0);
        }
    } 
	/**
	 * Change password
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function change_password()
	{
		if (! $this->ionAuth->loggedIn())
		{
			return redirect()->to('/auth/login');
		}
		
		$this->validation->setRule('old', lang('Auth.change_password_validation_old_password_label'), 'required');
		$this->validation->setRule('new', lang('Auth.change_password_validation_new_password_label'), 'required|min_length[' . $this->configIonAuth->minPasswordLength . ']|matches[new_confirm]');
		$this->validation->setRule('new_confirm', lang('Auth.change_password_validation_new_password_confirm_label'), 'required');

		$user = $this->ionAuth->user()->row();

		if (! $this->request->getPost() || $this->validation->withRequest($this->request)->run() === false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = ($this->validation->getErrors()) ? $this->validation->listErrors($this->validationListTemplate) : $this->session->getFlashdata('message');

			$this->data['minPasswordLength'] = $this->configIonAuth->minPasswordLength;
			$this->data['old_password'] = [
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			];
			$this->data['new_password'] = [
				'name'    => 'new',
				'id'      => 'new',
				'type'    => 'password',
				'pattern' => '^.{' . $this->data['minPasswordLength'] . '}.*$',
			];
			$this->data['new_password_confirm'] = [
				'name'    => 'new_confirm',
				'id'      => 'new_confirm',
				'type'    => 'password',
				'pattern' => '^.{' . $this->data['minPasswordLength'] . '}.*$',
			];
			$this->data['user_id'] = [
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			];

			// render
			return $this->renderPage($this->viewsFolder . DIRECTORY_SEPARATOR . 'change_password', $this->data);
		}
		else
		{
			$identity = $this->session->get('identity');

			$change = $this->ionAuth->changePassword($identity, $this->request->getPost('old'), $this->request->getPost('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->setFlashdata('message', $this->ionAuth->messages());
				return $this->logout();
			}
			else
			{
				$this->session->setFlashdata('message', $this->ionAuth->errors($this->validationListTemplate));
				return redirect()->to('/auth/change_password');
			}
		}
	}

	/**
	 * Forgot password
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function forgot_password()
	{
		$this->data['title'] = lang('Auth.forgot_password_heading');

		// setting validation rules by checking whether identity is username or email
		if ($this->configIonAuth->identity !== 'email')
		{
			$this->validation->setRule('identity', lang('Auth.forgot_password_identity_label'), 'required');
		}
		else
		{
			$this->validation->setRule('identity', lang('Auth.forgot_password_validation_email_label'), 'required|valid_email');
		}

		if (! ($this->request->getPost() && $this->validation->withRequest($this->request)->run()))
		{
			$this->data['type'] = $this->configIonAuth->identity;
			// setup the input
			$this->data['identity'] = [
				'name' => 'identity',
				'id'   => 'identity',
			];

			if ($this->configIonAuth->identity !== 'email')
			{
				$this->data['identity_label'] = lang('Auth.forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = lang('Auth.forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : $this->session->getFlashdata('message');
			return $this->renderPage($this->viewsFolder . DIRECTORY_SEPARATOR . 'forgot_password', $this->data);
		}
		else
		{
			$identityColumn = $this->configIonAuth->identity;
			$identity = $this->ionAuth->where($identityColumn, $this->request->getPost('identity'))->users()->row();

			if (empty($identity))
			{
				if ($this->configIonAuth->identity !== 'email')
				{
					$this->ionAuth->setError('Auth.forgot_password_identity_not_found');
				}
				else
				{
					$this->ionAuth->setError('Auth.forgot_password_email_not_found');
				}

				$this->session->setFlashdata('message', $this->ionAuth->errors($this->validationListTemplate));
				return redirect()->to('/auth/forgot_password');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ionAuth->forgottenPassword($identity->{$this->configIonAuth->identity});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->setFlashdata('message', $this->ionAuth->messages());
				return redirect()->to('/auth/login'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->setFlashdata('message', $this->ionAuth->errors($this->validationListTemplate));
				return redirect()->to('/auth/forgot_password');
			}
		}
	}

	/**
	 * Reset password - final step for forgotten password
	 *
	 * @param string|null $code The reset code
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function reset_password($code = null)
	{
		if (! $code)
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$this->data['title'] = lang('Auth.reset_password_heading');

		$user = $this->ionAuth->forgottenPasswordCheck($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->validation->setRule('new', lang('Auth.reset_password_validation_new_password_label'), 'required|min_length[' . $this->configIonAuth->minPasswordLength . ']|matches[new_confirm]');
			$this->validation->setRule('new_confirm', lang('Auth.reset_password_validation_new_password_confirm_label'), 'required');

			if (! $this->request->getPost() || $this->validation->withRequest($this->request)->run() === false)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : $this->session->getFlashdata('message');

				$this->data['minPasswordLength'] = $this->configIonAuth->minPasswordLength;
				$this->data['new_password'] = [
					'name'    => 'new',
					'id'      => 'new',
					'type'    => 'password',
					'pattern' => '^.{' . $this->data['minPasswordLength'] . '}.*$',
				];
				$this->data['new_password_confirm'] = [
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'pattern' => '^.{' . $this->data['minPasswordLength'] . '}.*$',
				];
				$this->data['user_id'] = [
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				];
				$this->data['code'] = $code;

				// render
				return $this->renderPage($this->viewsFolder . DIRECTORY_SEPARATOR . 'reset_password', $this->data);
			}
			else
			{
				$identity = $user->{$this->configIonAuth->identity};

				// do we have a valid request?
				if ($user->id != $this->request->getPost('user_id'))
				{
					// something fishy might be up
					$this->ionAuth->clearForgottenPasswordCode($identity);

					throw new \Exception(lang('Auth.error_security'));
				}
				else
				{
					// finally change the password
					$change = $this->ionAuth->resetPassword($identity, $this->request->getPost('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->setFlashdata('message', $this->ionAuth->messages());
						return redirect()->to('/auth/login');
					}
					else
					{
						$this->session->setFlashdata('message', $this->ionAuth->errors($this->validationListTemplate));
						return redirect()->to('/auth/reset_password/' . $code);
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->setFlashdata('message', $this->ionAuth->errors($this->validationListTemplate));
			return redirect()->to('/auth/forgot_password');
		}
	}

	/**
	 * Activate the user
	 *
	 * @param integer $id   The user ID
	 * @param string  $code The activation code
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function activate(int $id, string $code = ''): \CodeIgniter\HTTP\RedirectResponse
	{
		$activation = false;

		/*if ($code)
		{
			$activation = $this->ionAuth->activate($id, $code);
		}
		else*/ 
        if ($this->ionAuth->isAdmin())
		{
			$activation = $this->ionAuth->activate($id);
		}

		if ($activation)
		{
			return redirect()->back()->with("message", "Utilisateur activé avec succès !")->with("code", 1);
		}
		else
		{
            return redirect()->back()->with("message", "Désolé vous ne pouvez pas activer cet utilisateur !")->with("code", 0);
		}
	}

	/**
	 * Deactivate the user
	 *
	 * @param integer $id The user ID
	 *
	 * @throw Exception
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function deactivate(int $id = 0)
	{
		if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			// redirect them to the home page because they must be an administrator to view this
            return redirect()->back()->with("message", "Cette page est reservée aux administrateurs du sytème!")->with("code", 0);
		}
        $id = (int) $id;
		if ($id > 0 && $this->ionAuth->user($id) != null)
		{
            $message = $this->ionAuth->deactivate($id) ? $this->ionAuth->messages() : $this->ionAuth->errors($this->validationListTemplate);
			$this->session->setFlashdata('message', $message);
            return redirect()->back()->with("message", "Utilisateur banni avec succès !")->with("code", 1);

		}
		else
		{
            return redirect()->back()->with("message", "Désolé cet utilisateur n'est pas valide !")->with("code", 0);
		}

	}

	/**
	 * Create a new user
	 *
	 * @return string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function create_user()
	{
		
		if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			return redirect()->to('/');
		}

		 // bail if no group id given
		 if (!$this->request->getPost())
		 {
			 return redirect()->back()->with("message", "Erreur : Accès illégal !")->with("code", 0);
		 }

		$tables                        = $this->configIonAuth->tables;
		//$identityColumn                = $this->configIonAuth->identity;
		//$this->data['identity_column'] = $identityColumn;

		// validate form input
		$this->validation->setRules([
                                    'first_name'=> 'trim|required',
                                    'last_name'=> 'trim|required',
                                    'username'=> 'trim|required|is_unique['. $tables['users'] . '.username]',
                                    'email'=> 'trim|required|valid_email|is_unique['. $tables['users'] . '.email]',
                                    'password'=> 'trim|required|matches[password_confirm]',
                                    'password_confirm'=> 'trim|required',
                                    'phone'=> 'trim',

                                    ],
                                    [
                                        "first_name"=>["required"=>"Renseignez le nom"],
                                        "last_name"=>["required"=>"Renseignez le prénom"],
                                        "email"=>[
                                                    "required"=>"Renseignez l'adresse email",
                                                    "valid_email"=>"Renseignez une adresse email valide",
                                                    "is_unique"=>"L'email : ".$this->request->getPost('email')." existe déjà",
                                                    ],
                                        "username"=>[
                                                    "required"=>"Renseignez le nom d'utilisateur",
                                                    "is_unique"=>"Le nom d'utilisateur : ".$this->request->getPost('username')." existe déjà",
                                                    ],
                                        "password"=>[
                                                    "required"=>"Renseignez le mot de passe",
                                                    "matches"=>"Les deux mots de passe ne sont pas identiques",
                                                    ],
                                        "password_confirm"=>[   
                                                    "required"=>"Confirmer le mot de passe",
                                                    ],
                                    ]);
		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run())
		{
			$email    = strtolower($this->request->getPost('email'));
			$identity = $this->request->getPost('username');
			$password = $this->request->getPost('password');
			$additionalData = [
				'first_name' => $this->request->getPost('first_name'),
				'last_name'  => $this->request->getPost('last_name'),
				'company'    => "",
				'phone'      => $this->request->getPost('phone'),
				'address'      => $this->request->getPost('address'),
			];
            $group = array($this->request->getPost('group'));
            if ($this->ionAuth->register($identity, $password, $email, $additionalData, $group))
            {
                // check to see if we are creating the user
                // redirect them back to the admin page
                $this->session->setFlashdata('message', $this->ionAuth->messages());
                return redirect()->to('/users/list');
            }
            
        }
         //We find some error
         $this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
         $this->session->setFlashdata('message', $this->data['message']);
         return redirect()->back()->withInput();		
	}

	/**
	 * Redirect a user checking if is admin
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function redirectUser()
	{
		if ($this->ionAuth->isAdmin())
		{
			return redirect()->to('/auth');
		}
		return redirect()->to('/');
	}

	/**
	 * Edit a user
	 *
	 * @param integer $id User id
	 *
	 * @return string string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function edit_user(int $id)
	{
        if (!$this->ionAuth->loggedIn())
        {
            return redirect()->to('/');
        }
        // bail if no group id given
        if (!$id  || $id <= 0 || !$this->request->getPost() || $id!=$this->request->getPost('id') || (! $this->ionAuth->isAdmin() && $this->ionAuth->user($id)->row() && $this->ionAuth->user($id)->row()->id != $id))
        {
            return redirect()->back()->with("message", "Erreur : Accès illégal !")->with("code", 0);
        }

		$user          = $this->ionAuth->user($id)->row();
		if ($user!=null)
		{
			$route ="/";
			// validate form input
            $tables = $this->configIonAuth->tables;
            $this->validation->setRules([
                'first_name'=> 'trim|required',
                'last_name'=> 'trim|required',
                'phone'=> 'trim',
                'username'=> "trim|required|".($user->username == $this->request->getPost('username') ? ('') : ('is_unique['. $tables['users'] . '.username]')),
                'email'=> "trim|required|valid_email|".($user->email == $this->request->getPost('email') ? ('') : ('is_unique['. $tables['users'] . '.email]')),
                
                ],
                [
                    "first_name"=>["required"=>"Renseignez le nom"],
                    "last_name"=>["required"=>"Renseignez le prénom"],
                    "email"=>[
                        "required"=>"Renseignez l'adresse email",
                        "valid_email"=>"Renseignez une adresse email valide",
                        "is_unique"=>"L'email : ".$this->request->getPost('email')." existe déjà",
                        ],
                    "username"=>[
                        "required"=>"Renseignez le nom d'utilisateur",
                        "is_unique"=>"Le nom d'utilisateur : ".$this->request->getPost('username')." existe déjà",
                        ],
                ]);

			// update the password if it was posted
			if ($this->request->getPost('password')  && !empty($this->request->getPost('password')))
			{
                $this->validation->setRules([
                    'password'=> 'trim|required|matches[password_confirm]',
                    'password_confirm'=> 'trim|required',
                    ],
                    [
                        "password"=>[
                                    "required"=>"Renseignez le mot de passe",
                                    "matches"=>"Les deux mots de passe ne sont pas identiques",
                                    ],
                        "password_confirm"=>[   
                                    "required"=>"Confirmer le mot de passe",
                                    ],
                    ]);
                    $data['password'] = $this->request->getPost('password');
			}

			if ($this->validation->withRequest($this->request)->run())
			{
				$data = [
					'first_name' => $this->request->getPost('first_name'),
					'last_name'  => $this->request->getPost('last_name'),
					'address'    => $this->request->getPost('address'),
					'phone'      => $this->request->getPost('phone'),
				];
                if($user->username!=$this->request->getPost('username'))
                     $data['username'] = $this->request->getPost('username');
                if($user->email!=$this->request->getPost('email'))
                     $data['email'] = $this->request->getPost('email');

				// Only allow updating groups if user is admin
				if ($this->ionAuth->isAdmin())
				{
					$route="/users/list";
					// Update the groups user belongs to
					$groupData = $this->request->getPost('group');
					$oldgroup = $this->request->getPost('oldgroup');

					if (!empty($groupData) && $oldgroup!= $groupData) 
					{
						$this->ionAuth->removeFromGroup('', $id);
						$this->ionAuth->addToGroup($groupData, $id);
					}
				}

				// check to see if we are updating the user
				if ($this->ionAuth->update($user->id, $data))
				{
                    return redirect()->to($route)->with("message", "Profile édité avec succès !")->with("code", 1);
				}
				else
				{
					$this->session->setFlashdata('message', $this->ionAuth->errors($this->validationListTemplate));
                    return redirect()->back()->with("code", 0);
				}
			}else{
                $this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
                $this->session->setFlashdata('message', $this->data['message']);
                return redirect()->back()->withInput();
            }
		}else
		// display the edit user form
        return redirect()->back()->with("message", "L'utilisateur que vous essayez de modifier n'existe pas!")->with("code", 0);
    
    }

	/**
	 * Create a new group
	 *
	 * @return string string|\CodeIgniter\HTTP\RedirectResponse
	 */
	public function create_Group()
	{
		if (! $this->ionAuth->loggedIn() || ! $this->ionAuth->isAdmin())
		{
			return redirect()->to('/');
		}

        $tables = $this->configIonAuth->tables;
        // validate form input
		$this->validation->setRules([
            'name'=> 'trim|required|is_unique['. $tables['groups'] . '.name]|alpha_dash',
            ],
            [
                "name"=>[
                            "required"=>"Renseignez la désignation du rôle",
                            "is_unique"=>"Le rôle ".$this->request->getPost('name')." existe déjà",
                            "alpha_dash"=>"Le désignation du rôle doit être une chaine de caractère",
                        ],
            ]);
		// validate form input
		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run())
		{
			$newGroupId = $this->ionAuth->createGroup($this->request->getPost('name'), $this->request->getPost('description'),['display_name' => $this->request->getPost('display_name')]);
			if ($newGroupId)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
                insertPermissions($newGroupId, $this->request);
				return redirect()->to('/groups/list')->with("message", "Le rôle ".$this->request->getPost('name')." est créé avec succès !")->with("code", 1);
			}
			//We find some error
			$this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
			$this->session->setFlashdata('message', $this->data['message']);
			return redirect()->back()->withInput();		
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			//We find some error
			$this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
			$this->session->setFlashdata('message', $this->data['message']);
			return redirect()->back()->withInput();		
		}
	}

	/**
	 * Edit a group
	 *
	 * @param integer $id Group id
	 *
	 * @return string|CodeIgniter\Http\Response
	 */
	public function edit_group(int $id = 0)
	{
		
        if (!$this->ionAuth->loggedIn())
		{
			return redirect()->to('/');
		}
        // bail if no group id given
		if (!$id  || $id <= 0 || !$this->request->getPost() || $id!=$this->request->getPost('id') || ! $this->ionAuth->isAdmin())
		{
            return redirect()->back()->with("message", "Erreur : Accès illégal !")->with("code", 0);
		}

            $group = $this->ionAuth->group($id)->row();
            if($group!= null){
                //entry exists
                $tables = $this->configIonAuth->tables;
                // validate form input
                $this->validation->setRules([
                    'name'=> 'trim|required|alpha_dash',
                    ],
                    [
                        "name"=>[
                                    "required"=>"Renseignez la désignation du rôle",
                                "alpha_dash"=>"Le désignation du rôle doit être une chaine de caractère",
                            ],
                ]);

                //check validation 
                if ($this->validation->withRequest($this->request)->run())
                {
                    //update now
                    $groupUpdate = $this->ionAuth->updateGroup($id, $this->request->getPost('name'), ['description' => $this->request->getPost('description'),'display_name' => $this->request->getPost('display_name')]);
                    if ($groupUpdate)
                    {
                        updatePermissions($id, $this->request);
                        return redirect()->to('/groups/list')->with("message", "Le rôle ".$this->request->getPost('name')." est mise à jour avec succès !")->with("code", 1);
                    }
                    else
                    {
                        return redirect()->back()->with("message", " Il se pourrait que le rôle ".$this->request->getPost('name')." existe déjà!")->with("code", 0);
                    }
                }else{
                    //validation failed
                    $this->data['message'] = $this->validation->getErrors() ? $this->validation->listErrors($this->validationListTemplate) : ($this->ionAuth->errors($this->validationListTemplate) ? $this->ionAuth->errors($this->validationListTemplate) : $this->session->getFlashdata('message'));
                    return redirect()->back()->with("message", $this->data['message'])->with("code", 0);
                }

            }else{
                //group not existe
                return redirect()->back()->with("message", "Le rôle que vous essayez de mettre à jour n'existe pas")->with("code", 0);
            }
	}

	/**
	 * Render the specified view
	 *
	 * @param string     $view       The name of the file to load
	 * @param array|null $data       An array of key/value pairs to make available within the view.
	 * @param boolean    $returnHtml If true return html string
	 *
	 * @return string|void
	 */
	protected function renderPage(string $view, $data = null, bool $returnHtml = true): string
	{
		$viewdata = $data ?: $this->data;

		$viewHtml = view($view, $viewdata);

		if ($returnHtml)
		{
			return $viewHtml;
		}
		else
		{
			echo $viewHtml;
		}
	}
}
