<?php
session_start();
if (isset($_SESSION['username'])){
	unset($_SESSION['username']);
	session_destroy();
	echo '<script language="javascript">';
	echo 'alert("Logged out!");';
	echo 'window.location = "./index.php";';
	echo '</script>';
}else{
	header("location: ./index.php");
}
?>