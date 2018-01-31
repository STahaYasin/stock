<?php

include "result.php";

if(isset($_GET["from"])){
    $res = new result();
    
    if($_GET["from"] == null || $_GET["from"] == ""){
        $res->success = false;
        $res->message = "from cannot be empty";
        die(json_encode($res));
    }
    
    $extra = random_bytes(128);
    $saltplain = hash('sha256', $_GET["from"].$extra);
    
    $res->success = true;
    $res->message = "ok";
    $res->data = $saltplain;
    die(json_encode($res));
}
else{
    $res = new result();
    $res->success = false;
    $res->message = "from cannot be empty";
    die(json_encode($res));
}
?>