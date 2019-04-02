<?php 
    if (!isset($_SESSION['login'])) {
        echo "<script>location='login.php';</script>";
        exit();
    }
?>