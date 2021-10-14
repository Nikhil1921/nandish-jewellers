<?php
	include("layout/connect.php");                    
	$id = $_REQUEST['tid'];

 	$qry = "DELETE from testimonial where t_id = '$id'";
 	$run = $connect->query($qry);
   	if($run == true)
    {
?>
        <script>
            alert('data deleted successfully');
            window.open('testimonial_list.php','_self');
        </script>
<?php } ?> 