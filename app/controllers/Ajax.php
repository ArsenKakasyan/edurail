<?php
if(!defined("ROOT")) die ("direct script access denied");
/**
 * ajax controller
 */
class Ajax extends Controller
{
	
	public function index()
	{# инициализация класса Ajax для страницы Ajax.view.php

		$data['title'] = "Ajax";

		//$this->view('ajax', $data);
	}
    // функция для редактирования курса и загрузки страницы
    public function course_edit($id = null)
	{
        $user_id = Auth::getId();
		$course = new Course_model();
		$category = new Category_model();
		$language = new Language_model();
		$level = new Level_model();
		$price = new Price_model();
		$currency = new Currency_model();

        $data['categories'] = $category->findAll('asc');
        $data['languages'] = $language->findAll('asc');
        $data['levels'] = $level->findAll('asc');
        $data['prices'] = $price->findAll('asc');
        $data['currencies'] = $currency->findAll('asc');

		$data['title'] = "Ajax";
        $data['row'] = $row = $course->first(['user_id'=>$user_id, 'id'=>$id]);

		$this->view('course-edit-tabs/course-landing-page', $data);
	}

	
}