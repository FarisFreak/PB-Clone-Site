<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	$itemid = $_POST['itemid'];
	$name = $_POST['name'];
	$type = $_POST['type'];
	$title = $_POST['titulo'];
	$con = pg_connect("host=localhost port=5432 dbname=pbr41null user=postgres password=123456");
	$query = pg_query($con, "INSERT INTO storage (item_id, name, type, titulo) VALUES ('$itemid', '$name', '$type', '$title');");
	echo "success";
	header("refresh:2; url=./Add_Item.php" );
}else{
	?>
	<html>
	<body>
	<form method="POST">
	Item ID <input type="text" name="itemid"/><br/>
	Name <input type="text" name="name"/><br/>
	Type <input type="text" name="type" value="DIAS"/><br/>
	Title <input type="titulo" name="titulo" value="0"/><br/>
	<input type="submit" value="input"/>
	</form>
	</body>
	</html>
	<?php
}
?>