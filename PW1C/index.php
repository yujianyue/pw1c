<?php include "inc/conn.php";?><?php include "inc/pubs.php";?>
<!doctype html><?php $tts = date("YmdHis",time());?>
<html lang="zh-CN">
<head>
<meta charset="gb2312" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<title><?php echo $title;?></title>
<meta name="author" content="yujianyue, admin@ewuyi.net">
<meta name="copyright" content="www.12391.net">
<link href="inc/css/style.css?t=170828" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="inc/js/js.js?t=170828"></script>
</head>
<body onLoad="inst();">
<div class="html">
<div class="divs" id="divs">
<div id="head" class="head" onclick="location.href='?t=<?php echo $tts;?>';">
<?php echo $title;?>
<!--div class="back" id="pageback">
<a href="?t=<?php echo $tts;?>" class="d">更多</a>
</div-->
</div>
<div class="main" id="main">
<?php 
$stime=microtime(true); 
$codes = trim($_POST['code']);
$shujus = trim($_POST['time']);
$shuru1 = trim($_POST['name']);
if(!$shujus){
?>
<form name="queryForm" method="post" action="?t=<?php echo $tts;?>" onsubmit="return startRequest(0);">
<div class="select" id="10">
<select name="time" id="time" onBlur="startRequest(1)" >
<?php traverse($UpDir."/",$dbtype);?></select></div>
<div class="so_box" id="11">
<input name="name" type="text" class="txts" id="name" value="" placeholder="请输入<?php echo $tiaojian1;?>" onfocus="st('name',1)" onBlur="startRequest(2)" />
</div>
<?php 
if($ismas=="1"){
?>
<div class="so_box" id="33">
<input name="code" type="text" class="txts" id="code" placeholder="请输入验证码" onfocus="this.value=''" onBlur="startRequest(3)" />
<div class="more" id="clearkey">
<img src="inc/code.php?t=<?php echo $tts;?>" id="Codes" onClick="this.src='inc/code.php?t='+new Date();" />
</div></div>
<?php }?>
<div class="so_but">
<input type="submit" name="button" class="buts" id="sub" value="立即查询" />
<input type="button" class="buts" value="刷新本页" name="print" onclick="location.reload();">
</div>
<div class="so_bus" id="tishi">
说明:【<?php echo $tiaojian1;?><?php 
if($ismas=="1"){
?>+验证码<?php }?>】都输入正确才显示相应结果。
<!--你的其他说明在这里添加：开始-->
<?php
if(!file_exists($doup2s)){
//echo "<!-- $doup2s 不存在 -->";
}else{
echo file_get_contents($doup2s);
}
?>
<!--你的其他说明在这里添加：结束-->
</div>
<div id="tishi1" style="display:none;">请输入<?php echo $tiaojian1;?></div>
<div id="tishi4" style="display:none;">请输入4数字验证码</div>
</form>
<?php 
}else{
if($ismas=="1"){
session_start();
if($codes!=$_SESSION['PHP_M2T']){
 webalert("请正确输入验证码！");
}
}
if(!$shuru1){
 webalert("请输入$tiaojian1!");
}
$files = $UpDir."/".$shujus.$dbtype;
$files = charaget($files);
if(!file_exists($files)){
$files = charaget($files);
}
if(!file_exists($files)){
 webalert('请检查数据库文件');
}
echo '<p align="center">&nbsp;</p>';
echo '<p align="center"> ' . rephtmls($shujus) . '</p>';
echo '<!--startprint-->';
$file = fopen($files,'r'); 
while ($data = fgetcsv($file)){
$arra[] = $data;
}
//print_r($arra);
foreach($arra as $keyx=>$valx) 
{ 
 $ii++;
    if($ii=="1"){
 $val1=$valx;
echo "<table cellspacing=\"0\">";
echo '<caption align="center">查询结果' . $iae . '</caption><thead>';
echo '<tr class="tt">';
      $io=-1; 
      $iaa=0; 
 foreach($valx as $keyy=>$valy) 
 { 
 //echo '<td class="r">['.$keyx.']['.$keyy.']</td>';
  $bh0=stristr($bubuxians,"--$valy--");
if(!$bh0){
   $ix++; 
  echo '<td>'.$valy.'</td>';
 }
      $io++; 
    if($valy==$tiaojian1){
      $iaa=$io; 
    }
 } 
    if($iaa<0){   //if($iaa){
 webalert('请检查Excel数据第1行是否存在【'.$tiaojian1.'】字段!');
    }
 echo "</tr></thead><tbody>";
    }else{
if("_".$shuru1=="_".$valx[$iaa] ){
//echo "<!-- $shuru1=='.$valx[$iaa].' <br>\r\n--> ";
 $iae++;
 $ios=-1;
 echo '<tr>';
 foreach($valx as $keyy=>$valy){ 
 $ios++;
 $tabu = $valy;
  $line1tou =  $val1["$ios"];
 echo '<td  data-label='.$line1tou.'>'.$tabu.'</td>';
 } 
 echo '</tr>';
 }
 }
fclose($file);
}
if($iae<1){
 $shuru1 = rephtmls($shuru1);
 $shuru2 = rephtmls($shuru2);
 $shuru3 = rephtmls($shuru3);
    echo '<tr>';
  echo "<td colspan={$ix}  data-label=\"提示\">没有查询到$tiaojian1 = $shuru1 相关信息哦</td>";
    echo '</tr>';
}
echo '<tbody></table>';
echo '<!--endprint-->';
fclose($filer);
?>
<div class="so_but">
<input type="button" class="buts" value="预 览" name="print" onclick="preview()">
<input type="button" class="buts" value="返 回" id="reset" onclick="location.href='?t=back';"></div>
<?php 
}
$etime=microtime(true);
$total=$etime-$stime;
echo "<!----页面执行时间：{$total} ]秒--->";
?>
</div>
<div class="boto" id="boto">
&copy;<?php echo date('Y');?>&nbsp; <a href="<?php echo $copyu;?>" target="_blank"><?php echo $copyr;?></a>
</div>
</div>
</div>
</body>
</html>
