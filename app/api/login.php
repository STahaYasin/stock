<?php

require "../result.php";
require "../db_register.php";

//TODO clear all session data

header('Content-type: Application-json');

$postdata = file_get_contents("php://input");
$req = json_decode($postdata);

if($req == null){
    $res = new result();
    $res->success = false;
    $res->message = "Post data not found!";
    die(json_encode($res));
}

if($req->app_id != "1b9eb05f5a2f5a5f579bf8cadc67a9d5a0f1bf8ac66f9c65fa3cdd394755d60b" || $req->app_token != "f5bf37b683e2d7f6ab00da31fcadbf28bec06d38f2e858f38133484f5f297557aede47581d8dc6b32bced2a45b88da689010452dbf16688331fe261c66b06b78"){
    $res = new result();
    $res->success = false;
    $res->message = "Uknown app";
    die(json_encode($res));
}

$email = $req->email;
$hash = $req->hash;
$salt = $req->salt;

$look_for_email_sql_query = "SELECT rdl632stock_emails_uid FROM `rdl632stock_emails` WHERE rdl632stock_emails.rdl632stock_emails_email = '$email' limit 1";
$look_for_email_dieobject = new result();
$look_for_email_dieobject->success = false;
$look_for_email_dieobject->message = "Error in database";
$look_for_email_sqlres = mysqli_query($conn, $look_for_email_sql_query) or die (json_encode($look_for_email_dieobject));
$look_for_email = mysqli_fetch_assoc($look_for_email_sqlres);

if($look_for_email == null){
    $res = new result();
    $res->success = false;
    $res->message = "Email or password is incorrect";
    die(json_encode($res));
}

$userid = $look_for_email["rdl632stock_emails_uid"];

$get_salt_sql_query = "SELECT vfm184stock_passwords_uid FROM `vfm184stock_passwords` WHERE vfm184stock_passwords_uid = '$userid' and vfm184stock_passwords_hash = '$hash' and vfm184stock_passwords_salt = '$salt' and vfm184stock_passwords_version = (SELECT max(vfm184stock_passwords_version) from vfm184stock_passwords where vfm184stock_passwords_uid = $userid GROUP by vfm184stock_passwords_version limit 1) limit 1";
$look_for_salt_dieobject = new result();
$look_for_salt_dieobject->success = false;
$look_for_salt_dieobject->message = "Error in database";
$look_for_salt_sqlres = mysqli_query($conn, $get_salt_sql_query) or die (json_encode($look_for_salt_dieobject));
$look_for_salt = mysqli_fetch_assoc($look_for_salt_sqlres);

if($look_for_salt == null){
    $res = new result();
    $res->success = false;
    $res->message = "Email or password is incorrect";
    die(json_encode($res));
}

session_start();
$randomforsessionkey = bin2hex(random_bytes(128));
$randomforsessiontoken = bin2hex(random_bytes(256));

$_SESSION["sessionKey"] = $randomforsessionkey;
$_SESSION["sessionToken"] = $randomforsessiontoken;
$_SESSION["user_id"] = $userid;

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
    public $userid;
}

?>