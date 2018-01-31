<?php

$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "nathanapp";

//$link = mysqli_connect("rumiyouth.be","root","") or die("Verbinding mislukt");
//$link = mysqli_connect($server, $username, $password) or die("Verbinding mislukt");
//mysqli_select_db($link, $dbname) or die ("database niet beschikbaar");


//$link = mysqli_connect($server, $username, $password) or die("Verbinding mislukt");
$conn = mysqli_connect($server, $username, $password, $dbname);
if(!$conn){
    $res = new result();
    $res->success = false;
    $res->message = "connection failed database error";
    die(json_encode($res));
}
?>