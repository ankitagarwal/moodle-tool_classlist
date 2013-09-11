var app = angular.module('tool_classlist_table', []).
    controller('classList', function($scope, $http) {

        $scope.init = function() {
            $http({method: 'GET', url: M.cfg.wwwroot + '/admin/tool/classlist/list.php?key=' + M.cfg.sesskey}).
                success(function(data) {
                    $scope.data = data.data;
                    $scope.cols = data.cols;
                    $scope.total = $scope.data.length;
                    $scope.resetSorting();
                }).
                error(function() {
                    alert('Cannot fetch class list, something went wrong');
                }
            );
        };

        $scope.sorting = {};
        $scope.data = [];
        $scope.page = 1; // show first page
        $scope.total = 0; // length of data
        $scope.perPage = 25; // count per page

        // Set sorting flags.
        $scope.resetSorting = function () {
            var col;
            for(var i = 0; i < $scope.cols.length; i++) {
                col = $scope.cols[i];
                $scope.sorting[col] = 0;
            }
        };

        // Show hide sorting icons.
        $scope.showSortingIcon = function (col, asc) {
            if ((asc === true && $scope.sorting[col] === 1) || (asc === false && $scope.sorting[col] === 2)) {
                return true;
            }
            return false;
        };

        // update sorting flags and call sort method.
        $scope.updateSorting = function (col) {
            var val = 0;
            if ($scope.sorting[col] === 1) {
                val = 2;
            } else {
                val = 1;
            }
            $scope.resetSorting();
            $scope.sorting[col] = val;
            if (val !== 0 ) {
                $scope.data.sort(function(a, b) {
                    if (a[col] === b[col]) {
                        return 0;
                    } else {
                        if (val === 1) {
                            return a[col] > b[col] ? 1 : -1;
                        } else {
                            return a[col] > b[col] ? -1 : 1;
                        }
                    }
                });
            }
        };

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

        $scope.filterClasses = function(oldval, newval) {
            if (oldval !== newval) {
                // Do not call this during init.
                $scope.classes = $scope.data.slice(($scope.page - 1) * $scope.perPage, $scope.page * $scope.perPage);
            }
        };

        $scope.filterClassesReset = function() {
            $scope.page = 1;
            $scope.filterClasses();
        };

        // Update data when params are changed.
        $scope.$watch('perPage', $scope.filterClassesReset);

        // Update data when params are changed.
        $scope.$watch('page', $scope.filterClasses);

        // Watch array for change in sorting.
        $scope.$watchCollection('data', $scope.filterClasses);

        console.log($scope);

    }
)