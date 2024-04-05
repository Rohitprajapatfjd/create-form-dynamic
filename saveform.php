<?php
error_reporting(E_ERROR | E_PARSE);
include("./config.php");
extract($_POST);
$url = "http://localhost/project/client-pg-and-csv-code/newone/form.php?id=".base64_encode($title);
$json = [];
$json['status'] = false;
$result = "";
$sql = "INSERT INTO formlist (title,subtitle,name,email,address,phoneno,uid,dob,message,image,gender,url) values('$title','$subtitle','$names','$email','$address','$phoneno','$uid','$dob','$message','$file','$gender','$url')";
//echo $sql;
$run = mysqli_query($conn,$sql);

if($run){
    $json['status'] = true;
   
}else{
    $json['message'] = "Query Failed";
}
echo json_encode($json);
?>