<?php
/*
 * LibreCMS - Copyright (C) Diemen Design 2018
 * This software may be modified and distributed under the terms
 * of the MIT license (http://opensource.org/licenses/MIT).
 */
require'db.php';
$id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$bit=filter_input(INPUT_GET,'b',FILTER_SANITIZE_NUMBER_INT);
$tbl=filter_input(INPUT_GET,'t',FILTER_SANITIZE_STRING);
$col=filter_input(INPUT_GET,'c',FILTER_SANITIZE_STRING);
$ti=time();
if(($tbl!='NaN'&&$col!='NaN')||($tbl!=''&&$col!='')){
  if(in_array($tbl,array('cart','choices','comments','config','content','iplist','login','logs','media','menu','messages','orderitems','orders','rewards','subscribers','suggestions','tracker'))&&in_array($col,array('active','bio_options','bookable','bookingEmailReadNotification','comingsoon','development','featured','important','internal','maintenance','method','newsletter','newslettersEmbedImages','options','orderEmailReadNotification','php_options','pin','recurring','starred','suggestions'))){
    $q=$db->prepare("SELECT $col as c FROM `".$prefix.$tbl."` WHERE id=:id");
    $q->execute(array(':id'=>$id));
    $r=$q->fetch(PDO::FETCH_ASSOC);
    $r['c']{$bit}=$r['c']{$bit}==1?0:1;
    $q=$db->prepare("UPDATE `".$prefix.$tbl."` SET $col=:c WHERE id=:id");
    $q->execute(array(':c'=>$r['c'],':id'=>$id));
  }
}
if($tbl!='messages'||$col!='pin')
  echo'<script>/*<![CDATA[*/window.top.window.$("#'.$tbl.$col.$bit.'").remove();";/*]]>*/</script>';
