<?php

namespace App\Controllers;

class Users extends BaseController
{
    public  $ionAuth = null;
    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->ionAuth    = new \IonAuth\Libraries\IonAuth();
	}

    public function list()
    {
        if (!$this->ionAuth->loggedIn() || !$this->ionAuth->isAdmin())
		{
			return redirect()->to('/')->with("message", session()->get("message"))->with("code", session()->get("code"));
		}
		else 
		{
            $data['users'] = $this->ionAuth->users()->result();
            $data['auth'] = $this->ionAuth;
            return view('users/list',$data);
		}

       
    }
}
