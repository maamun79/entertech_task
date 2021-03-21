<?php
    session_start();
    unset($_SESSION["loggedUserId"]);
    unset($_SESSION["userType"]);
    unset($_SESSION["userLocationId"]);
    header("location: login.php");
