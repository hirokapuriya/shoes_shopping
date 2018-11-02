<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<style type="text/css">
			body{
				background-color: black;
				
			}
		#center{
			
			margin: 200px;
			margin-left: 450px;
		}
		</style>
	</head>

<body>
<div id="center">
				
				<form action="proccess_login.php" method="post">
					<font color="red" size="15">ADMIN LOGIN</font>
					</br></br>			
					
					<label><b><font color="white">UserName</font></b></label>
					
					<input class="input" value="" type="text" name="unm">
					<br />
					<br />
					<label><b><font color="white">Password</font></b></label>
					&nbsp;&nbsp;<input class="input" value="" type="password" name="pwd">
					<br />
					<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Login" />
					<a href="forgot_password.php">&nbsp;&nbsp;Forgot Password</a>
				</form>
		</div>
</html>