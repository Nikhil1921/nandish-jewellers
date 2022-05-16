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
    $qry = "SELECT p_image from blog_imgs where b_id = '$id'";

    $result = $connect->query($qry);

    while($img = $result->fetch_assoc()) {
        if (file_exists("image/blog/".$img['p_image']))
            unlink("image/blog/".$img['p_image']);
        if (file_exists("image/blog/thumb_".$img['p_image']))
            unlink("image/blog/thumb_".$img['p_image']);
    }

    $connect->query("DELETE from blog_imgs where b_id = '$id'");

    $msg = 'Data deleted successfully';
else:
    $msg = 'Data not deleted successfully';
endif;

echo '<script>
        alert("'.$msg.'");
        window.open("blog_list.php", "_self");
    </script>';