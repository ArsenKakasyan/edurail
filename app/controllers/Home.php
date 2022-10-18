<?php

/**
 * home class
 */
class Home extends Controller
{
	
	public function index()
	{# инициализация класса бд и вызов ее методов

		$data['title'] = "Home";

		$this->view('home', $data);
	}

	
}