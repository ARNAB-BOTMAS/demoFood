<?php
    include 'config.php';
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    $sl="SELECT * FROM `bill` ORDER BY id DESC limit 1";
    $res=mysqli_query($con, $sl);
    $rows=mysqli_fetch_array($res);
    $last=$rows['Customer_id'];
    if($last==0){
        $id="CUST1001";
    }
    else{
        $id = substr($last, 4);
        $id = intval($id);
        $id = "CUST".($id+1);
    }
?>
<html>
    <head>
        <title>Order</title>
    </head>
    <script>
        function ddlselect(){
            var d=document.getElementById
        };
    </script>
    <body>
        <table width='100%' height='100%'>
            
                <td height='10%' colspan="2" style="border-top: none; background-color: green; padding: 10px; color:#fff;">
                    <center>
                        <h1>Order</h1>
                    </center>
                    <?php 
                        date_default_timezone_set("Asia/Kolkata");
                        $date=date('d/m/Y');
                        $time=date('h:i A');
                        echo $date." | ".$time;
                    ?>
                </td>
            <tr>
                <td style="padding: 10px; background-color:antiquewhite; vertical-align:top">
                    <ul style="list-style: none;  list-style-type: none; padding-left:0;">
                        <li><a href="index.php"><button style="border: none; background-color: #ff3300; width: 100%; height: 100px; font-size: 20px; color: #fff;">Home</button></a></li><br>
                        <li><a href="invoice.php"><button style="border: none; background-color: #ff3300; width: 100%; height: 100px; font-size: 20px; color: #fff;">Invoice</button></a></li><br>
                    </ul> 
                </td>
                <td border='1' width='75%' style="vertical-align:top; padding: 10px; background-color:blanchedalmond">
                    <div class="card-header">
                        <h1>Order</h1><hr width="100%;" color="red" size="2px">
                    </div>
                    <div class="card-body p-4">
                        <form action="or.php" method="POST" id="add-form">
                            <input type="text" name="cust_id" value="<?php echo $id ;?>" readonly style="width: 20%; height: 50px; text-align:center">
                            <input type="submit" name="submit" value="Place Order" class="btn btn-primary w-25" id="add_btn" style="width: 39%; height: 50px; text-align:center">
                            <input type="reset" name="reset" value="Cancel" style="width: 40%; height: 50px; text-align:center">
                            <input type="text" name="name" placeholder="Customer Name" required id="name" style="width:100%; height: 50px;">
                            <div id="show-item">
                                <div class="row">
                                    <div class="rows">
                                        <table width="100%" style="background-color: #fff;">
                                            <td>
                                                <select name="food[]" id="food" class="food-name" required style="width:100%; height: 50px; vertical-align:center">
                                                    <option>---Select Food---</option>
                                                    <option value="Veggie Momo">Veggie Momo</option>
                                                    <option value="Chicken Supreme Momo">Chicken Supreme Momo</option>
                                                    <option value="Chicken Momo">Chicken Momo</option>
                                                    <option value="Corn Cheese sandwich">Corn Cheese sandwich</option>
                                                    <option value="Cheese sandwich">Cheese sandwich</option>
                                                    <option value="Veggie Roll">Veggie Roll</option>
                                                    <option value="Chicken Roll">Chicken Roll</option>
                                                    <option value="Paneer Roll">Paneer Roll</option>
                                                    <option value="Egg Roll">Egg Roll</option>
                                                    <option value="Chicken Pizza">Chicken Pizza</option>
                                                    <option value="Veggie Pizza">Veggie Pizza</option>
                                                </select>
                                            </td>
                                            <td><input type="number" name="qty[]" class="form-control" placeholder="Quantity" value="1" required style="width:100%; height: 50px;"></td>
                                            <td><button class="add_item_btn" style="width:100%; height: 50px;">ADD MORE</button></td>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <p>
                        <?php
                            if(isset($_SESSION['msg'])){
                                echo "<div class ='alert'>";
                                    echo $_SESSION['msg'];
                                echo "</div>";
                                    }
                            unset($_SESSION['msg']);
                        ?>
                                
                    </p>
                </td>
            </tr>
        </table>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            setTimeout(function(){
                let alert = document.querySelector(".alert");
                alert.remove();
            },5000);
          $(document).ready(function(){
                $(".add_item_btn").click(function(e){
                    e.preventDefault();
                    $("#show-item").append(`
                    <div class="rows">
                        <table width="100%" style="background-color: #fff;">
                            <td></td>
                            <td>
                                <select name="food[]" required style="width:100%; height: 50px;">
                                    <option>---Select Food---</option>
                                    <option value="Veggie Momo">Veggie Momo</option>
                                    <option value="Chicken Supreme Momo">Chicken Supreme Momo</option>
                                    <option value="Chicken Momo">Chicken Momo</option>
                                    <option value="Corn Cheese sandwich">Corn Cheese sandwich</option>
                                    <option value="Cheese sandwich">Cheese sandwich</option>
                                    <option value="Veggie Roll">Veggie Roll</option>
                                    <option value="Chicken Roll">Chicken Roll</option>
                                    <option value="Paneer Roll">Paneer Roll</option>
                                    <option value="Egg Roll">Egg Roll</option>
                                    <option value="Chicken Pizza">Chicken Pizza</option>
                                    <option value="Veggie Pizza">Veggie Pizza</option>
                                </select>
                            </td>
                            <td><input type="number" name="qty[]" class="form-control" placeholder="Quantity" value="1" required style="width:100%; height: 50px;"></td>
                            <td><button class="remove_item_btn" style="width: 100%; height: 50px; background-color: red">REMOVE</button></td>
                        </table>
                    </div>
                    `);
                    $(document).on('click', '.remove_item_btn', function(e){
                        e.preventDefault();
                        let row_item = $(this).parent().parent();
                        $(row_item).remove();
                    });
                });
            });
        </script>
    </body>
</html>