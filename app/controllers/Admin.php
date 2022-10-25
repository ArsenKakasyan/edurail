<?php

/**
 * admin class
 */
class Admin extends Controller
{
	
	public function index()
	{# инициализация класса бд и вызов ее методов

		$data['title'] = "Dashboard";

		$this->view('admin/dashboard', $data);
	}

	public function profile($id = null)
	{# функция для профиля адимн-панели

		$id = $id ?? Auth::getId();

		$user = new User();
		$data['row'] = $user->first(['id'=>$id]);
		$data['title'] = "Profile";

		$this->view('admin/profile', $data);
	}


}