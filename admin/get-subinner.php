<?php 
include("layout/connect.php");

$id = $_GET['id'];

$sql2 = "SELECT id, si_name AS name FROM blog_sub_inner_category where i_id = '$id'";
$run2 = mysqli_query($connect,$sql2);
$row = [];
while ($data = mysqli_fetch_assoc($run2)) {
    $row[] = $data;
}

die(json_encode($row));