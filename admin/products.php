<?php
    include("layout/connect.php");
    $connect = new PDO('mysql:host=localhost;dbname='.$db, $db_user, $db_pass);
    $output = array();

    $table = "product p";
    $select_column = 'p.p_id, c.c_name, sc.sc_name, p.p_name, p.p_code, p.p_gram';
    $search_column = ['c.c_name', 'sc.sc_name', 'p.p_name', 'p.p_code', 'p.p_gram'];
    $order_column = ['p.p_id', 'c.c_name', 'sc.sc_name', 'p.p_name', 'p.p_code', 'p.p_gram', 'p.p_id'];
    $order = 'p.p_sort ASC';
    $query = "SELECT $select_column FROM $table ";
    
    $query .= "INNER JOIN category c ON p.p_cat = c.c_id ";
    $query .= "INNER JOIN subcategory sc ON p.p_subcat = sc.sc_id ";
    
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
        $sub_array[] = '<span id="'.$row["p_id"].'">'.$row['c_name'].'</span>';
        $sub_array[] = $row['sc_name'];
        $sub_array[] = $row['p_name'];
        $sub_array[] = $row['p_code'];
        $sub_array[] = $row['p_gram'];
        $sub_array[] = '<a href="product_image.php?pid='.$row["p_id"].'" class="btn btn-warning btn-link btn-icon"><i class="fa fa-image"></i></a>
                        <a href="product_edit.php?pid='.$row["p_id"].'" class="btn btn-warning btn-link btn-icon"><i class="fa fa-edit"></i></a>';
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
        $statement = $connect->prepare('SELECT p_id FROM product');
        $statement->execute();
        return $statement->rowCount();
    }