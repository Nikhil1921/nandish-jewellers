<?php
	include("layout/connect.php");

	$innercat = $_GET['innercat'];
	$sql2 = "SELECT * FROM sub_innercategory where si_innercat_id = '$innercat'";
	$run2 = mysqli_query($connect,$sql2);
	$row = [];
	while ($data = mysqli_fetch_assoc($run2)) {
		$row[] = $data;
	}
	echo json_encode($row);