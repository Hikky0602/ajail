<?php
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

</body>
</html>

