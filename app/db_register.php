<?php

$local_server = "localhost";
$local_dbname = "stock";
$local_username = "root";
$local_password = "";

$server = "";
$dbname = "stock";
$username = "root";
$password = "";

//$conn = mysqli_connect($server, $username, $password, $dbname);
$conn = mysqli_connect($local_server, $local_username, $local_password, $local_dbname);
if(!$conn){
    $res = new result();
    $res->success = false;
    $res->message = "connection failed database error";
    die(json_encode($res));
}

?>