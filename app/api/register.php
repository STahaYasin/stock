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
$fname = $req->fname;
$mname = $req->mname;
$lname = $req->lname;

//TODO check for all input fields


$look_for_email_sql_query = "SELECT * FROM `rdl632stock_emails` WHERE rdl632stock_emails.rdl632stock_emails_email = '$email' limit 1";
$look_for_email_dieobject = new result();
$look_for_email_dieobject->success = false;
$look_for_email_dieobject->message = "Error in database";
$look_for_email_sqlres = mysqli_query($conn, $look_for_email_sql_query) or die (json_encode($look_for_email_dieobject));
$look_for_email = mysqli_fetch_assoc($look_for_email_sqlres);

if($look_for_email != null){
    $res = new result();
    $res->success = false;
    $res->message = "Email is in use";
    die(json_encode($res));
}

$date_time_now_obj = new DateTime("NOW");
$date_time_now = $date_time_now_obj->format("d/m/Y H:i:s");

//Insert user
$insert_user_sql_query = "INSERT INTO `dsl856stock_users` (`dsl856stock_users_id`, `dsl856stock_users_fname`, `dsl856stock_users_mname`, `dsl856stock_users_lname`) VALUES (NULL, '$fname', '$mname', '$lname');";
$insert_user_sql_error = new result();
$insert_user_sql_error->success = false;
$insert_user_sql_error->message = "died at insert user";
$insert_user_sql_res = mysqli_query($conn, $insert_user_sql_query) or die(json_encode($insert_user_sql_error));

if($insert_user_sql_res == false){
    $res = new result();
    $res->success = false;
    $res->message = "Error in database, please try again -----! error at inserting user";
    die(json_encode($res));
}
//// ---- start insert email ----
$new_user_id = (mysqli_insert_id($conn));

$insert_email_sql_query = "INSERT INTO `rdl632stock_emails` (`rdl632stock_emails_id`, `rdl632stock_emails_uid`, `rdl632stock_emails_email`, `rdl632stock_emails_ok`, `rdl632stock_emails_date`) VALUES (NULL, '$new_user_id', '$email', '0', '$date_time_now');";
$insert_email_sql_error = new result();
$insert_email_sql_error->success = false;
$insert_email_sql_error->message = "died at insert email";
$insert_email_sql_res = mysqli_query($conn, $insert_email_sql_query) or die(json_encode($insert_email_sql_error)); // TODO

if($insert_email_sql_res == false){
    $res = new result();
    $res->success = false;
    $res->message = "Error in database, please try again -----! error at inserting email";
    die(json_encode($res));
}

$new_email_id = (mysqli_insert_id($conn));

$insert_code_sql_query = "INSERT INTO `sqz264stock_verifycodes` (`sqz264stock_verifycodes_id`, `sqz264stock_verifycodes_eid`, `sqz264stock_verifycodes_code`, `sqz264stock_verifycodes_date`) VALUES (NULL, '$new_email_id', '3169', '$date_time_now');";
$insert_code_sql_error = new result();
$insert_code_sql_error->success = false;
$insert_code_sql_error->message = "died at insert code";
$insert_code_sql_res = mysqli_query($conn, $insert_code_sql_query) or die(json_encode($insert_code_sql_error)); // TODO

if($insert_code_sql_res == false){
    $res = new result();
    $res->success = false;
    $res->message = "Error in database, please try again -----! error at inserting code";
    die(json_encode($res));
}

$insert_hash_sql_query = "INSERT INTO `vfm184stock_passwords` (`vfm184stock_passwords_id`, `vfm184stock_passwords_uid`, `vfm184stock_passwords_hash`, `vfm184stock_passwords_salt`, `vfm184stock_passwords_challenge`, `vfm184stock_passwords_challenge_end`, `vfm184stock_passwords_version`) VALUES (NULL, '$new_user_id', '$hash', '$salt', '', '', 1);";
$insert_hash_sql_error = new result();
$insert_hash_sql_error->success = false;
$insert_hash_sql_error->message = "died at insert hash";
$insert_hash_sql_res = mysqli_query($conn, $insert_hash_sql_query) or die(json_encode($insert_hash_sql_error)); // TODO

if($insert_hash_sql_res == false){
    $res = new result();
    $res->success = false;
    $res->message = "Error in database, please try again -----! error at inserting hash";
    die(json_encode($res));
}

//----------------------------------------------------
$get_user_sql_query = "SELECT * FROM `dsl856stock_users` WHERE dsl856stock_users.dsl856stock_users_id = $new_user_id limit 1";
$get_user_sql_error = new result();
$get_user_sql_error->success = false;
$get_user_sql_error->message = "died at getting user";
$get_user_sql_res = mysqli_query($conn, $get_user_sql_query) or die (json_encode($get_user_sql_error));
$user = mysqli_fetch_assoc($get_user_sql_res);

$result = new result();
$result->success = true;
$result->message = "User made successfuly";

$newuser = new user();
$newuser->fname = $user["dsl856stock_users_fname"];
$newuser->mname = $user["dsl856stock_users_mname"];
$newuser->lname = $user["dsl856stock_users_lname"];

$get_emails_sql_query = "SELECT * FROM `rdl632stock_emails` WHERE rdl632stock_emails.rdl632stock_emails_uid = $new_user_id";
$get_emails_sql_error = new result();
$get_emails_sql_error->success = false;
$get_emails_sql_error->message = "died at sql get emails";
$get_emails_sql_res = mysqli_query($conn, $get_emails_sql_query) or die(json_encode($get_emails_sql_error));

$emailsarray = Array();

while($row = mysqli_fetch_assoc($get_emails_sql_res)){
    $object = new email();
    
    $object->email = $row["rdl632stock_emails_email"];
    $object->ok = $row["rdl632stock_emails_ok"];
    $object->type = "Not implemented jet";
    
    array_push($emailsarray, $object);
}

$newuser->emails = $emailsarray;
$newuser->numbers = Array();

//array_push($errorInputFieldsArray, "firstName");

$result->data = $newuser;

die(json_encode($result));

class user{
    public $fname;
    public $mname;
    public $lname;
    public $emails;
    public $numbers;
}
class email{
    public $email;
    public $ok;
    public $type;
}
class phone{
    public $phone;
    public $ok;
}

?>