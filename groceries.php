<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Groceries</title>
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
    if(isset($_POST['add']))
    {
		if(isset($_SESSION['mail']))
      {
		if($_POST['qty']==0)
		{
			echo"<script>alert('Quantity cannot be empty');</script>";
		}
		else{
			
		  $mail=$_SESSION['mail'];
		  $i_no=$_POST['add'];
		  $i_qty=$_POST['qty'];
		  $res_g=mysqli_query($connect,"SELECT * FROM grocery_stock WHERE item_no='$i_no'");
		  $res_dat=mysqli_fetch_assoc($res_g);
		  $stock=$res_dat['stock'];
		  $i_name=$res_dat['item_name'];
		  $i_price=$res_dat['item_price'];
		  $res_c=mysqli_query($connect,"SELECT * FROM cart_master WHERE item_name='$i_name' AND user_id='$mail'");
		  if($i_qty>$stock)
		  {
			  echo"<script>alert('Quantity Exceedind stock');</script>";
		  }
		  else
		  {
			  if(mysqli_num_rows($res_c)>0)
			  {
				$dat=mysqli_fetch_assoc($res_c);
				$i_qty=$i_qty+$dat['item_qty'];
				$t_price=$i_qty*$i_price;
				mysqli_query($connect,"UPDATE cart_master SET item_qty='$i_qty',total_price='$t_price' WHERE item_name='$i_name' AND user_id='$mail'");

			  }
			  else
			  {
				$t_price=$i_qty*$i_price;
				mysqli_query($connect,"INSERT INTO cart_master(user_id,item_name,item_type,item_qty,item_price,total_price) VALUES('$mail','$i_name','grocery','$i_qty','$i_price','$t_price')");

			  }
		  }
		  $stock=$stock-$i_qty;
		  mysqli_query($connect,"UPDATE grocery_stock SET stock='$stock' WHERE item_name='$i_name'");
		}
    }
	  else
	  {
		  header("Location:cart.php");
	  }
  }
  ?>
<?php
	include("header.php");
?>
  <?php
  if(isset($_SESSION['mail']))
  {
    $res_cart=mysqli_query($connect,"SELECT *  FROM cart_master WHERE user_id='".$_SESSION['mail']."'");
    $cart_items=mysqli_num_rows($res_cart);
  }
  else{
	  $cart_items=0;
  }
  ?>
  
	 <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="veg.php"><span class="glyphicon glyphicon-leaf"></span>Veg and Fruits</a></li>
            <li><a href="nonveg.php"><span class="glyphicon glyphicon-cutlery"></span>Non_Veg</a></li>
			<li class="active"><a href="#"><span class="glyphicon glyphicon-th"></span>Groceries</a></li>
			<li><a href="offers.php"><span class="glyphicon glyphicon-gift"></span>Offers</a></li>
			<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>My_cart</a></li>
			<li><a href="orders.php"><span class="glyphicon glyphicon-gift"></span>Orders</a></li>
         </ul>
        </div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Groceries</h1>
          <div class="row placeholders">
            <?php
              $res=mysqli_query($connect,"SELECT * FROM grocery_stock");
              $count=0;
              while($data=mysqli_fetch_assoc($res))
              {
                echo"<form name='f' method='POST' action='groceries.php'><div class='well col-xs-6 col-sm-3 placeholder'>
              <img src='img/Groceries/$data[item_img]' class='img-circle' alt='Generic placeholder thumbnail' height='200px' width='200px'>
        <h4>".$data['item_name']."</h4>
              <span class='text-muted'>".$data['item_price']."/- per packet</span>
              <input type='number' name='qty'>
        <button type='submit' class='btn btn-info btn-xs' name='add' value='$data[item_no]'>Add to <br>basket</button>
            </div></form>";
            $count++;
            if($count%4==0)
            {
              echo"</div><div class='row placeholders'>";
            }

              }
            ?>
          </div>
		  </div>
      </div>
    </div>
		  <!--Groceries -->
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
