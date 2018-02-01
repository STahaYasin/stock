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
        
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        
        <link href="css/default.css" type="text/css" rel="stylesheet"/>
        
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-route.js"></script>
        
        <script>
            var app = angular.module("stock_app", ["ngRoute"]);
        </script>
        
        <script src="controllers/home.js"></script>
        <script src="controllers/suppliers.js"></script>
        <script src="controllers/createshop.js"></script>
        <script src="controllers/overal.js"></script>
        
        <script>
            app.config(function($routeProvider, $locationProvider){
                $routeProvider
                .when('/home', {
                    templateUrl: 'templates/home.html',
                    controller: 'home'
                })
                .when('/home/:shopid', {
                    templateUrl: 'templates/home.html',
                    controller: 'home'
                })
                .when('/suppliers/:shopid', {
                    templateUrl: 'templates/suppliers.html',
                    controller: 'suppliers'
                })
                .when('/createshop', {
                    templateUrl: 'templates/createshop.html',
                    controller: 'createshop'
                })
                .when('/:param0/over-ons', {
                    templateUrl: 'client/overons.html'
                })
                .otherwise({
                    redirectTo: '/home'
                });
               //$locationProvider.html5Mode(true);
            });
        </script>
    </head>
    
    <body ng-app="stock_app" ng-controller="overal">
        <div ng-click="header_close_stores()" class="header_stores_hiden_hidden" ng-class="{'header_stores_hiden_show': header_open_stores_status}"></div>
        <header>
            <div class="header_user">
                
            </div>
            <div ng-click="header_open_stores()" class="header_stores">
                <div>
                    <img class="header_storesimg" src="uploads/schop-images/2018013113509654.png"/>
                    <div class="header_shop_name">
                        <h5 class="header_shop_nameh5">{{shop.name}}</h5>
                        <p class="header_shop_namep">{{shop.addresses[0].street}} {{shop.addresses[0].nr}}, {{shop.addresses[0].zipcode}} {{shop.addresses[0].city}}</p>
                    </div>
                </div>
                
                <div class="triangle" ng-class="{'triangleneg': header_open_stores_status}"></div>
            </div>
            <div class="header_stores_hiden"  ng-class="{'header_stores_show': header_open_stores_status}">
                <div class="header_stores_hidendiv" ng-repeat="item in shops" ng-click="openshop(item)">
                    <img class="header_storesimg" src="uploads/schop-images/2018013113509654.png"/>
                    <div class="header_shop_name">
                        <h5 class="header_shop_nameh5">{{item.name}}</h5>
                        <p class="header_shop_namep">{{item.addresses[0].street}} {{item.addresses[0].nr}}, {{item.addresses[0].zipcode}} {{item.addresses[0].city}}</p>
                    </div>
                </div>
                <div style="margin-top: 5px" class="header_stores_hidendiv" ng-click="opennewshoppage()">
                    <img class="header_storesimg" src="uploads/schop-images/2018013113509654.png"/>
                    <div class="header_shop_name">
                        <h5 class="header_shop_nameh5">NEW SHOP</h5>
                        <p class="header_shop_namep">Click here to add a new shop.</p>
                    </div>
                </div>
                
                <!--<div class="triangle"></div>-->
            </div>
        </header>
        <main>
            <panel-left>
                <div>
                    <div>
                        
                    </div>
                    <div>
                        <h3>SHOP</h3>
                        <button class="left_button">DETAILS</button>
                        <button class="left_button">LICENCES</button>
                        <button class="left_button">SUPPLIER</button>
                        <button class="left_button">PRODUCTS</button>
                    </div>
                </div>
            </panel-left>
            <panel-right ng-view>
                <h3>dit is de main page</h3><?php echo $_SESSION["user_id"]; ?>
            </panel-right>
        </main>
    </body>
</html>