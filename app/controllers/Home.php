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

		// получаем курсы для домашней страницы
		$data['rows'] = $course->where(['approved'=>0], 'desc', 7);
		// если массив существует, то разбиваем его на два массива
		if($data['rows']){
			// получаем первый элемент массива
			$data['first_row'] = $data['rows'][0];
			unset($data['rows'][0]);
			
			// полное количество элементов массива
			$total_rows = count($data['rows']);
			// половина элементов
			$half_rows = round($total_rows / 2);
			
			$data['rows1'] = array_splice($data['rows'], 0, $half_rows);
			$data['rows2'] = $data['rows'];
		}
		

		$this->view('home', $data);
	}

	
}