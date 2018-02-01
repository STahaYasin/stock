<?php

require "../result.php";
require "../db_register.php";

session_start();

if(!isset($_SESSION["user_id"])){
    $res = new result();
    $res->success = false;
    $res->message = "Youre not logged in!";
    $res->data = null;
    $res->code = 401;
    die(json_encode($res));
}

$userid = $_SESSION["user_id"];

header('Content-type: Application-json');

$postdata = file_get_contents("php://input");
$req = json_decode($postdata);

if($req == null){
    $res = new result();
    $res->success = false;
    $res->message = "Post data not found!";
    $res->code = 501;
    die(json_encode($res));
}

$sessionKey = $req->sessionKey;
$sessionToken = $req->sessionToken;

if($sessionKey != $_SESSION["sessionKey"]){
    $res = new result();
    $res->success = false;
    $res->message = "Invalid session!";
    $res->data = null;
    $res->code = 401;
    
    die(json_encode($res));
}

if($req->data->name == null || $req->data->name == ""){
    $res = new result();
    $res->success = false;
    $res->message = "Name is required!";
    $res->data = null;
    $res->code = 400;
}

$date_time_now_obj = new DateTime("NOW");
$date_time_now = $date_time_now_obj->format("d/m/Y H:i:s");

$data = $req->data;
$name = $data->name;
$email = $data->email;
$phone = $data->phone;

$address = $data->address;
$street = $address->street;
$nr = $address->number;
$zip = $address->zipcode;
$city = $address->city;
$country = $address->country;

$insert_shop_sql_query = "INSERT INTO `sho785stock_shops` (`sho785stock_shops_id`, `sho785stock_shops_name`, `sho785stock_shops_btw`, `sho785stock_shops_code`) VALUES (NULL, '$name', 'not implemented yet', 'code');";
$insert_shop_sql_error = new result();
$insert_shop_sql_error->success = false;
$insert_shop_sql_error->message = "died at insert hash";
$insert_shop_sql_error->code = 500;
$insert_shop_sql_res = mysqli_query($conn, $insert_shop_sql_query) or die(json_encode($insert_shop_sql_error)); // TODO

if($insert_shop_sql_res == false){
    $res = new result();
    $res->success = false;
    $res->message = "Error in database, please try again -----! error at inserting hash";
    die(json_encode($res));
}

$new_shop_id = (mysqli_insert_id($conn));

$insert_address_sql_query = "INSERT INTO `asx465stock_addresses` (`asx465stock_addresses_id`, `asx465stock_addresses_street`, `asx465stock_addresses_nr`, `asx465stock_addresses_zip`, `asx465stock_addressecity`, `asx465stock_addresses_country`, `asx465stock_addresses_type`, `asx465stock_addresses_oid`) VALUES (NULL, '$street', '$nr', '$zip', '$city', '$country', '2', '$new_shop_id');";
$insert_address_sql_error = new result();
$insert_address_sql_error->success = false;
$insert_address_sql_error->message = "died at insert hash";
$insert_address_sql_error->code = 500;
$insert_address_sql_res = mysqli_query($conn, $insert_address_sql_query) or die(json_encode($insert_address_sql_error)); // TODO

if($insert_address_sql_res == false){
    $res = new result();
    $res->success = false;
    $res->message = "Error in database, please try again -----! error at inserting address";
    die(json_encode($res));
}

$insert_email_sql_query = "INSERT INTO `rdl632stock_emails` (`rdl632stock_emails_id`, `rdl632stock_emails_uid`, `rdl632stock_emails_email`, `rdl632stock_emails_ok`, `rdl632stock_emails_date`, `rdl632stock_emails_type`) VALUES (NULL, '$new_shop_id', '$email', '0', '$date_time_now', '2');";
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

$insert_relation_sql_query = "INSERT INTO `sha243stock_shoprelations` (`sha243stock_shoprelations_id`, `sha243stock_shoprelations_uid`, `sha243stock_shoprelations_sid`, `sha243stock_shoprelations_type`) VALUES (NULL, '$userid', '$new_shop_id', '1');";
$insert_relation_sql_error = new result();
$insert_relation_sql_error->success = false;
$insert_relation_sql_error->message = "died at insert email";
$insert_relation_sql_res = mysqli_query($conn, $insert_relation_sql_query) or die(json_encode($insert_relation_sql_error)); // TODO

if($insert_relation_sql_res == false){
    $res = new result();
    $res->success = false;
    $res->message = "Error in database, please try again -----! error at inserting relation";
    die(json_encode($res));
}

$res = new result();
$res->success = true;
$res->message = "Shop created successfuly";
$res->data = Array();
$res->code = 200;

die(json_encode($res));


?>