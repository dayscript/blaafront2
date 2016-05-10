App.controller('ImageController1',function($scope,$http,$timeout,$q,$log,SERVER,SERVERFRONT){
  $http.get(SERVERFRONT.domain+'/musica/conciertos/img/json').success(function(data,status,headers,config){
    $scope.images = data.nodes
  })
});

App.controller('ImageController2',function($scope,$http,$timeout,$q,$log,SERVER,SERVERFRONT){
  $http.get(SERVERFRONT.domain+'/musica/conciertos/img/json').success(function(data,status,headers,config){
    $scope.images = data.nodes
  })
});
