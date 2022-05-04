<?php
include("layout/connect.php");
extract($_GET);

if(isset($cid)){
    $qry = "SELECT publish FROM `comments` WHERE id = '$cid'";
    $run = $connect->query($qry);
    $data = $run->fetch_assoc();
    if($data):
        $status = $data['publish'] == 0 ? 1 : 0;
        $qry = "UPDATE `comments` SET publish = '$status' WHERE id = '$cid'";
        if($connect->query($qry) == true)
            $msg = 'Data updated successfully';
        else
            $msg = 'Data updated successfully';
    else:
        $msg = 'Comment not found';
    endif;
}else{
    $msg = 'Comment not found';
}

echo '<script>
        alert("'.$msg.'");
        window.open("blog-comments.php", "_self");
    </script>';