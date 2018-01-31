<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        
        <script src="js/angular.min.js"></script>
        <script src="lib/sha512.js"></script>
        <script>
        
            var app = angular.module('loginApp', []);
            
            app.controller('loginController', function($scope, $http){
                $scope.userInput = {
                    email: '',
                    password: ''
                };
                
                $scope.login = function(){
                    if($scope.userInput.email == null || $scope.userInput.email == "" || $scope.userInput.password == null || $scope.userInput.password == ""){
                       pleaseFillInAllFieldsError();
                        return;
                    }
                    
                    $http.post('app/getsalt.php', {
                        appId: '1b9eb05f5a2f5a5f579bf8cadc67a9d5a0f1bf8ac66f9c65fa3cdd394755d60b',
                        appToken: 'f5bf37b683e2d7f6ab00da31fcadbf28bec06d38f2e858f38133484f5f297557aede47581d8dc6b32bced2a45b88da689010452dbf16688331fe261c66b06b78',
                        email: $scope.userInput.email
                    }).success(function(res){
                        if(res.success === true){
                            gotSalt(res.data);
                        }
                        else{
                            console.warn(res.message);
                        }
                    }).error(function(error){
                        console.error(error);
                    });
                }
                function gotSalt(salt){
                    if(salt == undefined || salt == null || salt == ""){
                        alert("bruh  bro");
                        return;
                    }
                    
                    var password = $scope.userInput.password;
                    var passPlusSalt = password + salt;
                    var hashcode = CryptoJS.SHA512(passPlusSalt).toString();
                    
                    $http.post('app/login.php', {
                        appId: '1b9eb05f5a2f5a5f579bf8cadc67a9d5a0f1bf8ac66f9c65fa3cdd394755d60b',
                        appToken: 'f5bf37b683e2d7f6ab00da31fcadbf28bec06d38f2e858f38133484f5f297557aede47581d8dc6b32bced2a45b88da689010452dbf16688331fe261c66b06b78',
                        email: $scope.userInput.email,
                        hash: hashcode
                    }).success(function(res){
                        //console.log(res.data.sessionId);
                        //console.log(res.data.sessionKey);
                        //console.log(res.data.sessionToken);
                        localStorage.setItem("sessionId", res.data.sessionId);
                        localStorage.setItem("sessionKey", res.data.sessionKey);
                        localStorage.setItem("sessionToken", res.data.sessionToken);
                    }).error(function(error){
                        console.error(error);
                    });
                }
                function pleaseFillInAllFieldsError(){
                    alert("pleaseFillInAllFieldsError");
                }
            });
            
        </script>
    </head>
    <body ng-app="loginApp" ng-controller="loginController">
        <input type="email" placeholder="email" ng-model="userInput.email" />
        <input type="password" placeholder="password" ng-model="userInput.password" />
        <button ng-click="login()">LOGIN</button>
    </body>
</html>