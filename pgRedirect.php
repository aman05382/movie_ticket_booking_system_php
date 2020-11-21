<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");



$checkSum = "";
$paramList = array();

$ORDER_ID = $_POST["ORDER_ID"];
$CUST_ID = $_POST["CUST_ID"];
$INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
$CHANNEL_ID = $_POST["CHANNEL_ID"];
$TXN_AMOUNT = $_POST["TXN_AMOUNT"];

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = "http://localhost/Railway_Reservation_System/pgResponse.php";

/*
$paramList["CALLBACK_URL"] = "http://localhost/PaytmKit/pgResponse.php";
$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
$paramList["EMAIL"] = $EMAIL; //Email ID of customer
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //

*/

//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

?>
<?php
//$id = $_POST['id'];
$link = mysqli_connect("localhost", "root", "", "cinema_db");

//$movieQuery = "SELECT * FROM movieTable WHERE movieID = $id";
//$movieImageById = mysqli_query($link, $movieQuery);
//$row = mysqli_fetch_array($movieImageById,TRUE);
?>
<?php
    $fNameErr = $pNumberErr = "";
	$fName = $pNumber = "";
	if (isset($_POST['submit'])) {


		$fName = $_POST['fName'];
		if (!preg_match('/^[a-zA-Z0-9\s]+$/', $fName)) {
			$fNameErr = 'Name can only contain letters, numbers and white spaces';
			echo "<script type='text/javascript'>alert('$fNameErr');</script>";
		}

		$pNumber = $_POST['pNumber'];
		if (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $pNumber)) {
			$pNumberErr = 'Phone Number can only contain numbers and white spaces';
			echo "<script type='text/javascript'>alert('$pNumberErr');</script>";
		}

		$insert_query = "INSERT INTO 
		bookingTable (  movieName,
						bookingTheatre,
						bookingType,
						bookingDate,
						bookingTime,
						bookingFName,
						bookingLName,
						bookingPNumber)
		VALUES (        '" . $_POST["movietitle"] . "',
						'" . $_POST["theatre"] . "',
						'" . $_POST["type"] . "',
						'" . $_POST["date"] . "',
						'" . $_POST["hour"] . "',
						'" . $_POST["fName"] . "',
						'" . $_POST["lName"] . "',
						'" . $_POST["pNumber"] . "')";
		mysqli_query($link, $insert_query);
	}
                    

                    
?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>