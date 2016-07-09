<?php
session_start();
mysql_connect("localhost","root","");
mysql_select_db("project");

$id=$_SESSION['sid'];
echo $id;
$res = mysql_query("SELECT * FROM profile where uid=$id"); 
$row = mysql_fetch_array($res);
$fsearch=$_SESSION['fsearchid'];
//echo $search;
$squery=mysql_query("select * from profile where fname like'%".$fsearch."%'");
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Appapp &amp; Away Website Template</title>
	<link rel="stylesheet" href="style.css" type="text/css">
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
				<a href="#">
				
		
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
				<form method="post" >
			<div class="article">
				
				<a href="post.php">Post Feed!</a>
			</div>
			<div class="blog">
				<div class="date">
					<span><?php echo date("d-m-Y");?></span>
					
				</div>
				<div>
					
					<h2>Latest Feed</h2>
					<div>
						border
					</div>
				</div>
				
				<ul>
				<?php 
				
					echo "<li>";
						echo"<div>";
							echo"<div>";
								while($fsearch = mysql_fetch_array($squery))
								{
								echo '<a href="#"><img src="data:image/jpeg;base64,'.base64_encode( $fsearch['image_name'] ).'"height="147" width="115" alt="" /></a>';
								
								
								echo"<a href=\"profile.php?prop_id=".$fsearch['uid']."\">". $fsearch['fname']."</a>";
							echo"</div>";
							echo"<div>";
							
								echo"<h3> Pasion is :- ".$fsearch['passion']."</h3>";
								
								echo'<p style="text-align:left"> About Myself :- '.$fsearch['description'].'</p>';
								echo'<p style="text-align:left"> Contact Info :- '.$fsearch['email_id'].'</p>';
								
								
								echo"</div>";
						echo"</div>";
					echo"</li>";
					}
					?>
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