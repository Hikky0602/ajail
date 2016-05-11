<?php

define('TABLE','user_ploto');
define('HOST','localhost');
define('DB','Akifarm_db');
define('USER','user');
define('PASS','password');

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

?>

<html>
<head><meta charset="utf8"></head>
<body>








</body>
</html>
<?php
	}
}



?>
