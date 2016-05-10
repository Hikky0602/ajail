
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">

<?php 


require_once("shiibashi.php");
require_once("database_class.php");




$db=new database();
$table="shift_submit";//テーブル名指定	

$where=" delete_flg =0";
$arr=$db->select($table,$column='', $where='');

//var_dump($arr);



//$person=15;	//人の数（仮）
$person=count($arr);
//$day=31;	//日数（仮）
$shift=explode(',',$arr[0]["shift_data"]);
$day=count($shift);

$shop=array("A","B","C");	//店舗配列

?>

<!-- 以下のjavascript関数は別ファイルに記述するのが望ましい -->
<title>sumtrue manager</title>
<script>
function turn(element){
	var val=document.b2.elements[element].value;
	if(val=="A"){
		document.b2.elements[element].value="B";
		document.b3.elements[element].value=3;
		setColor(element);
	}else if(val=="B"){
		document.b2.elements[element].value="C";
		document.b3.elements[element].value=2;
		setColor(element);
	}else if(val=="C"){
		document.b2.elements[element].value="o";
		document.b3.elements[element].value=1;
		setColor(element);
		
	}else if(val=="o"){
		document.b2.elements[element].value="x";
		document.b3.elements[element].value=0;
		setColor(element);

	}else if(val=="x"){
		document.b2.elements[element].value="A";
		document.b3.elements[element].value=4;
		setColor(element);
	}

}



function sum_row(shop,j){
	var ans=0;
	var itr=0;
	for(itr=0;itr< <?php echo $person;?> ; itr++){
		var val=document.b2.elements[j+itr*<?php echo $person; ?>].value;	
		if(val==shop){
			ans++;
		}
	}
	return ans;
}

function setColor(i){
	var val=document.b2.elements[i].value;
	if(val=="A"){
		document.b2.elements[i].style.background="yellow";
		document.b3.elements[i].value=4;
		
	}else if(val=="B"){
		document.b2.elements[i].style.background="blue";
		document.b3.elements[i].value=3;
	}else if(val=="C"){
		document.b2.elements[i].style.background="rgb(0,250,0)";
		document.b3.elements[i].value=2;
	}else if(val=="o"){
		document.b2.elements[i].style.background="white";
		document.b2.elements[i].value="o";
		document.b3.elements[i].value=1;
	}else {
		document.b2.elements[i].style.background="red";
		document.b2.elements[i].value="x";
		document.b3.elements[i].value=0;
		
	}
	
	var j=i%30;
	//以下が実行できればうまくいく
	//document.b4.elements[j].value=sum_row("<?php echo $shop[0]; ?>" , j);
	//document.b4.elements[j].value=1; //動く
	
	
	
}


</script>

</head>
<body>

<table border="/">
<tr>schedule
<th>名前


<form  action="" name="b2">

<?php 
//****スケジュール作成****************************/////////////



	$sup=array();//sup[i][j] i in person set, j in day set  人iがj日に供給できるとき1もしくは店舗名、そうでなければ0
	$dem=array();//dem[j] j in day set j日の需要量
	$year=array();//year[i] i in person set 人iの勤続年数
	
