<?php
    require 'include/head.php';
    require_once '../db_connection.php';
    include 'actions.php';
    if (!isset($_SESSION['loggedUserId']) && $_SESSION['userType'] != 2){
        header('location: ../login.php');
    }
    $sql = "SELECT * FROM locations";
    $result = mysqli_query($conn, $sql);
?>
<div class="login_form">
    <a href="index.php">Back</a><br>
    <?php
    if(isset($_SESSION["product_error"])){
        $error = $_SESSION["product_error"];
        echo "<span>$error</span>";
    }
    ?>
    <h3>Add Product</h3>
    <form action="actions.php" method="post">
        <div class="input_item">
            <label for="name">Name*</label>
            <input type="text" name="name" id="name" placeholder="Enter product name">
        </div>
        <div class="input_item">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="20" rows="4"></textarea>
        </div>
        <div class="input_item">
            <label for="price">Unit Price*</label>
            <input type="text" name="price" id="price" placeholder="Enter unit price">
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
            <input type="submit" name="addProductSubmit" value="Add">
        </div>
    </form>
</div>
</body>
</html>