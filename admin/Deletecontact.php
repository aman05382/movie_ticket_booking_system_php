<?php 
    $id = $_GET['id'];
    include "config.php";

    $sql = "DELETE FROM feedbackTable WHERE msgID = $id"; 

    if ($con->query($sql) === TRUE) {
        header('Location: contactus.php');
        exit;
    } else {
        echo "Error deleting record: " . $con->error;
    }
?>