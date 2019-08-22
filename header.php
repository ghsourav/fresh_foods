<header>
  <!-- Static navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
    <!--  <div class="container"> -->
        <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Fresh Foods</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
		  	<li><img src="img/Logo.jpeg" class="img-circle" width="50px" height="50px"></li>
            <li class="active" onclick="this.className='active';"><a href="index.php">Home</a></li>
            <li onclick="this.className='active';"><a href="About_us.php">About</a></li>
            <li onclick="this.className='active';"><a href="contact_us.php">Contact</a></li>
            <li onclick="this.className='active';"><a href="feeds.php">Feed Back</a></li>
            <li onclick="this.className='active';"><a href="offers.php">Offers</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Chart Toppers<span class="caret"></span></a>
              <ul class="dropdown-menu">
			  <li class="dropdown-header"><a href="veg.php">Veg</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header"><a href="nonveg.php">Non_veg</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header"><a href="groceries.php">Groceries</a></li>
              </ul>
            </li>
            <li><form name="form1" method="POST" action="search.php"><input name ="find" type="text" placeholder="Search.."><input class="btn btn-success btn-xs navbar-btn" type="submit" value="search" name="submit"></form></li>
          </ul>
          <ul class="nav navbar-nav">
            <?php
            if(isset($_GET['exit']))
            {
              session_unset();
              session_destroy();
            }
            ?>
		  <!--<li><form class="navbar-form navbar-right" method="POST" action=""  name="search">
		  	<input type="text" placeholder="Search...." width="10px">
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>search</button>
		  </form> </li>-->
      <?php
      $connect=mysqli_connect("localhost","root","","fresh_foods");
      if(isset($_POST['u_id'])==true&&isset($_POST['pw'])==true)
      {
        $user=$_POST['u_id'];
        $passkey=$_POST['pw'];
        $res_query=mysqli_query($connect,"SELECT * FROM user_master WHERE email_id='$user' AND password='$passkey'");
        $row=mysqli_fetch_assoc($res_query);
        if($user==$row['email_id']&&$passkey==$row['password'])
        {
          $_SESSION['f_name']=$row['f_name'];
          $_SESSION['l_name']=$row['l_name'];
		  $_SESSION['mail']=$row['email_id'];
          echo"<li><a href='index.php'><span class='glyphicon glyphicon-user'></span>".$_SESSION['f_name']." ".$_SESSION['l_name']."</a></li>
            <li><form name='f1' action='index.php' method='GET'><button class='btn btn-link' type='submit' name='exit' value='1'>Logout</button></form></li><li><a href='orders.php'>orders</a></li>";
        }
        else
        {
          echo"<li><a href='#' data-toggle='modal' data-target='#modal2'><span class='glyphicon glyphicon-user'></span>Signup</a></li>
            <li><a href='#' data-toggle='modal' data-target='#modal1'><span class='glyphicon glyphicon-log-in'></span>Login</a></li>";
        }

      }
      else if(isset($_SESSION['f_name'])==true&&isset($_SESSION['l_name'])==true)
        {
          echo"<li><a href='index.php'><span class='glyphicon glyphicon-user'></span>".$_SESSION['f_name']." ".$_SESSION['l_name']."</a></li>
            <li><form name='f1' action='index.php' method='GET'><button class='btn btn-link' type='submit' name='exit' value='1'>Logout</button></form></li></li><li><a href='orders.php'>orders</a></li>";
        }
      else
      {
        echo"<li><a href='#' data-toggle='modal' data-target='#modal2'><span class='glyphicon glyphicon-user'></span>Signup</a></li>
            <li><a href='#' data-toggle='modal' data-target='#modal1'><span class='glyphicon glyphicon-log-in'></span>Login</a></li>";
      }
      ?>
      <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span><span class="badge"><?php if(isset($_SESSION['mail'])){$query_res=mysqli_query($connect,"SELECT * FROM cart_master WHERE user_id='".$_SESSION['mail']."'"); $numb=mysqli_num_rows($query_res); echo"".$numb;} ?></span></a></li>

            <!--<li><a href="#" data-toggle="modal" data-target="#modal2"><span class="glyphicon glyphicon-user"></span>Sign up</a></li>
            <li><a href="#" data-toggle="modal" data-target="#modal1"><span class="glyphicon glyphicon-log-in"></span>Log in</a></li> -->
          </ul>
        </div><!--/.nav-collapse -->
    <!--  </div> -->
    </nav>
	<div class="container">
	<div class="modal fade" id="modal2">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="modal-title">Registration</h2><nr>
				</div>
				<div class="modal-body">
					<form role="form" name="form2" method="POST" action="register.php">
								<div class="form-group">
									First name: <input class="form-control focusedInput" type="text" name="f_name">
								</div>
								<div class="form-group">
									Last name: <input class="form-control focusedInput" type="text" name="l_name">
								</div>
								<div class="form-group">
									Password: <input class="form-control focusedInput" type="password" name="pw">
								</div>
								<div class="form-group">
									Confirm_Password: <input class="form-control focusedInput" type="password" name="c_pw">
								</div>
								<div class="form-group">
									Gender:<br> MALE<input class="form-control focusedInput" type="radio" name="gender" value="M">FEMALE <input class="form-control focusedInput" type="radio" name="gender" value="F">
								</div>
								<div class="form-group">
									Date of birth: <input class="form-control focusedInput" type="date" name="dob">
								</div>
                <div class="from-group">
                  Address: <input class="form-control focusedInput" type="text" name="add">
                </div>
								<div class="form-group">
									Email_Id: <input class="form-control focusedInput" type="text" name="email">
								</div>
								<div class="form-group">
									Phone_no: <input class="form-control focusedInput" type="number" name="phno">
								</div><hr>
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-warning">Reset</button>
					</form>
				</div>
				</div>
			</div>	
		</div>
	</div><!-- modal2 registration -->
		<div class="modal fade" id="modal1">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="modal-title">Login</h2>
				</div>
				<div class="modal-body">
				<form role="form" method="POST" name="form1" action="index.php">
				<div class="form-group">
				Email: <input class="form-control focusedInput" type="text" name="u_id">
				</div>
				<div class="form-group">
				Password:<input class="form-control focusedInput" type="password" name="pw">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-warning">Reset</button>
				</form>
				</div>
				</div>
			</div>
		</div>
	</div><!-- MOdal login -->
	</header>