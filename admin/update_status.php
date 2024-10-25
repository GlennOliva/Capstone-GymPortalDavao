<?php
include('../config/dbcon.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Update the status to "Accept"
    $sql = "UPDATE tbl_membership SET status = 'Accept' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error: " . mysqli_error($conn); // Display SQL error
    }
} else {
    echo "error: invalid request"; // Handle cases where ID is not set
}







?>