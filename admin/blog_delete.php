<?php

include("layout/connect.php");
$id = $_REQUEST['bid'];
$image = $_REQUEST['image'];

$qry = "DELETE from blog where id = '$id'";

if($connect->query($qry) == true):
    if (file_exists("image/blog/$image"))
        unlink("image/blog/$image");
    if (file_exists("image/blog/thumb_$image"))
        unlink("image/blog/thumb_$image");

    $msg = 'Data deleted successfully';
else:
    $msg = 'Data not deleted successfully';
endif;

echo '<script>
        alert("'.$msg.'");
        window.open("blog_list.php", "_self");
    </script>';