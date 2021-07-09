/**
 * Created by Administrator on 04/07/2016.
 */
app.directive('formElement', function () {
    return {
        restrict: 'E',
        transclude: true,
        scope: {
            label: "@",
            model: "="
        },
        link: function (scope, element, attrs) {
            scope.disabled = attrs.hasOwnProperty('disabled');
            scope.required = attrs.hasOwnProperty('required');
            scope.pattern = attrs.pattern || '.*';
        },
        template: '<div class="form-group"><label class="col-sm-3 control-label no-padding-right"> {{ label }}</label><div class="col-sm-7"><span class="block input-icon input-icon-right" ng-transclude></span></div></div>'
    };
});

app.directive('focus', function () {
    return function (scope, element) {
        element[0].focus();
    }
});

app.directive('animateOnChange', function ($animate) {
    return function (scope, elem, attr) {
        scope.$watch(attr.animateOnChange, function(nv, ov) {
            if (nv != ov) {
                var c = 'change-up';
                $animate.addClass(elem, c, function() { // element, class
                    $animate.removeClass(elem, c);
                });
            }
        });
    }
});

app.directive('passwordMatch', function () {
    return {
        restrict: 'A',
        scope: true,
        require: 'ngModel',
        link: function (scope, elem, attrs, control) {
            var checker = function () {
                // get the value of the first password
                var e1 = scope.$eval(attrs.ngModel);
                // get the value of the other password
                var e2 = scope.$eval(attrs.passwordMatch);
                if (e2 != null)
                    return e1 == e2;
            };
            scope.$watch(checker, function (n) {
                // set the form control to valid if both
                // passwords are the same, else invalid
                control.$setValidity("passwordNoMatch", n);
            });
        }
    };
});