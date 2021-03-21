<?php
session_start();
require_once 'db_connection.php';


// register
if (isset($_POST['signupSubmit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];
    $location_id = $_POST['location'];

    if (empty($name)){
        $_SESSION["signup_error"] = 'Name is required';
        header("location: signup.php");
    }elseif (empty($email)){
        $_SESSION["signup_error"] = 'Email is required';
        header("location: signup.php");
    }elseif (empty($password)){
        $_SESSION["signup_error"] = 'Password is required';
        header("location: signup.php");
    }elseif (empty($con_password)){
        $_SESSION["signup_error"] = 'Confirm password is required';
        header("location: signup.php");
    }elseif (empty($con_password)){
        $_SESSION["signup_error"] = 'Confirm password is required';
        header("location: signup.php");
    }elseif ($password != $con_password){
        $_SESSION["signup_error"] = 'Password mismatch';
        header("location: signup.php");
    }elseif (empty($location_id)){
        $_SESSION["signup_error"] = 'Location is required';
        header("location: signup.php");
    }else{
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check_email);
        if (mysqli_num_rows($result) > 0){
            $_SESSION["signup_error"] = 'User is already exist! Try another email';
            header("location: signup.php");
        }else{
            $insert_user = "INSERT INTO users (name, email, password, password_plain, location_id)
                            VALUES('$name', '$email', '".md5($password)."', '$password', '$location_id')";

            $result = mysqli_query($conn, $insert_user);
            if ($result){
                $_SESSION["signup_error"] = 'Registered successfully! Please login';
                header("location: login.php");
            }
        }
    }
}

// login
if (isset($_POST['loginSubmit'])){
   $email = $_POST['email'];
   $password = md5($_POST['password']);

   if (empty($email)){
       $_SESSION["login_error"] = 'Email is required';
       header("location: login.php");
   }elseif (empty($password)){
       $_SESSION["login_error"] = 'Password is required';
       header("location: login.php");
   }else{
       $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
       $result = mysqli_query($conn, $sql);

       if (mysqli_num_rows($result) > 0){
           while ($row = mysqli_fetch_assoc($result)){
                if ($row['type'] == 2){
                    $_SESSION['loggedUserId'] = $row['id'];
                    $_SESSION['userType'] = $row['type'];
                    header('location: admin/index.php');
                }else{
                    $_SESSION['loggedUserId'] = $row['id'];
                    $_SESSION['userType'] = $row['type'];
                    $_SESSION['userLocationId'] = $row['location_id'];
                    header('location: index.php');
                }
           }
       }else{
           $_SESSION["login_error"] = 'Invalid email or password';
           header("location: login.php");
       }
   }
}

//order
if (isset($_POST['orderSubmit'])){
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];

    if (!isset($_SESSION['loggedUserId']) && $_SESSION['userType'] != 1){
        $_SESSION["login_error"] = 'Please login to buy product';
        header('location: login.php');
    }else{
        $order_insert = "INSERT INTO orders (order_id, user_id, product_id, order_total)
                        VALUES('".uniqid()."', '$user_id', '$product_id', '$price')";

        $result = mysqli_query($conn, $order_insert);

        if ($result){
            header('location: order_success.php');
        }else{
            echo 'Error to create order';
        }
    }
}

