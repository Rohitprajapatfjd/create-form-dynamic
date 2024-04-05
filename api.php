<?php
header('Content-Type:application/json');
header("Access-Control-Allow-Origin:*");
header("Access-control-allow-Method:POST");
header("Access-control-allow-Header:Access-control-allow-Header,Access-control-allow-Method,Content-Type,X-Requested-With");

include("./config.php");

$name = 'null';
$email = 'null';
$address = 'null';
$phoneno = 'null';
$uid = 'null';
$dob = 'null';
$texts = 'null';
$add = 'null';
$gender = 'null';
$ip = 'null';

$data = json_decode(file_get_contents("php://input"),true);

extract($data);

$sql = "SELECT * FROM userdata WHERE phoneno ='$phoneno' or uid ='$uid'";
$run = mysqli_query($conn, $sql);
$row = mysqli_num_rows($run);
if ($row == 0) {

    if (!empty($_FILES['image']['name'])) {
        $file_upload_flag = "true";
        $size = $_FILES['image']['size'];
        $tmp = $_FILES['image']['tmp_name'];
        $type = $_FILES['image']['type'];
        $msg = '';
        if ($size > 2500000) {
            $msg .= "Your uploaded file size is more than 2500KB <br>";
            $file_upload_flag = "false";
        }
        if (!($type == "image/jpeg" or $type == "image/jpg" or $type == "image/png")) {
            $msg .= "Your uploaded file must be of JPG or png.";
            $file_upload_flag = "false";
        }
        $file_name = $_FILES['image']['name'];
        $temp = explode(".", $file_name);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        // the path with the file name where the file will be stored
        $add = "img/" . $newfilename;
        if ($file_upload_flag == 'true') {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $add)) {
                // do your coding here to give a thanks message or any other thing.
                $msg .= "File successfully uploaded";
            } else {
                echo "Failed to upload file Contact Site admin to fix the problem";
            }
        } else {
            $msg .= " Failed to upload file ";
        }
    }

    $sql2 = "INSERT INTO userdata (name,email,address,phoneno,uid,dob,message,paths,gender,ip,title) values('$name','$email','$address','$phoneno','$uid','$dob','$texts','$add','$gender','$ip','$title')";

    $run2 = mysqli_query($conn, $sql2);

    if ($run2) {
        $json['status'] = "true";
        $json['message'] = "Submit Successfully";
    } else {
        $json['status'] = "false";
        $json['message'] = "Some issue in Server Side";
    }

} else {
    while($fetch = mysqli_fetch_assoc($run)){
        $data_phone = $fetch['phoneno'];
        $data_uid = $fetch['uid'];
    }
    if($data_phone == $phoneno && $data_uid == $uid){
        $json['status'] = "true";
        $json['message'] = "This Phone No or UID are already Insert";
    }else if($data_phone == $phoneno ){
        $json['status'] = "true";
        $json['message'] = "This Phone No is already Insert";
    }else{
        $json['status'] = "true";
        $json['message'] = "This Uid is already Insert";
    }
   
}

echo json_encode($json);

?>