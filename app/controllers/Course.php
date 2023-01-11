<?php

namespace Controller;

if(!defined("ROOT")) die ("direct script access denied");


/**
 * single course class
 */


class Course extends Controller
{

	public function index()
	{# инициализация класса Home для страницы home.view.php

		$course = new \Model\Course();
		$data['title'] = "Home";

		// получаем курсы для домашней страницы
		$data['rows'] = $course->where(['approved'=>0], 'desc', 7);

		// read all courses order by trending value
		$query = "select * from courses where approved = 0 order by trending desc limit 5";
		$data['trending'] = $course->query($query);

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