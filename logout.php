<?php
    session_start();
    require_once('include/connection.php');
    session_destroy();
    header("location: login.php");
    exit();
?>