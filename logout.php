<?php 

    session_start();
    unset($_SESSION['director_login']);
    unset($_SESSION['admin_login']);
    unset($_SESSION['tech_login']);
    header('location: signin.php');

?>