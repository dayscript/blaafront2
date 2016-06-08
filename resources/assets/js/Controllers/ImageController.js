App.controller('ImageController',function($scope,$http,$timeout,$q,$log,SERVER,SERVERFRONT){
  $http.get(SERVERFRONT.domain+'/musica/conciertos/img/json').success(function(data,status,headers,config){
    console.log(data);
    $scope.images = data
  })
});
