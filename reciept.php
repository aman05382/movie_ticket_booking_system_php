<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>Recipt</title>
	<style>
		.invoice-box {
			max-width: 800px;
			margin: auto;
			padding: 30px;
			border: 1px solid #eee;
			box-shadow: 0 0 10px rgba(0, 0, 0, .15);
			font-size: 16px;
			line-height: 24px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
		}

		.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
		}

		.invoice-box table td {
			padding: 5px;
			vertical-align: top;
		}

		.invoice-box table tr td:nth-child(2) {
			text-align: right;
		}

		.invoice-box table tr.top table td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
		}

		.invoice-box table tr.information table td {
			padding-bottom: 40px;
		}

		.invoice-box table tr.heading td {
			background: #eee;
			border-bottom: 1px solid #ddd;
			font-weight: bold;
		}

		.invoice-box table tr.details td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.item td {
			border-bottom: 1px solid #eee;
		}

		.invoice-box table tr.item.last td {
			border-bottom: none;
		}

		.invoice-box table tr.total td:nth-child(2) {
			border-top: 2px solid #eee;
			font-weight: bold;
		}

		@media only screen and (max-width: 600px) {
			.invoice-box table tr.top table td {
				width: 100%;
				display: block;
				text-align: center;
			}

			.invoice-box table tr.information table td {
				width: 100%;
				display: block;
				text-align: center;
			}
		}

		/** RTL **/
		.rtl {
			direction: rtl;
			font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		}

		.rtl table {
			text-align: right;
		}

		.rtl table tr td:nth-child(2) {
			text-align: left;
		}

		.footer-brand {
			overflow: hidden;
		}

		.footer-brand:before {
			content: "";
			display: block;
			position: relative;
			background: #aa964c;
			box-shadow: 0px 8px 0px rgba(0, 0, 0, 0.1);
		}

		.footer-brand .footer-heading {
			position: relative;
			/* top: 0vmax;
			left: 1vmax; */
			padding: 0;
			margin: 0;
			color: #fff;
			font-size: 1em;
			font-family: "Lobster", cursive;
			text-shadow: 2px 2px 0px #6e5a11, 4px 4px 0px #836d24, 6px 6px 0px #a88616,
				8px 8px 0px #b08909, 10px 10px 0px #ab995e;
		}
	</style>
	<script src="_.js "></script>
</head>

<body>

	<div>
		<?php
include "connection.php";
$db = mysqli_select_db($con, "cinema_db");

		$qry = "select * from bookingtable where ORDERID = '" . $_GET['id'] . "'";
		if ((!$_GET['id'])) {
			echo "<script>alert('You are Not Suppose to come Here Directly');window.location.href='index.php';</script>";
		}
		$result = mysqli_query($con, $qry);
		if (mysqli_num_rows($result) == 0) {
			echo "No rows found, nothing to print so am exiting";
			exit;
		}
		while ($row = mysqli_fetch_assoc($result)) {
			$bookingid = $row['bookingID'];
			$movieID = $row['movieID'];
			$bookingFName = $row['bookingFName'];
			$bookingLName = $row['bookingLName'];
			$mobile = $row['bookingPNumber'];
			$email = $row['bookingEmail'];
			$date = $row['bookingDate'];
			$theatre = $row['bookingTheatre'];
			$type = $row['bookingType'];
			$time = $row['bookingTime'];
			$amount = $row['amount'];
			$ORDERID = $row['ORDERID'];
			$date = $row['DATE-TIME'];
		}
		
		?>
	</div>
	<br>
	<div class="invoice-box">
		<table cellpadding="0" cellspacing="0">
			<tr class="top">
				<td colspan="2">
					<table>
						<tr>
							<td class="title">
								<div class="footer-brand">
									<h1 class="footer-heading">ARVR Cinema</h1>
								</div>
							</td>
							<td>
								Invoice #: <?php echo $ORDERID; ?><br>
								Created: <?php date_default_timezone_set('Asia/Kolkata');
											echo $date = DATE("d-m-y h:i:s", strtotime($date));  ?><br>
								Due: <?php echo "After 24 Hours"; ?>
								<!-- 1 Day = 24*60*60 = 86400 -->
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class="information">
				<td colspan="2">
					<table>
						<tr>
							<td>
								ARVR Cinema<br>
								393 , Kohat Enclave<br>
								Delhi-110088
							</td>

							<td>
								<?php echo $bookingFName . ' ' . $bookingLName; ?><br>
								<?php echo $mobile; ?><br>
								<?php echo $email; ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr class="heading">
				<td>
					Payment Status
				</td>

				<td>
					Check #
				</td>
			</tr>

			<tr class="details">
				<td>
					Success
				</td>

				<td>
					<?php echo 'RS ' . $amount; ?>
				</td>
			</tr>

			<tr class="heading">
				<td>
					Movie Details
				</td>

				<td>
					Info
				</td>
			</tr>

			<tr class="item">
				<td>
					Movie Date
				</td>

				<td>
					<?php echo $date; ?>
				</td>
			</tr>

			<tr class="item">
				<td>
					Theatre Type
				</td>

				<td>
					<?php echo $theatre; ?> </td>
			</tr>

			<tr class="item last">
				<td>
					Movie Type
				</td>

				<td>
					<?php echo $type; ?>
				</td>
			</tr>

			<tr class="total">
				<td></td>

				<td>
					<!-- Total: $385.00 -->
				</td>
			</tr>

		</table>
		<?php
		include "phpqrcode/qrlib.php";
		QRcode::png("Bookingid=$bookingid,
		MovieID=$movieID,
		First Name=$bookingFName,
		Last Name=$bookingLName,
		Number=$mobile,
		Email=$email,
		date=$date,
		Theatre=$theatre,
		TYPE=$type,
		Time=$time,
		amount=$amount,
		OrderID=$ORDERID", "verify.png ", "L", 5, 5);
		echo "<img src='verify.png' width='auto' height='120'>";
		?>

	</div>
	
	<div style="max-width: 300px; margin:auto; padding: 30px;">
		<input type="button" class="btn btn-danger" onClick="window.print()" value="Print Recipt!" />
		<a type="button" class="btn btn-success" href='http://localhost/Railway_Reservation_System/'>Home-Page</a>
	</div>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>