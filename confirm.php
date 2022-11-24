<?php
    include 'config.php';
    session_start();
    if(isset($_SESSION['customer'])){
        $cus=$_SESSION['customer'];
        
        $sq="SELECT Customer_Name, COUNT(Customer_id) AS CountID FROM `bill` WHERE Customer_id = '$cus';";
        $fire=mysqli_query($con, $sq);

        $row=mysqli_fetch_array($fire);
        $tol=$row['CountID'];
        $cust=$row['Customer_Name'];
        //echo $tol."<br>";
    }
?>
<html>
    <head>
        <title>Welcome</title>
    </head>
    <body>
        <table width='100%' height='100%' style="border: none;">
           <tr> 
                <th height='10%' colspan="2" style="background-color: green; padding: 10px; color:#fff;">
                    <h1>BILL</h1>
                </th>
           </tr>
            <tr>
                <td width='100%' height='100%' colspan="2" style="background-color: green; vertical-align:top; text-align:center; padding: 10px; color:#fff;">
                    <center>
                        <table width='60%' height='auto' style="border-style:none; border-color:aquamarine;">
                            <tr style="border-style:none; border-color:aquamarine;">
                                <th colspan="4" style="background-color:aquamarine; width:70%; text-align:start; border-style:none; border-color:aquamarine;">
                                    <?php
                                        date_default_timezone_set("Asia/Kolkata");
                                        $today= date("d/m/Y");
                                        $time= date("h:i A");
                                        echo "<h3>Date: ".$today." | ";
                                        echo "Time: ".$time."</h3>";
                                    ?>
                                    <br><br>
                                    Customer ID:
                                    <?php 
                                        if(isset($_SESSION['customer'])){
                                            $cus=$_SESSION['customer'];
                                            echo " ".$cus;
                                        }
                                    ?>
                                    <br>
                                    Customer Name:
                                    <?php 
                                        if(isset($_SESSION['customer'])){
                                            $cus=$_SESSION['customer'];
                                            $sq="SELECT Customer_Name, COUNT(Customer_id) AS CountID FROM `bill` WHERE Customer_id = '$cus';";
                                            $fire=mysqli_query($con, $sq);

                                            $row=mysqli_fetch_array($fire);
                                            $cust=$row['Customer_Name'];
                                            echo " ".$cust;
                                        }
                                    ?>
                                </th>

                                <th style="background-color:aquamarine; text-align:left; border-style:none; border-color:aquamarine;">    
                                    <p style="padding: none;">
                                        <h2>Ratatouille Plaza</h2>
                                        74 Champahati J N Bose Road,<br>
                                        Christian Para,<br>
                                        Champahati Charge Road,<br>
                                        Baruipur 743330,<br>
                                        South 24 Paraganas<br><br>
                                    </p>
                                </th>
                            </tr>
                            <tr style="background-color:aquamarine; width:10%;">
                                <th>SL. No.</th>
                                <th>Items</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>                            
                                <?php
                                    if(isset($_SESSION['customer'])){
                                        $cus=$_SESSION['customer'];
                                        $sql="SELECT * FROM `bill` WHERE Customer_id = '$cus';";
                                        $fire=mysqli_query($con, $sql);
                                        $s=0;
                                        while($row=mysqli_fetch_array($fire)){
                                            $s=$s+1;
                                            echo "<tr style='background-color:aquamarine; width:10%;'>";
                                                echo "<td style='text-align:center'>".$s."</td>";
                                                echo "<td>".$row['Food_items']."</td>";
                                                echo "<td>₹ ".$row['Price']."/-</td>";
                                                echo "<td>".$row['Quantity']."</td>";
                                                echo "<td style='text-align: center; font-size: 20px; color: black'><b>₹".$row['Total_Price']."/-</b></td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                            <tr style='background-color:aquamarine; width:10%;'>
                                <td colspan="4" style='text-align:right; font-size: 20px; color: blue'>
                                    Total -<br>
                                    GST(15%) -<br>
                                </td>
                                <td style='text-align:center; font-size: 20px; color: blue'>
                                    <?php
                                        if(isset($_SESSION['customer'])){
                                            $cus=$_SESSION['customer'];
                                            $gst=15;
                                            $query="SELECT SUM(Total_Price) AS GrandTotal FROM `bill` WHERE Customer_id = '$cus'";
                                            $fi=mysqli_query($con, $query);
                                            $fet=mysqli_fetch_array($fi);
                                            $total=$fet['GrandTotal'];
                                            $net=($total*$gst)/100;
                                            $cgst=(int)$net+1;
                                            $netTotal=$total+$cgst;
                                            echo "<b>₹".$total."/-</b><br>";
                                            echo "<b>₹".$cgst."/-</b><br></td>
                                                </tr>";
                                            echo "<tr style='background-color:aquamarine; width:10%;'>";
                                                echo "<td colspan='4' style='text-align:right; font-size: 20px; color: red'>
                                                        <b>
                                                            Net Total-
                                                        </b>
                                                    </td>";
                                                echo "<td style='text-align:center; font-size: 20px; color: red'><b>₹".$netTotal."/-</b></td>";
                                        }
                                    ?>
                                </td>
                            <tr>
                                <td colspan="5" width="50%" style="vertical-align: center; text-align:center">
                                    <form action="bill.php" method="POST" style="vertical-align: center;">
                                        <input type="hidden" value="<?php echo $netTotal ?>" name="Ntotal">
                                        <select name="pay" style="width: 100%; height: 50px; padding: none; font-size: 25px; margin-bottom: 10px; background-color:blanchedalmond;">
                                            <option value="Cash">Cash</option>
                                            <option value="Credit Card/Debit Card">Credit Card/Debit Card.</option>
                                            <option value="Net Banking">Net Banking</option>
                                            <option value="Paytm/PhonePa">Paytm/PhonePa</option>
                                            <option value="Check">Check</option>
                                        </select>
                                        <!-- <input type="number" name="check" style="width: 29%; height: 50px; padding: none; font-size: 25px; margin-bottom: 10px; background-color:blanchedalmond;"> -->
                                        <input type="submit" name="Ok" value="Payment" style="width: 49%; height: 50px; padding: none; font-size: 25px;">&nbsp;&nbsp;&nbsp;
                                        <input type="submit" name="cancel" value="Cancel" style="width: 49%; height: 50px; padding: none; font-size: 25px;">
                                    </form>
                                </td>
                            </tr>       
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>
</html>