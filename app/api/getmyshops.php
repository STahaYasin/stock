<?php

require "../result.php";
require "../db_register.php";

session_start();

if(!isset($_SESSION["user_id"])){
    $res = new result();
    $res->success = false;
    $res->message = "Youre not logged in!";
    $res->data = null;
    die(json_encode($res));
}

$userid = $_SESSION["user_id"];

$sql_get_relations = "SELECT * FROM `sha243stock_shoprelations` WHERE sha243stock_shoprelations_uid = $userid";
$res_die = new result();
$res_die->success = false;
$res_die->message = "died at sql get map";
$sql_insert_res = mysqli_query($conn, $sql_get_relations) or die(json_encode($res_die));

$shops = Array();

while($row = mysqli_fetch_assoc($sql_insert_res)){
    $shop = new shop();
    $shop->id = $row["sha243stock_shoprelations_sid"];
    $shop->type = $row["sha243stock_shoprelations_type"];
    
    $shopid = $shop->id;
    
    $sql_get_shop = "SELECT * FROM `sho785stock_shops` WHERE sho785stock_shops_id = $shopid";
    $die = new result();
    $die->success = false;
    $die->message = "Error in database";
    $sql_get_shop_res = mysqli_query($conn, $sql_get_shop) or die (json_encode($die));
    $sql_shop = mysqli_fetch_assoc($sql_get_shop_res);
    
    if($sql_shop == null){
        
    }
    else{
        $shop->name = $sql_shop["sho785stock_shops_name"];
    }
    
    $sql_get_addresses = "SELECT * FROM `asx465stock_addresses` WHERE asx465stock_addresses_oid = '$shopid' AND asx465stock_addresses_type = 2";
    $res_die = new result();
    $res_die->success = false;
    $res_die->message = "died at sql get map";
    $sql_address = mysqli_query($conn, $sql_get_addresses) or die(json_encode($res_die));
    
    $addresses = Array();
    
    while($row = mysqli_fetch_assoc($sql_address)){
        $address = new address();
        
        $address->street = $row["asx465stock_addresses_street"];
        $address->nr = $row["asx465stock_addresses_nr"];
        $address->zipcode = $row["asx465stock_addresses_zip"];
        $address->city = $row["asx465stock_addressecity"];
        $address->country = $row["asx465stock_addresses_country"];
        
        array_push($addresses, $address);
    }
    
    $sql_get_emails = "SELECT * FROM `rdl632stock_emails` WHERE rdl632stock_emails_uid = '$shopid' and rdl632stock_emails_type = 2";
    $res_die = new result();
    $res_die->success = false;
    $res_die->message = "died at sql get map";
    $sql_email = mysqli_query($conn, $sql_get_emails) or die(json_encode($res_die));
    
    $emails = Array();
    
    while($row = mysqli_fetch_assoc($sql_email)){
        $email = new email();
        
        $email->email = $row["rdl632stock_emails_email"];
        
        array_push($emails, $email);
    }
    
    $shop->addresses = $addresses;
    $shop->emails = $emails;
    
    array_push($shops, $shop);
}


$res = new result();
$res->success = true;
$res->message = "Shops";
$res->data = $shops;

die(json_encode($res));

class shop{
    public $id;
    public $name;
    public $type;
    public $addresses;
    public $emails;
}
class address{
    public $street;
    public $nr;
    public $zipcode;
    public $city;
    public $country;
}
class email{
    public $email;
}

?>