(function ($) {
    Drupal.behaviors.productFilter = {
        attach: function (context, settings) {

            angular.module('glApp', [])

                /*
                 * Constants
                 */
                .constant('SETTINGS', settings.productFilter)

                /*
                 * Services
                 */
                .factory('Product', ['SETTINGS', function (SETTINGS) {
                    var products = SETTINGS.products

                    var factory = {
                        all: all,
                        filter: filter
                    };

                    return factory;

                    /*
                     * Get list of all products.
                     */

                    function all() {
                        return products;
                    }

                    /*
                     * Filter product by given criteria
                     */
                    function filter(options) {
                        return _.filter(products, function (product) {

                            return (product.minLoan <= options.loan)
                                && (product.maxLoan >= options.loan)
                                && (product.minTenure <= options.tenure)
                                && (product.maxTenure >= options.tenure)

                        });
                    }

                }])

                .factory('LoanCalculator', function () {
                    return {
                        perMonth: calculatePerMonth,
                        rate: calculateRate,
                        total: calculateTotal
                    };

                    function calculatePerMonth(product) {
                        return product.maxLoan;
                    }

                    function calculateRate(product) {
                        return product.maxInterest;
                    }

                    function calculateTotal(product) {
                        return product.maxInterest * product.maxLoan;
                    }
                })

                /*
                 * Controllers
                 */
                .controller('MainController', ['$scope', 'SETTINGS', 'Product', function ($scope, SETTINGS, Product) {

                    // Initialization
                    $scope.settings = SETTINGS;

                    $scope.userInput = {
                        loan: SETTINGS.minLoan,
                        tenure: SETTINGS.minTenure
                    };

                    $scope.result = {
                        total: 0,
                        rate: 0,
                        perMonth: 0
                    };

                    $scope.selectedProduct = null;

                    // Methods
                    $scope.setSelectedProduct = function(product) {

                        $scope.selectedProduct = product;

                    }

                    // Watchers
                    $scope.$watch('userInput', onUserInputChange, true);

                    // Implementations
                    function onUserInputChange(newValue, oldValue) {

                        $scope.products = Product.filter(newValue);

                    }


                }])

                /*
                 * Directives
                 */
                .directive('glSlider', ['SETTINGS', function (SETTINGS) {

                    return {
                        restrict: 'AE',
                        require: '^ngModel',
                        scope: {},
                        link: function (scope, elem, attrs, ngModelController) {

                            var text = $('#' + attrs.type.toLowerCase());

                            elem.slider({
                                range: "min",
                                value: SETTINGS['min' + attrs.type],
                                min: SETTINGS['min' + attrs.type],
                                max: SETTINGS['max' + attrs.type],
                                step: parseInt(attrs.step) || 1,
                                slide: function (event, ui) {
                                    scope.$apply(function () {
                                        ngModelController.$setViewValue(ui.value);
                                    });
                                    text.text("￥" + ui.value);
                                }
                            });
                        }
                    };

                }])

                .directive('glLoan', ['LoanCalculator', function (LoanCalculator) {

                    return {
                        restrict: 'A',
                        scope: {
                            type: '@',
                            product: '=selectedProduct'
                        },
                        link: function (scope, elem, attrs) {

                            scope.$watch('product', function (newValue, oldValue) {

                                if (newValue) {
                                    elem.text(LoanCalculator[scope.type](newValue));
                                }

                            }, true);

                        }
                    }

                }])
            ;
        }
    };

})(jQuery);