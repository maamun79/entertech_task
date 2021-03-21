<?php
require 'include/head.php';
require_once 'db_connection.php';
include 'actions.php';
?>
<div style="margin: 50px">
    <?php
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);

        if (isset($_SESSION['loggedUserId']) && $_SESSION['userType'] == 1){
    ?>
            <a href="logout.php">Logout</a>
    <?php }else{
    ?>
            <a href="login.php">Login</a>
    <?php } ?>

    <h2>Products</h2>
    <div class="grid-container">
        <?php
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
        ?>
                <div class="grid-item">
                    <h5><?=$row['name']?></h5>
                    <small><?=$row['description']?></small>
                    <?php
                        $loc_sql = "SELECT * FROM locations WHERE id='".$row['location_id']."'";
                        $loc_res = mysqli_query($conn, $loc_sql);
                        $loc = mysqli_fetch_assoc($loc_res);
                    ?>
                    <p>Location: <?=$loc['name']?></p>
                    <p>
                        <strong>Price:
                            <?=(isset($_SESSION['userLocationId']) && $_SESSION['userLocationId'] == $row['location_id']?
                                '<s>'.$row['price']. 'Tk</s> ' .($row['price']-(($row['price']/100)*25)).' Tk (<small>25% off for local customer</small>)':$row['price'].' Tk')?>
                        </strong>
                    </p>
                    <form action="actions.php" method="post">
                        <input type="hidden" name="product_id" value="<?=$row['id']?>">
                        <input type="hidden" name="user_id" value="<?=(isset($_SESSION['loggedUserId']) && $_SESSION['userType'] == 1?$_SESSION['loggedUserId']:'')?>">
                        <input type="hidden" name="price" value="<?=(isset($_SESSION['userLocationId']) && $_SESSION['userLocationId'] == $row['location_id']?($row['price']-(($row['price']/100)*25)):$row['price'])?>">
                        <input type="submit" name="orderSubmit" value="Buy Now">
                    </form>
                </div>
        <?php }
            }else{
        ?>
                <p>No Product available</p>
        <?php }
        ?>
    </div>

</div>
</body>
</html>