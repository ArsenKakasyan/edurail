<?php

/**
 * home class
 */
class Home extends Controller
{
	
	public function index()
	{# инициализация класса Home для страницы home.view.php

		$data['title'] = "Home";

		$this->view('home', $data);
	}

	
}