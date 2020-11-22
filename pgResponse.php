<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";


		if (isset($_POST['ORDERID'],$_POST['MID'],$_POST['TXNID'],$_POST['TXNAMOUNT'],$_POST['PAYMENTMODE'],$_POST['CURRENCY'],$_POST['TXNDATE'],$_POST['STATUS'],$_POST['RESPCODE'],$_POST['RESPMSG'],$_POST['GATEWAYNAME'],$_POST['BANKTXNID'],$_POST['BANKNAME'],$_POST['CHECKSUMHASH'])) {
			session_start();
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
			// $qry = "INSERT INTO `users`(`FNAME`, `LNAME`, `ADDRESS`, `EMAIL`, `MOB`, `EVENTS`, `ORDERID`, `MID`, `TXNID`, `TXNAMOUNT`, `PAYMENTMODE`, `CURRENCY`, `TXNDATE`, `STATUS`, `RESPCODE`, `RESPMSG`, `GATEWAYNAME`, `BANKTXNID`, `BANKNAME`, `CHECKSUMHASH`) VALUES 
			// ('" . $_SESSION['FNAME'] . "','" . $_SESSION['LNAME'] . "','" . $_SESSION['ADDR'] . "','" . $_SESSION['EMAIL'] . "','" . $_SESSION['MOBILENO'] . "','" . $_SESSION['EVENTS'] . "','" . $_POST['ORDERID'] . "','" . $_POST['MID'] . "', '" . $_POST['TXNID'] . "','" . $_POST['TXNAMOUNT'] . "','" . $_POST['PAYMENTMODE'] . "','" . $_POST['CURRENCY'] . "','" . $_POST['TXNDATE'] . "','" . $_POST['STATUS'] . "','" . $_POST['RESPCODE'] . "','" . $_POST['RESPMSG'] . "','" . $_POST['GATEWAYNAME'] . "','" . $_POST['BANKTXNID'] . "','" . $_POST['BANKNAME'] . "','" . $_POST['CHECKSUMHASH'] . "')";

			$qry = "INSERT INTO `bookingtable`(`movieID`, `bookingTheatre`, `bookingType`, `bookingDate`, `bookingTime`, `bookingFName`, `bookingLName`, `bookingPNumber`, `bookingEmail`, `ORDERID`) VALUES 
			('" . $_SESSION['MOVIEID'] . "','" . $_SESSION['THEATRE'] . "','" . $_SESSION['BOOKING_TYPE'] . "','" . $_SESSION['BOOKING_DATE'] . "','" . $_SESSION['BOOKING_TIME'] . "','" . $_SESSION['FNAME'] . "','" . $_SESSION['LNAME'] . "','" . $_SESSION['MOBILE'] . "','" . $_SESSION['EMAIL'] . "', '" . $_POST['ORDERID'] . "')";


			mysqli_query($conn, $qry);

			$payment = "INSERT INTO `payment`(`ORDERID`, `MID`, `TXNID`, `TXNAMOUNT`, `PAYMENTMODE`, `CURRENCY`, `TXNDATE`, `STATUS`, `RESPCODE`, `RESPMSG`, `GATEWAYNAME`, `BANKTXNID`, `BANKNAME`, `CHECKSUMHASH`) VALUES 
			('" . $_POST['ORDERID'] . "','" . $_POST['MID'] . "', '" . $_POST['TXNID'] . "','" . $_POST['TXNAMOUNT'] . "','" . $_POST['PAYMENTMODE'] . "','" . $_POST['CURRENCY'] . "','" . $_POST['TXNDATE'] . "','" . $_POST['STATUS'] . "','" . $_POST['RESPCODE'] . "','" . $_POST['RESPMSG'] . "','" . $_POST['GATEWAYNAME'] . "','" . $_POST['BANKTXNID'] . "','" . $_POST['BANKNAME'] . "','" . $_POST['CHECKSUMHASH'] . "')";

			mysqli_query($conn, $payment);
			
			header('Location: reciept.php?id=' . $_POST['ORDERID']);
		}

		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}
