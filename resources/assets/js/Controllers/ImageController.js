App.controller('ImageController',function($scope,$http,$timeout,$q,$log,SERVER){
  $http.get(SERVER.domain + '/archivos/imagen/artistas').success(function(data,status,headers,config){
    $scope.images = data.nodes
  })
});
