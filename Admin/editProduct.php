<?php
    session_start();

    include_once ('../Database/data.php');

    if (isset($_GET['p_id']))
    {
        $p_id = $_GET['p_id'];
        
        $result=$conn->query("select * from product where p_id=$p_id"); 
        $result=$result->fetch_all(MYSQLI_ASSOC);

        $count=$result[0]['stock'];
        $count++;

        $stmt=$conn->prepare("UPDATE product SET stock=? WHERE p_id=?");
        $stmt->bind_param("ii", $count,$p_id);
        $stmt->execute();

        header("Location: adDashboard.php");
    }

?>