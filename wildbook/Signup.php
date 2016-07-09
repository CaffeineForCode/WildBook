<?php
session_start();
mysql_connect("localhost","root","");
mysql_select_db("project");
if(isset($_POST['signup']))
{
$id=$_REQUEST['id'];
$name=$_REQUEST['name'];
$pwd=$_REQUEST['Password'];
$rpwd=$_REQUEST['Rpassword'];
$city=$_REQUEST['City'];
$dob=$_REQUEST['dob'];
if($id=="" or $pwd=="")
	{
	echo "Fill all fields!";
	}
elseif($pwd!=$rpwd)
echo "password does not match";
else
{
$query="insert into users values('$id','$name','$dob','$pwd','$city')";
mysql_query($query);
echo "account created successfully";
header('location:index.php');
}
}



?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>WildBooK - SignUP</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<!--[if IE 7]>
		<link rel="stylesheet" href="css/ie7.css" type="text/css">
	<![endif]-->
</head>
<body>
	<div class="page">
		<div class="sidebar">
			<div id="logo">
			
			
			</div>
			<ul class="navigation">
				
				<li class="selected">
					<a href="">SignUP</a>
				</li>
				
			</ul>
			
			
		</div>
		<div class="content">
			<div>
				

			</div>
			<div class="apps">
				<div class="date">
					<span><?php echo date("d-m-Y");?></span>
				</div>
				<div>
					
					
				</div>
<h1>Your Details Please!!</h1>
<ul>
				
					<li>
					
<form method="post">
					<h4 align="left" >User Id<input type="text" name="id"></h4>
					


					<h4 align="left" >Name<input type="text" name="name"></h4>

					<h4 align="left" >City<input type="text" name="City"></h4>
					
					<h4 align="left" >Password<input type="password" name="Password"></h4>
					
					<h4 align="left" >Retype Password<input type="password" name="Rpassword"></h4>
					
					<h4 align="left" >Date of Birth <input type="text" placeholder="yyyy-mm-dd" name="dob"></h4>

					<h4 align="right"><input type="submit" name="signup" value = "Signup"></h4>
				</form>

</li>
			
			
				</ul>
			</div>
		</div>
	</div>
</body>
</html>