<script>/*<![CDATA[*/
<?php
session_start();
include'db.php';
$id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$tbl=filter_input(INPUT_GET,'t',FILTER_SANITIZE_STRING);
$uid=$_SESSION['uid'];
if($id!=0&&$tbl!='logs'){
    $s=$db->prepare("SELECT * FROM ".$tbl." WHERE id=:id");
    $s->execute(array(':id'=>$id));
    $r=$s->fetch(PDO::FETCH_ASSOC);
    if($tbl=='config'||$tbl=='login')
    $r['contentType']='';
    $nda='';
    foreach($r as$o)$nda.=$o.'|';
}
if($id==0&&$tbl=='logs'){
    $q=$db->query("DELETE FROM logs");
    $q->execute();
    $id='activity';
}
if($tbl=='orders'){
    $q=$db->prepare("DELETE FROM orderitems WHERE oid=:oid");
    $q->execute(array(':oid'=>$id));
}
if($id!=0&&$id!='activity'){
    $q=$db->prepare("DELETE FROM $tbl WHERE id=:id");
    $q->execute(array(':id'=>$id));
}
$e=$db->errorInfo();
if(is_null($e[2])){?>
    window.top.window.$('#l_<?php echo$id;?>').slideUp(500,function(){$(this).remove()});
<?php }?>
    window.top.window.$('#busy').css("display","none");
/*]]>*/</script>
