<?php

/**
 * signup class
 */
class Signup extends Controller
{
	
	public function index()
	{# инициализация класса signup для страницы login.view.php

		$data['errors'] = [];
		$user = new User(); 
		#если метод запроса == post, тогда исполняется тело
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if($user->validate($_POST))
			{
				$_POST['date'] = date("Y-m-d H:i:s");
				$user->insert($_POST);
				
				message("Ваш аккаунт был успешно создан");
				redirect('login');
			}
		}

		$data['errors']= $user->errors;
		$data['title'] = "Signup";

		$this->view('signup', $data);
	}

	
}