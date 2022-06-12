<?php

namespace App\Controllers;

class Auth extends \IonAuth\Controllers\Auth
{
    public function index()
    {
        if (! $this->ionAuth->loggedIn())
		{
			// redirect them to the login page
			return redirect()->to('/login');
		}
		else 
		{
			return redirect()->to('/users/liste');
		}
    }
    
    public function login()
    {
        
        return view('auth/login');
    }
    public function sign_in()
    {
        $ionAuth = new \IonAuth\Libraries\IonAuth();
        $identity = 'admin@admin.com';
        $password = 'password';
        $remember = TRUE; // remember the user
        if($this->ionAuth->login($identity, $password, $remember)){
            return redirect()->to('/users/liste');
        }
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('auth/register');
    }
}
