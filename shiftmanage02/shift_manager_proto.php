<?php
$yearNow = date("Y");
$monthNow = date("m");
$count = 0;

$month = $monthNow;
$year = $yearNow;

if(isset($_POST["month"])){

	$monthPost = $_POST["month"][0];

	if($month-$monthPost>3){
		$year = $yearNow + 1;
		$month = $monthPost;
	}else if($monthPost==12 && $month==1){
		$year = $yearNow - 1;
		$month = $monthPost;
	}else{
		$month = $monthPost;
	}
}else{
	$monthPost = $month;
}
$prev = $month!=1 ? $monthPost-1 : 12;
$next = $month!=12 ? $monthPost+1 : 1;
	
$day = num_month($year,$month);
$startDay = date_id($year, $month, 1);


$link = mysqli_connect('localhost','user', 'password','Akifarm_db');
$query = 'select u.id, u.name, s.shift_data from user_ploto u join shift_submit_proto s on u.id = s.id'; 
$res = mysqli_query($link, $query);

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<div><div>

</div>
<div>
<table border=1>
<tr><td>name</td>

<?php for($i=1; $i<31; $i++){	echo "<td>$i</td>";}	?>
</tr>




<?php	
while($row = mysqli_fetch_assoc($res)){	?>
	<tr><td>
	<?php	echo $row["name"];	?>
	</td>
	<?php
	$data = explode(',', $row["shift_data"]);
	foreach($data as $val){	?>
	<td>
	<?php	echo	$val==0 ? '×' : '◯';	?>
	</td>
	<?php	}	?>
	</tr>
	<?php	}	
	mysqli_close($link);
	?>


</table>
</div>
</body>
</html>

