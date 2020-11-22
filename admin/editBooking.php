<?php
require('config.php');
$id = $_REQUEST['bookingID'];
$query = "SELECT * from bookingtable where bookingID='" . $id . "'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
</head>

<body>
    <div class="form">
        <p><a href="view.php">Dashboard</a>
            |<h1>Update Record</h1>
        <?php
        $status = "";
        if (isset($_POST['new']) && $_POST['new'] == 1) {
            $id = $_REQUEST['bookingID'];
            $trn_date = date("Y-m-d H:i:s");
            $name = $_REQUEST['name'];
            $age = $_REQUEST['age'];
            $submittedby = $_SESSION["username"];
            $update = "update new_record set trn_date='" . $trn_date . "',
name='" . $name . "', age='" . $age . "',
submittedby='" . $submittedby . "' where bookingID='" . $id . "'";
            mysqli_query($con, $update);
            $status = "Record Updated Successfully. </br></br>
<a href='view.php'>View Updated Record</a>";
            echo '<p style="color:#FF0000;">' . $status . '</p>';
        } else {
        ?>
            <div>
                <form name="form" method="post" action="">
                    <input type="hidden" name="new" value="1" />
                    <input name="id" type="hidden" value="<?php echo $row['bookingID']; ?>" />
                    <p><input type="text" name="name" placeholder="Enter Name" required value="<?php echo $row['name']; ?>" /></p>
                    <p><input type="text" name="age" placeholder="Enter Age" required value="<?php echo $row['age']; ?>" /></p>
                    <p><input name="submit" type="submit" value="Update" /></p>
                </form>
            <?php } ?>
            </div>
    </div>
</body>

</html>