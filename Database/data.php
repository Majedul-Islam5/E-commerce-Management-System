<?php
    $db_server="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="e_commerce_management_system";
    $conn="";
    
    $conn= new mysqli($db_server,$db_user,$db_pass,$db_name);
    if($conn->connect_error){
        die("Error Occured".$conn->connect_error);
    }
?>