
<html>

<head>
<meta charset='UTF8'>
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<link rel="stylesheet" type="text/css" href="test.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="./test.js"></script> 
</head>


<body>


<div id="container"><!--外-->
	<div id="header">
		<div id="logo"><h1>AKI農場</h1></div>




<?php 
session_start();
if(isset($_SESSION["USERID"])){	?>
<!--ログイン時    --->
<button class="loginBt" onclick="location.href='logout.php'">logout</button>
<?php }else{	?>
<!--非ログイン時  --->
<button class="loginBt" onclick="location.href='login.php'">login</button>
<?php } ?>


</div>

	<div id="topPic">
		<div id="loop">

		<ul>
			<?php
				foreach(glob('img/*.jpg') as $file){
				echo '<li><a href="#"><img src=' . $file . ' width="300" height="200" alt=""></a></li>';
			}?>
			</ul>
		</div>
	</div>

	<div id="mainColumn">
		<div id="border"><span id="borderTxt">オススメ</span></div>
		<div><img id="osusume" src="osusume.jpg" width="400px" height="300px"></div>
		<div id="border">地図</div>
		<div>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2535.602214537006!2d139.44800216427416!3d35.627776349208524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0xf993ae9d993f0a45!2z44GK44Gj44GR44GEIOawuOWxseW6lw!5e0!3m2!1sja!2sjp!4v1462498534360" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>

	
	<div id="sideColumn">
		<button class="reserveBt">ご予約はこちらから</button>
	</div>
	<div>
		<button type="checkbox" class="NGbutton" value="test"></button>
	</div>
	
	<div id="under"></div>

</div><!--外-->
</body>
</html>


