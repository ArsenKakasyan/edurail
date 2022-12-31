<?php

/**
 * currency model
 * 
 */
class currency_model extends Model
{
	public $errors = [];
	protected $table = "currencies";

	protected $allowedColumns = [
		#ключи массива разрешенных столбцов
	'symbol',
	'currency',
	'disabled',

	];

	#$data в данном случае - переменная которая попала в $_POST в ../controllers/Signup.php, т.е. массив регистрационных данных
	public function validate($data) 
	{#проверяет все ли хорошо прошло во время обращения к бд

		$this->errors = [];

		#валидации
		if(empty($data['currency']))
		{
			$this->errors['currency'] = "Требуется язык";
		}
        
		if(empty($data['symbol']))
		{
			$this->errors['symbol'] = "Требуется код валюты (например, 'USD')";
		}

		if(empty($this->errors)) #если все прошло хорошо
		{
			return true;
		}
		return false;
	}
	
}