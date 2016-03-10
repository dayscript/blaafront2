App.controller('ImageController',function($scope,$http,$timeout,$q,$log){
  $http.get('http://blaa.demodayscript/archivos/imagen/artistas').success(function(data,status,headers,config){
    $scope.images = data.nodes
    console.log($scope.images);
  })
});
