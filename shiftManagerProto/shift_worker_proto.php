<?php

define('TABLE','user_ploto');
define('HOST','localhost');
define('DB','Akifarm_db');
define('USER','user');
define('PASS','password');

require_once("database_class.php");
require_once("calendar.php");

$link = mysqli_connect('localhost','user','password','Akifarm_db');

if(isset($_POST['send'])===true){
	$id = $_POST['id'];
	$quary = 'SELECT * FROM user_ploto WHERE id="' . $id . '"';	
	$res = mysqli_query($link, $quary);
	$data = mysqli_fetch_assoc($res);
	if($data==NULL){
		echo 'ID error!';
		include_once("shift_worker_login_proto.html");
	}else{
		setCookie("id", $id);
		setCookie("name", $data['name']);
		include_once("shift_worker_send_proto.php");
	}
}
if(isset($_POST['month'])){
include_once("shift_worker_send_proto.php");
}

if(isset($_POST["submit"])){
	echo "提出完了";
	$id = $_COOKIE["id"];
	$month = $_POST['month'];

	$schedule_post=array();
	for($i=0;$i<30;$i++){
		$schedule_post[$i]=0;
	}
	for($i=0;$i<count($_POST["schedule"]);$i++){
		$schedule_post[$_POST["schedule"][$i]]=1;
	}
	var_dump($schedule_post);

	$data=implode("," , $schedule_post);
	$query='update shift_submit_proto set shift_data="'.$data.'" where id="'.$id.'" and month="'.$month.'"';
	
	mysqli_query($link, $query);

		include_once("shift_worker_send_proto.php");
}

?>
