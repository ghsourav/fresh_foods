
<?php
session_start();
$order_id;
if(isset($_GET['order_id']))
{
	$order_id=$_GET['order_id'];
}
$connect=mysqli_connect("localhost","root","","fresh_foods");
$res1=mysqli_query($connect,"SELECT * FROM user_master WHERE email_id='".$_SESSION['mail']."'");
$user=mysqli_fetch_assoc($res1);
$res2=mysqli_query($connect,"SELECT * FROM order_details WHERE order_id='".$order_id."' AND user_email='".$_SESSION['mail']."'");

?>

<!-- Bootstrap core CSS -->
	<link href="carousel.css" rel="stylesheet">
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="../../assets/js/ie8-responsive-file-warning.js"></script>
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
	<link href="dashboard.css" rel="stylesheet">


 <?php mysqli_query ($connect,"SELECT order_id,order_status,user_id,order_date,contact_no,user_name,user_address,products FROM order_details"); ?>  

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order </h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed From:<br>
                     <?php 
                    echo "FRESH FOODS<br>Email: mail@fresh_foods.com<br>Phno: 9748673686";
					
					?> </strong><br>
    					<br>
    					
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					<?php
							echo"NAME: ".$user['f_name']." ".$user['l_name']."<br>";
							echo"ADDRESS: ".$user['address']."<br>";
							echo"EMAIL: ".$user['email_id']."<br>";
							echo"PHNO: ".$user['ph_no']."<br>";
						?>
                        
    
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					<?php echo date("d-m-Y");?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>ORDER ID</strong></td>
									<td class="text-center"><strong>INVOICE ID</strong></td>
        							<td class="text-center"><strong>ORDER DETAILS</strong></td>
        							<td class="text-right"><strong>TOTAL</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
								<?php
								if(mysqli_num_rows($res2)==0)
								{
									echo"<tr><td>Order not found</td></tr>";
								}
								while($user_order=mysqli_fetch_assoc($res2))
								{
    							echo"<tr>
    								<td>".$user_order['order_id']."</td>
    								<td class='text-center'>".$user_order['invoice_id']."</td>
    								<td class='text-center'>".$user_order['products']."</td>
    								<td class='text-right'> Rs ".$user_order['pay_amount']."</td>
    							</tr>";
									
								}
								?>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>


<style>

.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}


</style>