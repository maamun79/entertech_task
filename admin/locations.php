<?php
session_start();
require '../include/head.php';
require_once '../db_connection.php';
include 'actions.php';

if (!isset($_SESSION['loggedUserId']) && $_SESSION['userType'] != 2){
    header('location: ../login.php');
}
?>
<style>
    table, th, td {
        border: 1px solid black;
        padding: 10px;
    }
    table{
        margin-top: 10px;
    }
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto;
        padding: 70px;
    }
    .grid-item {
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding: 20px;
        font-size: 20px;
        text-align: center;
    }
</style>
<div style="margin: 50px">
    <?php
    $sql = "SELECT * FROM locations";
    $result = mysqli_query($conn, $sql);
    ?>
    <a href="../logout.php">Logout</a>
    <h2>Products</h2>
    <a href="index.php" class="add_product">Products</a> |
    <a href="orders.php" class="add_product">Orders</a>

    <div class="grid-container">
        <div class="grid-item">
            <h4>Locations</h4>
            <table style="width:100%">
                <tr>
                    <th>ID</th>
                    <th>Location Name</th>
                </tr>
                <?php
                if (mysqli_num_rows($result)>0){
                    while ($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['name']?></td>
                        </tr>
                    <?php }
                }else{ ?>
                    <p>There is no location available</p>
                <?php } ?>

            </table>
        </div>

        <div class="grid-item">
            <h4>Add Location</h4>
            <?php
            if(isset($_SESSION["location_error"])){
                $error = $_SESSION["location_error"];
                echo "<span>$error</span>";
            }
            ?>
            <form action="actions.php" method="post">
                <div class="input_item">
                    <label for="name">Location Name*</label>
                    <input type="text" name="name" id="name" placeholder="Enter location name">
                </div>
                <div class="input_item">
                    <input type="submit" name="locationSubmit" value="Add">
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>