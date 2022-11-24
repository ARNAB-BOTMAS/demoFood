<?php
    include 'config.php';
    session_start();
    if(isset($_POST['submit'])){
        $cust=$_POST['cust_id'];
        $name=$_POST['name'];
        $food=$_POST['food'];
        $qty=$_POST['qty'];

        $query1="INSERT INTO `customer_details`(`Customer_id`, `Customer_name`) VALUES ('$cust', '$name')";
        if($fire1=mysqli_query($con,$query1)){

            foreach($food as $index => $foods){
                $sql="SELECT * FROM `food_details` WHERE Food_items='$foods'";
                    
                $result = mysqli_query($con,$sql);
                if($res=mysqli_fetch_array($result)){
                    $price=$res['Price_per_item'];
                    $qtys= $qty[$index];
                    $total=$price*$qtys;
                    
                    $query="INSERT INTO `bill`(`Customer_id`, `Customer_Name`, `Food_items`, `Quantity`, `Price`, `Total_Price`) VALUES ('$cust','$name','$foods','$qtys','$price','$total')";
                    if($fire=mysqli_query($con,$query)){
                        //echo $cust." ".$name." ".$foods." ".$qtys." ".$price." ".$total."<br>";
                        $_SESSION['customer']= $cust;
                        header('location: confirm.php');
                    }
                }
            }
        }
    }
?>