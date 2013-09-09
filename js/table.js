var app = angular.module('main', ['ngTable']).
    controller('classList', function($scope, ngTableParams) {
        var data = [{name: "Moroni", age: 50},
            {name: "Tiancum", age: 43},
            {name: "Jacob", age: 27},
            {name: "Nephi", age: 29},
            {name: "Enos", age: 34},
            {name: "Tiancum", age: 43},
            {name: "Jacob", age: 27},
            {name: "Nephi", age: 29},
            {name: "Enos", age: 34},
            {name: "Tiancum", age: 43},
            {name: "Jacob", age: 27},
            {name: "Nephi", age: 29},
            {name: "Enos", age: 34},
            {name: "Tiancum", age: 43},
            {name: "Jacob", age: 27},
            {name: "Nephi", age: 29},
            {name: "Enos", age: 34}];

        $scope.tableParams = new ngTableParams({
            page: 1, // show first page
            total: data.length, // length of data
            perPage: 10 // count per page

        });

        $scope.numPages = function () {
            return Math.ceil($scope.tableParams.total / $scope.perPage);
        };

        $scope.updatePerPage = function (param) {
            console.log(param);
            console.log($scope);
            $scope.tableParams.perPage = param;
        }

        $scope.$watch('tableParams', function(params) {

            $scope.classes = data.slice((params.page - 1) * params.perPage, params.page * params.perPage);
        }, true);

        console.log($scope);

    }
)