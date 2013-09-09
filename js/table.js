var app = angular.module('tool_classlist_table', []).
    controller('classList', function($scope) {
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

        $scope.page = 1; // show first page
        $scope.total = data.length; // length of data
        $scope.perPage = 10; // count per page


        $scope.numPages = function () {
            return Math.ceil($scope.total / $scope.perPage);
        };

        // Update per page variable. To be used if I decide to show traditional paging bar.
        $scope.updatePerPage = function (param) {
            $scope.perPage = param;
        };

        // Let us show more data.
        $scope.showNext = function () {
            $scope.page += 1;
        };

        // Show 'show next' button?
        $scope.hasNext = function () {
            return  ($scope.total > ($scope.page * $scope.perPage));
        };

        // Let us show previous data.
        $scope.showPrevious = function () {
            $scope.page -= 1;
        };

        // Show 'show previous' button?
        $scope.hasPrevious = function () {
            return  ($scope.page !== 1);
        };

        // Update data when params are changed.
        $scope.$watch('page + perPage', function() {
            $scope.classes = data.slice(($scope.page - 1) * $scope.perPage, $scope.page * $scope.perPage);
        }, true);

        console.log($scope);

    }
)