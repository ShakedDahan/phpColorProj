<?php
function set_db_connection(){
	$mysqli=new mysqli("localhost","shaked","Sd6696639","phpdb");

	return $mysqli;
}
function close_db_connection($mysqli){
	mysqli_close($mysqli);
}
function save_to_db($mysqli,$color,$today){
	$query = "INSERT INTO `colors` (`color`, `date`) VALUES ('$color', '$today'); ";
echo "$query <br />";
	$result=mysqli_query($mysqli,$query);
}

	function get_colors($mysqli){
	$qq="SELECT color FROM `colors` group BY `color` DESC LIMIT 0,1";
	$result=mysqli_query($mysqli,$qq);
	if(mysqli_num_rows($result) > 0){
		$row=mysqli_fetch_assoc($result);
		$ret=$row['color'];
		
	} else {
		$ret=1;
	}
	return $ret;
}


function showYesterday($mysqli)
{
	$yesterday = date_create(date('Y-m-d')); 
	date_sub($yesterday, date_interval_create_from_date_string('1 days')); 
	$query = "SELECT * from colors where date like '".$yesterday->format('Y-m-d')."%';";


$result=mysqli_query($mysqli,$query);
echo "<table border=1>";
while($row=mysqli_fetch_assoc($result)) {
	// var_dump($row);
echo "<tr><td>".$row['date']." </td><td> <a href='/stat.php?color=".$row['color']."'>".$row['color']."</a></td></tr>";
}
echo "</table>";


}

function showWeek($mysqli)
{
	$today=date_create(date('Y-m-d'));
	$week=date_create(date('Y-m-d'));
	date_sub($week, date_interval_create_from_date_string('7 days'));
	date_add($today,date_interval_create_from_date_string("1 days"));	
	$query="select * FROM colors
WHERE date BETWEEN '".$week->format('Y-m-d')."' AND '".$today->format('Y-m-d')."';";
	

$result=mysqli_query($mysqli,$query);
echo "<table border=1>";
while($row=mysqli_fetch_assoc($result)) {
	// var_dump($row);
echo "<tr><td>".$row['date']." </td><td> <a href='/stat.php?color=".$row['color']."'>".$row['color']."</a></td></tr>";
}
echo "</table>";


}
function showToday($mysqli)
{
	$today = date("Y-m-d");
		
	$query = "SELECT * from colors where date like '".$today."%'";


$result=mysqli_query($mysqli,$query);
echo "<table border=1>";
while($row=mysqli_fetch_assoc($result)) {
	// var_dump($row);
echo "<tr><td>".$row['date']." </td><td> <a href='/stat.php?color=".$row['color']."'>".$row['color']."</a></td></tr>";
}
echo "</table>";


}
function showFromTo($mysqli,$date1,$date2)
{
	
	$query = "SELECT * FROM colors
WHERE date BETWEEN '".$date1."' AND '".$date2."';";

// $query.=" LIMIT 0,1";


$result=mysqli_query($mysqli,$query);
echo "<table border=1>";
while($row=mysqli_fetch_assoc($result)) {
	// var_dump($row);
echo "<tr><td>".$row['date']." </td><td> <a href='/stat.php?color=".$row['color']."'>".$row['color']."</a></td></tr>";
}
echo "</table>";

}
function maxColorAll($mysqli)
{
	$arr=array();
	$color_res=mysqli_query($mysqli,"select distinct color from colors");
	if ($color_res->num_rows > 0) {
	while($tempcol= mysqli_fetch_array($color_res))
		$arr[$tempcol['color']]=(int)countClr($mysqli,$tempcol['color']);
	}

	echo "The Most Popular Color is:".array_search(max($arr), $arr)." With ".max($arr)." Times";
}

