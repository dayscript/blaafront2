var App = angular.module('Blaa', ['ngMaterial']);

App.controller('SearchController', function($scope,$http,$timeout,$q,$log){
  $scope.searchTextChange = function(text) {
   }
   $scope.GetAutors = function(){
        var deferred = $q.defer();
        $http.get('http://blaa.demodayscript/autocomplete/autores')
            //if request is successful
            .success(function(data,status,headers,config){
                $scope.data = data.nodes
                console.log($scope.data);
                deferred.resolve($scope.data);
            })
        return deferred.promise;
    }
    $scope.GetComposers = function(){
         var deferred = $q.defer();
         $http.get('http://blaa.demodayscript/autocomplete/compositores')
             //if request is successful
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
});
