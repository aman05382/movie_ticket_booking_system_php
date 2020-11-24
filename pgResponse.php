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


if ($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is su</b>" . "<br/>";


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


		if (isset($_SESSION['MOVIEID'], $_SESSION['THEATRE'], $_SESSION['BOOKING_TYPE'], $_SESSION['BOOKING_DATE'], $_SESSION['BOOKING_TIME'], $_SESSION['FNAME'], $_SESSION['LNAME'], $_SESSION['MOBILE'], $_SESSION['EMAIL'])) {
			// 	echo  $_SESSION['BOOKING_TYPE'];
			// }
			$t1 = $_SESSION['MOVIEID'];
			$t6 = $_SESSION['FNAME'];
			$t7 = $_SESSION['LNAME'];
			$t9 = $_SESSION['EMAIL'];
			$t8 = $_SESSION['MOBILE'];
			$t2 = $_SESSION['THEATRE'];
			$t3 = $_SESSION['BOOKING_TYPE'];
			$t4 = $_SESSION['BOOKING_DATE'];
			$t5 = $_SESSION['BOOKING_TIME'];
			$t10 = $_POST['ORDERID'];

			echo "$t1";
			$qry = "INSERT INTO bookingtable(`movieID`, `bookingTheatre`, `bookingType`, `bookingDate`, `bookingTime`, `bookingFName`, `bookingLName`, `bookingPNumber`, `bookingEmail`, `ORDERID`)VALUES 
('$t1','$t2','$t3','$t4','$t5','$t6','$t7','$t8','$t9','$t10')";

			// $qry = "INSERT INTO `bookingtable`(`movieID`, `bookingTheatre`, `bookingType`, `bookingDate`, `bookingTime`, `bookingFName`, `bookingLName`, `bookingPNumber`, `bookingEmail`, `ORDERID`) VALUES 
			// ('" . $_SESSION['MOVIEID'] . "','" . $_SESSION['THEATRE'] . "','$bt','" . $_SESSION['BOOKING_DATE'] . "','" . $_SESSION['BOOKING_TIME'] . "','" . $_SESSION['FNAME'] . "','" . $_SESSION['LNAME'] . "','" . $_SESSION['MOBILE'] . "','" . $_SESSION['EMAIL'] . "', '" . $_POST['ORDERID'] . "')";
			echo "$qry";

			$payment = "INSERT INTO `payment`(`ORDERID`, `MID`, `TXNID`, `TXNAMOUNT`, `PAYMENTMODE`, `CURRENCY`, `TXNDATE`, `STATUS`, `RESPCODE`, `RESPMSG`, `GATEWAYNAME`, `BANKTXNID`, `BANKNAME`, `CHECKSUMHASH`) VALUES 
		('" . $_POST['ORDERID'] . "','" . $_POST['MID'] . "', '" . $_POST['TXNID'] . "','" . $_POST['TXNAMOUNT'] . "','" . $_POST['PAYMENTMODE'] . "','" . $_POST['CURRENCY'] . "','" . $_POST['TXNDATE'] . "','" . $_POST['STATUS'] . "','" . $_POST['RESPCODE'] . "','" . $_POST['RESPMSG'] . "','" . $_POST['GATEWAYNAME'] . "','" . $_POST['BANKTXNID'] . "','" . $_POST['BANKNAME'] . "','" . $_POST['CHECKSUMHASH'] . "')";


			echo "$payment";
			$rs = mysqli_query($conn, $qry);

			if ($rs) {
				header('Location: reciept.php?id=' . $_POST['ORDERID']);
			} else {
				echo "false";
			}
		}
		// 	if (mysqli_query($conn, $payment)) {
		// 		echo "suck";
		// 	} else {
		// 		echo "fuck";
		// 	}
		// }
		//push manager
		// header('Location: reciept.php?id=' . $_POST['ORDERID']);

		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	} else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	if (isset($_POST) && count($_POST) > 0) {
		foreach ($_POST as $paramName => $paramValue) {
			echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
} else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}
