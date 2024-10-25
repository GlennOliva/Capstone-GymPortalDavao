<?php
include('../config/dbcon.php');
session_start();

if(isset($_POST['delete_adminbtn']))
{

    $id = $_POST['admin_id'];
    //Create SQL query to delete admin
$sql = "SELECT * FROM tbl_admin WHERE id=$id";

// Execute the query
$result = mysqli_query($conn, $sql);

$count2 = mysqli_fetch_array($result);


$image_name2 = $count2['image'];

   $sql1 = "DELETE FROM tbl_admin WHERE id=$id";
   $result1 = mysqli_query($conn,$sql1);

   if($result1)
   {
        if(file_exists("admin_image/".$image_name2))
        {
            unlink("admin_image/".$image_name2);
        }

        echo 200;

    }
    else
    {
        echo 500;
    }


}

?>