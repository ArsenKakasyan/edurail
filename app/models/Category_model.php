<?php

/**
 * categories model
 * 
 */
class Category_model extends Model
{
	public $errors = [];
	protected $table = "categories";

	protected $allowedColumns = [
		#ключи массива разрешенных столбцов
	'category',
	'disabled',

	];

	#$data в данном случае - переменная которая попала в $_POST в ../controllers/Signup.php, т.е. массив регистрационных данных
	public function validate($data) 
	{#проверяет все ли хорошо прошло во время обращения к бд

		$this->errors = [];

		#валидации
		if(empty($data['category']))
		{
			$this->errors['category'] = "Требуется категория";
		}else
		if(!preg_match("/^[а-яА-ЯЁёa-zA-Z \&\']+$/u", trim($data['category'])))
		{
			$this->errors['category'] = "Категория содержит только буквы и пробелы";
		}

		if(empty($this->errors)) #если все прошло хорошо
		{
			return true;
		}
		return false;
	}
	
}