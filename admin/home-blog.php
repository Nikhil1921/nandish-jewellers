<?php
include("layout/connect.php");
extract($_GET);

if(isset($bid)){
    $qry = "SELECT for_homepage FROM `blog` WHERE id = '$bid'";
    $run = $connect->query($qry);
    $data = $run->fetch_assoc();
    if($data):
        $status = $data['for_homepage'] == 0 ? 1 : 0;
        $qry = "UPDATE `blog` SET for_homepage = '$status' WHERE id = '$bid'";
        if($connect->query($qry) == true)
            $msg = 'Data updated successfully';
        else
            $msg = 'Data updated successfully';
    else:
        $msg = 'Blog not found';
    endif;
}else{
    $msg = 'Blog not found';
}

echo '<script>
        alert("'.$msg.'");
        window.open("blog_list.php", "_self");
    </script>';