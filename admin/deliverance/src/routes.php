<?php

namespace PHPMaker2021\project3;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // current
    $app->any('/CurrentList[/{id}]', CurrentController::class . ':list')->add(PermissionMiddleware::class)->setName('CurrentList-current-list'); // list
    $app->any('/CurrentAdd[/{id}]', CurrentController::class . ':add')->add(PermissionMiddleware::class)->setName('CurrentAdd-current-add'); // add
    $app->any('/CurrentView[/{id}]', CurrentController::class . ':view')->add(PermissionMiddleware::class)->setName('CurrentView-current-view'); // view
    $app->any('/CurrentEdit[/{id}]', CurrentController::class . ':edit')->add(PermissionMiddleware::class)->setName('CurrentEdit-current-edit'); // edit
    $app->any('/CurrentDelete[/{id}]', CurrentController::class . ':delete')->add(PermissionMiddleware::class)->setName('CurrentDelete-current-delete'); // delete
    $app->group(
        '/current',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', CurrentController::class . ':list')->add(PermissionMiddleware::class)->setName('current/list-current-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', CurrentController::class . ':add')->add(PermissionMiddleware::class)->setName('current/add-current-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', CurrentController::class . ':view')->add(PermissionMiddleware::class)->setName('current/view-current-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', CurrentController::class . ':edit')->add(PermissionMiddleware::class)->setName('current/edit-current-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', CurrentController::class . ':delete')->add(PermissionMiddleware::class)->setName('current/delete-current-delete-2'); // delete
        }
    );

    // defaults
    $app->any('/DefaultsList[/{id}]', DefaultsController::class . ':list')->add(PermissionMiddleware::class)->setName('DefaultsList-defaults-list'); // list
    $app->any('/DefaultsAdd[/{id}]', DefaultsController::class . ':add')->add(PermissionMiddleware::class)->setName('DefaultsAdd-defaults-add'); // add
    $app->any('/DefaultsView[/{id}]', DefaultsController::class . ':view')->add(PermissionMiddleware::class)->setName('DefaultsView-defaults-view'); // view
    $app->any('/DefaultsEdit[/{id}]', DefaultsController::class . ':edit')->add(PermissionMiddleware::class)->setName('DefaultsEdit-defaults-edit'); // edit
    $app->any('/DefaultsDelete[/{id}]', DefaultsController::class . ':delete')->add(PermissionMiddleware::class)->setName('DefaultsDelete-defaults-delete'); // delete
    $app->group(
        '/defaults',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', DefaultsController::class . ':list')->add(PermissionMiddleware::class)->setName('defaults/list-defaults-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', DefaultsController::class . ':add')->add(PermissionMiddleware::class)->setName('defaults/add-defaults-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', DefaultsController::class . ':view')->add(PermissionMiddleware::class)->setName('defaults/view-defaults-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', DefaultsController::class . ':edit')->add(PermissionMiddleware::class)->setName('defaults/edit-defaults-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', DefaultsController::class . ':delete')->add(PermissionMiddleware::class)->setName('defaults/delete-defaults-delete-2'); // delete
        }
    );

    // dimensions
    $app->any('/DimensionsList[/{id}]', DimensionsController::class . ':list')->add(PermissionMiddleware::class)->setName('DimensionsList-dimensions-list'); // list
    $app->any('/DimensionsAdd[/{id}]', DimensionsController::class . ':add')->add(PermissionMiddleware::class)->setName('DimensionsAdd-dimensions-add'); // add
    $app->any('/DimensionsView[/{id}]', DimensionsController::class . ':view')->add(PermissionMiddleware::class)->setName('DimensionsView-dimensions-view'); // view
    $app->any('/DimensionsEdit[/{id}]', DimensionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('DimensionsEdit-dimensions-edit'); // edit
    $app->any('/DimensionsDelete[/{id}]', DimensionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('DimensionsDelete-dimensions-delete'); // delete
    $app->group(
        '/dimensions',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', DimensionsController::class . ':list')->add(PermissionMiddleware::class)->setName('dimensions/list-dimensions-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', DimensionsController::class . ':add')->add(PermissionMiddleware::class)->setName('dimensions/add-dimensions-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', DimensionsController::class . ':view')->add(PermissionMiddleware::class)->setName('dimensions/view-dimensions-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', DimensionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('dimensions/edit-dimensions-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', DimensionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('dimensions/delete-dimensions-delete-2'); // delete
        }
    );

    // displayblock
    $app->any('/DisplayblockList[/{id}]', DisplayblockController::class . ':list')->add(PermissionMiddleware::class)->setName('DisplayblockList-displayblock-list'); // list
    $app->any('/DisplayblockAdd[/{id}]', DisplayblockController::class . ':add')->add(PermissionMiddleware::class)->setName('DisplayblockAdd-displayblock-add'); // add
    $app->any('/DisplayblockView[/{id}]', DisplayblockController::class . ':view')->add(PermissionMiddleware::class)->setName('DisplayblockView-displayblock-view'); // view
    $app->any('/DisplayblockEdit[/{id}]', DisplayblockController::class . ':edit')->add(PermissionMiddleware::class)->setName('DisplayblockEdit-displayblock-edit'); // edit
    $app->any('/DisplayblockDelete[/{id}]', DisplayblockController::class . ':delete')->add(PermissionMiddleware::class)->setName('DisplayblockDelete-displayblock-delete'); // delete
    $app->group(
        '/displayblock',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', DisplayblockController::class . ':list')->add(PermissionMiddleware::class)->setName('displayblock/list-displayblock-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', DisplayblockController::class . ':add')->add(PermissionMiddleware::class)->setName('displayblock/add-displayblock-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', DisplayblockController::class . ':view')->add(PermissionMiddleware::class)->setName('displayblock/view-displayblock-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', DisplayblockController::class . ':edit')->add(PermissionMiddleware::class)->setName('displayblock/edit-displayblock-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', DisplayblockController::class . ':delete')->add(PermissionMiddleware::class)->setName('displayblock/delete-displayblock-delete-2'); // delete
        }
    );

    // history
    $app->any('/HistoryList[/{id}]', HistoryController::class . ':list')->add(PermissionMiddleware::class)->setName('HistoryList-history-list'); // list
    $app->any('/HistoryAdd[/{id}]', HistoryController::class . ':add')->add(PermissionMiddleware::class)->setName('HistoryAdd-history-add'); // add
    $app->any('/HistoryView[/{id}]', HistoryController::class . ':view')->add(PermissionMiddleware::class)->setName('HistoryView-history-view'); // view
    $app->any('/HistoryEdit[/{id}]', HistoryController::class . ':edit')->add(PermissionMiddleware::class)->setName('HistoryEdit-history-edit'); // edit
    $app->any('/HistoryDelete[/{id}]', HistoryController::class . ':delete')->add(PermissionMiddleware::class)->setName('HistoryDelete-history-delete'); // delete
    $app->group(
        '/history',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', HistoryController::class . ':list')->add(PermissionMiddleware::class)->setName('history/list-history-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', HistoryController::class . ':add')->add(PermissionMiddleware::class)->setName('history/add-history-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', HistoryController::class . ':view')->add(PermissionMiddleware::class)->setName('history/view-history-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', HistoryController::class . ':edit')->add(PermissionMiddleware::class)->setName('history/edit-history-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', HistoryController::class . ':delete')->add(PermissionMiddleware::class)->setName('history/delete-history-delete-2'); // delete
        }
    );

    // pages
    $app->any('/PagesList[/{id}]', PagesController::class . ':list')->add(PermissionMiddleware::class)->setName('PagesList-pages-list'); // list
    $app->any('/PagesAdd[/{id}]', PagesController::class . ':add')->add(PermissionMiddleware::class)->setName('PagesAdd-pages-add'); // add
    $app->any('/PagesView[/{id}]', PagesController::class . ':view')->add(PermissionMiddleware::class)->setName('PagesView-pages-view'); // view
    $app->any('/PagesEdit[/{id}]', PagesController::class . ':edit')->add(PermissionMiddleware::class)->setName('PagesEdit-pages-edit'); // edit
    $app->any('/PagesDelete[/{id}]', PagesController::class . ':delete')->add(PermissionMiddleware::class)->setName('PagesDelete-pages-delete'); // delete
    $app->group(
        '/pages',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', PagesController::class . ':list')->add(PermissionMiddleware::class)->setName('pages/list-pages-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', PagesController::class . ':add')->add(PermissionMiddleware::class)->setName('pages/add-pages-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', PagesController::class . ':view')->add(PermissionMiddleware::class)->setName('pages/view-pages-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', PagesController::class . ':edit')->add(PermissionMiddleware::class)->setName('pages/edit-pages-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', PagesController::class . ':delete')->add(PermissionMiddleware::class)->setName('pages/delete-pages-delete-2'); // delete
        }
    );

    // randomfeed
    $app->any('/RandomfeedList[/{id}]', RandomfeedController::class . ':list')->add(PermissionMiddleware::class)->setName('RandomfeedList-randomfeed-list'); // list
    $app->any('/RandomfeedAdd[/{id}]', RandomfeedController::class . ':add')->add(PermissionMiddleware::class)->setName('RandomfeedAdd-randomfeed-add'); // add
    $app->any('/RandomfeedView[/{id}]', RandomfeedController::class . ':view')->add(PermissionMiddleware::class)->setName('RandomfeedView-randomfeed-view'); // view
    $app->any('/RandomfeedEdit[/{id}]', RandomfeedController::class . ':edit')->add(PermissionMiddleware::class)->setName('RandomfeedEdit-randomfeed-edit'); // edit
    $app->any('/RandomfeedDelete[/{id}]', RandomfeedController::class . ':delete')->add(PermissionMiddleware::class)->setName('RandomfeedDelete-randomfeed-delete'); // delete
    $app->group(
        '/randomfeed',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RandomfeedController::class . ':list')->add(PermissionMiddleware::class)->setName('randomfeed/list-randomfeed-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RandomfeedController::class . ':add')->add(PermissionMiddleware::class)->setName('randomfeed/add-randomfeed-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RandomfeedController::class . ':view')->add(PermissionMiddleware::class)->setName('randomfeed/view-randomfeed-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RandomfeedController::class . ':edit')->add(PermissionMiddleware::class)->setName('randomfeed/edit-randomfeed-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RandomfeedController::class . ':delete')->add(PermissionMiddleware::class)->setName('randomfeed/delete-randomfeed-delete-2'); // delete
        }
    );

    // resource
    $app->any('/ResourceList[/{id}]', ResourceController::class . ':list')->add(PermissionMiddleware::class)->setName('ResourceList-resource-list'); // list
    $app->any('/ResourceAdd[/{id}]', ResourceController::class . ':add')->add(PermissionMiddleware::class)->setName('ResourceAdd-resource-add'); // add
    $app->any('/ResourceView[/{id}]', ResourceController::class . ':view')->add(PermissionMiddleware::class)->setName('ResourceView-resource-view'); // view
    $app->any('/ResourceEdit[/{id}]', ResourceController::class . ':edit')->add(PermissionMiddleware::class)->setName('ResourceEdit-resource-edit'); // edit
    $app->any('/ResourceDelete[/{id}]', ResourceController::class . ':delete')->add(PermissionMiddleware::class)->setName('ResourceDelete-resource-delete'); // delete
    $app->group(
        '/resource',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', ResourceController::class . ':list')->add(PermissionMiddleware::class)->setName('resource/list-resource-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', ResourceController::class . ':add')->add(PermissionMiddleware::class)->setName('resource/add-resource-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', ResourceController::class . ':view')->add(PermissionMiddleware::class)->setName('resource/view-resource-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', ResourceController::class . ':edit')->add(PermissionMiddleware::class)->setName('resource/edit-resource-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', ResourceController::class . ':delete')->add(PermissionMiddleware::class)->setName('resource/delete-resource-delete-2'); // delete
        }
    );

    // scriptcounter
    $app->any('/ScriptcounterList', ScriptcounterController::class . ':list')->add(PermissionMiddleware::class)->setName('ScriptcounterList-scriptcounter-list'); // list
    $app->group(
        '/scriptcounter',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', ScriptcounterController::class . ':list')->add(PermissionMiddleware::class)->setName('scriptcounter/list-scriptcounter-list-2'); // list
        }
    );

    // sequentialfeed
    $app->any('/SequentialfeedList[/{id}]', SequentialfeedController::class . ':list')->add(PermissionMiddleware::class)->setName('SequentialfeedList-sequentialfeed-list'); // list
    $app->any('/SequentialfeedAdd[/{id}]', SequentialfeedController::class . ':add')->add(PermissionMiddleware::class)->setName('SequentialfeedAdd-sequentialfeed-add'); // add
    $app->any('/SequentialfeedView[/{id}]', SequentialfeedController::class . ':view')->add(PermissionMiddleware::class)->setName('SequentialfeedView-sequentialfeed-view'); // view
    $app->any('/SequentialfeedEdit[/{id}]', SequentialfeedController::class . ':edit')->add(PermissionMiddleware::class)->setName('SequentialfeedEdit-sequentialfeed-edit'); // edit
    $app->any('/SequentialfeedDelete[/{id}]', SequentialfeedController::class . ':delete')->add(PermissionMiddleware::class)->setName('SequentialfeedDelete-sequentialfeed-delete'); // delete
    $app->group(
        '/sequentialfeed',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', SequentialfeedController::class . ':list')->add(PermissionMiddleware::class)->setName('sequentialfeed/list-sequentialfeed-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', SequentialfeedController::class . ':add')->add(PermissionMiddleware::class)->setName('sequentialfeed/add-sequentialfeed-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', SequentialfeedController::class . ':view')->add(PermissionMiddleware::class)->setName('sequentialfeed/view-sequentialfeed-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', SequentialfeedController::class . ':edit')->add(PermissionMiddleware::class)->setName('sequentialfeed/edit-sequentialfeed-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', SequentialfeedController::class . ':delete')->add(PermissionMiddleware::class)->setName('sequentialfeed/delete-sequentialfeed-delete-2'); // delete
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->setName('index');
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
