<?php

/**
 * admin class
 */
class Admin extends Controller
{
	
	public function index()
	{# инициализация класса бд и вызов ее методов

		$data['title'] = "Admin";

		$this->view('admin/dashboard', $data);
	}

	
}