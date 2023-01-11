<?php

namespace Model;

/**
 * prices model
 * 
 */
class Price_model extends Model
{
	public $errors = [];
	protected $table = "prices";

	protected $allowedColumns = [
		#ключи массива разрешенных столбцов
	'name',
	'price',
	'disabled',

	];

	#$data в данном случае - переменная которая попала в $_POST в ../controllers/Admin.php, т.е. массив данных
	public function validate($data) 
	{#проверяет все ли хорошо прошло во время обращения к бд

		$this->errors = [];

		#валидации
		if(empty($data['price']))
		{
			$this->errors['price'] = "Требуется цена";
		}

		if(empty($data['name']))
		{
			$this->errors['name'] = "Требуется название цены (например, 'Базовый')";
		}

		if(empty($this->errors)) #если все прошло хорошо
		{
			return true;
		}
		return false;
	}
	
}