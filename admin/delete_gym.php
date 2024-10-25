<?php
// Include SweetAlert2 CSS and JS
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">';
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>';

include('../config/dbcon.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM tbl_gym WHERE id = $id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    if ($res) {
        // Success
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Gym successfully deleted.',
                    }).then(function() {
                        window.location = 'gym.php'; // Redirect to gym.php
                    });
                });
              </script>";
    } else {
        // Failure
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to delete gym.',
                    }).then(function() {
                        window.location = 'gym.php'; // Redirect to gym.php
                    });
                });
              </script>";
    }
} else {
    // No ID provided
    header('Location: gym.php');
    exit();
}
?>