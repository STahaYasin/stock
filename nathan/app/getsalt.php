<?php

include 'result.php';

header('Content-type: Application-json');

$postdata = file_get_contents("php://input");
$req = json_decode($postdata);

if($req == null){
    $res = new result();
    $res->success = false;
    $res->message = "Post data not found!";
    die(json_encode($res));
}

$errorInputFieldsArray = array();

if($req->appId != "1b9eb05f5a2f5a5f579bf8cadc67a9d5a0f1bf8ac66f9c65fa3cdd394755d60b" || $req->appToken != "f5bf37b683e2d7f6ab00da31fcadbf28bec06d38f2e858f38133484f5f297557aede47581d8dc6b32bced2a45b88da689010452dbf16688331fe261c66b06b78"){
    $res = new result();
    $res->success = false;
    $res->message = "Uknown app";
    die(json_encode($res));
}

if($req->email == null || $req->email == ""){
    $res = new result();
    $res->success = false;
    $res->message = "Email is required to get the salt";
    $res->data = null;
    die(json_encode($res));
}

$email = $req->email;
include 'dbset.php';

$sql = "select * from rhi864emails24vh where rhi864emails24vh.gbnh52email36sd = '$email' limit 1";
$sqldieobject = new result();
$sqldieobject->success = false;
$sqldieobject->message = "Error in database";
$sql_result = mysqli_query($conn, $sql) or die (json_encode($sqldieobject));
$emailindb = mysqli_fetch_assoc($sql_result);

if($emailindb == null){
    $res = new result();
    $res->success = false;
    $res->message = "User not found";
    $res->data = null;
    die(json_encode($res));
}

$useridindb = $emailindb["gbnh52user_id36sd"];

if($useridindb == null || $useridindb == "" || $useridindb == 0){
    $res = new result();
    $res->success = false;
    $res->message = "Invalid user parameter";
    $res->data = null;
    die(json_encode($res));
}

$sql_salt = "select ghbn521salt31got from ghb251passwords326bfvlcpasss31 where ghbn521user_id31got = '$useridindb' and ghbn521version31got = (select MAX(ghbn521version31got) from ghb251passwords326bfvlcpasss31 where ghbn521user_id31got = '$useridindb' limit 1) limit 1";
$sqldieobjectsalt = new result();
$sqldieobjectsalt->success = false;
$sqldieobjectsalt->message = "Error in database";
$sql_result_salt = mysqli_query($conn, $sql_salt) or die (json_encode($sqldieobjectsalt));
$saltindb = mysqli_fetch_assoc($sql_result_salt);

if($saltindb == null){
    $res = new result();
    $res->success = false;
    $res->message = "Salt not found";
    $res->data = null;
    die(json_encode($res));
}

if($saltindb["ghbn521salt31got"] == null || $saltindb["ghbn521salt31got"] == ""){
    $res = new result();
    $res->success = false;
    $res->message = "Salt not found";
    $res->data = null;
    die(json_encode($res));
}

$res = new result();
$res->success = true;
$res->message = "Salt ok";
$res->data = $saltindb["ghbn521salt31got"];

die(json_encode($res));


$res = new result();
$res->success = false;
$res->message = "Something went wrong";
$res->data = null;

die(json_encode($res));

?>