App.controller('ImageController',function($scope,$http,$timeout,$q,$log,SERVER,SERVERFRONT){
  //console.log(SERVERFRONT.domain)
  //$http.get(SERVERFRONT.domain+'/musica/conciertos/img/json').success(function(data,status,headers,config){
  $http.get(SERVERFRONT.domain+'/musica/conciertos/img/json').success(function(data,status,headers,config){
    //console.log(data);
    $scope.images = data
  })
});
