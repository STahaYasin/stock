<?php

// search for -----! for find developer texts

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


if($req->firstName == null || $req->firstName == ""){
    array_push($errorInputFieldsArray, "firstName");
}
if($req->lastName == null || $req->lastName == ""){
    array_push($errorInputFieldsArray, "lastName");
}
if($req->email == null || $req->email == ""){
    array_push($errorInputFieldsArray, "email");
}
if($req->salt == null || $req->salt == ""){
    array_push($errorInputFieldsArray, "salt");
}
// TODO salt chek
if($req->password == null || $req->password == ""){
    array_push($errorInputFieldsArray, "password");
}
if($req->passwordAgain == null || $req->passwordAgain == ""){
    array_push($errorInputFieldsArray, "password again");
}
if($req->type == null || $req->type == 0){
    array_push($errorInputFieldsArray, "type");
}
if($req->password != $req->passwordAgain){
    array_push($errorInputFieldsArray, "passwords are not the same");
}

if(sizeof($errorInputFieldsArray) > 0){
    $res = new result();
    $res->success = false;
    $res->message = "Please check the folowing fields!";
    $res->data = $errorInputFieldsArray;
    die(json_encode($res));
}

$in_email = $req->email;
$in_nameprefix = $req->namePrefix;
$in_firstname = $req->firstName;
$in_middlename = $req->middleName;
$in_lastname = $req->lastName;
$in_namesuffix = $req->nameSuffix;
$in_password = $req->password;
$in_type = $req->type;
$in_date = "02/12/17 7:27";

require("dbset.php");

$sql = "select * from rhi864emails24vh where rhi864emails24vh.gbnh52email36sd = '$in_email' limit 1";
$sqldieobject = new result();
$sqldieobject->success = false;
$sqldieobject->message = "Error in database";
$sql_result = mysqli_query($conn, $sql) or die (json_encode($sqldieobject));
$emailindb = mysqli_fetch_assoc($sql_result);

if($emailindb != null){
    $res = new result();
    $res->success = false;
    $res->message = "Email is in use";
    die(json_encode($res));
}

//TODO insert 

//// ---- start insert user ----
$sql_insert_user = "INSERT INTO `qzm647users62sm` (`rmg685user_id34gb`, `rmg685nameprefix34gb`, `rmg685firstname34gb`, `rmg685middlename34gb`, `rmg685lastname34gb`, `rmg685namesuffix34gb`, `rmg685prof_pic34gb`) VALUES (NULL, '$in_nameprefix', '$in_firstname', '$in_middlename', '$in_lastname', '$in_namesuffix', '');";
$res_die_insert_user = new result();
$res_die_insert_user->success = false;
$res_die_insert_user->message = "died at insert user";
$sql_insert_user_sql_res = mysqli_query($conn, $sql_insert_user) or die(json_encode($res_die_insert_user));

if($sql_insert_user_sql_res == false){
    $res = new result();
    $res->success = false;
    $res->message = "Error in database, please try again -----! error at inserting user";
    die(json_encode($res));
}
//// ---- start insert email ----
$new_user_id = (mysqli_insert_id($conn));

$sql_insert_email = "INSERT INTO `rhi864emails24vh` (`gbnh52email_id36sd`, `gbnh52user_id36sd`, `gbnh52email36sd`, `gbnh52status36sd`) VALUES (null, '$new_user_id', '$in_email', '0');"; // 0 = not verified, 1 = verified
$res_die_insert_email = new result();
$res_die_insert_email->success = false;
$res_die_insert_email->message = "died at insert email";
$sql_insert_email_sql_res = mysqli_query($conn, $sql_insert_email) or die(json_encode($res_die_insert_email)); // TODO

if($sql_insert_user_sql_res == false){
    $res = new result();
    $res->success = false;
    $res->message = "Error in database, please try again -----! error at inserting email";
    die(json_encode($res));
}
//// ---- start making and inserting password ----
$salt = $req->salt;
$hashedpass = $req->password;

$sql_insert_pass = "INSERT INTO `ghb251passwords326bfvlcpasss31` (`ghbn521pass_id31got`, `ghbn521user_id31got`, `ghbn521madeat31got`, `ghbn521hash31got`, `ghbn521salt31got`, `ghbn521key_crypted31got`, `ghbn521version31got`) VALUES (NULL, '$new_user_id', 'todo date things', '$hashedpass', '$salt', '', '1');";
$res_die_insert_pass = new result();
$res_die_insert_pass->success = false;
$res_die_insert_pass->message = "died at insert email";
$sql_insert_pass_sql_res = mysqli_query($conn, $sql_insert_pass) or die(json_encode($res_die_insert_pass));

if($sql_insert_pass_sql_res == false){
    $res = new result();
    $res->success = false;
    $res->message = "Error in database, please try again -----! error at inserting email";
    die(json_encode($res));
}

$sql_get_from_db_user = "SELECT * FROM `qzm647users62sm` WHERE qzm647users62sm.rmg685user_id34gb = '$new_user_id' limit 1";
$sqldiegetuser = new result();
$sqldiegetuser->success = false;
$sqldiegetuser->message = "Error in database";
$sql_result = mysqli_query($conn, $sql_get_from_db_user) or die (json_encode($sqldiegetuser));
$emailindb = mysqli_fetch_assoc($sql_result);

$result = new result();
$result->success = true;
$result->message = "User made successfuly";

$newuser = new user();
$newuser->nameprefix = $emailindb["rmg685nameprefix34gb"];
$newuser->firstname = $emailindb["rmg685firstname34gb"];
$newuser->middlename = $emailindb["rmg685middlename34gb"];
$newuser->lastname = $emailindb["rmg685lastname34gb"];
$newuser->namesuffix = $emailindb["rmg685namesuffix34gb"];

$result->data = $newuser;

die(json_encode($result));


class result{
    public $success;
    public $message;
    public $data;
}
class user{
    public $email;
    public $nameprefix;
    public $firstname;
    public $middlename;
    public $lastname;
    public $namesuffix;
}

?>