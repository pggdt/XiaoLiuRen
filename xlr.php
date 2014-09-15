<?php
header("Content-Type:text/html;charset=utf-8");
require ('lunar.php');
$LIUREN=["大安","留连","速喜","赤口","小吉","空亡"];
$user_time=$_POST["user_time"];
$msg=$user_time."<br/>";
function multiexplode ($delimiters,$string) {    
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}
$timeArray=multiexplode(array("-","T",":"),$user_time);

$lunar=new Lunar();
$lunarDate=$lunar->convertSolarToLunar($timeArray[0],$timeArray[1],$timeArray[2]);
if($lunarDate[7]>0){
    if($lunarDate[4]>$lunarDate[7]){
        $lunarDate[4]=$lunarDate[4]-1;
    }
}
$msg=$msg.$lunarDate[1].$lunarDate[2]."<br/>";
//echo "<br/>".$lunarDate[4].$lunarDate[5]."<br/>";
$mm=(int)$lunarDate[4];
if($mm>6){
    $mmi=($mm-1)%6;
}else{
    $mmi=$mm-1;
}
//echo $mmi.":".$LIUREN[$mmi]."月<br/>";
$dd=(int)$lunarDate[5];
if($dd>6){
    $dd=$dd%6;
}
   
if(($mmi+$dd)>6){
    $ddi=$mmi+$dd-7;
}elseif(($mmi+$dd)==0){
    $ddi=5;
}else{
    $ddi=$mmi+$dd-1;
}
//echo $ddi.":".$LIUREN[$ddi]."日<br/>";
$hh=$timeArray[3];
if($hh=="23"||$hh=="00"||$hh=="11"||$hh=="12"){
    $hhi=0;
}elseif($hh=="01"||$hh=="02"||$hh=="13"||$hh=="14"){
    $hhi=1;
}elseif($hh=="03"||$hh=="04"||$hh=="15"||$hh=="16"){
    $hhi=2;
}elseif($hh=="05"||$hh=="06"||$hh=="17"||$hh=="18"){
    $hhi=3;
}elseif($hh=="07"||$hh=="08"||$hh=="19"||$hh=="20"){
    $hhi=4;
}elseif($hh=="09"||$hh=="10"||$hh=="21"||$hh=="22"){
    $hhi=5;
}
if(($ddi+$hhi)>5){
    $hhi=$ddi+$hhi-6;
}elseif(($ddi+$hhi)==0){
    $hhi=5;
}else{
    $hhi=$ddi+$hhi;
}
//echo $hhi.":".$LIUREN[$hhi]."时<br/>";
$msg=$msg.$LIUREN[$mmi]."月".$LIUREN[$ddi]."日".$LIUREN[$hhi]."时";
echo $msg;
?>
