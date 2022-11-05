<?php

/**
 * main model class (как и controller, только для моделей)
 * 
 * в соответствии с шаблоном MVC каждая таблица будет иметь модель, в свою очередь каждая модель должна иметь возможноть 
 * использовать общий функционал из класса Model
 */
class Model extends Database
{
	protected $table = "";

	public function insert($data)
	{
		//убираем ненужные столбцы
		if(!empty($this->allowedColumns))
		{
			foreach ($data as $key => $value) {
				if(!in_array($key, $this->allowedColumns))
				{
					unset($data[$key]);
				}
			}
		}
		$keys = array_keys($data);

		#$this->table проверяет переменную protected $table в каждой модели таблиц 
		$query = "insert into " . $this->table;
		#разделям массив запятыми через метод implode e.g email,:password,:date
		$query .= " (".implode(",", $keys) .") values (:".implode(",:", $keys) .")";

		$this->query($query, $data); 
	}

	public function update($id, $data)
	{
		//убираем ненужные столбцы
		if(!empty($this->allowedColumns))
		{
			foreach ($data as $key => $value) {
				if(!in_array($key, $this->allowedColumns))
				{
					unset($data[$key]);
				}
			}
		}
		$keys = array_keys($data);

		//обновляет таблицу 
		$query = "update ".$this->table." set ";

		foreach ($keys as $key) {
			$query .= $key ."=:" . $key . ",";
			
		}
		$query = trim($query, ",");
		$query .= " where id = :id ";

		$data['id'] = $id;
		$this->query($query, $data); 
	}

	public function where($data)
	{
		 
		$keys = array_keys($data);

		$query = "select * from ".$this->table." where ";

		foreach ($keys as $key) {
					$query .= $key . "=:" . $key . " && ";
				}		

		$query = trim($query, "&& ");
		$res = $this->query($query, $data);

		if(is_array($res))
		{
			return $res;
		} 

		return false;
	}

	public function first($data)
	{
		#функция вытаскивает  первый объект из массива
		$keys = array_keys($data);

		$query = "select * from ".$this->table." where ";

		foreach ($keys as $key) {
					$query .= $key . "=:" . $key . " && ";
				}		

		$query = trim($query, "&& ");
		$query .= " order by id desc limit 1";

		$res = $this->query($query, $data);

		if(is_array($res))
		{
			return $res[0];
		} 

		return false;
	}

}