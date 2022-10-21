<?php
// session_start();
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "project";

$con = mysqli_connect("localhost", "root", "", "project" );
  // set the PDO error mode to exception
  if ($con === false) {
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}
  
  mysqli_query( $con, "SET NAMES UTF8" );

?>