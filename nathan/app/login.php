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


if($req->appId != "1b9eb05f5a2f5a5f579bf8cadc67a9d5a0f1bf8ac66f9c65fa3cdd394755d60b" || $req->appToken != "f5bf37b683e2d7f6ab00da31fcadbf28bec06d38f2e858f38133484f5f297557aede47581d8dc6b32bced2a45b88da689010452dbf16688331fe261c66b06b78"){
    $res = new result();
    $res->success = false;
    $res->message = "Uknown app";
    die(json_encode($res));
}

if($req->email == null || $req->email == "" || $req->hash == null || $req->hash == ""){
    $res = new result();
    $res->success = false;
    $res->message = "Email and password are required fields!";
    $res->data = null;
    die(json_encode($res));
}

include 'dbset.php';
$email = $req->email;

$sql = "select gbnh52user_id36sd from rhi864emails24vh where rhi864emails24vh.gbnh52email36sd = '$email' limit 1";
$sqldieobject = new result();
$sqldieobject->success = false;
$sqldieobject->message = "Error in database";
$sql_result = mysqli_query($conn, $sql) or die (json_encode($sqldieobject));
$emailindb = mysqli_fetch_assoc($sql_result);

if($emailindb == null){
    $res = new result();
    $res->success = false;
    $res->message = "Incorect email or password";
    $res->data = null;
    die(json_encode($res));
}

$useridindb = $emailindb["gbnh52user_id36sd"];

if($useridindb == null || $useridindb == 0){
    $res = new result();
    $res->success = false;
    $res->message = "Incorect email or password";
    $res->data = null;
    die(json_encode($res));
}

$sql_hash = "select ghbn521hash31got from ghb251passwords326bfvlcpasss31 where ghbn521user_id31got = '$useridindb' and ghbn521version31got = (select MAX(ghbn521version31got) from ghb251passwords326bfvlcpasss31 where ghbn521user_id31got = '$useridindb' limit 1) limit 1";
$sqldieobjecthash = new result();
$sqldieobjecthash->success = false;
$sqldieobjecthash->message = "Error in database";
$sql_result_salt = mysqli_query($conn, $sql_hash) or die (json_encode($sqldieobjecthash));
$hashindb = mysqli_fetch_assoc($sql_result_salt);

if($hashindb == null){
    $res = new result();
    $res->success = false;
    $res->message = "Incorect email or password";
    $res->data = null;
    die(json_encode($res));
}

if($hashindb["ghbn521hash31got"] == null || $hashindb["ghbn521hash31got"] == ""){
    $res = new result();
    $res->success = false;
    $res->message = "User not found";
    $res->data = null;
    die(json_encode($res));
}

$hash = $req->hash;

if($hash !== $hashindb["ghbn521hash31got"]){
    $res = new result();
    $res->success = false;
    $res->message = "Incorect email or password";
    $res->data = null;
    die(json_encode($res));
}

session_start();
$randomforsessionkey = bin2hex(random_bytes(128));
$randomforsessiontoken = bin2hex(random_bytes(256));

$_SESSION["sessionKey"] = $randomforsessionkey;
$_SESSION["sessionToken"] = $randomforsessiontoken;
$_SESSION["user_id"] = $useridindb;

$sessssss = new sessionStartModel();
$sessssss->sessionId = session_id();
$sessssss->sessionKey = $randomforsessionkey;
$sessssss->sessionToken = $randomforsessiontoken;


$res = new result();
$res->success = true;
$res->message = "Login ok";
$res->data = $sessssss;
die(json_encode($res));

die(json_encode("Bruh wtf zelfs"));

class sessionStartModel{
    public $sessionId;
    public $sessionKey;
    public $sessionToken;
}

?>