<?php
	include("layout/connect.php");

	$o_id = $_GET['o_id'];

	$sql = "SELECT u_f_name, u_m_name, u_l_name, o_invoice, u_mobile FROM orders o INNER JOIN user u ON o.o_u_id = u.u_id where o_id = '$o_id' AND o_status = 0";

	if($result = mysqli_query($connect, $sql))
	{
		$order = (object) mysqli_fetch_assoc($result);
		$sql_up = "UPDATE orders SET o_status = '1' where o_id = '$o_id'";
		mysqli_query($connect,$sql_up);
		$sms = "Hello $order->u_f_name $order->u_m_name $order->u_l_name, your Jewelery Order $order->o_invoice has been receive , thank u for shopping with nandish.in";
		$contact = $order->u_mobile;
		send_sms($contact, $sms, "1707163332294252963");
		echo "<script>alert('Accept Order Successfully');window.open('index.php','_self');</script>";
	}
	else
	{
		echo "<script>alert('Your Order Is Not Accept Successfully');window.open('index.php','_self');</script>";
	}