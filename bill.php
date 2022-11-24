<?php
    include 'config.php';
    session_start();
    if(isset($_SESSION['customer'])){
        $cus=$_SESSION['customer'];
        if(isset($_POST['Ok'])){
            $nTotal=$_POST['Ntotal'];
            $pay=$_POST['pay'];
            date_default_timezone_set("Asia/Kolkata");
            $date= date("Y/m/d");
            $time= date("h:i A");
            
            $sl="UPDATE `customer_details` SET `Total_amount_paid`='$nTotal',`Date_of_payment`='$date', `Payment_Method`='$pay' WHERE `Customer_id`='$cus'";
            
            if($result=mysqli_query($con, $sl)){
                $sql="UPDATE `bill` SET `Net_Price`='$nTotal', `Order_date`='$date', `Order_time`='$time' WHERE `Customer_id`='$cus'";
                if($result=mysqli_query($con, $sql)){
                        $_SESSION['msg']="Order Complete";
                        header('location: order.php');
                    }
               }
                
            }

        else{
            if(isset($_POST['cancel'])){
                $qul="DELETE FROM `customer_details` WHERE Customer_id='$cus'";
                if($rst=mysqli_query($con,$qul)){
                    
                    $qule="DELETE FROM `bill` WHERE Customer_id='$cus'";
                    if($rstl=mysqli_query($con,$qule)){
                        $_SESSION['msg']="Order cancel";
                        header('location: order.php');
                    }
                }
            }
        }
    }
?>