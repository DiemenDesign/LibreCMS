<?php
include'db.php';
if((!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off')||$_SERVER['SERVER_PORT']==443) define('PROTOCOL','https://'); else define('PROTOCOL','http://');
define('URL',PROTOCOL.$_SERVER['HTTP_HOST'].$settings['system']['url'].'/');
if($_FILES['file']['name']){
	if(!$_FILES['file']['error']){
		$name=md5(time());
		$ext=explode('.',$_FILES['file']['name']);
		$filename=strtolower($name.'.'.$ext[1]);
		$destination='../media/'.$filename;
		$location=$_FILES["file"]["tmp_name"];
		move_uploaded_file($location,$destination);
		echo URL.'media/'.$filename;
	}
}