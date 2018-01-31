<?php

$errorInvalidSession = "Invalid session";

include 'result.php';

$postdata = file_get_contents("php://input");
$req = json_decode($postdata);

if($req == null){
    $res = new result();
    $res->success = false;
    $res->message = "Post data not found!";
    die(json_encode($res));
}

if(!isset($req->appId) || !isset($req->appToken)){
    $res = new result();
    $res->success = false;
    $res->message = "Uknown app";
    die(json_encode($res));
}

if($req->appId != "1b9eb05f5a2f5a5f579bf8cadc67a9d5a0f1bf8ac66f9c65fa3cdd394755d60b" || $req->appToken != "f5bf37b683e2d7f6ab00da31fcadbf28bec06d38f2e858f38133484f5f297557aede47581d8dc6b32bced2a45b88da689010452dbf16688331fe261c66b06b78"){
    $res = new result();
    $res->success = false;
    $res->message = "Uknown app";
    die(json_encode($res));
}

if(!isset($req->sessionId) || $req->sessionId == ""){
    $res = new result();
    $res->success = false;
    $res->message = "a$errorInvalidSession";
    $res->data = null;
    die(json_encode($res));
}

if(!isset($req->sessionId)){
    $res = new result();
    $res->success = false;
    $res->message = "$errorInvalidSession";
    die(json_encode($res));
}

session_id($req->sessionId);
session_start();

if(!isset($_SESSION["sessionKey"])){
    $res = new result();
    $res->success = false;
    $res->message = "b$errorInvalidSession";
    $res->data = null;
    die(json_encode($res));
}
if(!isset($_SESSION["sessionToken"])){
    $res = new result();
    $res->success = false;
    $res->message = "c$errorInvalidSession";
    $res->data = null;
    die(json_encode($res));
}

if(!isset($req->sessionKey) || !isset($req->sessionToken)){
    $res = new result();
    $res->success = false;
    $res->message = "$errorInvalidSession";
    die(json_encode($res));
}

if($_SESSION["sessionKey"] != $req->sessionKey || $_SESSION["sessionToken"] != $req->sessionToken){
    $res = new result();
    $res->success = false;
    $res->message = "$errorInvalidSession";
    die(json_encode($res));
}

//die true wordt niet gebuikt omdat andere paginas hierop verder runnen

?>