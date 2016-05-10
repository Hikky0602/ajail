<?php

define('TABLE','user_ploto');
define('HOST','localhost');
define('DB','Akifarm_db');
define('USER','user');
define('PASS','password');

require_once("database_class.php");

$link = mysqli_connect('localhost','user','password','Akifarm_db');

if(isset($_POST['send'])===true){
	$id = $_POST['id'];
	$quary = 'SELECT * FROM user_ploto WHERE id="' . $id . '"';
	echo $id;	
	$res = mysqli_query($link, $quary);
	$data = mysqli_fetch_assoc($res);
	if($data==NULL){
		echo 'ID error!';
		include_once("shift_worker_login_proto.html");
	}else{

?>

<html>
<head><meta charset="utf8"></head>
<form  method="post"  action="" name="test">

<?php 
for($i=0;$i<30;$i++){
	echo "<input type=\"checkbox\" name=\"schedule[]\" value=".$i ." >";
}
?>
<input type="submit" name="submit" value="提出">
</form>

	
<body>


</body>
</html>
<?php
	}
	
	
}


if(isset($_POST["submit"])){

	var_dump($_POST["schedule"]);

	$schedule_post=array();
	for($i=0;$i<30;$i++){
		$schedule_post[$i]=0;
	}
	for($i=0;$i<count($_POST["schedule"]);$i++){
		$schedule_post[$_POST["schedule"][$i]]=1;
	}

	$db = new database();
	$table="shift_submit_proto";
	$col="id,shift_data";//insertするcolumn指定
	$shift_data=implode("," , $schedule_post);//insertするvalue指定
	$data=	'"'.$id.'"'
			.','
			.'"'.$shift_data.'"'
			;
		echo $db->insert($table,$col,$data);
}

?>
