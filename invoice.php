<?php
        include 'config.php';
        error_reporting(E_ERROR | E_PARSE);
        session_start();
        date_default_timezone_set("Asia/Kolkata");
        $date=date('d/m/Y');
        $time=date('h:i A');

        $today=date('Y-m-d');

        $sql = "SELECT `Order_date`, `Order_time`, `Customer_id`, `Customer_Name`, COUNT(`Food_items`) AS item, `Total_Price`, `GST`, `Net_Price` FROM `bill` GROUP BY Customer_id HAVING COUNT(Customer_id)>1 OR COUNT(Customer_id)=1;";
				
        $result = mysqli_query($con,$sql);
        
        
        
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
                        <h1>Invoice</h1><hr style="width: 25%;">
                    </center>
                    <?php 
                        echo $date." | ".$time;
                    ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; background-color:antiquewhite; vertical-align:top">
                    <ul style="list-style: none;  list-style-type: none; padding-left:0;">
                        <li><a href="index.php"><button style="border: none; background-color: #ff3300; width: 100%; height: 100px; font-size: 20px; color: #fff;">Home</button></a></li><br>
                        <li><a href="order.php"><button style="border: none; background-color: #ff3300; width: 100%; height: 100px; font-size: 20px; color: #fff;">Order</button></a></li><br>
                    </ul> 
                </td>
                <td border='1' width='75%' style="vertical-align:top; padding: 10px">
                
                    <table width='100%'>
                        <tr>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

                                <input list="li" name="cust" style="width:80%; height: 50px; vertical-align:center; font-size: 25px">
                                    <datalist id="li">
                                    <?php
                                        while($row=mysqli_fetch_array($result)){
                                            $Cid=$row['Customer_id'];
                                            echo "<option value='$Cid'>";
                                        }
                                    ?>
                                    </datalist>
                                <input type="submit" name="search" value="Search" style="width: 20%; height: 50px; text-align:center; font-size: 25px">
                            </form>
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $Cid = $_POST['cust'];
        
                                    $sql = "SELECT `Order_date`, `Order_time`, `Customer_id`, `Customer_Name`, COUNT(`Food_items`) AS item, `Total_Price`, `GST`, `Net_Price` FROM `bill` WHERE Customer_id ='$Cid'";
        
                                    $result = mysqli_query($con, $sql);
        
                                    if ($res = mysqli_fetch_array($result)) {
                                        echo "<table width='100%'' height='auto' style='border-bottom: 1px solid #000 ;'>
                                        <tr style='background-color:#ff3300 ; margin-bottom:0px '>
                                            <th>Sl. No</th>
                                            <th>Order Date</th>
                                            <th>Order Time</th>
                                            <th>Customer ID</th>
                                            <th>Customer Name</th>
                                            <th>Total item</th>
                                            <th>GST</th>
                                            <th>NET PRICE</th>
                                            <th>&nbsp;&nbsp;</th>
                                            
                                        </tr>";
        
                                        echo "
                                            <tr style='margin-botton:0px; hieght: auto; text-align: center;'>
                                                <td>".$s."</td>
                                                <td>".$res['Order_date']."</td>
                                                <td>".$res['Order_time']."</td>
                                                <td>".$res['Customer_id']."</td>
                                                <td>".$res['Customer_Name']."</td>
                                                <td>".$res['item']."</td>
                                                <td>".$res['GST']."</td>
                                                <td>₹ ".$res['Net_Price']."/-</td>
                                                <td colspan='2' style='text-align=center; vertical-align:center; margin-botton=0px; height:50%, background-color:#fff'>
                                                    <center style='padding: none; margin-botton=0px'>
                                                        <a href='Bills.php?show=".$Cid."'><button style='width:45%; height: 40px; vertical-align:center; background-color: #2b547e; color: #fff; border:none; font-size: 25px'>Bill</button></a>
                                                        <a href='delete.php?del=".$Cid."'><button style='width:45%; height: 40px; vertical-align:center; background-color: #95b9c7; color: #000; border:none; font-size: 25px'>Delete</button></a>
                                                    </center>
                                                </td>
                                            </tr>";
                                        echo "<a href=''><button style='width: 100%; height: 50px; font-size:25px'>Back</button></a>";
                                    } 
                                    else {
                                        echo "<h3>DATA NOT FOUND</h3>";
                                        echo "<a href=''><button style='width:100% background-color:#ff3300 ; margin-bottom:0px '>Back</button></a>";
                                    }echo "</table>";
                                } 
                                

                                else{
                                    $sql = "SELECT `Order_date`, `Order_time`, `Customer_id`, `Customer_Name`, COUNT(`Food_items`) AS item, `Total_Price`, `GST`, `Net_Price` FROM `bill` GROUP BY Customer_id HAVING COUNT(Customer_id)>1 OR COUNT(Customer_id)=1;";
				
                                    $result = mysqli_query($con,$sql);

                                    echo "<table width='100%'' height='auto' style='border-bottom: 1px solid #000 ;'>
                                        <tr style='background-color:#ff3300 ; margin-bottom:0px '>
                                            <th>Sl. No</th>
                                            <th>Order Date</th>
                                            <th>Order Time</th>
                                            <th>Customer ID</th>
                                            <th>Customer Name</th>
                                            <th>Total item</th>
                                            <th>GST</th>
                                            <th>NET PRICE</th>
                                            <th>&nbsp;&nbsp;</th>
                                            
                                        </tr>";
                                            $s=0;
                                            while($res=mysqli_fetch_array($result)){
                                                $Cid=$res['Customer_id'];
                                                $s=$s+1;
                                                echo "
                                                <tr style='margin-botton:0px; hieght: auto; text-align: center;'>
                                                    <td>".$s."</td>
                                                    <td>".$res['Order_date']."</td>
                                                    <td>".$res['Order_time']."</td>
                                                    <td>".$res['Customer_id']."</td>
                                                    <td>".$res['Customer_Name']."</td>
                                                    <td>".$res['item']."</td>
                                                    <td>".$res['GST']."</td>
                                                    <td>₹ ".$res['Net_Price']."/-</td>
                                                    <td colspan='2' style='text-align=center; vertical-align:center; margin-botton=0px; height:50%, background-color:#fff'>
                                                        <center style='padding: none; margin-botton=0px'>
                                                            <a href='Bills.php?show=".$Cid."'><button style='width:45%; height: 40px; vertical-align:center; background-color: #2b547e; color: #fff; border:none'>Bill</button></a>
                                                            <a href='delete.php?del=".$Cid."'><button style='width:45%; height: 40px; vertical-align:center; background-color: #95b9c7; color: #000; border:none''>Delete</button></a>
                                                        </center>
                                                    </td>
                                                </tr>";
                                            }
                                    echo "</table>";
                                }
                            ?>
                            <?php
                                if(isset($_SESSION['msg'])){
                                    echo "<div class ='alert'>";
                                        echo $_SESSION['msg'];
                                    echo "</div>";
                                        }
                                unset($_SESSION['msg']);
                            ?>
                </td>
            </tr>
        </table>
        <script>
             setTimeout(function(){
                let alert = document.querySelector(".alert");
                alert.remove();
            },5000);
        </script>
    </body>
</html>