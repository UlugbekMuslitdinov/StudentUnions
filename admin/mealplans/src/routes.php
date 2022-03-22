<?php

namespace PHPMaker2022\mealplans;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // bursar_payment
    $app->map(["GET","POST","OPTIONS"], '/BursarPaymentList[/{bursar_id}]', BursarPaymentController::class . ':list')->add(PermissionMiddleware::class)->setName('BursarPaymentList-bursar_payment-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/BursarPaymentAdd[/{bursar_id}]', BursarPaymentController::class . ':add')->add(PermissionMiddleware::class)->setName('BursarPaymentAdd-bursar_payment-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/BursarPaymentView[/{bursar_id}]', BursarPaymentController::class . ':view')->add(PermissionMiddleware::class)->setName('BursarPaymentView-bursar_payment-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/BursarPaymentEdit[/{bursar_id}]', BursarPaymentController::class . ':edit')->add(PermissionMiddleware::class)->setName('BursarPaymentEdit-bursar_payment-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/BursarPaymentDelete[/{bursar_id}]', BursarPaymentController::class . ':delete')->add(PermissionMiddleware::class)->setName('BursarPaymentDelete-bursar_payment-delete'); // delete
    $app->group(
        '/bursar_payment',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{bursar_id}]', BursarPaymentController::class . ':list')->add(PermissionMiddleware::class)->setName('bursar_payment/list-bursar_payment-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{bursar_id}]', BursarPaymentController::class . ':add')->add(PermissionMiddleware::class)->setName('bursar_payment/add-bursar_payment-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{bursar_id}]', BursarPaymentController::class . ':view')->add(PermissionMiddleware::class)->setName('bursar_payment/view-bursar_payment-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{bursar_id}]', BursarPaymentController::class . ':edit')->add(PermissionMiddleware::class)->setName('bursar_payment/edit-bursar_payment-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{bursar_id}]', BursarPaymentController::class . ':delete')->add(PermissionMiddleware::class)->setName('bursar_payment/delete-bursar_payment-delete-2'); // delete
        }
    );

    // card_info
    $app->map(["GET","POST","OPTIONS"], '/CardInfoList[/{card_id}]', CardInfoController::class . ':list')->add(PermissionMiddleware::class)->setName('CardInfoList-card_info-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CardInfoAdd[/{card_id}]', CardInfoController::class . ':add')->add(PermissionMiddleware::class)->setName('CardInfoAdd-card_info-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CardInfoView[/{card_id}]', CardInfoController::class . ':view')->add(PermissionMiddleware::class)->setName('CardInfoView-card_info-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CardInfoEdit[/{card_id}]', CardInfoController::class . ':edit')->add(PermissionMiddleware::class)->setName('CardInfoEdit-card_info-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CardInfoDelete[/{card_id}]', CardInfoController::class . ':delete')->add(PermissionMiddleware::class)->setName('CardInfoDelete-card_info-delete'); // delete
    $app->group(
        '/card_info',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{card_id}]', CardInfoController::class . ':list')->add(PermissionMiddleware::class)->setName('card_info/list-card_info-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{card_id}]', CardInfoController::class . ':add')->add(PermissionMiddleware::class)->setName('card_info/add-card_info-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{card_id}]', CardInfoController::class . ':view')->add(PermissionMiddleware::class)->setName('card_info/view-card_info-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{card_id}]', CardInfoController::class . ':edit')->add(PermissionMiddleware::class)->setName('card_info/edit-card_info-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{card_id}]', CardInfoController::class . ':delete')->add(PermissionMiddleware::class)->setName('card_info/delete-card_info-delete-2'); // delete
        }
    );

    // cashier_access
    $app->map(["GET","POST","OPTIONS"], '/CashierAccessList[/{id}]', CashierAccessController::class . ':list')->add(PermissionMiddleware::class)->setName('CashierAccessList-cashier_access-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CashierAccessAdd[/{id}]', CashierAccessController::class . ':add')->add(PermissionMiddleware::class)->setName('CashierAccessAdd-cashier_access-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CashierAccessView[/{id}]', CashierAccessController::class . ':view')->add(PermissionMiddleware::class)->setName('CashierAccessView-cashier_access-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CashierAccessEdit[/{id}]', CashierAccessController::class . ':edit')->add(PermissionMiddleware::class)->setName('CashierAccessEdit-cashier_access-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CashierAccessDelete[/{id}]', CashierAccessController::class . ':delete')->add(PermissionMiddleware::class)->setName('CashierAccessDelete-cashier_access-delete'); // delete
    $app->group(
        '/cashier_access',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CashierAccessController::class . ':list')->add(PermissionMiddleware::class)->setName('cashier_access/list-cashier_access-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CashierAccessController::class . ':add')->add(PermissionMiddleware::class)->setName('cashier_access/add-cashier_access-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', CashierAccessController::class . ':view')->add(PermissionMiddleware::class)->setName('cashier_access/view-cashier_access-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CashierAccessController::class . ':edit')->add(PermissionMiddleware::class)->setName('cashier_access/edit-cashier_access-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CashierAccessController::class . ':delete')->add(PermissionMiddleware::class)->setName('cashier_access/delete-cashier_access-delete-2'); // delete
        }
    );

    // charge_payment
    $app->map(["GET","POST","OPTIONS"], '/ChargePaymentList[/{charge_id}]', ChargePaymentController::class . ':list')->add(PermissionMiddleware::class)->setName('ChargePaymentList-charge_payment-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ChargePaymentAdd[/{charge_id}]', ChargePaymentController::class . ':add')->add(PermissionMiddleware::class)->setName('ChargePaymentAdd-charge_payment-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ChargePaymentView[/{charge_id}]', ChargePaymentController::class . ':view')->add(PermissionMiddleware::class)->setName('ChargePaymentView-charge_payment-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ChargePaymentEdit[/{charge_id}]', ChargePaymentController::class . ':edit')->add(PermissionMiddleware::class)->setName('ChargePaymentEdit-charge_payment-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ChargePaymentDelete[/{charge_id}]', ChargePaymentController::class . ':delete')->add(PermissionMiddleware::class)->setName('ChargePaymentDelete-charge_payment-delete'); // delete
    $app->group(
        '/charge_payment',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{charge_id}]', ChargePaymentController::class . ':list')->add(PermissionMiddleware::class)->setName('charge_payment/list-charge_payment-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{charge_id}]', ChargePaymentController::class . ':add')->add(PermissionMiddleware::class)->setName('charge_payment/add-charge_payment-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{charge_id}]', ChargePaymentController::class . ':view')->add(PermissionMiddleware::class)->setName('charge_payment/view-charge_payment-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{charge_id}]', ChargePaymentController::class . ':edit')->add(PermissionMiddleware::class)->setName('charge_payment/edit-charge_payment-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{charge_id}]', ChargePaymentController::class . ':delete')->add(PermissionMiddleware::class)->setName('charge_payment/delete-charge_payment-delete-2'); // delete
        }
    );

    // config2
    $app->map(["GET","POST","OPTIONS"], '/Config2List[/{id}]', Config2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('Config2List-config2-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/Config2Add[/{id}]', Config2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('Config2Add-config2-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/Config2View[/{id}]', Config2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('Config2View-config2-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/Config2Edit[/{id}]', Config2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('Config2Edit-config2-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/Config2Delete[/{id}]', Config2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('Config2Delete-config2-delete'); // delete
    $app->group(
        '/config2',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', Config2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('config2/list-config2-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', Config2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('config2/add-config2-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', Config2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('config2/view-config2-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', Config2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('config2/edit-config2-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', Config2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('config2/delete-config2-delete-2'); // delete
        }
    );

    // control
    $app->map(["GET","POST","OPTIONS"], '/ControlList[/{ID}]', ControlController::class . ':list')->add(PermissionMiddleware::class)->setName('ControlList-control-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ControlAdd[/{ID}]', ControlController::class . ':add')->add(PermissionMiddleware::class)->setName('ControlAdd-control-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ControlView[/{ID}]', ControlController::class . ':view')->add(PermissionMiddleware::class)->setName('ControlView-control-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ControlEdit[/{ID}]', ControlController::class . ':edit')->add(PermissionMiddleware::class)->setName('ControlEdit-control-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ControlDelete[/{ID}]', ControlController::class . ':delete')->add(PermissionMiddleware::class)->setName('ControlDelete-control-delete'); // delete
    $app->group(
        '/control',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{ID}]', ControlController::class . ':list')->add(PermissionMiddleware::class)->setName('control/list-control-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{ID}]', ControlController::class . ':add')->add(PermissionMiddleware::class)->setName('control/add-control-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{ID}]', ControlController::class . ':view')->add(PermissionMiddleware::class)->setName('control/view-control-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{ID}]', ControlController::class . ':edit')->add(PermissionMiddleware::class)->setName('control/edit-control-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{ID}]', ControlController::class . ':delete')->add(PermissionMiddleware::class)->setName('control/delete-control-delete-2'); // delete
        }
    );

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
