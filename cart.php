<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>cart</title>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/Logo.jpeg">

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
	<link href="dashboard.css" rel="stylesheet">
</head>
<body>
<?php 
        $connect=mysqli_connect("localhost","root","","fresh_foods");
    ?>
	<?php
                    
                    if(isset($_POST['remove']))
                    {
                        $rmv=$_POST['remove'];
						$val;
						$resultsx=mysqli_query($connect,"SELECT * FROM cart_master WHERE item_no='$rmv' AND user_id='$_SESSION[mail]'");
						if(mysqli_num_rows($resultsx)>0)
						{
							$val=mysqli_fetch_assoc($resultsx);
							$i_type=$val['item_type'];
							$i_name=$val['item_name'];
							$i_qty=$val['item_qty'];
							$vresultsx=mysqli_query($connect,"SELECT * FROM ".$i_type."_stock WHERE item_name='$i_name'");
							if(mysqli_num_rows($vresultsx)>0)
							{
								$val2=mysqli_fetch_assoc($vresultsx);
								$i_qty=$i_qty+$val2['stock'];
								mysqli_query($connect,"UPDATE ".$i_type."_stock SET stock='$i_qty' WHERE item_name='$i_name'");
							}
							mysqli_query($connect,"DELETE FROM cart_master WHERE item_no='$rmv' AND user_id='".$_SESSION['mail']."'");
						}
						else
						{
							exit();
						}
                    } 

         ?>
    <?php
		include("header.php");
	?>
    
          

    
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="veg.php"><span class="glyphicon glyphicon-leaf"></span>Veg and Fruits</a></li>
            <li><a href="nonveg.php"><span class="glyphicon glyphicon-cutlery"></span>Non_Veg</a></li>
            <li><a href="groceries.php"><span class="glyphicon glyphicon-th"></span>Groceries</a></li>
            <li><a href="offers.php"><span class="glyphicon glyphicon-gift"></span>Offers</a></li>
            <li class="active"><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span>My_cart</a></li>
			<li><a href="orders.php"><span class="glyphicon glyphicon-gift"></span>Orders</a></li>
         </ul>
        </div>
        <div class="container">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="page-header">
        <h1>Mycart<span class="glyphicon glyphicon-shopping-cart"></span></h1>
      </div>
      <div class="row">
        <div class="col-md-6">
		<?php
		if($_SERVER['REQUEST_METHOD']=="POST")
		{
					if(isset($_POST['cnfrm']))
						{
							$sum1=$_POST['cnfrm'];
							if($sum1<500)
								{
									$sum1=$sum1+100;
								}
							if(isset($_SESSION['f_name'])==true&&isset($_SESSION['l_name'])==true)
							{
								$order_id=0;
								$fnm=$_SESSION['f_name'];
								$lnm=$_SESSION['l_name'];
								$fetc=mysqli_query($connect,"SELECT * FROM user_master WHERE f_name='$fnm' AND l_name='$lnm'");
								$orders=mysqli_query($connect,"SELECT order_id FROM order_details");
								$num_order=mysqli_num_rows($orders);
								$fetassc=mysqli_fetch_assoc($fetc);
								$eml=$fetassc['email_id'];
								$addr=$fetassc['address'];
								$invoice_id="16INV".$num_order;
								$phonenumber=$fetassc['ph_no'];
								$od=date("d-m-Y");
								$user_cart=mysqli_query($connect,"SELECT * FROM cart_master WHERE user_id='".$_SESSION['mail']."'");
								$products="";
								while($usercval=mysqli_fetch_assoc($user_cart))
								{
									if(strtolower($usercval['item_type'])=="veg" || strtolower($usercval['item_type'])=="nonveg")
									{
										$products=$products." ".$usercval['item_name']." ".$usercval['item_qty']."kg ,";
									}
									else if(strtolower($usercval['item_type'])=="grocery")
									{
										$products=$products." ".$usercval['item_name']." ".$usercval['item_qty']."packets ,";
									}
								}
								$nms=$fnm.$lnm;
								mysqli_query($connect,"INSERT INTO order_details(invoice_id,order_date,contact_no,user_email,user_name,user_address,products,pay_amount) VALUES('$invoice_id','$od','$phonenumber','$eml','$nms','$addr','$products','$sum1')");
								echo"<h1>".$_SESSION['f_name']." ".$_SESSION['l_name']." Your order has been sucessfully placed <span class='glyphicon glyphicon-thumbs-up'></span></h1>";
								$orders=mysqli_query($connect,"SELECT order_id FROM order_details");
								while($vals=mysqli_fetch_assoc($orders))
								{
									if(isset($vals['order_id']))
									{
										$order_id=$vals['order_id'];
									}
									else{
										break;
									}
								}
								$qdid=mysqli_query($connect,"SELECT * FROM order_details WHERE user_name='$nms' AND order_id='".$order_id."'");
								$odid=mysqli_fetch_assoc($qdid);
								
									echo"<h3>Amount to be paid: Rs".$sum1."</h3>";
								echo"<h1>Your order ID is ".$odid['order_id']."</h1>";
								echo"<a href='bills.php?order_id=".$order_id."'>invoice</a>";
								mysqli_query($connect,"DELETE FROM cart_master WHERE user_id='".$_SESSION['mail']."'");
								exit();
							}
							else
							{
								echo "<h1>Please register first to place your order</h1>";
							}
						}
		}
		?>
          <table class="table">
            <thead>
              <tr>
                

                <th>Item_no</th>
                <th>Item_Name</th>
                <th>Item_type</th>
                <th>Item_Quantity<br>(Kilo/Liter)</th>
                <th>Item_Price(per Kilo/Liter)</th>
                <th>Total_Price</th>
              </tr>
            </thead>
            <tbody>

                <?php
				
                echo"<form name='form1' method='POST' action='cart.php'>";
				if(isset($_SESSION['mail']))
				{
					$result=mysqli_query($connect,"SELECT * FROM cart_master WHERE user_id='$_SESSION[mail]'");
					if(mysqli_num_rows($result)>0)
					{
						while($data=mysqli_fetch_assoc($result))
						{
							echo"<tr>
						<td>".$data['item_no']."</td>
						<td>".$data['item_name']."</td>
						<td>".$data['item_type']."</td>
						<td>".$data['item_qty']."</td>
						<td>".$data['item_price']."</td>
						<td>".$data['total_price']."</td>
						<td><button name='remove' type='submit' class='btn btn-sm btn-danger' value='$data[item_no]'>Remove</button></td>
					  </tr>";
						}
						echo"</form>";
					}
					else{
						echo"<tr><td colspan='5'><center><h1><span class='glyphicon glyphicon-shopping-cart'></span>Cart Empty</h1></center></td></tr>";
						echo"</tbody>
			  </table></div>
	
			  ";
						exit();
					}
				}
                ?>
                
               
          
              <!--<tr>
                <td>1</td>
                <td>Brinjal</td>
                <td>veg</td>
                <td>2</td>
                <td>15.00</td>
                <td>30.00</td>
                <td><button type="submit" class="btn btn-sm btn-danger">Remove</button></td>
              </tr>

              <tr>
                <td>2</td>
                <td>Eggs</td>
                <td>nonveg</td>
                <td>1</td>
                <td>45.00</td>
                <td>45.00</td>
                <td><button type="submit" class="btn btn-sm btn-danger">Remove</button></td>
              </tr>
              <tr>
                <td>3</td>
                <td>Apple</td>
                <td>veg</td>
                <td>1</td>
                <td>10.00</td>
                <td>10.00</td>
                <td><button type="submit" class="btn btn-sm btn-danger">Remove</button></td>
              </tr>-->
            </tbody>
          </table>
          <?php
		  if(isset($_SESSION['mail']))
		  {
            $price_fetch=mysqli_query($connect,"SELECT total_price FROM cart_master WHERE user_id='$_SESSION[mail]'");
            $sum=0;
            while($price_val=mysqli_fetch_assoc($price_fetch))
            {
                $sum=$sum+$price_val['total_price'];
            }
            if($sum==0)
            {
                echo"<h1>Your cart is empty<span class='glyphicon glyphicon-shopping-cart'></span></h1>";
                exit;
            }
            echo"<form name='f1' method='POST' action='cart.php'><h1>Amount to be paid ".$sum."</h1><button name='cnfrm' class='btn btn-lg btn-success' value='$sum'>Confirm</button></form>";
            if($sum<500&&$sum!=0)
            {
                echo"Delivery charge +100";
            }
		  }
		  else
		  {
			  echo "<h2>Please Sign in to buy something</h2>";
		  }
			
          ?>
        </div>
        </div>
        </div>
        </div>
</body>
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
</html>