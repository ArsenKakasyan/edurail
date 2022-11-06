<?php

/**
 * users model (модель - простой класс позволяющий подключиться к базе данных)
 * 
 * весь функционал Database также пашет в этом классе
 */
class User extends Model
{
	public $errors = [];
	protected $table = "users";

	protected $allowedColumns = [
		#ключи массива разрешенных столбцов
	'email',
	'firstname',
	'lastname',
	'password',
	'role',
	'date',
	'image',
	'about',
	'company',
	'job',
	'country',
	'address',
	'phone',
	'slug',
	'vkontakte_link',
	'telegram_link', 
	'headhunter_link', 	
	'bigbluebutton_link', 	

	];

	#$data в данном случае - переменная которая попала в $_POST в ../controllers/Signup.php, т.е. массив регистрационных данных
	public function validate($data) 
	{#проверяет все ли хорошо прошло во время обращения к бд

		$this->errors = [];

		#валидации
		if(empty($data['firstname']))
		{
			$this->errors['firstname'] = "Требуется имя";
		}else
		if(!preg_match("/^[а-яА-ЯЁёa-zA-Z]+$/u", trim($data['firstname'])))
		{
			$this->errors['firstname'] = "Имя содержит только буквы";
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
		if($this->where(['email'=>$data['email']]))
		{
			$this->errors['email'] = "Email уже существует ";
		}

		if(empty($data['password']))
		{
			$this->errors['password'] = "Требуется пароль";
		}

		if($data['password'] !== $data['retype_password'])
		{
			$this->errors['password'] = "Пароли не совпадают";
		}

		if(empty($data['terms']))
		{
			$this->errors['terms'] = "Пожалуйста, примите условия";
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

	
}