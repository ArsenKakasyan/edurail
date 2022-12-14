<?php

namespace Controller;

/**
 * Login class
 */

use \Model\Auth;
use \Model\User;

class Login extends Controller
{
	
	public function index()
	{# инициализация класса login для страницы login.view.php

		$data['errors'] = [];

		$data['title'] = "Login";
		$user = new User();

		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			//валидация аккаунта пользователя из бд при входе
			$row = $user->first([
				'email'=>$_POST['email']
			]);

			if($row){

				if(password_verify($_POST['password'], $row->password))
				{
					//authenticate
					Auth::authenticate($row);

					redirect('home');
				}
			}

			$data['errors']['email'] = "Неправильный email или пароль";
		}

		$this->view('login', $data);
	}

	
}