<?php
session_start();
mysql_connect("localhost","root","");
mysql_select_db("project");
$id=$_SESSION['sid'];
$res = mysql_query("SELECT * FROM profile where uid=$id"); 
$row = mysql_fetch_array($res);
$query=mysql_query("Select id,name ,content_id, content_title, content, times from contents natural join users where uid = id and uid in
(SELECT uid FROM contents WHERE uid IN (SELECT X.fid AS fid
FROM ( SELECT fid FROM friends WHERE uid =$id )X INNER JOIN (
SELECT uid FROM friends WHERE fid =$id)Y ON X.fid = Y.uid) AND privacy = 'friends'
UNION
SELECT uid FROM contents WHERE uid IN ( SELECT DISTINCT ( Z.fid) AS fid
FROM (SELECT uid, fid FROM friends WHERE uid IN (
SELECT X.fid AS fid FROM ( SELECT uid, fid FROM friends WHERE uid =$id)X
INNER JOIN ( SELECT uid FROM friends WHERE fid =$id)Y ON X.fid = Y.uid))Z)
AND privacy = 'fof' AND uid <>$id) ORDER BY (times) DESC");

//mysql_query("insert into like_content values ('','$id','$friend_id','$content_id'");


if(isset($_POST['tsubmit']))
{


$tsearch=$_POST['tsearch'];
$_SESSION['tsearchid']=$tsearch;

header('location:search.php');

}
if(isset($_POST['fsubmit']))
{


$flag=0;
$fsearch=$_POST['fsearch'];
$fsearchid=mysql_query("select id from users where name like '%".$fsearch."%'");
$fres=mysql_fetch_array($fsearchid);
$_SESSION['fsearchid']=$fsearch;

$search_frn=mysql_query("SELECT id,name AS friends FROM users WHERE id in(
SELECT X.fid AS fid
FROM (SELECT fid FROM friends WHERE uid =$id)X
INNER JOIN (SELECT uid FROM friends WHERE fid =$id)Y ON X.fid = Y.uid ) ");
while($searchrow=mysql_fetch_array($search_frn))
{

if($fres['id']==$searchrow['id'])
{
echo $searchrow['id'];
$flag=1;
break;
}
}
echo $flag;
if($flag==1){
echo "friend";
header('location:search_friends.php');
}
if($flag==0)
{
echo "unfriend";
header('location:notfriend.php');
}
//header('location:search_friends.php');

}



?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
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
				<a href="#">
				
		
				<?php
				
				 echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image_name'] ).'" alt="logo" class="auto-style1" height="247" width="208">';?></a>
			</div>
			<ul class="navigation" style="left: 0px; top: 200px; height: 183px; width: 183px">
				<li>
				<a href="profileset.php">Update</a>
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
					
				<input type="text" name="tsearch" value="Search topic" onblur="this.value=!this.value?'Search Topic':this.value;" onfocus="this.select()" onclick="this.value='';">
				 <input type="submit" name="tsubmit" >  
					</li>
			<li>
					
				<input type="text" name="fsearch" value="Search friends" onblur="this.value=!this.value?'Search Friends':this.value;" onfocus="this.select()" onclick="this.value='';">
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
				while($row=mysql_fetch_array($query))
					{
								
					echo "<li>";
						echo"<div>";
							echo"<div>";
								$fid=$row['id'];
								$pic = mysql_query("SELECT * FROM profile where uid=$fid"); 
								while($pic_row = mysql_fetch_array($pic))
								{
								echo '<a href="#"><img src="data:image/jpeg;base64,'.base64_encode( $pic_row['image_name'] ).'"height="147" width="115" alt="" /></a>';
								
								}
								echo"<a href=\"profile.php?prop_id=".$fid."\">".$row['name']."</a>";
							
							echo"</div>";
							echo"<div>";
							
								echo"<h3>".$row['content_title']."</h3>";
								
								echo'<p style="text-align:left">'.$row['content'].'</p>';
								
								echo'<h5 style="text-align:left">';
								
								echo"<a href=\"like.php?frn_id=".$fid."&amp;content_id=".$row['content_id']."&amp;choice=1\"> Like</a>&nbsp;&nbsp;";
								echo"<a href=\"like.php?frn_id=".$fid."&amp;content_id=".$row['content_id']."&amp;choice=2\"> Comment</a></h5>";
								
								
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
	</form>
</body>
</html>