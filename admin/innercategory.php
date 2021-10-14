<?php
	include("layout/connect.php");

	$subcat = $_POST['subcat'];
	$sql2 = "SELECT * FROM innercategory where i_sub_id = '$subcat'";
	$run2 = mysqli_query($connect,$sql2);
	$row = [];
	while ($data = mysqli_fetch_assoc($run2)) {
		$row[] = $data;
	}
	echo json_encode($row);