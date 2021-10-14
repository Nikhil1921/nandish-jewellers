<?php
	include("layout/connect.php");

	$o_id = $_GET['o_id'];

	$sql = "SELECT * FROM orders where o_id = '$o_id' AND o_return = '1'";
	if(mysqli_query($connect,$sql))
	{
		$sql_up = "UPDATE orders SET o_status = '0' where o_id = '$o_id'";
		mysqli_query($connect,$sql_up);

		echo "<script>alert('Accept Order Successfully');window.open('index.php','_self');</script>";
	}
	else
	{
		echo "<script>alert('Your Order Is Not Accept Successfully');window.open('order_list.php','_self');</script>";
	}
?>
