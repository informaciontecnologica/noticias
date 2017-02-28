<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Dialog - Default functionality</title>
<!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<?php include'../cabezera.php' ?>

</head>
<body ng-app="myApp" ng-controller="cus">
    <div ng-repeat="a in registro">
        <select ng-init="perfila={id:a.id}" ng-model="perfila"  ng-change="update(perfila, x.id_usuario);"  
          ng-options="item as item.label for item in perfiles track by item.id">  </select>
                                    
                              
    <button ng-click="ver();">asaa</button>
 </div>
   <script>
var app = angular.module('myApp', []);
app.controller('cus', function ($scope, $http, $filter) {
    $scope.detalle = false;
    $scope.lista = true;
  $scope.registro=[
      {id:2},
      {id:5},
      {id:1}
  ];
    $scope.perfiles = [
        {'id': 1, 'label': 'Administracion'},
        {'id': 2, 'label': 'Editor'},
        {'id': 3, 'label': 'Registrador'},
        {'id': 5, 'label': 'Usuario'}
    ];
 
    $scope.ver=function(){
        $scope.perfila={id:1};
    };
       });
  </script>
</body>
</html>