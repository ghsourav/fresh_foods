<?php
	session_start();
	$connect=mysqli_connect("localhost","root","","fresh_foods");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/Logo.jpeg">

    <!-- Bootstrap core CSS -->
	<link href="carousel.css" rel="stylesheet">
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
		<title>OFFERS</title>
	</head>
	<body>
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
			<li class="active"><a href="#"><span class="glyphicon glyphicon-gift"></span>Offers</a></li>
			<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>My_cart</a></li>
         </ul>
        </div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Offers</h1>
          <div class="row placeholders">
		  <div class="well">
			<div id="offerslide" class="carousel slide">
				<ol class="carousel-indicators">
					<li data-target="#offerslide" data-slide-to="0" class="active"></li>
					<li data-target="#offerslide" data-slide-to="1"></li>
					<li data-target="#offerslide" data-slide-to="2"></li>
					<li data-target="#offerslide" data-slide-to="3"></li>
				</ol>
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="img/food1.jpg" >
					</div>
					<div class="item">
						<img src="img/food2.jpg" >
					</div>
					<div class="item/food3.jpg">
						<img src="" >
					</div>
					<div class="item/food4.jpg">
						<img src="" >
					</div>
				</div>
				<a class="left carousel-control" role="button" href="#offerslide" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control right" role="button" href="#offerslide" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			
		  </div>
		  
			<!--<div class="well">
				<div class="carousel slide" id="#discount">
				<ol>
					<li data-slide-to="0" data-target="#discount"></li>
					<li data-slide-to="1" data-target="#discount"></li>
					<li data-slide-to="2" data-target="#discount"></li>
					<li data-slide-to="3" data-target="#discount"></li>
					<li data-slide-to="4" data-target="#discount"></li>
					<li data-slide-to="5" data-target="#discount"></li>
				</ol>
					<div class="carousel-inner">
						<div class="item active">
							<div class="col-xs-6 col-sm-3 placeholder">
								<img src="">
							</div>
						</div>
						<div class="item">
							<div class="col-xs-6 col-sm-3 placeholder">
								<img src="">
							</div>
						</div>
						<div class="item">
							<div class="col-xs-6 col-sm-3 placeholder">
								<img src="">
							</div>
						</div>
						<div class="item">
							<div class="col-xs-6 col-sm-3 placeholder">
								<img src="">
							</div>
						</div>
						<div class="item">
							<div class="col-xs-6 col-sm-3 placeholder">
								<img src="">
							</div>
						</div>
						<div class="item">
							<div class="col-xs-6 col-sm-3 placeholder">
								<img src="">
							</div>
						</div>
						<a class="left carousel-control" href="#discount" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
							<span class="sr-only"></span>
						</a>
						<a class="right carousel-control" href="#discount" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
							<span class="sr-only"></span>
						</a>
					</div>
			</div>
		  </div>-->
      </div>
	  <h1 class="page-header">Discounts</h1>
	  <div class="well">
	  <div class="row placeholders">
	  <?php
		$count=0;
		$rows=mysqli_query($connect,"SELECT * FROM offers");
		if(mysqli_num_rows($rows)>0)
		{
			while($var=mysqli_fetch_assoc($rows))
			{
				if($var['offer_type']=="veg")
				{
						$img="img/Veg/".$var['offer_image'];
				}
				if($var['offer_type']=="nonveg")
				{
					$img="img/Nonveg/".$var['offer_image'];
				}
				if($var['offer_type']=="grocery")
				{
					$img="image/Groceries/".$var['offer_image']; 
				}
				echo"<form name='f1' method='post' action=''>
						<div class='well col-sm-4 placeholders' style='overflow:hidden;'>
				<img src=$img height='140px' width='140px' class='img-circle'><h1>".$var['product_name']."</h1><br><h4 style='display:inline;'>offer price Rs".$var['offer_p']."</h4>&nbsp<br><h4 style='display:inline;'>offer valid ".$var['offer_valid']."</h4></div>
						</form>";
						$count++;
						if($count%3==0)
						{
							echo"</div><div class='row placeholders'>";
						}
			}
		}
	  ?>
	 <!-- <form name="f1" method="post" action="veg.php">
			<div class="well col-sm-4 placeholders" style="overflow:hidden;">
				<img src="img/Veg.png" height="140px" width="140px" class="img-circle"><h1>Offers on Veg</h1><br><button class="btn btn-primary ">SUBMIT</button></div>
		</form>
		<form name="f2" method="post" action="nonveg.php">
			<div class="well col-sm-4 placeholders" style="overflow:hidden;">
				<img src="img/Non_veg.jpg" height="140px" width="140px" class="img-circle"><h1>Offers on Non Veg</h1><br><button class="btn btn-success">SUBMIT</button></div>
		</form>
		<form  name="f2" method="post" action="groceries.php">
			<div class="well col-sm-4 placeholders" style="overflow:hidden;">
				<img src="img/groceries.gif" height="140px" width="140px" class="img-circle"><h1>Offers on Groceries</h1><br><button class="btn btn-warning" value="offveg">SUBMIT</button></div>
			</form>-->
				
		<!--<div class="well col-xs-6 col-sm-3 placeholders"></div>-->
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