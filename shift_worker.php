﻿<!DOCTYPE html >
<html>

<head>
<?php
require_once("calendar.php");
require_once("database_class.php");
require_once("schedule.php");

$year=date("Y");
$month=date("m");
$day=num_month($year,$month);

$name="小島瑠璃子";
$user_id="kojiruri";




?>

<script >
<!--
function turn(element){
//element番目のボタンの色を変更

var col=document.b1.elements[element].style.backgroundColor;
if(col=="red"){
	document.b1.elements[element].style.background="blue";
	document.hb.elements[element].value=1;
}else{
	document.b1.elements[element].style.background="red";
	document.hb.elements[element].value=0;
}

}

function inputSchedule(){
	
	var i=0;
	for(i=0;i< <?php echo $day; ?> ;i++){
	
		if(document.hb.elements[i].value==1){
				document.b1.elements[i].style.background="blue";
				document.hb.elements[i].value=1;
		}else{
				document.b1.elements[i].style.background="red";
				document.hb.elements[i].value=0;
		}

		
	}
	
	
}


// -->
</script>



<meta charset="utf-8">
<title>sumtrue</title>
</head>
<body >
名前:<?php echo $name; ?>
<br>
シフト締切:前月25日
<br>



<table border="/">
<tr><?php echo  $year."年".$month. " 月"; ?>
<th>日
<th>月
<th>火
<th>水
<th>木
<th>金
<th>土
</tr>



<form method ="post" action="" name="b1">
<?php

$db=new database();
$table="shift_submit";//テーブル名指定	

$column="shift_data";
$where=" user_id =".$user_id;
$arr=$db->select($table,$column='', $where='');
$arr=scheduleToArray($arr);
	
	//提出された場合
	if(isset($_POST["schedule_worker"])){
		
		//すでに提出されたシフトがある場合
		$column="shift_data";
		$where=" user_id ="."\"".$user_id."\"". " AND delete_flg=0 ";
		
		if(count($arr)>0){
			//提出されてたら古いほうをlogical delete
			$db->delete($table, $where);
		}
		
		$col="name,user_id,shift_year,shift_month,shift_data,delete_flg";//insertするcolumn指定
		$shift_data=implode("," , $_POST["schedule_worker"]);//insertするvalue指定
		$data="\"".$name."\""
				.","
				."\"".$user_id."\""
				.","
				.$year
				.","
				.$month
				.","
				."\"".$shift_data."\""
				.","."0"
				;
		echo $db->insert($table,$col,$data);
		
	}

	$arr= array();
		
	/**  カレンダー表示 **/		
		echo "<tr>";
		//初月の曜日揃え
		for($j=0;$j<date_id($year,$month,1);$j++){
			echo "<td>"." ";
		}
		
		for($j=1;$j<=7-date_id($year,$month,1);$j++){
			//echo "<td>".($j);
			echo "<td>";
			
				echo "<input type=\"button\"  value=".$j."&nbsp&nbsp"." onClick=turn(".($j-1).")    >" ;
				
		}
		echo "</tr>";
		
		//週ごとに改行
		$cnt=0;
		for($i=$j;$i<=$day;$i++){
			if(($i-$j)%7==0){
				echo "<tr>";
			}
			echo "<td>";
			if($i<10){
				echo "<input type=\"button\" name=\"sche[]\" value=".$i."&nbsp&nbsp"." onClick=turn(".($i-1).") >" ;
			}else{
				 echo "<input type=\"button\" name=\"sche[]\" value=".$i." onClick=turn(".($i-1).")  >" ;
			}
			if(($i-$j)%7==6){
				echo "</tr>";
			}
		}	
	
?>
</table>
</form>


<form action=""   >
<input id ="input" type="button" value="前回のデータ読み込み" onClick="inputSchedule();">
</form>



<form method="post" action="" name="hb" >
<?php

$db=new database();
$table="shift_submit";//テーブル名指定	

$column="shift_data";
$where=" user_id ="."\"".$user_id."\"";
$arr=$db->select($table,$column, $where);
$arr=scheduleToArray($arr);
for($i=0;$i<$day;$i++){
	if(count($arr)>0){
		
		if($arr[$i]==1){
			echo "<input type=\"hidden\" name=\"schedule_worker[]\" value=1>";
		}else{
			echo "<input type=\"hidden\" name=\"schedule_worker[]\" value=0>";
		}
	}else{
		
		echo "<input type=\"hidden\" name=\"schedule_worker[]\" value=0>";
	}
	
}

	
?>
<input type="submit" name="submit" value="提出" /> 
</form>
</body>
赤・・・空いていない　青・・・空いている
</html>








