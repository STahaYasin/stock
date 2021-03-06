<?php

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>STOCK - REGISTER</title>
        
        <link href="css/login.css" type="text/css" rel="stylesheet"/>
        
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-route.js"></script>
        <script src="lib/sha512.js"></script>
        
        <script>
        
            var app = angular.module("register_app", []);
            app.controller("register_controller", function($scope, $http){
                
                $scope.message;
                $scope.messages = [];
                
                $scope.reg_new_user = {
                    email: "",
                    password: "",
                    passwordagain: "",
                    fname: "",
                    mname: "",
                    lname: ""
                }
                
                $scope.register = function(){
                    var badpoints = 0;
                    var badpointmessages = [];
                    
                    if($scope.reg_new_user.email == null || $scope.reg_new_user.email == undefined || $scope.reg_new_user.email == ""){
                        badpoints ++;
                        badpointmessages.push("Email is required!");
                    }
                    else if($scope.reg_new_user.email.charAt("@") == -1){
                        badpoints ++;
                        badpointmessages.push("Please enter a valid email address!");
                    }
                    if($scope.reg_new_user.password == null || $scope.reg_new_user.password == undefined || $scope.reg_new_user.password == ""){
                        badpoints ++;
                        badpointmessages.push("Password is required!");
                    }
                    else{
                        if($scope.reg_new_user.password.length < 8){
                            badpoints ++;
                            badpointmessages.push("Password needs at least 8 characters!");
                        }
                        else if($scope.reg_new_user.passwordagain == null || $scope.reg_new_user.passwordagain == undefined || $scope.reg_new_user.passwordagain == "" || $scope.reg_new_user.password != $scope.reg_new_user.passwordagain){
                            badpoints ++;
                            badpointmessages.push("Passwords are not the same!");
                        }
                    }
                    if($scope.reg_new_user.fname == null || $scope.reg_new_user.fname == undefined || $scope.reg_new_user.fname == ""){
                        badpoints ++;
                        badpointmessages.push("First name is required!");
                    }
                    if($scope.reg_new_user.lname == null || $scope.reg_new_user.lname == undefined || $scope.reg_new_user.lname == ""){
                        badpoints ++;
                        badpointmessages.push("Last name is required!");
                    }
                    
                    
                    if(badpoints > 0){
                        $scope.message = "Please check the following points";
                        console.warn(badpointmessages);
                        $scope.messages = badpointmessages;
                        return;
                    }
                    
                    var salt = CryptoJS.SHA512("salt123456" + $scope.reg_new_user.email + "salt").toString();
                    var hash = CryptoJS.SHA512(salt + $scope.reg_new_user.password).toString();
                    
                    $http.post("app/api/register.php", {
                        app_id: "1b9eb05f5a2f5a5f579bf8cadc67a9d5a0f1bf8ac66f9c65fa3cdd394755d60b",
                        app_token: "f5bf37b683e2d7f6ab00da31fcadbf28bec06d38f2e858f38133484f5f297557aede47581d8dc6b32bced2a45b88da689010452dbf16688331fe261c66b06b78",
                        email: $scope.reg_new_user.email,
                        hash: hash,
                        salt: salt,
                        fname: $scope.reg_new_user.fname,
                        mname: $scope.reg_new_user.mname,
                        lname: $scope.reg_new_user.lname
                    }).success(function(res){
                        if(res.success == true){
                            $scope.gotologin();
                        }
                        else{
                            $scope.message = res.message;
                        }
                    }).error(function(error){
                        console.error(error);
                    });
                }
                
                $scope.gotologin = function(){
                    window.location.href = "login.php";
                }
                
            });
        
        </script>
        
    </head>
    <body ng-app="register_app" ng-controller="register_controller">
        <div class="error_message_box">
            <h3>{{message}}</h3>
            <p ng-repeat="item in messages">{{item}}</p>
        </div>
        <div class="input_container">
            <div>
                <table>
                    <thead><h3>REGISTER</h3></thead>
                    <tr>
                        <td>NAME</td>
                        <td><input ng-model="reg_new_user.fname" type="text" placeholder="FIRST NAME" /></td>
                        <td><input ng-model="reg_new_user.lname" type="text" placeholder="LAST NAME" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><input ng-model="reg_new_user.mname" type="text" placeholder="MIDDLE NAME" /></td>
                    </tr>
                    <tr>
                        <td>EMAIL</td>
                        <td><input ng-model="reg_new_user.email" type="email" placeholder="EMAIL" /></td>
                    </tr>
                    <tr>
                        <td>PASSWORD</td>
                        <td><input ng-model="reg_new_user.password" type="password" placeholder="PASSWORD" /></td>
                        <td><input ng-model="reg_new_user.passwordagain" type="password" placeholder="REPEAT PASSWORD " /></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><button ng-click="register()">REGISTER</button></td><td><button ng-click="gotologin()">LOGIN</button></td>
                    </tr>
                </table> 
            </div>
        </div>
    </body>
</html>