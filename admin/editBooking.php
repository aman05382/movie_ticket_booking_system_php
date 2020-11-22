<?php
require('config.php');
$id=$_REQUEST['bookingID'];
$query = "SELECT * from bookingtable where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>