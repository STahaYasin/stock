<?php

session_start();
if(!isset($_SESSION["user_id"])){
    header("location:login.php");
}



?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>HOME</title>
        
        <link href="css/default.css" type="text/css" rel="stylesheet"/>
        <script>
            
        </script>
    </head>
    <body>
        <header>
            
        </header>
        <main>
            <panel-left>
                
            </panel-left>
            <panel-right>
                <h3>dit is de main page</h3><?php echo $_SESSION["user_id"]; ?>
            </panel-right>
        </main>
    </body>
</html>