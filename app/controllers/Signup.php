<?php

namespace Controller;

/**
 * signup class
 */
class Signup extends Controller
{
	
	public function index()
	{# инициализация класса signup для страницы signup.view.php

		$data['errors'] = [];
		$user = new \Model\User(); 
		#если метод запроса == post, тогда исполняется тело
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if($user->validate($_POST))
			{
				$_POST['date'] = date("Y-m-d H:i:s");
				$_POST['role'] = 'user';
				$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

				$user->insert($_POST);
				
				message("Ваш аккаунт был успешно создан. Выполните вход");
				redirect('login');
			}
		}

		$data['errors']= $user->errors;
		$data['title'] = "Signup";

		$this->view('signup', $data);
	}

	
}