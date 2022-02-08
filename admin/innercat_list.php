<?php
    include("layout/connect.php");
    $connect = new PDO('mysql:host=localhost;dbname='.$db, $db_user, $db_pass);
    $output = array();

    $table = "innercategory ic";
    $select_column = 'ic.i_id, c.c_name, sc.sc_name, ic.i_name, ic.i_show';
    $search_column = ['c.c_name', 'sc.sc_name', 'ic.i_name', 'ic.i_show'];
    $order_column = ['ic.i_id', 'c.c_name', 'sc.sc_name', 'ic.i_name', 'ic.i_show'];
    $order = 'ic.i_sort ASC';
    $query = "SELECT $select_column FROM $table ";
    
    $query .= "INNER JOIN category c ON ic.i_cat_id = c.c_id ";
    $query .= "INNER JOIN subcategory sc ON ic.i_sub_id = sc.sc_id ";
    
    foreach($search_column as $i => $item):
        if($_GET['search']['value']) 
        {
            if($i===0) 
            {
                $query .= "WHERE (";
                $query .= "$item LIKE '%".$_GET["search"]["value"]."%' ";
            }
            else
            {
                $query .= "OR $item LIKE '%".$_GET["search"]["value"]."%'";
            }

            if(count($search_column) - 1 == $i) 
                $query .= ") ";
        }
    endforeach;
    
    if(isset($_GET["order"]))
    {
        $query .= "ORDER BY ".$order_column[$_GET['order'][0]['column']]." ".$_GET['order'][0]['dir']." ";
    }
    else
    {
        $query .= 'ORDER BY '.$order.' ';
    }
    
    $statement = $connect->prepare($query);

    $statement->execute();

    $filtered_rows = $statement->rowCount();

    if($_GET["length"] != -1)
    {
        $query .= 'LIMIT ' . $_GET['start'] . ', ' . $_GET['length'];
    }
    
    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    foreach($result as $k => $row)
    {
        $sub_array = array();
        $sub_array[] = ++$_GET['start'];
        $sub_array[] = '<span id="'.$row["i_id"].'">'.$row['c_name'].'</span>';
        $sub_array[] = $row['sc_name'];
        $sub_array[] = $row['i_name'];
        $sub_array[] = $row['i_show'];
        $sub_array[] = '<a href="innercategory_edit.php?iid='.$row["i_id"].'" class="btn btn-warning btn-link btn-icon"><i class="fa fa-edit"></i></a>
                        <a href="innercategory_delete.php?iid='.$row["i_id"].'" class="btn btn-danger btn-link btn-icon"><i class="fa fa-times"></i></a>';
        $output[] = $sub_array;
    }

    $data = array(
        "draw"    => intval($_GET["draw"]),
        "recordsTotal"  => get_total_all_records($connect),
        "recordsFiltered" => $filtered_rows,
        "data"    => $output
    );

    die(json_encode($data));

    function get_total_all_records($connect)
    {
        $statement = $connect->prepare('SELECT i_id FROM innercategory');
        $statement->execute();
        return $statement->rowCount();
    }