<?php
    require 'include/head.php';
    include 'actions.php';
?>
<a href="index.php">Home</a>
<div class="login_form">
            <?php
                if(isset($_SESSION["login_error"])){
                    $error = $_SESSION["login_error"];
                    echo "<span>$error</span>";
                }
            ?>
            <div>
                <h4>Login Credentials (Demo accounts)</h4>
                <p>User email : maamun79@gmail.com</p>
                <p>User password : 123</p>

                <p>Admin email : admin@gmail.com</p>
                <p>Admin password : 123</p>
            </div>

            <h3>Login</h3>
            <form action="actions.php" method="post">
                <div class="input_item">
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email">
                </div>
                <div class="input_item">
                    <label for="password">Password*</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password">
                </div>
                <div class="input_item">
                    <input type="submit" name="loginSubmit" value="Login">
                    <a href="signup.php">Register</a>
                </div>
            </form>
        </div>
    </body>
</html>