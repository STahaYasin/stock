<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>REGISTER</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="js/angular.min.js"></script>
        <script src="lib/sha512.js"></script>
        <script>
        
            var app = angular.module('registerApp', []);
            
            app.controller('registerController', function($scope, $http){
                $scope.newUserInput = {
                    namePrefix: '',
                    firstName: '',
                    middleName: '',
                    lastName: '',
                    nameSuffix: '',
                    email: '',
                    password: '',
                    passwordAgain: '',
                    key_crypted: "",
                    type: '1',
                    appId: '1b9eb05f5a2f5a5f579bf8cadc67a9d5a0f1bf8ac66f9c65fa3cdd394755d60b',
                    appToken: 'f5bf37b683e2d7f6ab00da31fcadbf28bec06d38f2e858f38133484f5f297557aede47581d8dc6b32bced2a45b88da689010452dbf16688331fe261c66b06b78',
                    appName: 'web-register'
                }
                
                $scope.register = function(){
                    $http.get('app/makesalt.php?from=' + $scope.newUserInput.email).success(function(res){
                        if(res.success === true){
                            registerWithSalt(res.data);
                        }
                        else{
                            console.warn(res.message);
                        }
                    }).error(function(error){
                        console.error(error);
                    });
                }
                function registerWithSalt(salt){
                    var password = $scope.newUserInput.password;
                    var passPlusSalt = password + salt;
                    
                    var input = $scope.newUserInput;
                    input.salt = salt;
                    
                    var hash = CryptoJS.SHA512(passPlusSalt).toString();
                    input.password = hash;
                    input.passwordAgain = hash;
                    
                    var key = CryptoJS.SHA512("key" + passPlusSalt + "private").toString();
                    var keyEncryptKey = CryptoJS.SHA512(salt + password);
                    
                    input.key_crypted = key;
                    
                    $http.post('app/register.php', input).success(function(res){
                        console.log(res);
                    }).error(function(error){
                        console.error(error);
                    });
                }
            });
            
        </script>
    </head>
    <body ng-app="registerApp" ng-controller="registerController">
        <div>
            <input type="text" placeholder="NamePrefix" ng-model="newUserInput.namePrefix" />
            <input type="text" placeholder="FirstName" ng-model="newUserInput.firstName" />
            <input type="text" placeholder="MiddleName" ng-model="newUserInput.middleName" />
            <input type="text" placeholder="LastName" ng-model="newUserInput.lastName" />
            <input type="text" placeholder="NameSuffix" ng-model="newUserInput.nameSuffix" />
            <input type="email" placeholder="Email" ng-model="newUserInput.email" />
            <input type="password" placeholder="Password" ng-model="newUserInput.password" />
            <input type="password" placeholder="Pasword Again" ng-model="newUserInput.passwordAgain" />
            <select ng-model="newUserInput.type">
                <option value="1">User</option>
                <option value="150">Seler</option>
            </select>
            <button ng-click="register()">REGISTER</button>
        </div>
    </body>
</html>