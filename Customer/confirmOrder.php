<?php

    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }

    $userId=$_SESSION['userId'];
    $status="ordered";

    $sql="select * from customer_order where user_id=$userId";
    $result = $conn->query($sql);
    $result=$result->fetch_all(MYSQLI_ASSOC);

    foreach($result as $row)
    {
        $p_id=$row['p_id'];
        $opt=$conn->query("select stock from product where p_id=$p_id");
        $opt=$opt->fetch_all(MYSQLI_ASSOC);
        $count=$opt[0]['stock'];
        $count--;

        $stmt=$conn->prepare("UPDATE product SET stock=? WHERE p_id=?");
        $stmt->bind_param("ii", $count,$row['p_id']);
        $stmt->execute();
    }

    

    $stmt=$conn->prepare("INSERT INTO order_info (c_id,status) VALUES (?,?)");
    $stmt->bind_param("is", $userId, $status);
    $stmt->execute();

    $stmt=$conn->prepare("DELETE FROM customer_order where user_id=?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    header("Location: cusDashboard.php");
?>