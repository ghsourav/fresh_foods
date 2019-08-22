<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>ORDERS</title>

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
						$resultsx=mysqli_query($connect,"DELETE FROM order_details WHERE order_id='$rmv' AND user_email='".$_SESSION['mail']."'");
						
						
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
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>My_cart</a></li>
			<li class="active"><a href="orders.php"><span class="glyphicon glyphicon-gift"></span>Orders</a></li>
         </ul>
        </div>
        <div class="container">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="page-header">
        <h1>Your orders<span class="glyphicon glyphicon-shopping-cart"></span></h1>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-striped">
            <thead>
              <tr>
                

                <th>ORDER ID</th>
                <th>INVOICE ID</th>
                <th>ORDER DETAILS</th>
                <th>ORDER STATUS</th>
                <th>ORDER DATE</th>
				<th>DELIVERY DATE</th>
				<th>DELIVERY TIMMING</th>
                <th>TOTAL PRICE</th>
				<th>ACTION</th>
              </tr>
            </thead>
            <tbody>

                <?php
				
                echo"<form name='form1' method='POST' action='orders.php'>";
				if(isset($_SESSION['mail']) && isset($_SESSION['f_name']) && isset($_SESSION['l_name']))
				{
					$result=mysqli_query($connect,"SELECT * FROM order_details WHERE user_email='".$_SESSION['mail']."'");
					if(mysqli_num_rows($result)>0)
					{
						while($data=mysqli_fetch_assoc($result))
						{
							echo"<tr>
						<td>".$data['order_id']."</td>
						<td><a href='bills.php?order_id=".$data['order_id']."'>".$data['invoice_id']."</a></td>
						<td>".$data['products']."</td>
						<td>".$data['order_status']."</td>
						<td>".$data['order_date']."</td>
						<td>".$data['delivery_date']."</td>
						<td>".$data['delivery_time']."</td>
						<td>".$data['pay_amount']."</td>
						<td><button name='remove' type='submit' class='btn btn-sm btn-danger' value='".$data['order_id']."'>Cancel </button></td>
					  </tr>";
						}
						echo"</form>";
					}
					else{
						echo"<tr><td colspan='5'><center><h1><span class='glyphicon glyphicon-shopping-cart'></span>No order</h1></center></td></tr>";
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