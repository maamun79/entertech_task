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
    $sql = "SELECT * FROM orders";
    $result = mysqli_query($conn, $sql);
    ?>
    <a href="../logout.php">Logout</a>
    <h2>Orders</h2>
    <a href="index.php" class="add_product">Products</a> |
    <a href="locations.php">Locations</a>
    <table style="width:100%">
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Product</th>
            <th>Order Total</th>
            <th>Status</th>
        </tr>
        <?php
        if (mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?=$row['order_id']?></td>
                    <?php
                        $sql = "SELECT name FROM users WHERE id= '".$row['user_id']."'";
                        $res = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_assoc($res);
                    ?>
                    <td><?=$user['name']?></td>
                    <?php
                        $pro_sql = "SELECT name FROM products WHERE id= '".$row['product_id']."'";
                        $res = mysqli_query($conn, $pro_sql);
                        $product = mysqli_fetch_assoc($res);
                    ?>
                    <td><?=$product['name']?></td>
                    <td><?=$row['order_total']?> Tk</td>
                    <td>
                        <form action="actions.php" method="post">
                            <input type="hidden" name="orderId" value="<?=$row['id']?>">
                            <select name="status" id="status">
                                <option value="1" <?=($row['status']==1?'selected':'')?>>Submitted</option>
                                <option value="2" <?=($row['status']==2?'selected':'')?>>In Transit</option>
                                <option value="3" <?=($row['status']==3?'selected':'')?>>Delivered</option>
                            </select>
                            <input type="submit" name="changeOrderStatus" value="Change status">
                        </form>
                    </td>

                </tr>
            <?php }
        }else{ ?>
            <p>There is no product available</p>
        <?php } ?>

    </table>

</div>
</body>
</html>