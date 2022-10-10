<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['user_id'];
    $role="SELECT role FROM users WHERE user_id = {$outgoing_id}";
    $rolequery = mysqli_query($conn, $role);
    $row = mysqli_fetch_assoc($rolequery);
    if($row['role']=='patient'){
        $sql = "SELECT * FROM users WHERE NOT user_id = {$outgoing_id} AND role='doctor' ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;

    }
    if($row['role']=='doctor'){
        $sql = "SELECT * FROM users WHERE NOT user_id = {$outgoing_id} AND role='patient' ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;

    }
    
?>