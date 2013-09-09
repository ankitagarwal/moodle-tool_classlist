var app = angular.module('tool_classlist_table', []).
    controller('classList', function($scope) {

        $scope.init = function(classes) {
            $scope.data = classes;
            $scope.total = $scope.data.length;
        }

        $scope.page = 1; // show first page
        $scope.total = 0; // length of data
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
        $scope.$watch('perPage', function() {
            $scope.page = 1; // Reset page counter.
            $scope.classes = $scope.data.slice(($scope.page - 1) * $scope.perPage, $scope.page * $scope.perPage);
        }, true);

        // Update data when params are changed.
        $scope.$watch('page', function() {
            $scope.classes = $scope.data.slice(($scope.page - 1) * $scope.perPage, $scope.page * $scope.perPage);
        }, true);

        console.log($scope);

    }
)