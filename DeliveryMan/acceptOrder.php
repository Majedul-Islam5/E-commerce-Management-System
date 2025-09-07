<?php
    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }

    if (isset($_GET['order_id']))
    {
        $order_id=$_GET['order_id'];
        $userId=$_SESSION['userId'];
        $status = "accepted";

        $stmt=$conn->prepare("update order_info set d_id=?,status=? WHERE order_id=?");
        $stmt->bind_param("isi", $userId,$status,$order_id);
        $stmt->execute();

        header("Location: deliDashBoard.php");
    }
?>