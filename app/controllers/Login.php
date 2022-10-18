<?php

/**
 * Login class
 */
class Login extends Controller
{
	
	public function index()
	{# инициализация класса login для страницы login.view.php

		$data['title'] = "Login";

		$this->view('login', $data);
	}

	
}