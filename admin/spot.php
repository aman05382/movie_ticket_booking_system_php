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

if (isset($_POST['submit'])) {
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
    $order = "cash";



    $qry = "INSERT INTO `bookingtable`(`movieID`, `bookingTheatre`, `bookingType`, `bookingDate`, `bookingTime`, `bookingFName`, `bookingLName`, `bookingPNumber`, `bookingEmail`,`amount`, `ORDERID`) VALUES  
			('$movieid', '$theatre', '$type', '$date', '$time', '$fname', '$lname', '$mobile','$email', '$amount' ,'$order')";


    $rs = mysqli_query($conn, $qry);

    // $payment = "INSERT INTO `payment`(`ORDERID`, `MID`, `TXNID`, `TXNAMOUNT`, `PAYMENTMODE`, `CURRENCY`, `TXNDATE`, `STATUS`, `RESPCODE`, `RESPMSG`, `GATEWAYNAME`, `BANKTXNID`, `BANKNAME`, `CHECKSUMHASH`) VALUES 
    // ('$order', NULL, NULL, '$amount', 'CASH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";

    if ($rs) {
        // if (mysqli_query($conn, $payment)) {
        //     echo "Success";
        // } else {
        //     echo "no";
        // }
        header('Location: add.php');
    }
} else {
    echo "error" . mysqli_error($conn);
}
