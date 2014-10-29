(function ($) {
    Drupal.behaviors.productFilter = {
        attach: function (context, settings) {
//            $('.product-filter-slider', context).once('nivo-slider', function () {
//                var vns = $(this);
//                var cfgs = angular.copy(Drupal.settings.views_nivo_slider);
//                for(var idx in cfgs){
//                    var cfg = cfgs[idx];
//                    break;
//                }
//
//                cfg.manualAdvance = true;
//                cfg.slices = 1;
//                cfg.effect = 'fade';
//                cfg.animSpeed = '1';
//
//                // Fix sizes
//                vns.data('hmax', 0).data('wmax', 0);
//                $('img', vns).each(function () {
//                    $(this).load(function () {
//                        hmax = (vns.data('hmax') > $(this).height()) ? vns.data('hmax') : $(this).height();
//                        wmax = (vns.data('wmax') > $(this).width()) ? vns.data('wmax') : $(this).width();
//
//                        // vns.width(wmax).height(hmax).data('hmax', hmax).data('wmax', wmax); /* fixed responsive issue */
//                        vns.data('hmax', hmax).data('wmax', wmax);
//                    });
//                });
//
//                vns.nivoSlider(cfg);
//            });

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

                /*
                 * Controllers
                 */
                .controller('MainController', ['$scope', 'SETTINGS', 'Product', function ($scope, SETTINGS, Product) {

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

                    $scope.$watch('userInput', onUserInputChange, true);

                    function onUserInputChange(oldValue, newValue) {

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

                }]);
        }
    };

})(jQuery);