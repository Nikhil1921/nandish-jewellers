<?php
	include("layout/connect.php");                    
	$id = $_REQUEST['scid'];

 	$qry = "DELETE from subcategory where sc_id = '$id'";
 	$run = $connect->query($qry);
   	if($run == true)
    {
?>
        <script>
            alert('data deleted successfully');
            window.open('subcategory_list.php','_self');
        </script>
<?php } ?> 