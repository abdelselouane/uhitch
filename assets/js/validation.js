'use strict';
angular.module('formApp',['formApp.directives']);

function signInController($scope) {
    $scope.isInvalid = function(field){
        return $scope.signform[field].$error.required && $scope.signform[field].$dirty;
    };
    
    $scope.isValid = function(field){
        return $scope.signform[field].$valid && $scope.signform[field].$dirty;
    };
    
    $scope.emailInValid = function(field) {
        return $scope.signform[field].$dirty && $scope.signform[field].$error.email;
    };
    
    $scope.verifyPasswordLength = function(field) {
        return $scope.signform[field].$dirty && $scope.signform[field].$error.minlength;
    }

    $scope.user = {};

    $scope.$watch('myForm', function(){
        console.log('$scope.signform', $scope.signform);
    });
}

// Directives
angular.module('formApp',[]).directive('ngMatch', function() {
    return {
        require: 'ngModel',
        link: function (scope, elem, attrs, ctrl) {
            
            scope.$watch('[' + attrs.ngModel + ',' 
                +attrs.ngMatch+']', function() {

                    var equal = scope.$eval(attrs.ngModel) === scope.$eval(attrs.ngMatch);
                    
                    ctrl.$setValidity('match', equal);
                 }, true);
            }
    }
});

