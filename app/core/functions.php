<?php

function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}

function set_value($key)
{
	if(!empty($_POST[$key]))
	{
		return $_POST[$key];
	}

	return '';
}

function redirect($link)
{
	header("Location: ". ROOT."/".$link);
	die;
}

function message($msg = '',$erase = false)
{
	if(!empty($msg))
	{
		$_SESSION['message'] = $msg;
	}else{
		
		if(!empty($_SESSION['message']))
		{
			$msg = $_SESSION['message'];
			if($erase){
				unset($_SESSION['message']);
			}
			
			return $msg;
		}
	}

	return false;
}

function esc($str)
{ #функция для защиты от js инъекций и прочей грязи в формах ввода
	return nl2br(htmlspecialchars($str));
}

function str_to_url($url)
{
	#функция для очистки url от сторонних сивмолов
	$url = str_replace("'", "", $url);
	$url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
	$url = trim($url, "-");
	$url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
	$url = strtolower($url);
	$url = preg_replace('~[^-a-z0-9_]+~', '', $url);
	return $url;
} 
