<?php
include '../conn.php';
$id=$_POST["id"];
$sql="SELECT `id`,`rtitle`,`rsubject`,`rdescription`,`rstage`,`rurl`,`register`,`nve`,`create_date` FROM `resource_hub` WHERE `id`='".$id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$rtitle=$row['rtitle'];
$rsubject=$row['rsubject'];
$rdescription=$row['rdescription'];
$rstage=$row['rstage'];
$rurl=$row['rurl'];
$register=$row['register'];
$nve=$row['nve'];
$create_date=$row['create_date'];
$arr=array("id" => $id,"rtitle" => $rtitle,"rsubject" => $rsubject,"rdescription" => $rdescription,"rstage" => $rstage,"rurl" => $rurl,"register" => $register,"nve" => $nve,"create_date" => $create_date);
echo json_encode($arr);
}

?> 

