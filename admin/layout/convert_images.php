<?php
require "connect.php";

require "thumbimage.php";

set_time_limit(0);

$imgs = array_diff(scandir('../image/product/'), array('..', '.'));

foreach ($imgs as $key => $img) {
	
	if (strpos($img, 'thumb_') !== false) {
		unlink('../image/product/'.$img);
	}else{
		/* $sql = "SELECT p_id FROM product WHERE p_image like '%".$img."%'";
		$run = $connect->query($sql);
		$data = $run->fetch_assoc();
		if($data){ */
			$objThumbImage = new ThumbImage("../image/product/$img");
			$objThumbImage->createThumb("../image/product/thumb_$img", 512);
			$objThumbImage->createThumb("../image/product/thumb_120_$img", 150);
		/* }else{
			unlink('../image/product/'.$img);
		} */
	}
}
echo "<pre>";
// print_r($imgs);
die;