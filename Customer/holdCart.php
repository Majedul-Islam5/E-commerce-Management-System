<?php
    session_start();

    include_once ('../Database/data.php');

    if (isset($_GET['p_id'])) 
    {
        $p_id = $_GET['p_id'];
        $userId=$_SESSION['userId'];

        $result=$conn->query("select * from customer_order where user_id='$userId' AND p_id=$p_id"); 
        $result=$result->fetch_all(MYSQLI_ASSOC);
        if(count($result)>0)
        {
            header("Location: cusDashboard.php");
        }
        else
        {
            $stmt = $conn->prepare("INSERT INTO customer_order (p_id,user_id) VALUES (?,?)");
            $stmt->bind_param("ii", $p_id, $userId);
            $stmt->execute();
            header("Location: cusDashboard.php");
        }
    }
?>