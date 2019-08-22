<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>

<title>Contact_Us</title>

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
</head>
<?php $connect=mysqli_connect("localhost","root","","fresh_foods"); ?>
<body>
	<?php
	include("header.php");
	?>
	
	<div class="container" style="background-color:#FFFECA">
		<div class="well">
			<div class="jumbotron">
				<h1>Contact Us</h1>
				<div class="container">
					<dl>
						<dt>Email us: </dt>
							<dd><i>fresh_foods15@gmail.com</i></dd><br>
						<dt>Call us:</dt>
							<dd> 9746673686/ 9830381159</dd
					></dl>
				</div>
				<p class="lead">Dear User<br>
				thanks for visiting us. Hope you liked our service. For more offers<br><i style="color:#164AC2">Click below</i> to get registered</p>
			 <p><a class="btn btn-lg btn-success" href="#" role="button" data-target="#modal2" data-toggle="modal">Sign up</a></p>
			 </div>
			 <div class="jumbotron" >
			 	<h1>Follow us </h1>
					<div class="row">
						<div class="col-lg-4" style="padding:10px;">
						<img src="img/facebook.jpg" class="img-circle" width="140px" alt="www.facebook.com">
						</div>
						<div class="col-lg-4" style="padding:10px;">
						<img src="img/twitter.png" class="img-circle" width="140px" alt="www.twitter.com">
						</div>
						<div class="col-lg-4" style="padding:10px;">
						<img src="img/google.jpg" class="img-circle" width="140px" alt="plus.google.com">
						</div>
					</div>
			 </div>
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
