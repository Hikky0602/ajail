<?php

require_once('database_class.php');

session_start(); //セッション開始

//データベース情報

/*
$db['host']   = "localhost";
$db['user']   = "user";
$db['pass']   = "password";
$db['dbname'] = "Akifarm_db";
*/

$errorMessage = "";
$errorMessage1 = "";

//echo $_POST["userid"];

if (isset($_POST["login"])) { //ログインボタンが押された時

   if (empty($_POST["userid"]))
     $errorMessage = "ユーザーIDが未入力です。";
   if (empty($_POST["password"])) 
     $errorMessage1 = "パスワードが未入力です。";
   

if (!empty($_POST["userid"]) && !empty($_POST["password"])) {

$db = new database();
$table = "regist";
$column = "";
$where = "User_ID = '" .  $_POST["userid"] . "'";
//print_r($where);
$_SESSION["USERID"] = $_POST["userid"];
$password_db = array();
$password_db = $db->select($table, $column, $where);  
//var_dump($password_db);
$arart = $db->IDCheck($table, $column, $where);
echo $arart;
$counts = count($password_db);
//echo "$counts";
if($counts>=1){
if($password_db[0]["Password"] == $_POST["password"]){
  echo "認証に成功しました";
  session_regenerate_id(true);
//  $_SESSION["USERID"] = $_POST["userid"];
  $_SESSION["USERID"] = $password_db[0]["FamilyName"];
//  echo $_SESSION["USERID"];
  if($password_db[0]["Type"]=="お客様")
  header("Location: main.php");
  if($password_db[0]["Type"]=="社員")
  header("Location: shift_worker.php");
//echo $_SESSION["USERID"];
  exit;
}else{
  echo "認証に失敗しました。";
  print_r($password_db[0]["Password"]);
  print_r($_POST["password"]);
} }else{
 $errorMessage1 = "ユーザーIDもしくはパスワードが違います。";
  }
     }else{}
}
//echo $_SESSION["USERID"];
?>

<html>
  <head>
    <meta charset = "utf-8" />
    <title> ログイン </title>
  </head>
  <body>
  <center>
    <h1>ログイン</h1>
  <center>
  <form action = "" method = "post">
  </center>
  <label for="userid">ユーザーID</label><input type="text" id = "userid" name = "userid" value = "">
  <br><?php echo $errorMessage;?><br>
  <label for = "password">パスワード</label><input type="password" id = "password" name = "password" value = "">
  <br><?php echo $errorMessage1;?><br>
  <input type="submit" id="login" name = "login" value = "ログイン">
  
  
  <!-- とりあえずリンクはり  -->
  
 <!-- <li><a href="regist.php">レジスト</a></li>
  <li><a href="test.php">TOP</a></li>
  <li><a href="shift_worker.php">シフト登録</a></li>
  <li><a href="shift_manager.php">シフト編集</a></li>
  <li><a href="shift_confirm.php">シフト確認</a></li>-->
  </form>
  </body>
</html>

