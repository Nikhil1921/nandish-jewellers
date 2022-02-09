<?php
switch ($_SERVER['HTTP_HOST']) {
	case 'localhost':
		$db_user = 'root';
		$db_pass = '';
		$db = 'nandish';
		break;
	case 'nandish.in':
	case 'www.nandish.in':
		$db_user = 'nandish';
		$db_pass = 'c?T4mAs*.3+.';
		$db = 'denseeqq_nandish';
		break;
	
	default:
		$db_user = 'nandish';
		$db_pass = 'c?T4mAs*.3+.';
		$db = 'test_nandish';
		break;
}

$connect = mysqli_connect("localhost", $db_user, $db_pass, $db) or die("database is not connected");

require "thumbimage.php";

set_time_limit(0);

$imgs = array_diff(scandir('../image/product/'), array('..', '.'));

foreach ($imgs as $key => $img) {
	$sql = "SELECT * FROM product WHERE p_image like '%".$img."%'";
	$run = $connect->query($sql);
	$data = $run->fetch_assoc();
	if($data){
		$objThumbImage = new ThumbImage("../image/product/$img");
		$objThumbImage->createThumb("../image/product/thumb_$img", 512);
		$objThumbImage->createThumb("../image/product/thumb_120_$img", 120);
	}else{
		unlink('../image/product/'.$img);
	}
}
echo "<pre>";
print_r($imgs);
die;