<?php
if(!defined("ROOT")) die ("direct script access denied");
/**
 * home class
 */
class Home extends Controller
{
	
	public function index()
	{# инициализация класса Home для страницы home.view.php

		$course = new Course_model();
		$data['title'] = "Home";

		//get courses
		$data['rows'] = $course->where(['approved'=>0]);

		$this->view('home', $data);
	}

	
}