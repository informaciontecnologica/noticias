/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


angular.module('DemoPagineo', [])
.controller('tablaUsuarios', ['$scope','$http',function($scope,$http) {
    

  

        $http({
            url: '../controles/not.php',
            method: "POST"
        }).then(function (response) {
            $scope.noti = response.data.noticias;
            console.log("response");
        });

   
 
    
    $scope.currentPage = 0;
    $scope.pageSize = 10;
   
	$scope.configPages = function() {
        $scope.pages.length = 0;
        var ini = $scope.currentPage - 4;
        var fin = $scope.currentPage + 5;
        if (ini < 1) {
            ini = 1;
            if (Math.ceil($scope.noticias.length / $scope.pageSize) > 10)
                fin = 10;
            else
                fin = Math.ceil($scope.noticias.length / $scope.pageSize);
        }
        else {
            if (ini >= Math.ceil($scope.noticias.length / $scope.pageSize) - 10) {
                ini = Math.ceil($scope.noticias.length / $scope.pageSize) - 10;
                fin = Math.ceil($scope.noticias.length / $scope.pageSize);
            }
        }
        if (ini < 1) ini = 1;
        for (var i = ini; i <= fin; i++) {
            $scope.pages.push({no: i});
        }

        if ($scope.currentPage >= $scope.pages.length)
            $scope.currentPage = $scope.pages.length - 1;
    };

    $scope.setPage = function(index) {
        $scope.currentPage = index - 1;
    };
}])

.filter('startFromGrid', function() {
    return function(input, start) {
        start =+ start;
        return input.slice(start);
    };
});