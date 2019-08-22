<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Non Veg</title>
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
  
    if(isset($_POST['addc'])!=false)
    { 
	  if(isset($_SESSION['mail']))
	  {
		$mail=$_SESSION['mail'];
		 
		if($_POST['n1']<=0)
		{
			echo"<script type='text/javascript'>alert('Quantity Cannot be Empty');</script>";
		}
		else
	{
     $id=$_POST['addc'];
      $qty=$_POST['n1'];
      $cid=mysqli_query($connect,"SELECT * FROM nonveg_stock WHERE item_no='$id'");
      $idval=mysqli_fetch_assoc($cid);
      $itemname=$idval['item_name'];
	  $stock=$idval['stock'];
      $itemprice=$idval['item_price'];
      $total_price=$qty*$idval['item_price'];
      $check_q=mysqli_query($connect,"SELECT * FROM cart_master WHERE item_name='$itemname' AND user_id='$mail'");
	  if($qty>$stock)
	  {
		  echo "<script>alert('Quantity Exceeding stock');</script>";
	  }
	  else
	 {
			  if(mysqli_num_rows($check_q)>0)
			  {
				$fetch_val=mysqli_fetch_assoc($check_q);
				$qty=$qty+$fetch_val['item_qty'];
				$total_price=$qty*$fetch_val['item_price'];
				mysqli_query($connect,"UPDATE cart_master SET item_qty='$qty',total_price='$total_price' WHERE item_name='$itemname' AND user_id='$mail'");
			  }
			  else
			  {
				mysqli_query($connect,"INSERT INTO cart_master(user_id,item_name,item_type,item_qty,item_price,total_price) VALUES('$mail','$itemname','nonveg','$qty','$itemprice','$total_price')");
			  }
			  $stock=$stock-$qty;
			  mysqli_query($connect,"UPDATE nonveg_stock SET stock='$stock' WHERE item_no='$id'");
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
           <li><a href="veg.php"><span class="glyphicon glyphicon-leaf"></span>Veg and Fruits</a></li>
            <li class="active"><a href="#"><span class="glyphicon glyphicon-cutlery"></span>Non_Veg</a></li>
      <li><a href="groceries.php"><span class="glyphicon glyphicon-th"></span>Groceries</a></li>
      <li><a href="offers.php"><span class="glyphicon glyphicon-gift"></span>Offers</a></li>
      <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>My_cart<span class="badge"></span></a></li>
	  <li><a href="orders.php"><span class="glyphicon glyphicon-gift"></span>Orders</a></li>
         </ul>
        </div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"> Non veg</h1>
          <div class='row placeholders'>
          <?php
          $counter=0;
            $fetch_q_rs=mysqli_query($connect,"SELECT * FROM nonveg_stock");
            while($val=mysqli_fetch_assoc($fetch_q_rs))
            {             
              if($val['item_status']==1)
              {
                echo"<form name='form1' method='POST' action='nonveg.php'><div class=' well col-xs-6 col-sm-3 placeholder'>
              <img src='img/Nonveg/$val[item_img]' class='img-circle' alt='Generic placeholder thumbnail' height='200px' width='200px'>
        <h4>".$val['item_name']."</h4>
              <span class='text-muted'>".$val['item_price']."/- per kg</span>
          <input type='number' name='n1'><br><button name='addc' type='submit' class='btn btn-info btn-xs' value='$val[item_no]'>Add to <br>basket</button>
            </div></form>";
            $counter++;
              }
              else
              {
                continue;
              }
              if($counter==4)
              {
                echo"</div><div class='row placeholders'>";
              }

            }
          ?>
        </div>
        
		  </div>
      </div>
    </div>
		  <!-- nonvegsection -->


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
