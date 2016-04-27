var App = angular.module('Blaa', ['ngMaterial','ngRoute']);

App.config(['$locationProvider','$routeProvider', function ($locationProvider,$routeProvider){
  $locationProvider.html5Mode(true);
}]);

App.constant('SERVER',{
    'domain':'http://blaa.demodayscript.com',
    'port':'80'
});

App.constant('SERVERFRONT',{
    'domain':'http://blaafront2.demodayscript.com',
    'port':'80'
});

App.controller('SearchController', function($scope,$http,$timeout,$q,$log,$rootScope,SERVER,SERVERFRONT){
  $scope.searchTextChange = function(text) {
   }

   $scope.GetAutors = function(){
        var deferred = $q.defer();
        //$http.get(SERVER.domain + '/autocomplete/autores')
        $http.get(SERVERFRONT.domain+'/json/autores.json')
            .success(function(data,status,headers,config){
                $scope.data = data.nodes
                console.log($scope.data);
                deferred.resolve($scope.data);
            })
        return deferred.promise;
    }
    $scope.GetComposers = function(){
         var deferred = $q.defer();
         //$http.get(SERVER.domain + '/autocomplete/compositores')
         $http.get(SERVERFRONT.domain+'/json/compositores.json')
              .success(function(data,status,headers,config){
                 $scope.data = data.nodes
                 deferred.resolve($scope.data);
             })
         return deferred.promise;
     }
    $scope.CallBackFilterComposers = function(text){
        var query = angular.lowercase(text);
        var myPromise = $scope.GetComposers();
        return myPromise.then(function(resolve){
                resolve = filter(query,resolve)
                return resolve;
              });
    }
    $scope.CallBackFilter = function(text){
        var query = angular.lowercase(text);
        var myPromise = $scope.GetAutors();
        return myPromise.then(function(resolve){
                resolve = filter(query,resolve)
                return resolve;
              });
    }
    function filter(query,resolve){
      var data;
      var item = [];
      for( var i = 0; i <= resolve.length-1;i++){
          var item = angular.lowercase(resolve[i]['Título']);
          if (item.indexOf(angular.lowercase(query)) === 0){
             data += '/'+ resolve[i]['Título'];
           }
      }
      return data.split('/').map( function (pos) {
        return pos.replace('','');
      });
    }
    //slider de fechas
    $scope.date = {
      year: '1990',
      month: '4',
      day:'12'
    };
    $scope.isDisabled = true;
    $scope.rating1 = 3;

});
