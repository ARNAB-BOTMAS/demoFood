<?php
        include 'config.php';
        error_reporting(E_ERROR | E_PARSE);
        date_default_timezone_set("Asia/Kolkata");
        $date=date('d/m/Y');
        $time=date('h:i A');

        $today=date('Y-m-d');

        $sql="SELECT * FROM `bill` WHERE Order_date ='$today'";
        $result=mysqli_query($con, $sql);
        $row=mysqli_fetch_array($result);
        if($row!=0){
            
            $sl1="SELECT COUNT(id) AS TotalOrder FROM `bill`";
            $res1=mysqli_query($con, $sl1);
            $rows1=mysqli_fetch_array($res1);
            $totalOrder=$rows1['TotalOrder'];
            
            $sl2="SELECT SUM(Total_Price) AS TotalSell FROM `bill`";
            $res2=mysqli_query($con, $sl2);
            $rows2=mysqli_fetch_array($res2);
            $totalSell=$rows2['TotalSell'];
            
            $sl="SELECT * FROM `bill` ORDER BY id DESC limit 1";
            $res=mysqli_query($con, $sl);
            $rows=mysqli_fetch_array($res);
            $last=$rows['Customer_id'];
        }
        
        else{
            $totalOrder=0;
            $totalSell=0;
            
            $sl="SELECT * FROM `bill` ORDER BY id DESC limit 1";
            $res=mysqli_query($con, $sl);
            $rows=mysqli_fetch_array($res);
            $last=$rows['Customer_id'];
        }
        
        
?>
<html>
    <head>
        <title>Welcome</title>
    </head>
    <body>
        <table width='100%' height='100%'>
            <tr>            
                <td height='10%' colspan="2" style="border-top: none; background-color: green; padding: 10px; color:#fff;">
                    <center>
                        <h1>Ratatouille Plaza</h1><hr style="width: 25%;">
                        <p>
                            74 Champahati J N Bose Road,
                            Christian Para,<br>
                            Champahati Charge Road,
                            Baruipur 743330,<br>
                            South 24 Paraganas
                        </p>
                    </center>
                    <?php 
                        echo $date." | ".$time;
                    ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; background-color:antiquewhite; vertical-align:top">
                    <ul style="list-style: none;  list-style-type: none; padding-left:0;">
                        <li><a href="order.php"><button style="border: none; background-color: #ff3300; width: 100%; height: 100px; font-size: 20px; color: #fff;">Order</button></a></li><br>
                        <li><a href="invoice.php"><button style="border: none; background-color: #ff3300; width: 100%; height: 100px; font-size: 20px; color: #fff;">Invoice</button></a></li><br>
                    </ul> 
                </td>
                <td border='1' width='75%' style="vertical-align:top; padding: 10px">
                    <table width='100%' height='30%'>
                        <td style="padding: 10px; vertical-align:bottom; text-align:right; background-color:aqua">
                            <h1>Total Order</h1>
                            <p>
                                <?php
                                    if($totalOrder==0){
                                        echo "No Order Make Today";
                                    }
                                    else{
                                        echo $totalOrder;
                                    }
                                ?>
                            </p>
                        </td>
                        </td>
                        <td style="padding: 10px; vertical-align:bottom; text-align:right; background-color:aqua">
                            <h1>Current Customer ID</h1>
                            <p>
                                <?php
                                    if($last==0){
                                        echo "Zero Customer";
                                    }
                                    else{
                                        echo $last;
                                    }
                                ?>
                            </p>
                        </td>
                        <td style="padding: 10px; vertical-align:bottom; text-align:right; background-color:aqua">
                            <h1>Total Sells</h1>
                            <p>
                                <?php
                                    if($totalOrder==0){
                                        echo "No Order Make Today";
                                    }
                                    else{
                                        echo "₹ ".$totalSell."/-";
                                    }
                                ?>
                            </p>
                        </td>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>