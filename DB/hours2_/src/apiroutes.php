<?php

namespace PHPMaker2022\project1;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // API
    $app->map(['POST', 'OPTIONS'], '/' . Config("API_LOGIN_ACTION"), ApiController::class . ':login')->add(JwtMiddleware::class . ':create')->setName('api/' . Config("API_LOGIN_ACTION")); // login
    $app->map(['GET', 'OPTIONS'], '/' . Config("API_LIST_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->add(new JwtMiddleware())->setName('api/' . Config("API_LIST_ACTION")); // list
    $app->map(['GET', 'OPTIONS'], '/' . Config("API_VIEW_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->add(new JwtMiddleware())->setName('api/' . Config("API_VIEW_ACTION")); // view
    $app->map(['POST', 'OPTIONS'], '/' . Config("API_ADD_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->add(new JwtMiddleware())->setName('api/' . Config("API_ADD_ACTION")); // add
    $app->map(['POST', 'OPTIONS'], '/' . Config("API_EDIT_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->add(new JwtMiddleware())->setName('api/' . Config("API_EDIT_ACTION")); // edit
    $app->map(['GET', 'POST', 'DELETE', 'OPTIONS'], '/' . Config("API_DELETE_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->add(new JwtMiddleware())->setName('api/' . Config("API_DELETE_ACTION")); // delete
    $app->map(['GET', 'OPTIONS'], '/' . Config("API_FILE_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->add(new JwtMiddleware())->setName('api/' . Config("API_FILE_ACTION")); // file
    $app->map(['GET', 'POST', 'OPTIONS'], '/' . Config("API_LOOKUP_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->add(new JwtMiddleware())->setName('api/' . Config("API_LOOKUP_ACTION")); // lookup
    $app->map(['POST', 'OPTIONS'], '/' . Config("API_UPLOAD_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->add(new JwtMiddleware())->setName('api/' . Config("API_UPLOAD_ACTION")); // upload
    $app->map(['POST', 'OPTIONS'], '/' . Config("API_JQUERY_UPLOAD_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->setName('api/' . Config("API_JQUERY_UPLOAD_ACTION")); // jupload
    $app->map(['GET', 'OPTIONS'], '/' . Config("API_SESSION_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->setName('api/' . Config("API_SESSION_ACTION")); // session
    $app->map(['GET', 'OPTIONS'], '/' . Config("API_PROGRESS_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->setName('api/' . Config("API_PROGRESS_ACTION")); // session
    $app->map(['GET', 'OPTIONS'], '/' . Config("API_EXPORT_CHART_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->setName('api/' . Config("API_EXPORT_CHART_ACTION")); // chart
    $app->map(['GET', 'POST', 'OPTIONS'], '/' . Config("API_PERMISSIONS_ACTION") . '[/{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->add(new JwtMiddleware())->setName('api/' . Config("API_PERMISSIONS_ACTION")); // permissions

    // User API actions
    if (function_exists(PROJECT_NAMESPACE . "Api_Action")) {
        Api_Action($app);
    }

    // Other API actions
    $app->any('/[{params:.*}]', ApiController::class)->add(ApiPermissionMiddleware::class)->setName('custom');
};
