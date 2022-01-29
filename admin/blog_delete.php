<?php
    include("layout/connect.php");                    
    $id = $_REQUEST['bid'];
    $image = $_REQUEST['image'];

    $qry = "DELETE from blog where id = '$id'";
    $run = $connect->query($qry);
    if($run == true):
        if (file_exists("image/blog/$image"))
            unlink("image/blog/$image");
?>
        <script>
            alert('data deleted successfully');
            window.open('blog_list.php','_self');
        </script>
<?php endif; ?> 