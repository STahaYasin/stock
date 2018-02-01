app.controller("overal", function($scope, $http, $location){
    $scope.shops = [];
    
    
    function start(){
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
    
    $scope.header_open_stores_status = false;
    
    $scope.header_open_stores = function(){
        $scope.header_open_stores_status = !$scope.header_open_stores_status;
    }
    $scope.header_close_stores = function(){
        $scope.header_open_stores_status = false;
    }
});