<?php
include('../config/dbcon.php');
session_start();

$data = array();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query to fetch records individually
    $chart_sql = "
        SELECT created_at, weight, repetition, excercise
        FROM tbl_userprogress
        WHERE user_id = $user_id
        ORDER BY created_at
    ";

    $chart_result = mysqli_query($conn, $chart_sql);

    if ($chart_result && mysqli_num_rows($chart_result) > 0) {
        while ($row = mysqli_fetch_assoc($chart_result)) {
            $date = $row['created_at'];
            
            // Group data by date
            if (!isset($data[$date])) {
                $data[$date] = array();
            }
            
            $data[$date][] = $row; // Append each record to its date group
        }
    }
}

// Output the chart data as JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
