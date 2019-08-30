<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/inc.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	$db = new db;
	$username = $db -> escape_string($_POST['username']);
	$password = $db -> escape_string($_POST['password']);
	
	$query = "SELECT * FROM contas WHERE login='$username' AND senha='$password'";
	$res = $db -> num_rows($query);
	if ($res == 1){
		session_start();
		session('username', $username);
		//$_SESSION['username'] = $username;
		echo "Login Success!";
	}else{
		echo "Wrong ID / Password";
	}
}else{
	header("location: /index.php");
}
?>