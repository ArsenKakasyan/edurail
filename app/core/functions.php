<?php

function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}

function set_value($key, $default = '')
{
	if(!empty($_POST[$key]))
	{
		return $_POST[$key];
	}else 
	if(!empty($default))
	{
		return $default;
	}

	return '';
}

function get_date($date){
	$intlFormatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
	$intlFormatter->setPattern('dd MMMM, yyyy');

	return $intlFormatter->format(strtotime($date));
}

function set_select($key, $value, $default = '')
{ #хранит значение выбранной категории курса
	if(!empty($_POST[$key]))
	{
		if($value == $_POST[$key]){
			return ' selected ';
		}
	}else 
	if(!empty($default))
	{
		if($value == $default){
			return ' selected ';
		}
		return $default;
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
//функция для защиты от js инъекций и прочей грязи в формах ввода
function esc($str)
{ 
	return nl2br(htmlspecialchars($str));
}

// функция для очистки url от сторонних символов
function str_to_url($url)
{
	$url = str_replace("'", "", $url);
	$url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
	$url = trim($url, "-");
	$url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
	$url = strtolower($url);
	$url = preg_replace('~[^-a-z0-9_]+~', '', $url);
	return $url;
} 
// функция сжатия изображения
function resize_image($filename, $max_size = 700)
{
	$ext = explode(".", $filename);
	$ext = strtolower(end($ext));

	if(file_exists($filename))
	{
		switch($ext){

			case 'png':
				$image = imagecreatefrompng($filename);
				break;

			case 'gif':
				$image = imagecreatefromgif($filename);
				break;	

			case 'jpg':
			case 'jpeg':	
				$image = imagecreatefromjpeg($filename);
				break;

			default:
				$image = imagecreatefromjpeg($filename);
				break;
		}

		$src_w = imagesx($image);
		$src_h = imagesy($image);

		if($src_w > $src_h)
		{
			$dst_w = $max_size;
			$dst_h = ($src_h / $src_w) * $max_size;
		}else{
			$dst_w = ($src_w / $src_h) * $max_size;
			$dst_h = $max_size;
		}

		$dst_image = imagecreatetruecolor($dst_w, $dst_h);
		imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);

		imagedestroy($image);
		imagejpeg($dst_image, $filename, 90);
		switch($ext){

			case 'png':
				imagepng($dst_image, $filename);
				break;

			case 'gif':
				imagegif($dst_image, $filename);
				break;	

			case 'jpg':
			case 'jpeg':	
				imagejpeg($dst_image, $filename, 90);
				break;

			default:
				imagejpeg($dst_image, $filename, 90);
				break;
		}
		imagedestroy($dst_image);
	}
	return $filename;
}
