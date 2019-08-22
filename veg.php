<?php
  session_start();
  
?>
 <?php
    $connect=mysqli_connect("localhost","root","","fresh_foods");
    if(!$connect)
    {
      exit("Connection failed");
    } 
  ?>
<!DOCTYPE html>
<html>
<head>
<title>veg</title>

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
    if(isset($_GET['add'])==true)
    {
	 if(isset($_SESSION['mail']))
     {
      if($_GET['qty']==0)
      {
        echo"<script>window.alert('Enter the Quantity')</script>";
      }
      else
      {
		  
		$mail=$_SESSION['mail'];
        $product=$_GET['add'];
        $result2=mysqli_query($connect,"SELECT * FROM cart_master WHERE item_name='$product' AND user_id='$mail'");
		$ress2=mysqli_query($connect,"SELECT * FROM veg_stock WHERE item_name='$product'");
		$prc=mysqli_fetch_assoc($ress2);
		
		$c_rows=mysqli_fetch_assoc($result2);
		$qty;
		$stock;
		if($_GET['qty']>$prc['stock'])
		{
			echo"<script>alert('Quantity Exceeding Stock');</script>";
		}
		else
		{
			$stock=$prc['stock'];
			if(mysqli_num_rows($result2)>0)
			{
			  $qty=$c_rows['item_qty'];
			  $price=$c_rows['item_price'];
			  
			  $qty=$qty+$_GET['qty'];
			  $total=$qty*$price;
			  mysqli_query($connect,"UPDATE cart_master SET item_qty='$qty',total_price='$total' WHERE item_name='$product' AND user_id='$mail'");
		   }
			else
			{
				
			  $result3=mysqli_query($connect,"SELECT item_price FROM veg_stock WHERE item_name='$product'");
			  $Row3=mysqli_fetch_assoc($result3);
			  $v_price=$Row3['item_price'];
			  $qty=$_GET['qty'];
			   $totalprice=$v_price*$qty;
			  mysqli_query($connect,"INSERT INTO cart_master (user_id,item_name,item_type,item_qty,item_price,total_price) VALUES ('$mail','$product','veg','$qty',$v_price,$totalprice)");   
			}
			$stock=$stock-$qty;
			mysqli_query($connect,"UPDATE veg_stock SET stock='$stock' WHERE item_name='$product'");
		}
      }
	}
	else{
	header("location: cart.php");
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
            <li class="active"><a href="#"><span class="glyphicon glyphicon-leaf"></span>Veg and Fruits</a></li>
            <li><a href="nonveg.php"><span class="glyphicon glyphicon-cutlery"></span>Non_Veg</a></li>
			<li><a href="groceries.php"><span class="glyphicon glyphicon-th"></span>Groceries</a></li>
			<li><a href="offers.php"><span class="glyphicon glyphicon-gift"></span>Offers</a></li>
			<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>My_cart<span class="badge"></span></a></li>
			<li><a href="orders.php"><span class="glyphicon glyphicon-gift"></span>Orders</a></li>
         </ul>
        </div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Vegetables <br>& Fruits</h1>

          <div class="row placeholders">
          <?php
            $result=mysqli_query($connect,"SELECT * FROM veg_stock");
            $val=mysqli_num_rows($result);
            $counter=0;
            if($val==true)
            {
              while($row=mysqli_fetch_assoc($result))
              {
                $img=$row['item_img'];
                echo"<form name='f1' method='GET' action='veg.php'><div class=' well col-xs-6 col-sm-3 placeholder'>
              <img src='img/Veg/$row[item_img]' class='img-circle' alt='Generic placeholder thumbnail' height='200px' width='200px'>
        <h4>".$row['item_name']."</h4>
              <span class='text-muted'>Rs".$row['item_price']."/- per Kg</span>
              <input type='number' name='qty'>
        <button name='add' type='submit' class='btn btn-info btn-xs' value='$row[item_name]'>Add to <br>basket</button>
            </div></form>";
            $counter++;
            if($counter==4)
            {
              echo"</div><div class='row placeholders'>";
            }
              }
            }

          ?>
         
          </div>
		  
		  </div>
      </div>
    </div>
		  <!--vegsection -->
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
