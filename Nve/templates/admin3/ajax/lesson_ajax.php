<?php
include '../conn.php';
$id=$_POST["id"];
$sql="SELECT `id`,`l_title`,`l_subject`,`l_stage`,`l_resources`,`l_url` FROM `lessons` WHERE `id`='".$id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$l_title=$row['l_title'];
$l_subject=$row['l_subject'];
$l_stage=$row['l_stage'];
$l_resources=$row['l_resources'];
$l_url=$row['l_url'];
$arr=array("id" => $id,"l_title" => $l_title,"l_stage" => $l_stage,"l_subject" => $l_subject,"l_resources" => $l_resources,"l_url" => $l_url);
echo json_encode($arr);
}

?> 

