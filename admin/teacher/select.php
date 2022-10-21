<?php 
 include("dbcon.php");
 
	$bid =$_REQUEST["id_school"];
	
 	$sql2= "SELECT * FROM  class_room WHERE id_school = '$bid' "; 
	
 	$result2 = mysqli_query($con, $sql2); 
	
	while($row2 = mysqli_fetch_array($result2)) { 
	
	echo"<option value='$row2[0]'>" .$row2["class_name"]." </option>";
	}
 ?>