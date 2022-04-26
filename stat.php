<html>
<style>
#pic{
	position: absolute;
  right: 0px;
}
body{
font-size:20px;
background-image: url("bg.png");
background-repeat: no-repeat;
background-position: center;
}
.myButton {
	box-shadow: 0px 0px 0px 2px #101012;
	background:linear-gradient(to bottom, #0d0e0f 5%, #445161 100%);
	background-color:#0d0e0f;
	border-radius:10px;
	border:1px solid #0b0c0d;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:12px;
	padding:6px 11px;
	text-decoration:none;
	text-shadow:0px 1px 0px #030303;
}
.myButton:hover {
	background:linear-gradient(to bottom, #445161 5%, #0d0e0f 100%);
	background-color:#445161;
}
.myButton:active {
	position:relative;
	top:1px;
}

</style>
<body><img id="pic" src="logo.png"/></body>
</html>
<?php
include "functions.php"; 
$mysqli=set_db_connection();
countColor($mysqli,$_GET['color']);
showColor($mysqli,$_GET['color']);
