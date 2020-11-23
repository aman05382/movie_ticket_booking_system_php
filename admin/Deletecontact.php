<?php 
    $id = $_GET['id'];
    $link = mysqli_connect("localhost", "root", "", "cinema_db");

    $sql = "DELETE FROM feedbackTable WHERE msgID = $id"; 

    if ($link->query($sql) === TRUE) {
        header('Location: contactus.php');
        exit;
    } else {
        echo "Error deleting record: " . $link->error;
    }
?>