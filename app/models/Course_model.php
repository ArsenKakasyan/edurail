<?php

/**
 * Courses model (модель - простой класс позволяющий подключиться к базе данных)
 * все функции находящиеся в этом модуле используются ТОЛЬКО в бизнес логике КУРСОВ!
 */
class Course_model extends Model
{
	public $errors = [];
	protected $table = "courses";

	protected $afterSelect = [
		#массив функций которые запускаются после select
		'get_category',
		'get_sub_category',
		'get_user',
		'get_price',
		'get_level',
		'get_language',
	];
	protected $beforeUpdate = [];

	protected $allowedColumns = [
		#ключи массива разрешенных столбцов
		'title',
		'description',
		'user_id',
		'category_id',
		'sub_category_id',
		'level_id',
		'language_id',
		'price_id',
		'promo_link',
		'course_image',
		'course_image_tmp',
		'course_promo_video',
		'primary_subject',
		'date',
		'tags',
		'congratulations_message',
		'welcome_message',
		'approved',
		'published',
		'subtitle',
		'currency_id',
		'csrf_token',

	];

	#$data в данном случае - переменная которая попала в $_POST в ../controllers/Admin.php, т.е. массив данных
	public function validate($data) 
	{#проверяет все ли хорошо прошло во время обращения к бд

		$this->errors = [];

		#валидации
		if(empty($data['title']))
		{
			$this->errors['title'] = "Требуется название";
		}else
		if(!preg_match("/^[а-яА-ЯЁёa-zA-Z \-\_\&]+$/u", trim($data['title'])))
		{
			$this->errors['title'] = "Название курса содержит только буквы, пробелы и [-_&]";
		}

		if(empty($data['primary_subject']))
		{
			$this->errors['primary_subject'] = "Требуется основной предмет";
		}else
		if(!preg_match("/^[а-яА-ЯЁёa-zA-Z \-\_\&]+$/u", trim($data['primary_subject'])))
		{
			$this->errors['primary_subject'] = "Название предмета содержит только буквы, пробелы и [-_&]";
		}

		if(empty($data['category_id']))
		{
			$this->errors['category_id'] = "Выберите категорию";
		}

		if(empty($this->errors)) #если все прошло хорошо
		{
			return true;
		}
		return false;
	}

	public function edit_validate($data, $id = null, $tab_name = null) 
	{#проверяет все ли хорошо прошло во время обращения к бд при изменении данных аккаунта

		$this->errors = [];

		
		if($tab_name == "course-landing-page")
		{

			#валидации
			if(empty($data['title']))
			{
				$this->errors['title'] = "Требуется название";
			}else
			if(!preg_match("/^[а-яА-ЯЁёa-zA-Z \-\_\&]+$/u", trim($data['title'])))
			{
				$this->errors['title'] = "Название курса содержит только буквы, пробелы и [-_&]";
			}

			if(empty($data['primary_subject']))
			{
				$this->errors['primary_subject'] = "Требуется основной предмет";
			}else
			if(!preg_match("/^[а-яА-ЯЁёa-zA-Z \-\_\&]+$/u", trim($data['primary_subject'])))
			{
				$this->errors['primary_subject'] = "Название предмета содержит только буквы, пробелы и [-_&]";
			}

			if(empty($data['category_id']))
			{
				$this->errors['category_id'] = "Выберите категорию";
			}

			if(empty($data['level_id']))
			{
				$this->errors['level_id'] = "Выберите уровень";
			}

			if(empty($data['currency_id']))
			{
				$this->errors['currency_id'] = "Выберите валюту";
			}

			if(empty($data['language_id']))
			{
				$this->errors['language_id'] = "Выберите язык";
			}

			if(empty($data['price_id']))
			{
				$this->errors['price_id'] = "Выберите цену";
			}

			if(empty($data['subtitle']))
			{
				$this->errors['subtitle'] = "Выберите подзаголовок";
			}

			if(empty($data['description']))
			{
				$this->errors['description'] = "Введите описание курса";
			}

		}else
		if($tab_name == "course-messages")
		{
			
		}


		if(empty($this->errors)) #если все прошло хорошо
		{
			return true;
		}
		return false;
	}

	// функции которые запускаются после select

	protected function get_category($rows)
	{	#реинициализируем db class во избежании лупа
		$db = new Database();
		if(!empty($rows[0]->category_id))
		{	#проходим через каждую строку в таблице 1
			foreach($rows as $key => $row){

				$query = "select * from categories where id = :id limit 1"; #получаем действительную строку из таблицы категории 3
				$cat = $db->query($query,['id'=>$row->category_id]); # проверяем id категории 2
				if(!empty($cat)){
					# и все это мракобесие чтобы вывести вместо id название категории 4
					$rows[$key]->category_row = $cat[0];  
				}
			}
		}

		return $rows;
	}
	protected function get_sub_category($rows)
	{
		return $rows;
	}
	protected function get_user($rows)
	{
		$db = new Database();
		if(!empty($rows[0]->user_id))
		{	#проходим через каждую строку в таблице 1
			foreach($rows as $key => $row){

				$query = "select firstname, lastname, image, role from users where id = :id limit 1"; #получаем действительную строку из таблицы пользователей 3
				$user = $db->query($query,['id'=>$row->user_id]); # проверяем id пользователя 2
				if(!empty($user)){
					# и все это мракобесие чтобы вывести вместо id имя пользователя 4
					$user[0]->name = $user[0]->firstname . ' '.$user[0]->lastname;
					$rows[$key]->user_row = $user[0];  
				}
			}
		}

		return $rows;
	}
	protected function get_price($rows)
	{
		$db = new Database();
		if(!empty($rows[0]->price_id))
		{	#проходим через каждую строку в таблице 1
			foreach($rows as $key => $row){

				$query = "select * from prices where id = :id limit 1"; #получаем действительную строку из таблицы цен 3
				$price = $db->query($query,['id'=>$row->price_id]); # проверяем id цены 2
				if(!empty($price)){
					# и все это мракобесие чтобы вывести вместо id категорию цены 4
					$price[0]->name = $price[0]->name . ' (₽'.$price[0]->price .')';
					$rows[$key]->price_row = $price[0];  
				}
			}
		}

		return $rows;
	}
	protected function get_level($rows)
	{
		return $rows;
	}
	protected function get_language($rows)
	{
		return $rows;
	}

	
}