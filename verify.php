<?php
  session_start();

  $fname = $_POST['fName'];
  $lname = $_POST['lName'];
  $email = $_POST['email'];
  $mobile = $_POST['pNumber'];
  $theatre = $_POST['theatre'];
  $type = $_POST['type'];
  $date = $_POST['date'];
  $time = $_POST['hour'];
  $title=$_POST[''];
  $order = "ORD" . rand(10000, 99999999);
 $cust  = "CUST" . rand(1000, 999999);


 $_SESSION['FNAME']=$fname;
 $_SESSION['LNAME']=$lname;
 $_SESSION['EMAIL']=$email;
 $_SESSION['MOBILE']=$mobile;
 $_SESSION['THEATRE']=$theatre;
 $_SESSION['TYPE']=$type;
 $_SESSION['DATE']=$date;
 $_SESSION['TIME']=$time;

 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Verify</title>
<meta name="GENERATOR" content="Evrsoft First Page">
</head>
<body>
<br><br>
        <h1>Proceed for Payment </h1>
        <br><br>
	
	<form method="post" action="pgRedirect.php">
		<table border="1" style="text-align: center;">
			<tbody>
				<tr>
					<th>S.No</th>
					<th>Label</th>
					<th>Value</th>
				</tr>
				<tr>
                        <td>1</td>
                        <td><label>ORDER_ID::*</label></td>
                        <td><?php echo $order; ?>
                            <input type="hidden" name="ORDER_ID" value="<?php echo $order; ?>">
                        </td>
                </tr>
				
				<tr>
                        <td>2</td>
                        <td><label>Name</label></td>
                        <td><?php echo $_POST['first_name'] . " " . $_POST['last_name']; ?></td>
				</tr>
				<tr>
                        <td>3</td>
                        <td><label>Website ::*</label></td>
                        <td>
                            <?php echo "ARVRcinemas"; ?>
                        </td>
				</tr>
				<tr>
                        <td>4</td>
                        <td><label>THEATRE ::*</label></td>
                        <td>
                            <?php echo $_POST['theatre']; ?>
                        </td>
				</tr>
				<tr>
                        <td>5</td>
                        <td><label>TYPE ::*</label></td>
                        <td>
                            <?php echo $_POST['type']; ?>
                        </td>
                </tr>
				<tr>
                        <td>6</td>
                        <td><label>txnAmount*</label></td>
                        <td>
                            <?php
                            if ($theatre == "main-hall") {
								$ta=200;
							}
							if ($theatre == "vip-hall") {
								$ta=500;
							}
							if ($theatre == "private-hall") {
								$ta=900;
							}
                          
                            ?>

                            <input type="text" name="TXN_AMOUNT" value="<?php echo $ta; ?>" readonly>
                            <input type="hidden" name="CUST_ID" value="<?php echo $cust; ?>">
                            <input type="hidden" name="INDUSTRY_TYPE_ID" value="retail">
                            <input type="hidden" name="CHANNEL_ID" value="WEB">

                        </td>
                </tr>
				
				<tr>
					<td></td>
					<td></td>
					<td><input value="CheckOut" type="submit"	onclick=""></td>
				</tr>
			</tbody>
		</table>
		* - Mandatory Fields
	</form>
</body>
</html>