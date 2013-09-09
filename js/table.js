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

        // Update per page variable. To be used if I decide to show traditional paging bar.
        $scope.updatePerPage = function (param) {
            $scope.tableParams.perPage = param;
        };

        // Let us show more data.
        $scope.showNext = function () {
            $scope.tableParams.page += 1;
        };

        // Show 'show next' button?
        $scope.hasNext = function () {
            return  ($scope.tableParams.total > ($scope.tableParams.page * $scope.tableParams.perPage));
        };

        // Let us show previous data.
        $scope.showPrevious = function () {
            $scope.tableParams.page -= 1;
        };

        // Show 'show previous' button?
        $scope.hasPrevious = function () {
            return  ($scope.tableParams.page !== 1);
        };

        // Update data when params are changed.
        $scope.$watch('tableParams', function(params) {
            $scope.classes = data.slice((params.page - 1) * params.perPage, params.page * params.perPage);
        }, true);

        console.log($scope);

    }
)