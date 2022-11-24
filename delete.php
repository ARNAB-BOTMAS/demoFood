<?php
    include 'config.php';
    session_start();
    if(isset($_GET['del'])){
        $id=$_GET['del'];

        $sql="DELETE FROM `bill` WHERE Customer_id='$id'";
        if($resuli=mysqli_query($con, $sql)){
            $_SESSION['msg']= "Database Delete Successful.";
            header('location: invoice.php');
        }
    }
?>