<?php
	include("layout/connect.php");                    
	$id = $_REQUEST['bid'];
	$image = $_REQUEST['image'];

 	$qry = "DELETE from banner where b_id = '$id'";
 	$run = $connect->query($qry);
   	if($run == true):
   		if (file_exists("image/banner/$image"))
   			unlink("image/banner/$image");
?>
        <script>
            alert('data deleted successfully');
            window.open('banner_list.php','_self');
        </script>
<?php endif; ?> 