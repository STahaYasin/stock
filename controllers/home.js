app.controller("home", function($scope, $http, $location, $routeParams){
    
    $scope.shopid;
    $scope.shops = [];
    $scope.shop = {};
    
    
    function start(){
        $scope.shopid = $routeParams.shopid;
        $http.get("app/api/getmyshops.php").success(function(res){
            if(res.success = true){
                gotShops(res.data);
            }
            else{
                console.error(res.message);
            }
        }).error(function(error){
            console.error(error);
        });
        
        $http.post("app/api/getshopbyid.php", {
            shopid: $scope.shopid
        }).success(function(res){
            if(res.success == true){
                $scope.shop = res.data;
            }
            else{
                console.warn(res.message);
            }
        }).error(function(error){
            console.error(error);
        });
    }
    start();
    
    function gotShops(data){
        console.log(data);
        if(data.length == 0){
            $location.path("/createshop");
        }
        else{
            $scope.shops = data;
        }
    }
});