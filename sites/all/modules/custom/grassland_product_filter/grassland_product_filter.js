(function ($) {
    Drupal.behaviors.productFilter = {
        attach: function (context, settings) {

            angular.module('glApp', [])

                /*
                 * Constants
                 */
                .constant('SETTINGS', settings.productFilter)

                /*
                 * Controllers
                 */
                .controller('MainController', ['$scope', 'SETTINGS', function ($scope, SETTINGS) {

                    $scope.settings = SETTINGS;

                    $scope.userInput = {
                        loan: SETTINGS.minLoan,
                        tenure: SETTINGS.minTenure
                    };

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