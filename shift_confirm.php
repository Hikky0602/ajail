﻿<!DOCTYPE html >
<html>

<head>
<?php
require_once("database_class.php");
require_once("calendar.php");
require_once("login_check.php");
 require_once("calendar.php");
 

$db=new database();
$table="shift_submit";//テーブル名指定	

$where=" shift_month=". $month;
$column="";
$arr=$db->select($table,$column, $where);

）
$person=count($arr);
$shift=explode(',',$arr[0]["shift_data"]);

$day=num_month($year,$month);
$shop=array("A","B","C");
?>




</head>

<body>

<br>
<br>
<?php echo $year."年 ".$month."月 ";  ?>
<br>
<form method="post" action="">
<input type="submit" name="prev" value="前の月"  /> 
<input type="submit" name="next" value="次の月"  /> 
<input type="submit" name="now" value="今月"  /> 
<input type="hidden" name="month" value=<?php  echo $month; ?>>
<input type="hidden" name="year" value=<?php  echo $year; ?>>
</form>


<table border="/">
<th>名前


<?php
 
	for ($j=0;$j<$day;$j++ ){
		//dayの出力
		echo "<th>".($j+1);
	}
	for($i=0;$i<$person;$i++){
		//人の出力
		echo "<tr>";
		echo "<td>".$arr[$i]["name"];
		$shift=explode(',',$arr[$i]["shift_data"]);
		for($j=0;$j<$day;$j++){
			//表データボタン作成
			
			
			
			echo "<td>";
			if(isWork($shift[$j],$shop)){
				echo "$shift[$j] <br>";
			}else{
				echo "<br>";
			}
		}
	echo"</tr>";
	}	


?>
</table>
<?php 

function isWork($str,$shop){
	$result=false;
	for($s=0;$s<count($shop);$s++){
		if($str==$shop[$s]){
			$result=true;
		}
	}
	return $result;
	
}
?>

</body>


</html>