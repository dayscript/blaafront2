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
