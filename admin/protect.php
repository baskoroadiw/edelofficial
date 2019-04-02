<?php 
    if (!isset($_SESSION['admin'])) {
        echo "<script>location='login.php';</script>";
        exit();
    }
?>