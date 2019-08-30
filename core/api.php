<?php
include "./config.php";
include "./function.php";


if ($_SERVER['REQUEST_METHOD'] === 'GET'){
	if (!isset($_GET['q'])){
		exit;
	}
	$q = $_GET['q'];
	switch ($q){
		case "check_username":
			checkUsername();
			break;
		case "check_email":
			checkEmail();
			break;
		default:
			echo "NULL";
			break;
	}
}

function checkUsername(){
	//header('Content-Type: application/json');
	if (isset($_GET['val'])){
		$db = new db();
		$username = $db -> escape_string($_GET['val']);
		$query = $db -> query("SELECT * FROM contas WHERE login='$username'");
		$res = pg_num_rows($query);
		$stat = array('username' => $username, 'registered' => $res);
		echo json_encode($stat);
	}else{
		$stat = array('status' => 'ERROR');
		echo json_encode($stat);
	}
	
}
function checkEmail(){
	//header('Content-Type: application/json');
	if (isset($_GET['val'])){
		$db = new db();
		$email = $db -> escape_string($_GET['val']);
		$query = $db -> query("SELECT * FROM contas WHERE email='$email'");
		$res = pg_num_rows($query);
		$stat = array('email' => $email, 'registered' => $res);
		echo json_encode($stat);
	}else{
		$stat = array('status' => 'ERROR');
		echo json_encode($stat);
	}
}
?>