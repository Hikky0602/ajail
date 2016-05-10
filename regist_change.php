<?php

require_once('database_class.php'); //データベースクラス
require_once('To_hash_class.php');  //ハッシュ化クラス

session_start();

//入力IDからデータベース参照
$db = new database();

$table = "regist";
$column = "";
$where = "Password = '" .  $_SESSION["Pass"] . "'";
$password_db = array();
$password_db = $db->select($table, $column, $where);  

//$password_dbにはレジストの情報が

//データベースに同じIDの情報があったか確認
$counts = count($password_db);

//セッションに苗字を入れる「〜様ようこそ」用
  session_regenerate_id(true);
  $_SESSION["USERID"] = $password_db[0]["FamilyName"];

$dataArr = array(
   'family_name'      => '',
   'first_name'       => '',
   'family_name_kana' => '',
   'first_name_kana'  => '',
   'sex'              => '',
   'year'             => '',
   'month'            => '',
   'day'              => '',
   'tel1'             => '',
   'tel2'             => '',
   'tel3'             => '',
   'email'            => '',
   'ID'               => '',
   'password1'         => '',
   'password2'         => ''
);

$tel = array();
$tel = explode( '-', $password_db[0]['PhoneNum']); 
var_dump($_SESSION["Pass_Raw"]);

$dataArr['family_name']      = $password_db[0]['FamilyName'];
$dataArr['first_name']       = $password_db[0]['FirstName'];
$dataArr['family_name_kana'] = $password_db[0]['FamilyName_kana'];
$dataArr['first_name_kana']  = $password_db[0]['FirstName_kana'];
$dataArr['sex']              = $password_db[0]['Sex'];
$dataArr['year']             = substr($password_db[0]['Birthday'],0,4); 
$dataArr['month']            = substr($password_db[0]['Birthday'],4,2);
$dataArr['day']              = substr($password_db[0]['Birthday'],-2);
$dataArr['tel1']             = $tel[0];
$dataArr['tel2']             = $tel[1];
$dataArr['tel3']             = $tel[2];
$dataArr['email']            = $password_db[0]['Mail'];
$dataArr['ID']               = $password_db[0]['User_ID'];
$dataArr['password1']        = $_SESSION["Pass_Raw"];
$dataArr['password2']        = '';

//var_dump($password_db);

?>  
 



