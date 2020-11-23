<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>update</title>
</head>

<body>
    <div class="admin-section-header">
        <div class="admin-logo">
            BUE Cinema
        </div>
        <div class="admin-login-info">
            <div style="padding: 0 20px;"><h2><a href="#">Admin Panel</a></h2></div>
            <form method='post' action="">
                <input type="submit" value="Logout" class="btn btn-outline-warning" name="but_logout">
            </form>
            <img class="admin-user-avatar" src="../img/avatar.png" alt="">
        </div>
        
    </div>
    <div class="admin-container">
        <?php include('sidebar.php'); ?>
    </div>
    <?php

// include "dbConn.php"; // Using database connection file here
$link = mysqli_connect("localhost", "root", "", "cinema_db");
$id = $_GET['id']; // get id through query string

$qry = mysqli_query($link,"select * from bookingtable where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
	
    $edit = mysqli_query($db,"update tblemp set fullname='$fullname', age='$age' where id='$id'");
	
    if($edit)
    {
        mysqli_close($db); // Close connection
        header("location:all_records.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo "error";
    }    	
}
?>

<h3>Update Data</h3>

<form method="POST">
  <input type="text" name="fullname" value="<?php echo $data['fullname'] ?>" placeholder="Enter Full Name" Required>
  <input type="text" name="age" value="<?php echo $data['age'] ?>" placeholder="Enter Age" Required>
  <input type="submit" name="update" value="Update">
</form>
</body>

</html>