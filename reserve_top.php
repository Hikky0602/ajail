<?php

//ログインしてる時，予約フォームに飛ばす．
if(0==1){
	require_once('index.php');//とりあえずindex...
}else{	//ログインしてない時，ログインするかどうか？

?>

<html>
<head>
<meta charset="utf8">
<meta http-equiv="content-style-type" content="text/css" />
<link rel="stylesheet" type="text/css" href="adminTop.css" />
</head>

<body>

<div id="container">
<h1>ログインして予約しますか？</h1>
<div><button onclick="location.href='login.php'">ログイン</button></div>
<div><button onclick="location.href='index.php'">ログインしないで予約</button></div>
</div>

</div>
</body>
</html>

<?php	}	?>