if(isset($_POST["schedule"])){//makeボタンを押されたらtrue

	
		
	for($j=0;$j<$day;$j++){
		for($i=0;$i<$person;$i++){
			//スケジュール表のデータをsupに代入
			$sup[$i][$j]=$_POST["schedule"][$i*$day+$j];
			if($sup[$i][$j]>1){
				$sup[$i][$j]=1;
			}
		}
		if($j%7==3||$j%7==4){
			//テスト的に金土を設定　*count($shop)に変えたほうがいい
			$dem[$j]=4*3;
		}else{
			//上記以外
			$dem[$j]=2*3;
		}		
	}
	
	for($i=0;$i<$person;$i++){
		//人iの勤続年数を入力
		$year[$i]=$i+1;
	}

	//shiibashiクラスの作成
	/* クラスの各メンバーを代入して、solve_step1とsolve_step2で解を得る
	*/
	$problem=new shiibashi();
	$problem->setSupply($sup);
	$problem->setDemand($dem);
	$problem->setShop($shop);
	$problem->setYear($year);
	$sol1=$problem->solve_step1();
	$sol2=$problem->solve_step2($sol1);
//******************************************//


	
	for ($j=0;$j<$day;$j++ ){
		//dayの出力
		echo "<th>".($j+1);
	}
	
	
	echo "<script> var index=0;</script>";
	for($i=0;$i<$person;$i++){
		//人の出力
		echo "<tr>";
		echo "<td>".$arr[$i]["name"];
		
		$shift=explode(',',$arr[$i]["shift_data"]);
		$day=count($shift);
		
		for($j=0;$j<$day;$j++){
			//解の出力
			echo "<td>";
			echo "<input type=\"button\"  value=".$sol2[$i][$j]. " onClick=turn(".($j+$i*$day).")>";
			
			//色の表示
			echo "<script>setColor(index)</script>";
			echo "<script> index++;</script>";
		}
	echo"</tr>";

	}
	if(isset($_POST["sendToDB"])){
		//シフト決定ボタンが押されたとき
		
		
		$db=new database();
		$table=	"shift_fix";//テーブル名指定
		$where=" shift_year= ".$arr[0]["shift_year"]." AND shift_month= ".$arr[0]["shift_month"];
		$db->delete($table,$where);
		$col="name,user_id,shift_year,shift_month,shift_data,delete_flg";//insertするcolumn指定
		
		for($i=0;$i<$person;$i++){
		$shift_data=implode("," , $sol2[$i]);//insertするvalue指定
		//echo $shift_data."<br>";
		$data="\"".$arr[$i]["name"]."\""
				.","
				."\"".$arr[$i]["user_id"]."\""
				.","
				.$arr[$i]["shift_year"]
				.","
				.$arr[$i]["shift_month"]
				.","
				."\"".$shift_data."\""
				.","."0"
				;
		$db->insert($table,$col,$data);
	
		
		}
		//header("Location:http://localhost/aki_farm/shift_confirm.php");
		//exit();

	}	
}else{
	//makeボタンが押される前に実行される

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
			//echo "$shift[$j] <br>";
			if($shift[$j]==1){
				//echo "aa";
				echo "<input type=\"button\"  value="."\"○\"". " onClick=turn(".($j+$i*$day).")>";
			}else{
				//echo "bb";
				echo "<input type=\"button\"  value="."\"x\"". " onClick=turn(".($j+$i*$day).")>";
			}
		}
	echo"</tr>";
	}	
	
	
}

?>
</table>

</form>


<!-- postする値をhiddenタグで作成  -->
<form method="post" action="" name="b3">
<?php
	//***hiddenタグでスケジュールの値を保存******////
	echo "<script> var index=0;</script>";
	for($i=0;$i<$person;$i++){
		$shift=explode(',',$arr[$i]["shift_data"]);
	for($j=0;$j<$day;$j++){
		if($shift[$j]==1){
				//echo "aa";
				echo "<input type=\"hidden\"  value=1 name=\"schedule[]\" )>";
			}else{
				//echo "bb";
				echo "<input type=\"hidden\"  value=0  name=\"schedule[]\" )>";
			}
		//echo "<input type=\"hidden\" name=\"schedule[]\" >";
		//echo "<script>setColor(index)</script>";
		echo "<script>index++;</script>";
	}
}
?>
<input type="submit" name="submit" value="シフト作成">
<input type="submit" name="sendToDB" value="シフト決定">


<!--  未完成  -->
<form  action="" name="b4">
<table border="/">
<tr>各店舗
<th>名前
<?php
	for($j=0;$j<$day;$j++){
		echo "<th>".($j+1);	
	}
	for($s=0;$s<count($shop);$s++){
		echo "<tr>";
		echo "<td>".$shop[$s]."  店  ";
		for($j=0;$j<$day;$j++){
			echo "<td>";
			echo " <input type=\"button\"  value=0>";
		}
		echo "</tr>";
	}
	
?>
</table>
</form>

</body>
</html>

