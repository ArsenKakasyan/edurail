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

function message($msg)
{
	if(!empty($msg))
	{
		$_SESSION['message'] = $msg;
	}else{
		
		if(!empty($_SESSION['message']))
		{
			$msg = $_SESSION['message'];
			unset($_SESSION['message']);
			return $_SESSION['message'];
		}
	}

	return false;
}