<?php

/**
 * levels model
 * 
 */
class Level_model extends Model
{
	public $errors = [];
	protected $table = "course_levels";

	protected $allowedColumns = [
		#ключи массива разрешенных столбцов
	'level',
	'disabled',

	];

	#$data в данном случае - переменная которая попала в $_POST в ../controllers/Admin.php, т.е. массив данных
	public function validate($data) 
	{#проверяет все ли хорошо прошло во время обращения к бд

		$this->errors = [];

		#валидации
		if(empty($data['level']))
		{
			$this->errors['level'] = "Требуется уровень курса (например, 'Начальный')";
		}

		if(empty($this->errors)) #если все прошло хорошо
		{
			return true;
		}
		return false;
	}
	
}