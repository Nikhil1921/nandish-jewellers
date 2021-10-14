<?php
	include("layout/connect.php");                    
	$id = $_REQUEST['cid'];

 	$qry = "DELETE from category where c_id = '$id'";
 	$run = $connect->query($qry);
   	if($run == true)
    {
?>
        <script>
            alert('data deleted successfully');
            window.open('category_list.php','_self');
        </script>
<?php } ?> 