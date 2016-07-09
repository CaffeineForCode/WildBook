<?php
session_start();
mysql_connect("localhost","root","");
mysql_select_db("project");
$id=$_GET['prop_id'];
$res = mysql_query("SELECT * FROM profile where uid=$id"); 
$row = mysql_fetch_array($res);
$query=mysql_query("Select id,name , content_title, content, times from contents natural join users where uid = id and uid in
(SELECT uid FROM contents WHERE uid IN (SELECT X.fid AS fid
FROM ( SELECT fid FROM friends WHERE uid =$id )X INNER JOIN (
SELECT uid FROM friends WHERE fid =$id)Y ON X.fid = Y.uid) AND privacy = 'friends'
UNION
SELECT uid FROM contents WHERE uid IN ( SELECT DISTINCT ( Z.fid) AS fid
FROM (SELECT uid, fid FROM friends WHERE uid IN (
SELECT X.fid AS fid FROM ( SELECT uid, fid FROM friends WHERE uid =$id)X
INNER JOIN ( SELECT uid FROM friends WHERE fid =$id)Y ON X.fid = Y.uid))Z)
AND privacy = 'fof' AND uid <>$id) ORDER BY (times) DESC");

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
<!-- Website template by freewebsitetemplates.com -->
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
	<div class="page">
		<div class="sidebar">
			<div id="logo" style="left: -85px; top: 0">
				<a href="index.html">
				<?php
				
				 echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image_name'] ).'" alt="logo" class="auto-style1" height="247" width="208">';?></a>
			</div>
			<ul class="navigation" style="left: 0px; top: 200px; height: 183px; width: 183px">
								
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
				<h3 style="text-decoration: blink; text-align: center"; style=" font-style: italic;"><?php echo "Welcome &nbsp; To&nbsp;" .$row['fname']."&nbsp; Profile"; ?></h3>
				
				<p style="text-align:right"><a href="wall.php">Home</a>&nbsp;&nbsp;<a href="logout.php">Logout</a></p>
				
				</div>
				
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
				while($row=mysql_fetch_array($query))
					{
					echo "<li>";
						echo"<div>";
							echo"<div>";
								$fid=$row['id'];
								$pic = mysql_query("SELECT * FROM profile where uid=$fid"); 
								while($pic_row = mysql_fetch_array($pic))
								{
								echo '<a href="profile.php?prop_id="'.$fid.'><img src="data:image/jpeg;base64,'.base64_encode( $pic_row['image_name'] ).'"height="147" width="115" alt="" /></a>';
								
								}
								echo"<a href='#'>".$row['name']."</a>";
							echo"</div>";
							echo"<div>";
							
								echo"<h3>".$row['content_title']."</h3>";
								
								echo'<p style="text-align:left">'.$row['content'].'</p>';
								
								echo "<a >".$row['times']."</a>";
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
</body>
</html>