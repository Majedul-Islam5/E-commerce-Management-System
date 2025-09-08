<?php

    session_start();

    include_once ('../Database/data.php');

    if(!isset($_SESSION['userId'])) 
    {
        header("Location: ../Login.php");
        exit();
    }

    $result = $conn->query("select * from product");
    $result=$result->fetch_all(MYSQLI_ASSOC);

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $p_name=isset($_POST['p_name']) ? test_input($_POST['p_name']) : '';
    $price=isset($_POST['price']) ? test_input($_POST['price']) : '';
    $stock=isset($_POST['stock']) ? test_input($_POST['stock']) : '';
    $category=isset($_POST['category']) ? test_input($_POST['category']) : '';


    $errors="";
    if(empty($p_name)) 
    {
        $_SESSION['p_name'] = "Product name is empty";
        $errors="empty";
    }
    else
    {
        if(strlen($p_name)<4) 
        {
            $_SESSION['p_name']="Product name must be atleast 4 letters";
            $errors="empty";
        }

        foreach($result as $row)
        {
            if($row['p_name']==$p_name)
            {
                $_SESSION['p_name'] = "This Product Already Exits";
                $errors="empty";
            }
        }
    }

    if(empty($price)) 
    {
        $_SESSION['price']="Add the price of product";
        $errors="empty";
    }
    else
    {
        if(!preg_match("/^-?\d+$/", $price)) 
        {
            $_SESSION['price']="Price must be a valid integer";
            $errors="empty";
        }

        if($price<1) 
        {
            $_SESSION['price']="Price Must be Greater than 0";
            $errors="empty";
        }
    }

    if(empty($stock)) 
    {
        $_SESSION['stock']="Add the Quantity of product";
        $errors="empty";
    }
    else
    {
        if(!preg_match("/^-?\d+$/", $stock)) 
        {
            $_SESSION['stock'] = "Quantity must be a valid integer";
            $errors="empty";
        }
        if($stock <1) 
        {
            $_SESSION['stock'] = "Quantity Must be Greater than 0";
            $errors="empty";
        }
    }

    if(empty($category)) 
    {
        $_SESSION['category'] = "Category is empty";
        $errors="empty";
    }
    else
    {
        if(!preg_match("/^[a-zA-Z]+$/", $category)) 
        {
            $_SESSION['category'] = "Category name can contain only letters";
            $errors="empty";
        }
        if(strlen($category) < 2) 
        {
            $_SESSION['category'] = "Category must be atleast 2 letters";
            $errors="empty";
        }
    }

    if (!isset($_FILES['product']) ||  $_FILES['product']['error'] !== UPLOAD_ERR_OK) 
    {
    
        $_SESSION['product'] = "Please upload a product image.";
        $errors="empty";
    }
    else
    {
        $fileName=$_FILES["product"]["name"];
        $folder="../Image/".$fileName;

        if (file_exists($folder)) 
        {
            $_SESSION['product'] = "This file already exists. Rename your file.";
            $errors="empty";
        }

        foreach($result as $row)
        {
            if($row['image_url']==$fileName)
            {
                $_SESSION['product'] = "This file already exists. Rename your file.";
                $errors="empty";
            }
        }
    }

    if (!empty($errors)) 
    {
        header("Location: adAddProduct.php");
        exit();
    }
    else
    {
        
        move_uploaded_file($_FILES["product"]["tmp_name"],$folder);

        $stmt=$conn->prepare("insert into product (p_name,price,image_url,stock,category) values (?,?,?,?,?)");
        $stmt->bind_param("sdsis",$p_name,$price,$fileName,$stock,$category);
        $stmt->execute();

        header("Location: adAddProduct.php");
        
    }




?>