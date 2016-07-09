<?php
session_start();
mysql_connect("localhost","root","");
mysql_select_db("project");
$id=$_SESSION['sid'];
$res = mysql_query("SELECT * FROM profile where uid=$id"); 
$row = mysql_fetch_array($res);
$query=mysql_query("SELECT id,name AS friends FROM users WHERE id in(
SELECT X.fid AS fid
FROM (SELECT fid FROM friends WHERE uid =$id)X
INNER JOIN (SELECT uid FROM friends WHERE fid =$id)Y ON X.fid = Y.uid ) ");
if(isset($_POST['tsubmit']))
{


$tsearch=$_POST['tsearch'];
$_SESSION['tsearchid']=$tsearch;

header('location:search.php');

}
if(isset($_POST['fsubmit']))
{


$fsearch=$_POST['fsearch'];
$_SESSION['fsearchid']=$fsearch;

header('location:search_friends.php');

}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Appapp &amp; Away Website Template</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<!--[if IE 7]>
		<link rel="stylesheet" href="css/ie7.css" type="text/css">
	<![endif]-->
	<style type="text/css">
	.auto-style1 {
		margin-left: 12px;
	}
	</style>
</head>
<body>
<form method="post">
	<div class="page">
		<div class="sidebar">
			<div id="logo" style="left: -85px; top: 0">
				<a href="index.html">
				<?php
				
				 echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image_name'] ).'" alt="logo" class="auto-style1" height="247" width="208">';?></a>
			</div>
			<ul class="navigation" style="left: 0px; top: 200px; height: 183px; width: 183px">
				<li>
				<a href="profileset.php">Update </a>
				</li>
				
				<li>
				
					<a href="friends.php">Friends</a></li>
				<li>
					<a href="Pendingreq.php">Pending Request</a>
				</li>
				<li>
				

					<a href="#">Liked places</a>
				</li>
				<li>
					
				<input type="text" name="tsearch" value="Search" onblur="this.value=!this.value?'Search Topic':this.value;" onfocus="this.select()" onclick="this.value='';">
				<input type="submit" name="tsubmit" >
					</li>
			<li>
					
				<input type="text" name="fsearch" value="Search" onblur="this.value=!this.value?'Search Friends':this.value;" onfocus="this.select()" onclick="this.value='';">
				<input type="submit" name="fsubmit" >
					</li>
			</ul>
			
		</div>
		<div class="content">
		<div>
				<h3 style="text-decoration: blink; text-align: center"; style=" font-style: italic;"><?php echo "Welcome &nbsp; &nbsp;" .$row['fname']; ?></h3>
				
				<p style="text-align:right"><a href="wall.php">Home</a>&nbsp;&nbsp;<a href="logout.php">Logout</a></p>
				
				</div>
				
			<div class="article">
				
				<a href="post.php">Post Feed!</a>
			</div>
			<div class="blog">
				<div>
					
					<h2>Friends</h2>
					<div>
						border
					</div>
				</div>
				<ul>
				<li>
				<?php 
				
				while($row=mysql_fetch_array($query))
					{
				
						echo"<div>";
							echo"<div>";
								$fid=$row['id'];
								$pic = mysql_query("SELECT * FROM profile where uid=$fid"); 
								while($pic_row = mysql_fetch_array($pic))
								{
								echo '<a href="#"><img src="data:image/jpeg;base64,'.base64_encode( $pic_row['image_name'] ).'"height="100" width="75" alt="" /></a>';
								
								}
								echo"<a href=\"profile.php?prop_id=".$fid."\">".$row['friends']."</a>";
						
								echo"</div>";
							echo"</div>";
					
					}
					?>
					</li>
				</ul>
				
				<div class="section">
					
					<a href="#">Show All</a>
					<div class="paging">
						<a "href="#">Prev</a>
						<a href="#">Next</a>
					</div>
				</div>
			</div>
		</div>
			<div class="connect">
				</div>
	</div>
	</form>
</body>
</html>