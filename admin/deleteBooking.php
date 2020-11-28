<?php 
    $id = $_GET['id'];
    include "config.php";

    $sql = "DELETE FROM bookingTable WHERE bookingID = $id"; 

    if ($con->query($sql) === TRUE) {
        header('Location: view.php');
        exit;
    } else {
        echo "Error deleting record: " . $link->error;
    }
?>