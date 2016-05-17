<?php

require_once( 'initMaster.class.php' );

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


list( $yearArr, $monthArr, $dayArr ) = initMaster::getDate();
$sexArr = initMaster::getSex();

arsort($yearArr); 

$selectYear = date("Y");
$selectMonth = date("m");
$selectDay  =  date("d");

?>

<html>
  <head>
     <meta charset = "utf-8">
	 <meta http-equiv="content-style-type" content="text/css" />
	 <link rel="stylesheet" type="text/css" href="regist.css"/>
       <title>登録フォーム</title>
  </head>
 <body>


<div id="container">
<div id="header">
   <h1>登録フォーム</h1>
</div>

<div id="registform">


<form action = "confirm.php" method = "post">
<table border=0>

<tr>
	<td>お名前（氏名）<span>*</span></td>
	<td><input type="text" name = "family_name" size="15" value="<?php echo $dataArr['family_name'] /*valueは初期値*/?>" />    
	<input type="text" name = "first_name" size="15" value="<?php echo $dataArr['first_name'] /*valueは初期値*/?>" /></td>
</tr>

<tr>
	<td>お名前（かな）<span>*</span></td>
	<td><input type="text" name = "family_name_kana" size="15"  value="<?php echo $dataArr['family_name_kana'] /*valueは初期値*/?>" />    
	<input type="text" name = "first_name_kana" size="15" value="<?php echo $dataArr['first_name_kana'] /*valueは初期値*/?>" /></td>
</tr>
	<td>性別<span>*</span></td>
	<td><input type = "radio" name = "sex" selected = "<?php echo $selectSex ?>" value = "0" >男
	<input type = "radio" name = "sex" selected = "<?php echo $selectSex ?>" value = "1" >女</td>
</tr>

<tr>
<td>生年月日<span>*</span></td>
<td>
<select name = "year">
     <option selected></option>
     <?php foreach( $yearArr as $yearArr){ ?>
     <option value = "<?php echo $yearArr ?>"><?php echo $yearArr ?>
     </option>
     <?php } ?>
</select>年

<select name = "month">
     <option selected></option>
     <?php foreach( $monthArr as $monthArr){ ?>
     <option value = "<?php echo $monthArr ?>"><?php echo $monthArr ?>
     </option>
     <?php } ?>
</select>月

<select name = "day">
     <option selected></option>
     <?php foreach( $dayArr as $dayArr){ ?>
     <option value = "<?php echo $dayArr ?>"><?php echo $dayArr ?>
     </option>
     <?php } ?> 
</select>日
</td>
</tr>

<tr>
<td>電話番号<span>*</span></td>
<td>	<input type="text" name = "tel1" size="4" value="<?php echo $dataArr['tel1'] /*valueは初期値*/?>" /> -    
        <input type="text" name = "tel2" size="5" value="<?php echo $dataArr['tel2'] /*valueは初期値*/?>" /> -    
        <input type="text" name = "tel3" size="5" value="<?php echo $dataArr['tel3'] /*valueは初期値*/?>" /> </td>
</tr>

<tr>
	<td>Eメールアドレス<span>*</span></td>
	<td><input type ="text" name = "email" size="60"value = "<?php echo $dataArr['email'] ?>" /></td>
</tr>

<tr>
	<td>ログインID<span>*</span></td>
	<td><input type ="text" name = "ID" value = "<?php echo $dataArr['ID'] ?>" /></td>
</tr>

<tr>
	<td>パスワード<span>*</span></td>
	<td><input type ="password" name = "password1" value = "<?php echo $dataArr['password1'] ?>" /></td>
</tr>

<tr>
	<td>パスワード再入力<span>*</span></td>
	<td><input type ="password" name = "password2" value = "<?php echo $dataArr['password2'] ?>" /></td>
</tr>
</table>

<input type = "submit" id="confirm" name = "confirm"  value = "登録">  
</form>  
</div></div>
</body>
</html>
