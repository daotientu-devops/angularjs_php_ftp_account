<!DOCTYPE html>
<html class="app" ng-app="myApp">
<head>
    <meta charset="utf-8"/>
    <title>Account Manager Web Application</title>
    <meta name="description" content="Account Manager Web Application created with AngularJS and PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <!-- base css styles -->
    <link rel="stylesheet" href="templates/flaty/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="templates/flaty/assets/bootstrap/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="templates/flaty/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="templates/flaty/assets/normalize/normalize.css">
    <!-- custom css styles -->
    <link rel="stylesheet" href="css/custom.css" type="text/css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- flaty css styles -->
    <link rel="stylesheet" href="templates/flaty/css/flaty.css">
    <link rel="stylesheet" href="templates/flaty/css/flaty-responsive.css">
    <link rel="shortcut icon" href="images/favicon.ico"/>
</head>
<body ng-cloak="" class="skin-green">

<div>
    <div class="page-content">
        <div ng-view="" id="ng-view"></div>
    </div>
</div>

<!--page specific plugin scripts-->
<script src="js/angular.min.js"></script>
<script src="js/ui-bootstrap-tpls-0.11.2.min.js"></script>
<script src="js/angular-route.min.js"></script>
<script src="js/angular-animate.min.js"></script>
<script src="js/toaster.js"></script>

<!-- AngularJS custom codes -->
<script src="app/app.js"></script>
<script src="app/data.js"></script>
<script src="app/directives.js"></script>
<script src="app/accountsCtrl.js"></script>
<script src="app/authCtrl.js"></script>

<!-- Some Bootstrap Helper Libraries -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/underscore.min.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>

<!-- JQUERY -->
<script src="plugins/angular-datatables-master/vendor/jquery/dist/jquery.js"></script>
<script src="plugins/angular-datatables-master/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="plugins/angular-datatables-master/vendor/datatables/media/css/jquery.dataTables.min.css">

<!-- ANGULAR -->
<script src="plugins/angular-datatables-master/vendor/angular/angular.js"></script>

<script src="plugins/angular-datatables-master/src/angular-datatables.directive.js"></script>
<script src="plugins/angular-datatables-master/src/angular-datatables.instances.js"></script>
<script src="plugins/angular-datatables-master/src/angular-datatables.util.js"></script>
<script src="plugins/angular-datatables-master/src/angular-datatables.renderer.js"></script>
<script src="plugins/angular-datatables-master/src/angular-datatables.factory.js"></script>
<script src="plugins/angular-datatables-master/src/angular-datatables.options.js"></script>
<script src="plugins/angular-datatables-master/src/angular-datatables.js"></script>

</body>
</html>