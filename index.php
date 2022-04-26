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
<body>
<img id="pic" src="logo.png"/>
<form action="" method="get">
<label class="character">Select Color</label>
            <select type="text" name="n">
                <option>Black</option>
                <option>White</option>
                <option>Brown</option>
                <option>Pink</option>
                <option>Grey</option>
                <option>Blue</option>
                <option>Red</option>
            </select>
			<input class="myButton" type="submit" value="send" />
</form>

<form action="" method="get">
<label class="character">Filter</label>
            <select type="text" name="filter">
                <option>All</option>
                <option>Today</option>
                <option>Yesterday</option>
                <option>7 Days</option>
                
            </select>
			<input class="myButton" type="submit" value="Filter" />
</form>


<form action="" method="get">
  <label for="date1">From Date:</label>
  <input type="date" id="date1" name="date1">
  <label for="date2">To Date:</label>
  <input type="date" id="date2" name="date2">
  
  <input class="myButton" type="submit" value="Between 2 Dates">
</form>
</body>
</html>
<?php
include "functions.php"; 
$date1=0;
$date2=0;
$filter="Between 2 Dates";
$mysqli=set_db_connection();
if(isset($_GET['filter']))
	$filter=$_GET['filter'];
else
	$filter="Between 2 Dates";
if($filter=="All")
{	
maxColorAll($mysqli);
showAll($mysqli);
}

if($filter=="Yesterday")
{
maxColorYesterday($mysqli);
showYesterday($mysqli);
}


if($filter=="Today")
{
	maxColorToday($mysqli);
showToday($mysqli);
}

if($filter=="7 Days")
{
	maxColorWeek($mysqli);
	showWeek($mysqli);
}
if($filter="Between 2 Dates")
{
	if(isset ($_GET['date1']))
	$date1=$_GET['date1'];
if(isset ($_GET['date2']))
	$date2=$_GET['date2'];
maxColorBetween($mysqli,$date1,$date2);
showFromTo($mysqli,$date1,$date2);

}

	
