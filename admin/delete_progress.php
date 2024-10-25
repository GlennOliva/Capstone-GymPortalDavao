<?php
// Include SweetAlert2 CSS and JS
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">';
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>';

include('../config/dbcon.php');

if (isset($_GET['id']) && isset($_GET['user_id'])) {
    $id = $_GET['id'];
    $user_id = $_GET['user_id'];

    // Delete query
    $sql = "DELETE FROM tbl_userprogress WHERE id = $id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    if ($res) {
        // Success
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Progress successfully deleted.',
                    }).then(function() {
                        window.location = 'gym_progress.php?id=' + $user_id; // Correctly concatenate user_id
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
                        text: 'Failed to delete User Progress.',
                    }).then(function() {
                        window.location = 'gym_inventory.php'; // Correct redirect on failure
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
