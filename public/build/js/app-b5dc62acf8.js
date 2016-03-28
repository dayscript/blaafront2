var App = angular.module('Blaa', ['ngMaterial','ngRoute']);

App.config(['$locationProvider','$routeProvider', function ($locationProvider,$routeProvider){
  $locationProvider.html5Mode(true);
}]);

App.constant('SERVER',{
    'domain':'http://blaa.local',
    'port':'80'
});

App.controller('SearchController', function($scope,$http,$timeout,$q,$log,$rootScope,SERVER){
  $scope.searchTextChange = function(text) {
   }

   $scope.GetAutors = function(){
        var deferred = $q.defer();
        $http.get(SERVER.domain + '/autocomplete/autores')
            .success(function(data,status,headers,config){
                $scope.data = data.nodes
                console.log($scope.data);
                deferred.resolve($scope.data);
            })
        return deferred.promise;
    }
    $scope.GetComposers = function(){
         var deferred = $q.defer();
         $http.get(SERVER.domain + '/autocomplete/compositores')
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

App.controller('ImageController',function($scope,$http,$timeout,$q,$log,SERVER){
  $http.get(SERVER.domain + '/archivos/imagen/artistas').success(function(data,status,headers,config){
    $scope.images = data.nodes
  })
});

App.factory('AutorsService', function($http) {
    var Autors = {
      async: function() {
        var promise = $http.get('http://blaa.local/autocomplete/autores').then(function (response) {
          return response.data;
        });
        return promise;
      }
    };
    return Autors;
  });

$(document).foundation()

$(document).ready(function() {
	
	//Permite cerrar los mensajes emergentes
    jQuery('.close-button').click(function(){jQuery('.callout').fadeOut();});
});


//# sourceMappingURL=app.js.map
