<?php
ini_set('display_errors',0);
session_start();
require_once '../db_connection.php';


// add product
if (isset($_POST['addProductSubmit'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location_id = $_POST['location'];

    if (empty($name)){
        $_SESSION["product_error"] = 'Product name is required';
        header("location: add_product.php");
    }elseif (empty($price)){
        $_SESSION["product_error"] = 'Product price is required';
        header("location: add_product.php");
    }elseif (!is_numeric($price)){
        $_SESSION["product_error"] = 'Product price should be numeric';
        header("location: add_product.php");
    }elseif (empty($location_id)){
        $_SESSION["product_error"] = 'Location is required';
        header("location: add_product.php");
    }else{
        $insert_product = "INSERT INTO products (name, description, price, location_id)
                            VALUES('$name', '$description', '$price','$location_id')";

        $result = mysqli_query($conn, $insert_product);
        if ($result){
            header("location: index.php");
        }else{
            $_SESSION["product_error"] = 'Error to add product';
            header("location: add_product.php");
        }
    }
}

//change order status
if (isset($_POST['changeOrderStatus'])){
    $orderId = $_POST['orderId'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status='$status' WHERE id='$orderId'";
    $update = mysqli_query($conn, $sql);

    if ($update){
        header("location: orders.php");
    }else{
        echo "Error to change order status";
    }

}

//add location
if (isset($_POST['locationSubmit'])){
    $name = $_POST['name'];

    if (empty($name)){
        $_SESSION["location_error"] = 'Location name is required';
        header("location: locations.php");
    }else{
        $sql = "INSERT INTO locations (name) VALUES('$name')";

        $result = mysqli_query($conn, $sql);
        if ($result){
            $_SESSION["location_error"] = 'Location added successfully';
            header("location: locations.php");
        }else{
            $_SESSION["location_error"] = 'Error to add location';
            header("location: locations.php");
        }
    }
}