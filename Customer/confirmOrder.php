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

    if(isset($_POST['button']) && $_POST['button']=="order")
    {

        if(empty(trim($_POST['cardPayment'])) && empty($_POST['onlinePayment']))
        {
            $_SESSION['pay']="Select a payment option";
            header("Location: viewCart.php");
            exit();
        }

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

        $delivary=$_POST['delivary'];
        $total=$_POST['total'];

        $stmt=$conn->prepare("INSERT INTO order_info (c_id,status,product_cost,delivery_fee) VALUES (?,?,?,?)");
        $stmt->bind_param("isdd", $userId, $status,$total,$delivary);
        $stmt->execute();

        $stmt=$conn->prepare("DELETE FROM customer_order where user_id=?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        header("Location: cusDashboard.php");
    }
    else
    {
        $id=$_POST['button'];
        $stmt=$conn->prepare("DELETE FROM customer_order where user_id=? AND p_id=?");
        $stmt->bind_param("ii",$userId, $id);
        $stmt->execute();

        header("Location: viewCart.php");
    }

    
?>