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
        'course_promo_video',
        'primary_subject',
        'date',
        'tags',
        'congratulations_message',
        'welcome_message',
        'approved',
        'published', 		

	];

	#$data в данном случае - переменная которая попала в $_POST в ../controllers/Signup.php, т.е. массив регистрационных данных
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

	public function edit_validate($data, $id) 
	{#проверяет все ли хорошо прошло во время обращения к бд при изменении данных аккаунта

		$this->errors = [];

		#валидации
		if(empty($data['firstname']))
		{
			$this->errors['firstname'] = "Требуется имя";
		}else
		if(!preg_match("/^[а-яА-ЯЁёa-zA-Z]+$/u", trim($data['firstname'])))
		{
			$this->errors['firstname'] = "Имя может содержать только буквы";
		}

		if(empty($data['lastname']))
		{
			$this->errors['lastname'] = "Требуется фамилия";
		}else
		if(!preg_match("/^[а-яА-ЯЁёa-zA-Z]+$/u", trim($data['lastname'])))
		{
			$this->errors['lastname'] = "Фамилия содержит только буквы";
		}

		#check email
		if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
		{
			$this->errors['email'] = "Email не является допустимым";
		}else
		if($results = $this->where(['email'=>$data['email']]))
		{
			foreach($results as $result){
				if($id != $result->id)
					$this->errors['email'] = "Email уже существует ";
			}
		}

		if(!empty($data['phone']))
		{
			if(!preg_match("/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/", trim($data['phone'])))
			{
				$this->errors['phone'] = "Некорректный номер телефона";
			}
		}
		#check social medias
		if(!empty($data['vkontakte_link']))
		{
			if(!filter_var($data['vkontakte_link'], FILTER_VALIDATE_URL))
			{
				$this->errors['vkontakte_link'] = "Некорректная ссылка VK";
			}
		}
		
		if(!empty($data['telegram_link']))
		{
			if(!filter_var($data['telegram_link'], FILTER_VALIDATE_URL))
			{
				$this->errors['telegram_link'] = "Некорректная ссылка Telegram";
			}
		}
		if(!empty($data['headhunter_link']))
		{
			if(!filter_var($data['headhunter_link'], FILTER_VALIDATE_URL))
			{
				$this->errors['headhunter_link'] = "Некорректная ссылка HeadHunter";
			}
		}
		if(!empty($data['bigbluebutton_link']))
		{
			if(!filter_var($data['bigbluebutton_link'], FILTER_VALIDATE_URL))
			{
				$this->errors['bigbluebutton_link'] = "Некорректная ссылка BigBlueButton";
			}
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

				$query = "select firstname, lastname, role from users where id = :id limit 1"; #получаем действительную строку из таблицы пользователей 3
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