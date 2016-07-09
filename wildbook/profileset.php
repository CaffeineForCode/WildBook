<?php
session_start();
mysql_connect("localhost","root","");
mysql_select_db("project");
$id=$_SESSION['sid'];
$res=mysql_query("select * from users where id=$id");
$row = mysql_fetch_array($res); 


if(isset($_POST['submit']))
{
if(($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg"))
{
$image_name = mysql_real_escape_string($_FILES['image']['name']);
$image = mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
$name=$row['name'];
$description=$_REQUEST['description'];
$gender=$_REQUEST['gender'];
$passion=$_REQUEST['passion'];
$email=$_REQUEST['email'];

$query="update profile set image_name='$image',gender='$gender',passion='$passion',description='$description',email_id='$email' where uid=$id";
mysql_query($query);
header('location:wall.php');
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
					<a href="">Update</a>
				</li>
				
			</ul>
			
			
		</div>
		<div class="content">
			<div>
				<h3 style="text-decoration: blink; text-align: center"; style=" font-style: italic;"><?php echo "Welcome &nbsp; &nbsp;" .$row['name']; ?></h3>
				<p style="text-align:right"><a href="wall.php">Home</a>&nbsp;&nbsp;<a href="logout.php">Logout</a></p>
				

			</div>
			<div class="apps">
				<div class="date">
					<span><?php echo date("d-m-Y");?></span>
				</div>
				<div>
					
					
				</div>
<h1> Please Update Your Profile !!</h1>
<ul>
				
					<li>
					
<form method="post" enctype="multipart/form-data">
					<h4 align="left" >User Profile Picture <input type="file" name="image" id="image"></h4>
					


					<h4 align="left" >Choose your gender <input type= "radio" name="gender" value="Male">Male  &nbsp; &nbsp;<input type="radio" name="gender" value="Female" >Female</h4>

					<h4 align="left" >Passion<input type="text" name="passion"></h4>
					
					<h4 align="left" >Email Id<input type="email" name="email"></h4>
					
					<h4 align="left" >Description<textarea rows="4" cols="60" name="description" placeholder="Write about yourself"></textarea>
					

					<h4 align="right"><input type="submit" name="submit" value = "Update"></h4>
				</form>

</li>
			
			
				</ul>
			</div>
		</div>
	</div>
</body>
</html>