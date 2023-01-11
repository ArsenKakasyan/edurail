<?php

class App
{
	protected $controller = '_404';
	protected $method = 'index';
	#$page хранит значение текущей страницы
	public static $page = '_404'; 

#construcor with routing
	function __construct()
	{
		$arr = $this->getURL();

		$filename = "../app/controllers/".ucfirst($arr[0]).".php";
		if(file_exists($filename))
		{ #если файл controller найден -> больше не 404
			require $filename;
			$this->controller = $arr[0];
			self::$page = $arr[0];
			unset($arr[0]);
		}else{#если файл не найден то 404 оставлен
			require "../app/controllers/".$this->controller.".php";
		}
		#инциализация (не)найденного файла класса
		$mycontroller = new ("Controller\\".$this->controller)(); 
		#проверка существования метода
		$mymethod = $arr[1] ?? $this->method;

		if(!empty($arr[1])) 
		{
			if(method_exists($mycontroller, strtolower($mymethod)))
			{
				$this->method = strtolower($mymethod);
				unset($arr[1]);
			}
		}
		#вызов метода класса
		$arr = array_values($arr);
		call_user_func_array([$mycontroller,$this->method], $arr);
	}
//URL router function
	private function getURL()
	{
		$url = $_GET['url'] ?? 'home';
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$arr = explode("/", $url);
		return $arr;
	}
}