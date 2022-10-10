<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['user_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    

    $role="SELECT role FROM users WHERE user_id = {$outgoing_id}";
    $rolequery = mysqli_query($conn, $role);
    $row = mysqli_fetch_assoc($rolequery);
    if($row['role']=='patient'){
        $sql = "SELECT * FROM users WHERE NOT user_id = {$outgoing_id} AND role='doctor' AND (first_name LIKE '%{$searchTerm}%' OR last_name LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;

    }
    if($row['role']=='doctor'){
        $sql = "SELECT * FROM users WHERE NOT user_id = {$outgoing_id} AND role='patient' AND (first_name LIKE '%{$searchTerm}%' OR last_name LIKE '%{$searchTerm}%') ";
        $output = "";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            include_once "data.php";
        }else{
            $output .= 'No user found related to your search term';
        }
        echo $output;

    }



?>