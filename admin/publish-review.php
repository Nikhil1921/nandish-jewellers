<?php
include("layout/connect.php");
extract($_GET);

if(isset($pid)){
    $qry = "SELECT publish FROM `reviews` WHERE id = '$pid'";
    $run = $connect->query($qry);
    $data = $run->fetch_assoc();
    if($data):
        $status = $data['publish'] == 0 ? 1 : 0;
        $qry = "UPDATE `reviews` SET publish = '$status' WHERE id = '$pid'";
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
        window.open("reviews.php", "_self");
    </script>';