<?php

namespace Model;

/**
 * languages model
 * 
 */
class Language_model extends Model
{
	public $errors = [];
	protected $table = "languages";

	protected $allowedColumns = [
		#ключи массива разрешенных столбцов
	'symbol',
	'language',
	'disabled',

	];

	#$data в данном случае - переменная которая попала в $_POST в ../controllers/Signup.php, т.е. массив регистрационных данных
	public function validate($data) 
	{#проверяет все ли хорошо прошло во время обращения к бд

		$this->errors = [];

		#валидации
		if(empty($data['language']))
		{
			$this->errors['language'] = "Требуется язык";
		}

		if(empty($data['symbol']))
		{
			$this->errors['symbol'] = "Требуется код языка";
		}

		if(empty($this->errors)) #если все прошло хорошо
		{
			return true;
		}
		return false;
	}
	
}