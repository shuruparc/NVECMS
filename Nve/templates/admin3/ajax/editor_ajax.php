<?php
include '../conn.php';
$id=$_POST["id"];
$sql="SELECT `id`,`fname`,`password`,`lname`,`role`,`school`,`username` FROM `users` WHERE `id`='".$id."'";
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
$id=$row['id'];
$fname=$row['fname'];
$password=$row['password'];
$lname=$row['lname'];
$role=$row['role'];
$school=$row['school'];
$username=$row['username'];
$arr=array("id" => $id,"fname" => $fname,"password" => $password,"lname" => $lname,"role" => $role,"school" => $school,"username" => $username);
echo json_encode($arr);
}

?> 

