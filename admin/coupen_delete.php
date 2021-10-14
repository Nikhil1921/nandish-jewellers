<?php
	include("layout/connect.php");                    
	$id = $_REQUEST['cid'];

 	$qry = "DELETE from code where co_id = '$id'";
 	$run = $connect->query($qry);
   	if($run == true)
    {
?>
        <script>
            alert('data deleted successfully');
            window.open('coupen_list.php','_self');
        </script>
<?php } ?> 