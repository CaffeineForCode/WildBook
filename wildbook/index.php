<?php
session_start();
mysql_connect("localhost","root","");
mysql_select_db("project");
if(isset($_POST['submit']))
{
$id=$_REQUEST['id'];
$pwd=$_REQUEST['pwd'];
$_SESSION['sid']=$id;


if($id=="" or $pwd=="")
	{
	$error="fill your name and password";
	}
	else
	{
	$sql="select * from users where id='$id' and pwd='$pwd'";
	$data=mysql_query($sql);
    	  $res=mysql_fetch_array($data);
	
	if($res['id']==$id and $res['pwd']==$pwd)
		{
		//echo "hii";
		header('location:wall.php');
		}
		else
		{
		echo "invalid";
		}
	
	}
}


?>


<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>WildBooK - LogIN</title>
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
					<a href="">LOGIN</a>
				</li>
				
			</ul>
			
			
		</div>
		<div class="content">
			<div>
			<h3 style="text-decoration: blink; text-align: center"; style=" font-style: italic;"> Welcome To Wildbook</h3>
			
			</div>
			<div class="apps">
				<div class="date">
					
					<span><?php echo date("d-m-Y");?></span>
				</div>
				<div>
					
					
				</div>
<ul>
				
					<li>
					<form method="post">
						<input type="text" name="id"  placeholder="id" >
						<input type="password" name="pwd"  placeholder="Password">
    						<input type="submit" name="submit" value="LogIn">
						<a href="signup.php">New User? </a>

						</form>

						
</li>						
		
</ul>	
				
			</div>
		</div>
	</div>
</body>
</html>