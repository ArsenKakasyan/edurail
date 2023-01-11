<?php

#анонимная функция автозагрузки если класс не найден
spl_autoload_register(function($class_name)
{
	$parts = explode("\\", $class_name); #разбиваем строку на массив
	$class_name = end($parts); #получаем имя класса
	require_once "../app/models/" .$class_name . ".php";
});



require "config.php";
require "functions.php";
require "database.php";
require "model.php";
require "controller.php";
require "app.php";