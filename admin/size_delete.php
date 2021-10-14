<?php
	include("layout/connect.php");                    
	$id = $_REQUEST['sid'];

 	$qry = "DELETE from size where s_id = '$id'";
 	$run = $connect->query($qry);
   	if($run == true)
    {
?>
        <script>
            alert('data deleted successfully');
            window.open('size_list.php','_self');
        </script>
<?php } ?> 