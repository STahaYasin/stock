<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        
        <script src="js/angular.min.js"></script>
        <script>
            var app = angular.module("app", []);   
            
            app.controller("controller", function($scope, $http){
                
                function start(){
                    //todo localstorage and route things
                }
                start();
                
                $scope.zend = function(){
                    $http.post('app/products/newproduct.php', {
                        appId: '1b9eb05f5a2f5a5f579bf8cadc67a9d5a0f1bf8ac66f9c65fa3cdd394755d60b',
                        appToken: 'f5bf37b683e2d7f6ab00da31fcadbf28bec06d38f2e858f38133484f5f297557aede47581d8dc6b32bced2a45b88da689010452dbf16688331fe261c66b06b78',
                        sessionId: localStorage.getItem("sessionId"),
                        sessionKey: localStorage.getItem("sessionKey"),
                        sessionToken: localStorage.getItem("sessionToken"),
                        productName: 'taha'
                    }).success(function(res){
                        
                    }).error(function(error){
                        console.error(error);
                    });
                }
            });
        </script>
    </head>
    <body ng-app="app" ng-controller="controller">
        <button ng-click="zend()">ZEND</button>
    </body>
</html>