app.controller('createshop', function($scope, $http, $location){
    
    $scope.newshop = {
        name: "",
        address: {
            street: "",
            number: "",
            zipcode: "",
            city: "",
            country: ""
        },
        email: "",
        phone: ""
    }
    
    $scope.savenewshop = function(){
        if($scope.newshop.name == null || $scope.newshop.name == undefined || $scope.newshop.name == ""){
            alert("Name is required when adding a new shop!");
            return;
        }
        $http.post("app/api/addnewshop.php", {
            sessionKey: localStorage.getItem("sessionKey"),
            sessionToken: localStorage.getItem("sessionToken"),
            data: $scope.newshop
        }).success(function(res){
            gotResult(res);
        }).error(function(error){
            console.warn(error);
        });
        
    }
    function gotResult(res){
        if(res.success = true){
            $location.path("/home");
        }
        else{
            alert(res.message);
        }
    }
});