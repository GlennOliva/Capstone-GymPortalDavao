<?php
include('../config/dbcon.php');

// Make sure to send the headers to the browser
header('Content-Type: text/html; charset=UTF-8');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_GET['user_id'];

    // Update query to set the status to 'Archived'
    $sql = "UPDATE tbl_membership SET status = 'Archived' WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);

    // Start outputting the HTML
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Archive Record</title>
        <!-- SweetAlert2 CSS -->
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
        <!-- SweetAlert2 JS -->
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js'></script>
    </head>
    <body>";

    if ($res) {
        // Success
        echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Record successfully archived.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'gym_member.php';
                });
              </script>";
    } else {
        // Failure
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to archive record.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'gym_member.php';
                });
              </script>";
    }

    echo "</body>
    </html>";
} else {
    header('Location: gym_progress.php');
    exit();
}
?>
