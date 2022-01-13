<?php
	include("layout/connect.php");

	$cat = $_GET['cat'];
	$sql2 = "SELECT * FROM subcategory where sc_c_id = '$cat'";
	$run2 = mysqli_query($connect,$sql2);
	$row = [];
	while ($data = mysqli_fetch_assoc($run2)) {
		$row[] = $data;
	}
	echo json_encode($row);