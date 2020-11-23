<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
	       $fname = $_POST['fName'];
            $lname = $_POST['lName'];
            $email = $_POST['email'];
            $mobile = $_POST['pNumber'];
            $theatre = $_POST['theatre'];
            $type = $_POST['type'];
            $date = $_POST['date'];
            $time = $_POST['hour'];
            $movieid = $_POST['movie_id'];
            $amount = $_POST['cash'];
            $order = "ORD" . rand(10000, 99999999);
            
            
			$qry = "INSERT INTO `bookingtable`(`movieID`, `bookingTheatre`, `bookingType`, `bookingDate`, `bookingTime`, `bookingFName`, `bookingLName`, `bookingPNumber`, `bookingEmail`, `ORDERID`) VALUES  
			('$movieid', '$theatre', '$type', '$date', '$time', '$fname', '$lname', '$mobile','$email', '$order')";

			$payment = "INSERT INTO `payment`(`ORDERID`,`TXNAMOUNT`, `PAYMENTMODE`) VALUES 
			('$order', '$amount, 'CASH')";

            mysqli_query($conn, $payment);
			mysqli_query($conn, $qry);
            
            echo "Success";
            header('Location: add.php');

        }
?>