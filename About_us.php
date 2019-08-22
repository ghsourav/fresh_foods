<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>About us</title>
<!-- Bootstrap core CSS -->
	<link rel="icon" href="img/Logo.jpeg">
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" href="jumbotron.css">
<?php
$connect=mysqli_connect("localhost","root","","fresh_foods");
?>

</head>

<body>
 <?php
 include("header.php");
 ?>
 	<div class="container">
		<div class="jumbotron" style="border-top-left-radius:50px; border-top-right-radius:50px; border-bottom-right-radius:50px; border-bottom-left-radius:50px; box-shadow:-2px 4px 5px 5px; ">
			<center>
				<h1>About us</h1>
				<p>Fresh food's vision is to

create India's most impactful digital food marketing ecosystem that creates life-changing experiences for buyers and sellers. In JUNE 2015, Kushal banik along with Subham pal, Ratul Halder, Sekhar saha, Sushmita Ghosh, Sourav Ghosh, Anirban das started foodbasket.in- Kolkata's largest online Food marketplace, with the widest assortment of various products from thousands of regional, national,brands and retailers.With millions of users and 150,000 sellers, Foodbasket is the shopping destination for internet users across the city, delivering to many cities and towns in West Bengal. With its acquisition of Freecharge in 2015, a leading mobile transactions platform, it will become the largest m-Commerce company in the WestBengal.
				</p>
			</center>
		</div>
	</div>
 	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
