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
                        <h1>Ratatouille Plaza</h1><hr style="width: 25%;">
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
                        <li><a href="menu.php"><button style="border: none; background-color: #ff3300; width: 100%; height: 100px; font-size: 20px; color: #fff;">Menu</button></a></li><br>
                    </ul> 
                </td>
                <td border='1' width='75%' style="vertical-align:top; padding: 10px">
                
                    <table width='100%'>
                        <tr>
                            <form action="search.php" method="POSt">
                                <input type="search" name="cust">
                                <input type="submit" name="search" value="Search">
                            </form>
                            <?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$email=$_POST['email'];
		
				$sql = "SELECT * FROM `student` WHERE email='$email';";
				
				$result = mysqli_query($con,$sql);
				
				if($res=mysqli_fetch_array($result)){
					echo "<h2>Search Resultr</h2>";
					echo "<table border='1' width='100%'>";
					echo "<tr>";
						echo "<th>Name</th>";
						echo "<th>Roll No</th>";
						echo "<th>City</th>";
						echo "<th>Email</th>";
						echo "<th>Date of Birth</th>";
					echo "</tr>";
			
						echo "<tr>";
						echo "<td>".$res['Name']."</td>";
						echo "<td>".$res['Roll_No']."</td>";
						echo "<td>".$res['City']."</td>";
						echo "<td>".$res['email']."</td>";
						echo "<td>".$res['Date_of_Birth']."</td>";
						echo "</tr>";
					
					echo "</table>";
					echo "<br><br>";
					//echo "<a href='Main.php'><button>Home</button></a>&nbsp";
					echo "<a href=''><button>Back</button></a>";
				}
				else{
					echo "<h3>DATA NOT FOUND</h3>";
					//echo "<a href='Main.php'><button>Home</button></a>&nbsp";
					echo "<a href=''><button>Back</button></a>";
				}
					
			}
		?>
                            </table>
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