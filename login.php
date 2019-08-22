<?php
session_start();
	$uid=$_POST['u_id'];
	$pw=$_POST['pw'];
	$connect=mysqli_connect("localhost","root","","fresh_foods");
	if(!$connect)
	{
		die("server error".mysqli_error());
	}
	else
	{
		$q_val=mysqli_query($connect,"SELECT f_name,l_name,email_id,password FROM user_master WHERE email_id='$uid' AND password='$pw'");
		if(mysqli_num_rows($q_val)>0)
		{
			$rows=mysqli_fetch_assoc($q_val);
			if($rows['email_id']==$uid&&$rows['password']==$pw)
			{
				$_SESSION['msg']="<script>window.alert('Welcome')</script>";
				$_SESSION['fnm']=$rows['f_name'];
				$_SESSION['lnm']=$rows['l_name'];
				header("location: try2.html");
			}
			else
			{
				echo"<script>window.alert('Wrong user id password')</script";
				session_destroy();
			}

		}
		else
		{
			echo"<script>window.alert('User not Found')</script>";
			session_destroy();
		}
	}
?>