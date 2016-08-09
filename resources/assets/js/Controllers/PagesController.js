App.controller('PageController',function($scope,$http,$timeout,$q,$log,$sce,SERVER,SERVERFRONT){
  $http.get(SERVER.domain+'/paginas-basicas/musica').success(function(data,status,headers,config){
    console.log(data.nodes[0].node);
    $scope.title = data.nodes[0].node.title
    $scope.content = $sce.trustAsHtml(data.nodes[0].node.Contenido);
  })
});
