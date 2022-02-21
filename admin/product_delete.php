<?php
	include("layout/connect.php");                    
	$id = $_REQUEST['pid'];

 	$qry = "UPDATE product SET is_deleted = 1 WHERE p_id = '$id'";
 	$run = $connect->query($qry);
   	if($run == true)
    {
?>
    <script>
        alert('Data deleted successfully');
        window.open('product_list.php','_self');
    </script>
<?php } else { ?>
    <script>
        alert('Data delete not successful.');
        window.open('product_list.php','_self');
    </script>
<?php } ?>