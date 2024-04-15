<?php session_start();

extract($_POST);
include("./config.php");
$sql = "SELECT * FROM userdata WHERE phoneno like '%$phoneno%' or uid like '%$uid%'";
$run = mysqli_query($conn, $sql);
$row = mysqli_num_rows($run);
while ($fetch = mysqli_fetch_assoc($run)) {
    $data_phone = $fetch['phoneno'];
    $data_uid = $fetch['uid'];
    $image = $fetch['paths'];
    $img_size = $fetch['img_size'];
}
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
        $add = "img/" . $_FILES['image']['name'];
        $sql_img = "SELECT * FROM userdata WHERE paths ='$add' or img_size ='$size'";
        $run_img = mysqli_query($conn, $sql_img);
        $row_img = mysqli_num_rows($run_img);
        if($row_img >0){
            $_SESSION['status'] = true;
            $_SESSION['message']= "This image is already update";
            //echo $_SESSION['message'];
            $id = base64_encode($id);
            header("Location:./form.php?id=$id");
            die;
        }
       
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
   
    $sql2 = "INSERT INTO userdata (name,email,address,phoneno,uid,dob,message,paths,img_size,gender,ip,title) values('$name','$email','$address','$phoneno','$uid','$dob','$texts','$add','$size','$gender','$ip','$title')";

    $run2 = mysqli_query($conn, $sql2);

    if ($run2) {
        $_SESSION['status'] = "true";
        $_SESSION['message'] = "Submit Successfully";
    } else {
        $_SESSION['status'] = "false";
        $_SESSION['message'] = "Some issue in Server Side";
    }

} else {
   
    if ($data_phone == $phoneno && $data_uid == $uid) {
        $_SESSION['status'] = "true";
        $_SESSION['message'] = "This Phone No or UID are already Insert";
    } else if ($data_phone == $phoneno) {
        $_SESSION['status'] = "true";
        $_SESSION['message'] = "This Phone No is already Insert";
    } else {
        $_SESSION['status'] = "true";
        $_SESSION['message'] = "This Uid is already Insert";
    }

}
$id = base64_encode($id);
header("Location:./form.php?id=$id");

?>