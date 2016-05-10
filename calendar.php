<?php

function num_month($year,$month){

$ans=0;
switch($month){
 case 4;
 case 6;
 case 9;
 case 11;
	$ans=30;
	break;
 case 1;
 case 3;
 case 5;
 case 7;
 case 8;
 case 10;
 case 12;	
	$ans=31;
	break;
 case 2;
	if($year%4!=0){
		$ans=28;
		break;
	}else if($year%4==0&&$year%400==0){
		$ans=28;
		break;
	}else{
		$ans=29;
		break;
	}

}

return $ans;



}

function date_id($year,$month,$day){

$date_num=date("w",mktime(0,0,0,$month,$day,$year));
$youbi="";
switch($date_num){

case 0;
	$youbi="日";
	break;
case 1;
        $youbi="月";
        break;
case 2;
        $youbi="火";
        break;
case 3;
        $youbi="水";
        break;
case 4;
        $youbi="木";
        break;
case 5;
        $youbi="金";
        break;
case 6;
        $youbi="土";
        break;
}
//return $youbi;
return $date_num;


}




?>
