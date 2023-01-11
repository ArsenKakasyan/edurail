<?php

namespace Controller;

/**
 * logout class
 */

use \Model\Auth;
class Logout extends Controller
{
	
	public function index()
	{
        Auth::logout();

        redirect('home');
	}

	
}