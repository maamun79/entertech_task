<?php
require 'include/head.php';
require_once 'db_connection.php';
include 'actions.php';

$sql = "SELECT * FROM locations";
$result = mysqli_query($conn, $sql);
?>
<div class="login_form">
    <?php
        if(isset($_SESSION["signup_error"])){
            $error = $_SESSION["signup_error"];
            echo "<span>$error</span>";
        }
    ?>
    <h3>Registration</h3>
    <form action="actions.php" method="post">
        <div class="input_item">
            <label for="name">Name*</label>
            <input type="text" name="name" id="name" placeholder="Enter your name">
        </div>
        <div class="input_item">
            <label for="email">Email*</label>
            <input type="email" name="email" id="email" placeholder="Enter your email">
        </div>
        <div class="input_item">
            <label for="password">Password*</label>
            <input type="password" name="password" id="password" placeholder="Enter your password">
        </div>
        <div class="input_item">
            <label for="con_password">Confirm Password*</label>
            <input type="password" name="con_password" id="con_password" placeholder="Re-type password">
        </div>
        <div class="input_item">
            <label for="location">Choose your location*</label>
            <select name="location" id="location">
                <option value="">Select location</option>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                ?>
                            <option value="<?=$row['id']?>"><?=$row['name']?></option>
                <?php
                        }
                    }
                ?>
            </select>
        </div>
        <div class="input_item">
            <input type="submit" name="signupSubmit" value="Signup">
            <a href="login.php">Login</a>
        </div>
    </form>
</div>
</body>
</html>