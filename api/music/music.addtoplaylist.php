<?php
require '../api.key.php';

$email = $_GET['email'];
$name = $_GET['name'];
$url = $_GET['url'];
$img = $_GET['img'];

if ($email && $name && $url) {
	$email = md5($email);
	$name = str_replace("'", "", $name);
	$url = str_replace("'", "", $url);
	$img = str_replace("'", "", $img);
	$queryCheck = mysql_query("SELECT id FROM `". $email ."` WHERE `musicPlaylist` LIKE '%" . $name . "%'") or die('{"status":0,"error":"'.mysql_error().'"}');
	if (mysql_num_rows($queryCheck) > 0) {
		die('{"status":0,"error":"You Already Added"}');
	}

	$queryNull = mysql_query("SELECT id FROM `". $email ."` WHERE `musicPlaylist` IS NULL") or die('{"status":0,"error":"'.mysql_error().'"}');
	$query = NULL;
	if (mysql_num_rows($queryNull) > 0) {
		$qArray = mysql_fetch_array($queryNull);
		$id = $qArray['id'];
		$query = mysql_query("UPDATE `". $email ."` SET `musicPlaylist`='".$name.":::".$url.":::".$img."' WHERE id='" . $id . "'") or die('{"status":0,"error":"'.mysql_error().'"}');
	}else{
		$query = mysql_query("INSERT INTO `". $email ."`(`musicPlaylist`) VALUES ('".$name.":::".$url.":::".$img."')") or die('{"status":0,"error":"'.mysql_error().'"}');
	}

	if ($query) {
		echo "{";
		echo '"status":1,';
		echo '"email":"'.$email.'",';
		echo '"name":"'.$name.'",';
		echo '"url":"'.$url.'"';
		echo "}";
	}else{
		die('{"status":0,"error":"Cannot Add"}');
	}
}else{
	die('{"status":0,"error":"'.mysql_error().'"}');
}
?>
