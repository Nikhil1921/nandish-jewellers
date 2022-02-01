<?php
	include("layout/connect.php");                    
	$id = $_REQUEST['iid'];
    
 	$qry = "DELETE from innercategory where i_id = '$id'";
 	$run = $connect->query($qry);
   	if($run == true)
    {
?>
        <script>
            alert('data deleted successfully');
            window.open('innercategory_list.php','_self');
        </script>
<?php } ?>