<?php
function test(){
	session_start();
	$bil1 = mt_rand(0, 20);
	$bil2 = mt_rand(0, 20);
	
	$quiz = $bil1 . " + " . $bil2;
	$bilr = $bil1 + $bil2;
	//echo $bil1 . " + " . $bil2;
	$baseimg  = imagecreatetruecolor(100, 37);
	$bgColor = imagecolorallocate($baseimg, rand(1, 255), rand(1, 255), rand(1, 255));
	$txtColor = imagecolorallocate($baseimg, 0, 0, 0);
	imagefilledrectangle($baseimg, 0, 0, 100, 38, $bgColor);
	imagestring($baseimg, 5, rand(0, 36), rand(0, 21), $quiz, $txtColor);
	$_SESSION['cap_code'] = $bilr;
	header("Content-type: image/jpeg");
	imagejpeg($baseimg);
	imagedestroy($baseimg);
}

function test2(){
	session_start();
	$ranStr = "";
	$string = "";
	$baseimg  = imagecreatetruecolor(60, 37);
	$bgColor = imagecolorallocate($baseimg, rand(1, 255), rand(1, 255), rand(1, 255));
	imagefilledrectangle($baseimg, 0, 0, 100, 38, $bgColor);
	for ($i = 0; $i < 6; $i++){
		$rand = substr(str_shuffle("123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,1);
		$ranStr = $ranStr . $rand;
		$txtColor = imagecolorallocate($baseimg, 0, 0, 0);
		imagestring($baseimg, rand(3, 5), $i * 9 + 3, 2 * rand(5, 10) - 5, $rand, $txtColor);
	}
	$_SESSION['captcha'] = strtolower($ranStr);
	header("Content-type: image/jpeg");
	imagejpeg($baseimg);
	imagedestroy($baseimg);
}
test2();

/*session_start();
$ranStr = "";
$cur = 0;
$resimg = "";
$baseimg  = imagecreatetruecolor(60, 37);
$bgColor = imagecolorallocate($baseimg, rand(1, 255), rand(1, 255), rand(1, 255));
imagefilledrectangle($baseimg, 0, 0, 60, 38, $bgColor);
for ($i = 0; $i < 6; $i++){
	$rand = substr(str_shuffle("123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,1);
	$ranStr = $ranStr . $rand;
	//$baseimg  = imagecreatetruecolor(60, 37);
	$bgColor = imagecolorallocate($baseimg, rand(1, 255), rand(1, 255), rand(1, 255));
	$txtColor = imagecolorallocate($baseimg, 0, 0, 0);
	imagefilledrectangle($baseimg, 0, 0, 60, 38, $bgColor);
	$ranX = rand(0 + $i * 2, 5 + $i);
	$ranY = rand(0 + $i * 2, 20 + $i);
	imagestring($baseimg, rand(3, 5), $ranX, $ranY, $ranStr, $txtColor);
	
	$rand = substr(str_shuffle("123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,1);
	$ranStr = $ranStr . $rand;
	$txtColor = imagecolorallocate($baseimg, 0, 0, 0);
	$ranX = rand(0 + $i, 5);
	$ranY = rand(0 + $i, 20);
	imagestring($baseimg, rand(3, 5), 0, 0, $ranStr, $txtColor);
}
//echo $ranStr;
$ranStrx = substr(str_shuffle("123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"),0,6);
$_SESSION['cap_code'] = $ranStr;
//$baseimg  = imagecreatetruecolor(60, 37);
//$newImage = imagecreatefromjpeg("img/cap_bg.jpg");
$bgColor = imagecolorallocate($baseimg, rand(1, 255), rand(1, 255), rand(1, 255));
$txtColor = imagecolorallocate($baseimg, 0, 0, 0);
imagefilledrectangle($baseimg, 0, 0, 60, 38, $bgColor);
//imagestring($baseimg, rand(3, 5), rand(0, 5), rand(0, 20), $ranStr, $txtColor);
header("Content-type: image/jpeg");
imagejpeg($baseimg);
imagedestroy($baseimg);*/
?>


