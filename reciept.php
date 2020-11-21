<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>Recipt</title>
</head>

<body>
	<div id="printableArea">
		<?php
		$conn = mysqli_connect("localhost", "root", "");
		$db = mysqli_select_db($conn, "test");

		$qry = "select * from users where ORDERID = '" . $_GET['id'] . "'";

		$result = mysqli_query($conn, $qry);
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<h2>Your Payment is Sucessfull</h2>";
			echo "Name= " . $row['FNAME'] . "." . $row['LNAME']. "<br>";
			echo "Email= " . $row['EMAIL'] . "<br>";
			echo "Mobile= " . $row['MOB'] . "<br>";
			echo "OrderID= " . $row['ORDERID'] . "<br>";
			echo "Date=" . $row['TXNDATE'] . "<br>";
			echo "Amount=" . $row['TXNAMOUNT'] . "<br>";
		}
		?>
	</div>
	<br>
	<input type="button" class="btn btn-danger" onclick="printDiv('printableArea')" value="Print Recipt!" />
	<a type="button" class="btn btn-success" href='http://localhost/Paytm_Payment_Gateway-PHP/'>Home-Page</a>



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="print.js"></script>
</body>

</html>