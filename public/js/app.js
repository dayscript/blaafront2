var App = angular.module('Blaa', ['ngMaterial','ngRoute']);

App.config(['$locationProvider','$routeProvider', function ($locationProvider,$routeProvider){
  $locationProvider.html5Mode(true);
}]);

App.constant('SERVER',{
    'domain':'http://blaa.demodayscript.com',
    'port':'80'
});

App.constant('SERVERFRONT',{
    //'domain':'http://blaafront2.demodayscript.com',
    'domain':'http://blaafront2.local',
    'port':'80'
});

App.controller('SearchController', function($scope,$http,$timeout,$q,$log,$rootScope,SERVER,SERVERFRONT){

  $http.get(SERVER.domain+'/taxonomias/series/json')
     .success(function(data,status,headers,config){
     $scope.series = data.nodes
   })
  $http.get(SERVER.domain+'/taxonomias/paises/json')
    .success(function(data,status,headers,config){
    $scope.paises = data.nodes
  })
  $http.get(SERVER.domain+'/taxonomias/instrumentos/json')
   .success(function(data,status,headers,config){
   $scope.instrumentos = data.nodes
  })

   $scope.GetAutors = function(){
        var deferred = $q.defer();
        $http.get(SERVERFRONT.domain+'/json/autores.json')
            .success(function(data,status,headers,config){
                $scope.data = data.nodes
                //console.log($scope.data);
                deferred.resolve($scope.data);
            })
        return deferred.promise;
    }

    $scope.GetComposers = function(){
         var deferred = $q.defer();
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
                debugResolve(resolve);
                return resolve.unique();
              });
    }
    $scope.CallBackFilter = function(text){
        var query = angular.lowercase(text);
        var myPromise = $scope.GetAutors();
        return myPromise.then(function(resolve){
                resolve = filter(query,resolve)
                debugResolve(resolve)
                return resolve.unique();
              });
    }
    function debugResolve(resolve){
      return resolve.splice(0,1);
    }

    Array.prototype.unique=function(a){
      return function(){
        return this.filter(a)
      }
    }(function(a,b,c){
      return c.indexOf(a,b+1)<0
    });

    function filter(query,resolve){
      var data;
      var item = [];
      for( var i = 0; i <= resolve.length-1;i++){
          var item = angular.lowercase(resolve[i]['Título']);
          if (item.indexOf(angular.lowercase(query)) >= 0){
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

App.controller('ImageController',function($scope,$http,$timeout,$q,$log,SERVER,SERVERFRONT){
  $http.get(SERVERFRONT.domain+'/musica/conciertos/img/json').success(function(data,status,headers,config){
    console.log(data);
    $scope.images = data
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
