<?php
error_reporting(E_ERROR | E_PARSE);
$conn = mysqli_connect("localhost","root","","createform") or die("connection fail");

define('id',$_SESSION['id']);

?>