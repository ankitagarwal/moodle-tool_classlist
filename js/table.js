var app = angular.module('tool_classlist_table', []).
    controller('classList', function($scope, $http) {

        $scope.init = function() {
            $http({method: 'GET', url: M.cfg.wwwroot + '/admin/tool/classlist/list.php?key=' + M.cfg.sesskey}).
                success(function(data) {
                    $scope.data = data;
                    $scope.total = $scope.data.length;
                    $scope.filterClassesReset();
                }).
                error(function() {
                    alert('Cannot fetch class list, something went wrong');
                }
            );
        };

        $scope.data = [];
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

        $scope.filterClasses = function() {
            $scope.classes = $scope.data.slice(($scope.page - 1) * $scope.perPage, $scope.page * $scope.perPage);
        };

        $scope.filterClassesReset = function() {
            $scope.page = 1;
            $scope.filterClasses();
        };

        // Update data when params are changed.
        $scope.$watch('perPage', $scope.filterClassesReset , true);

        // Update data when params are changed.
        $scope.$watch('page', $scope.filterClasses, true);

        console.log($scope);

    }
)