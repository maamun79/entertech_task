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
</style>
<div style="margin: 50px">
    <?php
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);
    ?>
    <a href="../logout.php">Logout</a>
    <h2>Products</h2>
    <a href="add_product.php" class="add_product">Add Product</a> |
    <a href="orders.php" class="add_product">Orders</a> |
    <a href="locations.php">Locations</a>
    <table style="width:100%">
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Unit Price</th>
            <th>Location</th>
            <th>Total Ordered</th>
        </tr>
        <?php
            if (mysqli_num_rows($result)>0){
                while ($row = mysqli_fetch_assoc($result)){
        ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['name']?></td>
                    <td><?=$row['description']?></td>
                    <td><?=$row['price']?></td>
                    <?php
                        $sql = "SELECT name FROM locations WHERE id= '".$row['location_id']."'";
                        $res = mysqli_query($conn, $sql);
                        $location = mysqli_fetch_assoc($res);
                    ?>
                    <td><?=$location['name']?></td>
                    <?php
                        $order_sql = "SELECT * FROM orders WHERE product_id='".$row['id']."'";
                        $order_res = mysqli_query($conn, $order_sql);
                    ?>
                    <td><?=mysqli_num_rows($order_res)?></td>
                </tr>
        <?php }
            }else{ ?>
                <p>There is no product available</p>
        <?php } ?>

    </table>

</div>
</body>
</html>