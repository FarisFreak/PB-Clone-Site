<?php
$cur = 0;
$x = 1;
$y = 1;
$sel = $_GET['no'] ?? 0;
$sel2 = $_GET['type'] ?? 'player';
header('Content-Type: image/png');
if ($sel2 == "player"){
	for ($i = 0; $i <= 100; $i++){
		$im = imagecreatefrompng('../images/icon_rank/level_icon.png');
		$im2 = imagecrop($im, ['x' => $x, 'y' => $y, 'width' => 20, 'height' => 20]);
		if ($im2 !== FALSE) {
			if ($i == $sel){
				imagepng($im2);
				imagedestroy($im2);
				imagedestroy($im);
			}
		}
		$x += 24;
		//$y += 20;
		$cur++;
		imagedestroy($im);
		if ($cur > 9){
			$x = 1;
			$y +=24;
			$cur = 0;
		}
	}
}elseif ($sel2 == "clan"){
	for ($i = 0; $i <= 50; $i++){
		$im = imagecreatefrompng('../images/icon_rank/clan_level.png');
		$im2 = imagecrop($im, ['x' => $x, 'y' => $y, 'width' => 20, 'height' => 20]);
		if ($im2 !== FALSE) {
			if ($i == $sel){
				imagepng($im2);
				imagedestroy($im2);
				imagedestroy($im);
			}
		}
		$x += 21;
		//$y += 20;
		$cur++;
		imagedestroy($im);
		if ($cur > 11){
			$x = 1;
			$y +=21;
			$cur = 0;
		}
	}
}
?>

