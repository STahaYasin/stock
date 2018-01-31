<?php

include '../checksession.php'; // Dit doet de session controlleren

if(!isset($req->productName)){
    $res = new result();
    $res->success = false;
    $res->message = "Product name is required to create a new product";
    $res->data = null;
    die(json_encode($res));
}
if($req->productName == ""){
    $res = new result();
    $res->success = false;
    $res->message = "Product name is required to create a new product";
    $res->data = null;
    die(json_encode($res));
}

$productName = $req->productName;
$datetime = '13/12/2017 11:55:58';
$productPrice = "56";

include '../dbset.php';

$sql_insert_new_product = "INSERT INTO `dby6985products54bg` (`dby6985products54bg_id`, `dby6985products54bg_name`, `dby6985products54bg_date`) VALUES ('', '$productName', '$datetime');";
$res_die_insert_product = new result();
$res_die_insert_product->success = false;
$res_die_insert_product->message = "died at insert product";
$sql_insert_product_sql_res = mysqli_query($conn, $sql_insert_new_product) or die(json_encode($res_die_insert_product));

$inserted_product_id = mysqli_insert_id($conn);

$sql_inser_new_price = "INSERT INTO `sgp523prices42xc` (`sgp523price_id42xc`, `sgp523productid42xc`, `sgp523date42xc`, `sgp523price42xc`, `sgp523version42xc`) VALUES (NULL, '$inserted_product_id', '$datetime', '$productPrice', '1');";
$res_die_insert_price = new result();
$res_die_insert_price->success = false;
$res_die_insert_price->message = "died at insert price";
$sql_insert_price_sql_res = mysqli_query($conn, $sql_inser_new_price) or die(json_encode($res_die_insert_price));

?>