function maxColorYesterday($mysqli)
{	$yesterday = date_create(date('Y-m-d')); 
	date_sub($yesterday, date_interval_create_from_date_string('1 days')); 
	$query = "SELECT distinct color from colors where date like '".$yesterday->format('Y-m-d')."%';";
	$arr=array();
	$color_res=mysqli_query($mysqli,$query);
	if ($color_res->num_rows > 0) {
	while($tempcol= mysqli_fetch_array($color_res))
		$arr[$tempcol['color']]=(int)countClrYesterday($mysqli,$tempcol['color']);
	}

	echo "The Most Popular Color Yesterday is:".array_search(max($arr), $arr)." With ".max($arr)." Times";
}
function maxColorToday($mysqli)
{	$today=date('Y-m-d');
	$arr=array();
	$color_res=mysqli_query($mysqli,"select distinct color from colors where date like '".$today."%'");
	if ($color_res->num_rows > 0) {
	while($tempcol= mysqli_fetch_array($color_res))
		$arr[$tempcol['color']]=(int)countClrToday($mysqli,$tempcol['color']);
	}

	echo "The Most Popular Color is:".array_search(max($arr), $arr)." With ".max($arr)." Times";
}
function maxColorWeek($mysqli)
{	$today=date_create(date('Y-m-d'));
	$week=date_create(date('Y-m-d'));
	date_sub($week, date_interval_create_from_date_string('7 days'));
	date_add($today,date_interval_create_from_date_string("1 days"));	
	$query="select distinct color FROM colors
WHERE date BETWEEN '".$week->format('Y-m-d')."' AND '".$today->format('Y-m-d')."';";
	
	$arr=array();
	$color_res=mysqli_query($mysqli,$query);
	if ($color_res->num_rows > 0) {
	while($tempcol= mysqli_fetch_array($color_res))
		$arr[$tempcol['color']]=(int)countClrWeek($mysqli,$tempcol['color']);
	}

	echo "The Most Popular Color is:".array_search(max($arr), $arr)." With ".max($arr)." Times";
}
function maxColorBetween($mysqli,$date1,$date2)
{	$query = "SELECT distinct color FROM colors
WHERE date BETWEEN '".$date1."' AND '".$date2."';";
	
	$arr=array();
	$color_res=mysqli_query($mysqli,$query);
	if ($color_res->num_rows > 0) {
	while($tempcol= mysqli_fetch_array($color_res))
		$arr[$tempcol['color']]=(int)countClrBetween($mysqli,$tempcol['color'],$date1,$date2);
	}
	if(count($arr)>0)
	echo "The Most Popular Color is:".array_search(max($arr), $arr)." With ".max($arr)." Times";
}
function countColor($mysqli,$color)
{
	$sql="SELECT count(color) FROM phpdb.colors where color='$color' ;";
	$result = mysqli_query($mysqli,$sql);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
         echo "<br> The chosen color is $color: ". $row["count(color)"]."<br>";
		
		
    }
} else {
    echo "0 results";
}

}
function countClr($mysqli,$color)
{
	$sql="SELECT count(color) FROM phpdb.colors where color='$color' ;";
	$result = mysqli_query($mysqli,$sql);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
         return $row["count(color)"];
		
		
    }
	}}
	
function countClrYesterday($mysqli,$color)
{	$yesterday = date_create(date('Y-m-d')); 
	date_sub($yesterday, date_interval_create_from_date_string('1 days'));
	$sql="SELECT count(color) FROM phpdb.colors where color='$color' and date like '".$yesterday->format('Y-m-d')."%';";
	$result = mysqli_query($mysqli,$sql);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
         return $row["count(color)"];
		
		
    }
	}}
function countClrWeek($mysqli,$color)
{	
$today=date_create(date('Y-m-d'));
	$week=date_create(date('Y-m-d'));
	date_sub($week, date_interval_create_from_date_string('7 days'));
	date_add($today,date_interval_create_from_date_string("1 days"));	
	$query="select  count(color) FROM colors
WHERE date BETWEEN '".$week->format('Y-m-d')."' AND '".$today->format('Y-m-d')."' and color='".$color."';";
	
	
	$result = mysqli_query($mysqli,$query);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
         return $row["count(color)"];
		
		
    }
	}}
function countClrBetween($mysqli,$color,$date1,$date2)
{	
	$query="SELECT count(color) FROM colors
WHERE color='".$color."' and date BETWEEN '".$date1."' AND '".$date2."';";
	
	$result = mysqli_query($mysqli,$query);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
         return $row["count(color)"];
		
		
    }
	}}
function countClrToday($mysqli,$color)
{	$today=date('Y-m-d');
	$sql="SELECT count(color) FROM phpdb.colors where color='$color' and date like '".$today."%';";
	$result = mysqli_query($mysqli,$sql);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
         return $row["count(color)"];
		
		
    }
	}}
function showAll($mysqli)
{
	
$query="SELECT * FROM colors";
// $query.=" LIMIT 0,1";


$result=mysqli_query($mysqli,$query);
echo "<table border=1>";
while($row=mysqli_fetch_assoc($result)) {
	// var_dump($row);
echo "<tr><td>".$row['date']." </td><td> <a href='/stat.php?color=".$row['color']."'>".$row['color']."</a></td></tr>";
}
echo "</table>";

}
function showColor($mysqli,$color)
{
	
$query="SELECT * FROM colors where color='".$color."';";
// $query.=" LIMIT 0,1";


$result=mysqli_query($mysqli,$query);
echo "<table border=1>";
while($row=mysqli_fetch_assoc($result)) {
	// var_dump($row);
echo "<tr><td>".$row['date']." </td><td> ".$row['color']."</td></tr>";
}
echo "</table>";

}
