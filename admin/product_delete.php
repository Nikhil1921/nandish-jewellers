<?php
	include("layout/connect.php");                    
	$id = $_REQUEST['pid'];

 	$qry = "DELETE from product where p_id = '$id'";
 	$run = $connect->query($qry);
   	if($run == true)
    {
?>
        <script>
            alert('data deleted successfully');
            window.open('product_list.php','_self');
        </script>
<?php } ?> 