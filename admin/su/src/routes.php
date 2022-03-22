<?php

namespace PHPMaker2021\project1;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // accounts
    $app->any('/AccountsList[/{id}]', AccountsController::class . ':list')->add(PermissionMiddleware::class)->setName('AccountsList-accounts-list'); // list
    $app->any('/AccountsAdd[/{id}]', AccountsController::class . ':add')->add(PermissionMiddleware::class)->setName('AccountsAdd-accounts-add'); // add
    $app->any('/AccountsView[/{id}]', AccountsController::class . ':view')->add(PermissionMiddleware::class)->setName('AccountsView-accounts-view'); // view
    $app->any('/AccountsEdit[/{id}]', AccountsController::class . ':edit')->add(PermissionMiddleware::class)->setName('AccountsEdit-accounts-edit'); // edit
    $app->any('/AccountsDelete[/{id}]', AccountsController::class . ':delete')->add(PermissionMiddleware::class)->setName('AccountsDelete-accounts-delete'); // delete
    $app->group(
        '/accounts',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AccountsController::class . ':list')->add(PermissionMiddleware::class)->setName('accounts/list-accounts-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', AccountsController::class . ':add')->add(PermissionMiddleware::class)->setName('accounts/add-accounts-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AccountsController::class . ':view')->add(PermissionMiddleware::class)->setName('accounts/view-accounts-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AccountsController::class . ':edit')->add(PermissionMiddleware::class)->setName('accounts/edit-accounts-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', AccountsController::class . ':delete')->add(PermissionMiddleware::class)->setName('accounts/delete-accounts-delete-2'); // delete
        }
    );

    // accounts_events
    $app->any('/AccountsEventsList[/{id}]', AccountsEventsController::class . ':list')->add(PermissionMiddleware::class)->setName('AccountsEventsList-accounts_events-list'); // list
    $app->any('/AccountsEventsAdd[/{id}]', AccountsEventsController::class . ':add')->add(PermissionMiddleware::class)->setName('AccountsEventsAdd-accounts_events-add'); // add
    $app->any('/AccountsEventsView[/{id}]', AccountsEventsController::class . ':view')->add(PermissionMiddleware::class)->setName('AccountsEventsView-accounts_events-view'); // view
    $app->any('/AccountsEventsEdit[/{id}]', AccountsEventsController::class . ':edit')->add(PermissionMiddleware::class)->setName('AccountsEventsEdit-accounts_events-edit'); // edit
    $app->any('/AccountsEventsDelete[/{id}]', AccountsEventsController::class . ':delete')->add(PermissionMiddleware::class)->setName('AccountsEventsDelete-accounts_events-delete'); // delete
    $app->group(
        '/accounts_events',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AccountsEventsController::class . ':list')->add(PermissionMiddleware::class)->setName('accounts_events/list-accounts_events-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', AccountsEventsController::class . ':add')->add(PermissionMiddleware::class)->setName('accounts_events/add-accounts_events-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AccountsEventsController::class . ':view')->add(PermissionMiddleware::class)->setName('accounts_events/view-accounts_events-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AccountsEventsController::class . ':edit')->add(PermissionMiddleware::class)->setName('accounts_events/edit-accounts_events-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', AccountsEventsController::class . ':delete')->add(PermissionMiddleware::class)->setName('accounts_events/delete-accounts_events-delete-2'); // delete
        }
    );

    // admin_access
    $app->any('/AdminAccessList[/{id}]', AdminAccessController::class . ':list')->add(PermissionMiddleware::class)->setName('AdminAccessList-admin_access-list'); // list
    $app->any('/AdminAccessAdd[/{id}]', AdminAccessController::class . ':add')->add(PermissionMiddleware::class)->setName('AdminAccessAdd-admin_access-add'); // add
    $app->any('/AdminAccessView[/{id}]', AdminAccessController::class . ':view')->add(PermissionMiddleware::class)->setName('AdminAccessView-admin_access-view'); // view
    $app->any('/AdminAccessEdit[/{id}]', AdminAccessController::class . ':edit')->add(PermissionMiddleware::class)->setName('AdminAccessEdit-admin_access-edit'); // edit
    $app->any('/AdminAccessDelete[/{id}]', AdminAccessController::class . ':delete')->add(PermissionMiddleware::class)->setName('AdminAccessDelete-admin_access-delete'); // delete
    $app->group(
        '/admin_access',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AdminAccessController::class . ':list')->add(PermissionMiddleware::class)->setName('admin_access/list-admin_access-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', AdminAccessController::class . ':add')->add(PermissionMiddleware::class)->setName('admin_access/add-admin_access-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AdminAccessController::class . ':view')->add(PermissionMiddleware::class)->setName('admin_access/view-admin_access-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AdminAccessController::class . ':edit')->add(PermissionMiddleware::class)->setName('admin_access/edit-admin_access-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', AdminAccessController::class . ':delete')->add(PermissionMiddleware::class)->setName('admin_access/delete-admin_access-delete-2'); // delete
        }
    );

    // admin_group
    $app->any('/AdminGroupList[/{id}]', AdminGroupController::class . ':list')->add(PermissionMiddleware::class)->setName('AdminGroupList-admin_group-list'); // list
    $app->any('/AdminGroupAdd[/{id}]', AdminGroupController::class . ':add')->add(PermissionMiddleware::class)->setName('AdminGroupAdd-admin_group-add'); // add
    $app->any('/AdminGroupView[/{id}]', AdminGroupController::class . ':view')->add(PermissionMiddleware::class)->setName('AdminGroupView-admin_group-view'); // view
    $app->any('/AdminGroupEdit[/{id}]', AdminGroupController::class . ':edit')->add(PermissionMiddleware::class)->setName('AdminGroupEdit-admin_group-edit'); // edit
    $app->any('/AdminGroupDelete[/{id}]', AdminGroupController::class . ':delete')->add(PermissionMiddleware::class)->setName('AdminGroupDelete-admin_group-delete'); // delete
    $app->group(
        '/admin_group',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AdminGroupController::class . ':list')->add(PermissionMiddleware::class)->setName('admin_group/list-admin_group-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', AdminGroupController::class . ':add')->add(PermissionMiddleware::class)->setName('admin_group/add-admin_group-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AdminGroupController::class . ':view')->add(PermissionMiddleware::class)->setName('admin_group/view-admin_group-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AdminGroupController::class . ':edit')->add(PermissionMiddleware::class)->setName('admin_group/edit-admin_group-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', AdminGroupController::class . ':delete')->add(PermissionMiddleware::class)->setName('admin_group/delete-admin_group-delete-2'); // delete
        }
    );

    // admin_routes
    $app->any('/AdminRoutesList[/{id}]', AdminRoutesController::class . ':list')->add(PermissionMiddleware::class)->setName('AdminRoutesList-admin_routes-list'); // list
    $app->any('/AdminRoutesAdd[/{id}]', AdminRoutesController::class . ':add')->add(PermissionMiddleware::class)->setName('AdminRoutesAdd-admin_routes-add'); // add
    $app->any('/AdminRoutesView[/{id}]', AdminRoutesController::class . ':view')->add(PermissionMiddleware::class)->setName('AdminRoutesView-admin_routes-view'); // view
    $app->any('/AdminRoutesEdit[/{id}]', AdminRoutesController::class . ':edit')->add(PermissionMiddleware::class)->setName('AdminRoutesEdit-admin_routes-edit'); // edit
    $app->any('/AdminRoutesDelete[/{id}]', AdminRoutesController::class . ':delete')->add(PermissionMiddleware::class)->setName('AdminRoutesDelete-admin_routes-delete'); // delete
    $app->group(
        '/admin_routes',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AdminRoutesController::class . ':list')->add(PermissionMiddleware::class)->setName('admin_routes/list-admin_routes-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', AdminRoutesController::class . ':add')->add(PermissionMiddleware::class)->setName('admin_routes/add-admin_routes-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AdminRoutesController::class . ':view')->add(PermissionMiddleware::class)->setName('admin_routes/view-admin_routes-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AdminRoutesController::class . ':edit')->add(PermissionMiddleware::class)->setName('admin_routes/edit-admin_routes-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', AdminRoutesController::class . ':delete')->add(PermissionMiddleware::class)->setName('admin_routes/delete-admin_routes-delete-2'); // delete
        }
    );

    // admin_screens
    $app->any('/AdminScreensList[/{id}]', AdminScreensController::class . ':list')->add(PermissionMiddleware::class)->setName('AdminScreensList-admin_screens-list'); // list
    $app->any('/AdminScreensAdd[/{id}]', AdminScreensController::class . ':add')->add(PermissionMiddleware::class)->setName('AdminScreensAdd-admin_screens-add'); // add
    $app->any('/AdminScreensView[/{id}]', AdminScreensController::class . ':view')->add(PermissionMiddleware::class)->setName('AdminScreensView-admin_screens-view'); // view
    $app->any('/AdminScreensEdit[/{id}]', AdminScreensController::class . ':edit')->add(PermissionMiddleware::class)->setName('AdminScreensEdit-admin_screens-edit'); // edit
    $app->any('/AdminScreensDelete[/{id}]', AdminScreensController::class . ':delete')->add(PermissionMiddleware::class)->setName('AdminScreensDelete-admin_screens-delete'); // delete
    $app->group(
        '/admin_screens',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AdminScreensController::class . ':list')->add(PermissionMiddleware::class)->setName('admin_screens/list-admin_screens-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', AdminScreensController::class . ':add')->add(PermissionMiddleware::class)->setName('admin_screens/add-admin_screens-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AdminScreensController::class . ':view')->add(PermissionMiddleware::class)->setName('admin_screens/view-admin_screens-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AdminScreensController::class . ':edit')->add(PermissionMiddleware::class)->setName('admin_screens/edit-admin_screens-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', AdminScreensController::class . ':delete')->add(PermissionMiddleware::class)->setName('admin_screens/delete-admin_screens-delete-2'); // delete
        }
    );

    // admin_users
    $app->any('/AdminUsersList[/{id}]', AdminUsersController::class . ':list')->add(PermissionMiddleware::class)->setName('AdminUsersList-admin_users-list'); // list
    $app->any('/AdminUsersAdd[/{id}]', AdminUsersController::class . ':add')->add(PermissionMiddleware::class)->setName('AdminUsersAdd-admin_users-add'); // add
    $app->any('/AdminUsersView[/{id}]', AdminUsersController::class . ':view')->add(PermissionMiddleware::class)->setName('AdminUsersView-admin_users-view'); // view
    $app->any('/AdminUsersEdit[/{id}]', AdminUsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('AdminUsersEdit-admin_users-edit'); // edit
    $app->any('/AdminUsersDelete[/{id}]', AdminUsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('AdminUsersDelete-admin_users-delete'); // delete
    $app->group(
        '/admin_users',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', AdminUsersController::class . ':list')->add(PermissionMiddleware::class)->setName('admin_users/list-admin_users-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', AdminUsersController::class . ':add')->add(PermissionMiddleware::class)->setName('admin_users/add-admin_users-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', AdminUsersController::class . ':view')->add(PermissionMiddleware::class)->setName('admin_users/view-admin_users-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', AdminUsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('admin_users/edit-admin_users-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', AdminUsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('admin_users/delete-admin_users-delete-2'); // delete
        }
    );

    // box_choice
    $app->any('/BoxChoiceList[/{id}]', BoxChoiceController::class . ':list')->add(PermissionMiddleware::class)->setName('BoxChoiceList-box_choice-list'); // list
    $app->any('/BoxChoiceAdd[/{id}]', BoxChoiceController::class . ':add')->add(PermissionMiddleware::class)->setName('BoxChoiceAdd-box_choice-add'); // add
    $app->any('/BoxChoiceView[/{id}]', BoxChoiceController::class . ':view')->add(PermissionMiddleware::class)->setName('BoxChoiceView-box_choice-view'); // view
    $app->any('/BoxChoiceEdit[/{id}]', BoxChoiceController::class . ':edit')->add(PermissionMiddleware::class)->setName('BoxChoiceEdit-box_choice-edit'); // edit
    $app->any('/BoxChoiceDelete[/{id}]', BoxChoiceController::class . ':delete')->add(PermissionMiddleware::class)->setName('BoxChoiceDelete-box_choice-delete'); // delete
    $app->group(
        '/box_choice',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BoxChoiceController::class . ':list')->add(PermissionMiddleware::class)->setName('box_choice/list-box_choice-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BoxChoiceController::class . ':add')->add(PermissionMiddleware::class)->setName('box_choice/add-box_choice-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BoxChoiceController::class . ':view')->add(PermissionMiddleware::class)->setName('box_choice/view-box_choice-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BoxChoiceController::class . ':edit')->add(PermissionMiddleware::class)->setName('box_choice/edit-box_choice-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BoxChoiceController::class . ':delete')->add(PermissionMiddleware::class)->setName('box_choice/delete-box_choice-delete-2'); // delete
        }
    );

    // box_menu
    $app->any('/BoxMenuList[/{id}]', BoxMenuController::class . ':list')->add(PermissionMiddleware::class)->setName('BoxMenuList-box_menu-list'); // list
    $app->any('/BoxMenuAdd[/{id}]', BoxMenuController::class . ':add')->add(PermissionMiddleware::class)->setName('BoxMenuAdd-box_menu-add'); // add
    $app->any('/BoxMenuView[/{id}]', BoxMenuController::class . ':view')->add(PermissionMiddleware::class)->setName('BoxMenuView-box_menu-view'); // view
    $app->any('/BoxMenuEdit[/{id}]', BoxMenuController::class . ':edit')->add(PermissionMiddleware::class)->setName('BoxMenuEdit-box_menu-edit'); // edit
    $app->any('/BoxMenuDelete[/{id}]', BoxMenuController::class . ':delete')->add(PermissionMiddleware::class)->setName('BoxMenuDelete-box_menu-delete'); // delete
    $app->group(
        '/box_menu',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BoxMenuController::class . ':list')->add(PermissionMiddleware::class)->setName('box_menu/list-box_menu-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BoxMenuController::class . ':add')->add(PermissionMiddleware::class)->setName('box_menu/add-box_menu-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BoxMenuController::class . ':view')->add(PermissionMiddleware::class)->setName('box_menu/view-box_menu-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BoxMenuController::class . ':edit')->add(PermissionMiddleware::class)->setName('box_menu/edit-box_menu-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BoxMenuController::class . ':delete')->add(PermissionMiddleware::class)->setName('box_menu/delete-box_menu-delete-2'); // delete
        }
    );

    // box_order
    $app->any('/BoxOrderList[/{id}]', BoxOrderController::class . ':list')->add(PermissionMiddleware::class)->setName('BoxOrderList-box_order-list'); // list
    $app->any('/BoxOrderAdd[/{id}]', BoxOrderController::class . ':add')->add(PermissionMiddleware::class)->setName('BoxOrderAdd-box_order-add'); // add
    $app->any('/BoxOrderView[/{id}]', BoxOrderController::class . ':view')->add(PermissionMiddleware::class)->setName('BoxOrderView-box_order-view'); // view
    $app->any('/BoxOrderEdit[/{id}]', BoxOrderController::class . ':edit')->add(PermissionMiddleware::class)->setName('BoxOrderEdit-box_order-edit'); // edit
    $app->any('/BoxOrderDelete[/{id}]', BoxOrderController::class . ':delete')->add(PermissionMiddleware::class)->setName('BoxOrderDelete-box_order-delete'); // delete
    $app->group(
        '/box_order',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BoxOrderController::class . ':list')->add(PermissionMiddleware::class)->setName('box_order/list-box_order-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BoxOrderController::class . ':add')->add(PermissionMiddleware::class)->setName('box_order/add-box_order-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BoxOrderController::class . ':view')->add(PermissionMiddleware::class)->setName('box_order/view-box_order-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BoxOrderController::class . ':edit')->add(PermissionMiddleware::class)->setName('box_order/edit-box_order-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BoxOrderController::class . ':delete')->add(PermissionMiddleware::class)->setName('box_order/delete-box_order-delete-2'); // delete
        }
    );

    // catering
    $app->any('/CateringList[/{id}]', CateringController::class . ':list')->add(PermissionMiddleware::class)->setName('CateringList-catering-list'); // list
    $app->any('/CateringAdd[/{id}]', CateringController::class . ':add')->add(PermissionMiddleware::class)->setName('CateringAdd-catering-add'); // add
    $app->any('/CateringView[/{id}]', CateringController::class . ':view')->add(PermissionMiddleware::class)->setName('CateringView-catering-view'); // view
    $app->any('/CateringEdit[/{id}]', CateringController::class . ':edit')->add(PermissionMiddleware::class)->setName('CateringEdit-catering-edit'); // edit
    $app->any('/CateringDelete[/{id}]', CateringController::class . ':delete')->add(PermissionMiddleware::class)->setName('CateringDelete-catering-delete'); // delete
    $app->group(
        '/catering',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', CateringController::class . ':list')->add(PermissionMiddleware::class)->setName('catering/list-catering-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', CateringController::class . ':add')->add(PermissionMiddleware::class)->setName('catering/add-catering-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', CateringController::class . ':view')->add(PermissionMiddleware::class)->setName('catering/view-catering-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', CateringController::class . ':edit')->add(PermissionMiddleware::class)->setName('catering/edit-catering-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', CateringController::class . ':delete')->add(PermissionMiddleware::class)->setName('catering/delete-catering-delete-2'); // delete
        }
    );

    // catering_event_requests
    $app->any('/CateringEventRequestsList[/{id}]', CateringEventRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('CateringEventRequestsList-catering_event_requests-list'); // list
    $app->any('/CateringEventRequestsAdd[/{id}]', CateringEventRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('CateringEventRequestsAdd-catering_event_requests-add'); // add
    $app->any('/CateringEventRequestsView[/{id}]', CateringEventRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('CateringEventRequestsView-catering_event_requests-view'); // view
    $app->any('/CateringEventRequestsEdit[/{id}]', CateringEventRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('CateringEventRequestsEdit-catering_event_requests-edit'); // edit
    $app->any('/CateringEventRequestsDelete[/{id}]', CateringEventRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('CateringEventRequestsDelete-catering_event_requests-delete'); // delete
    $app->group(
        '/catering_event_requests',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', CateringEventRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('catering_event_requests/list-catering_event_requests-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', CateringEventRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('catering_event_requests/add-catering_event_requests-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', CateringEventRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('catering_event_requests/view-catering_event_requests-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', CateringEventRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('catering_event_requests/edit-catering_event_requests-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', CateringEventRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('catering_event_requests/delete-catering_event_requests-delete-2'); // delete
        }
    );

    // catering_highland
    $app->any('/CateringHighlandList[/{id}]', CateringHighlandController::class . ':list')->add(PermissionMiddleware::class)->setName('CateringHighlandList-catering_highland-list'); // list
    $app->any('/CateringHighlandAdd[/{id}]', CateringHighlandController::class . ':add')->add(PermissionMiddleware::class)->setName('CateringHighlandAdd-catering_highland-add'); // add
    $app->any('/CateringHighlandView[/{id}]', CateringHighlandController::class . ':view')->add(PermissionMiddleware::class)->setName('CateringHighlandView-catering_highland-view'); // view
    $app->any('/CateringHighlandEdit[/{id}]', CateringHighlandController::class . ':edit')->add(PermissionMiddleware::class)->setName('CateringHighlandEdit-catering_highland-edit'); // edit
    $app->any('/CateringHighlandDelete[/{id}]', CateringHighlandController::class . ':delete')->add(PermissionMiddleware::class)->setName('CateringHighlandDelete-catering_highland-delete'); // delete
    $app->group(
        '/catering_highland',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', CateringHighlandController::class . ':list')->add(PermissionMiddleware::class)->setName('catering_highland/list-catering_highland-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', CateringHighlandController::class . ':add')->add(PermissionMiddleware::class)->setName('catering_highland/add-catering_highland-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', CateringHighlandController::class . ':view')->add(PermissionMiddleware::class)->setName('catering_highland/view-catering_highland-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', CateringHighlandController::class . ':edit')->add(PermissionMiddleware::class)->setName('catering_highland/edit-catering_highland-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', CateringHighlandController::class . ':delete')->add(PermissionMiddleware::class)->setName('catering_highland/delete-catering_highland-delete-2'); // delete
        }
    );

    // catering_highland_burrito
    $app->any('/CateringHighlandBurritoList[/{id}]', CateringHighlandBurritoController::class . ':list')->add(PermissionMiddleware::class)->setName('CateringHighlandBurritoList-catering_highland_burrito-list'); // list
    $app->any('/CateringHighlandBurritoAdd[/{id}]', CateringHighlandBurritoController::class . ':add')->add(PermissionMiddleware::class)->setName('CateringHighlandBurritoAdd-catering_highland_burrito-add'); // add
    $app->any('/CateringHighlandBurritoView[/{id}]', CateringHighlandBurritoController::class . ':view')->add(PermissionMiddleware::class)->setName('CateringHighlandBurritoView-catering_highland_burrito-view'); // view
    $app->any('/CateringHighlandBurritoEdit[/{id}]', CateringHighlandBurritoController::class . ':edit')->add(PermissionMiddleware::class)->setName('CateringHighlandBurritoEdit-catering_highland_burrito-edit'); // edit
    $app->any('/CateringHighlandBurritoDelete[/{id}]', CateringHighlandBurritoController::class . ':delete')->add(PermissionMiddleware::class)->setName('CateringHighlandBurritoDelete-catering_highland_burrito-delete'); // delete
    $app->group(
        '/catering_highland_burrito',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', CateringHighlandBurritoController::class . ':list')->add(PermissionMiddleware::class)->setName('catering_highland_burrito/list-catering_highland_burrito-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', CateringHighlandBurritoController::class . ':add')->add(PermissionMiddleware::class)->setName('catering_highland_burrito/add-catering_highland_burrito-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', CateringHighlandBurritoController::class . ':view')->add(PermissionMiddleware::class)->setName('catering_highland_burrito/view-catering_highland_burrito-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', CateringHighlandBurritoController::class . ':edit')->add(PermissionMiddleware::class)->setName('catering_highland_burrito/edit-catering_highland_burrito-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', CateringHighlandBurritoController::class . ':delete')->add(PermissionMiddleware::class)->setName('catering_highland_burrito/delete-catering_highland_burrito-delete-2'); // delete
        }
    );

    // catering_highland_menu
    $app->any('/CateringHighlandMenuList[/{id}]', CateringHighlandMenuController::class . ':list')->add(PermissionMiddleware::class)->setName('CateringHighlandMenuList-catering_highland_menu-list'); // list
    $app->any('/CateringHighlandMenuAdd[/{id}]', CateringHighlandMenuController::class . ':add')->add(PermissionMiddleware::class)->setName('CateringHighlandMenuAdd-catering_highland_menu-add'); // add
    $app->any('/CateringHighlandMenuView[/{id}]', CateringHighlandMenuController::class . ':view')->add(PermissionMiddleware::class)->setName('CateringHighlandMenuView-catering_highland_menu-view'); // view
    $app->any('/CateringHighlandMenuEdit[/{id}]', CateringHighlandMenuController::class . ':edit')->add(PermissionMiddleware::class)->setName('CateringHighlandMenuEdit-catering_highland_menu-edit'); // edit
    $app->any('/CateringHighlandMenuDelete[/{id}]', CateringHighlandMenuController::class . ':delete')->add(PermissionMiddleware::class)->setName('CateringHighlandMenuDelete-catering_highland_menu-delete'); // delete
    $app->group(
        '/catering_highland_menu',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', CateringHighlandMenuController::class . ':list')->add(PermissionMiddleware::class)->setName('catering_highland_menu/list-catering_highland_menu-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', CateringHighlandMenuController::class . ':add')->add(PermissionMiddleware::class)->setName('catering_highland_menu/add-catering_highland_menu-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', CateringHighlandMenuController::class . ':view')->add(PermissionMiddleware::class)->setName('catering_highland_menu/view-catering_highland_menu-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', CateringHighlandMenuController::class . ':edit')->add(PermissionMiddleware::class)->setName('catering_highland_menu/edit-catering_highland_menu-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', CateringHighlandMenuController::class . ':delete')->add(PermissionMiddleware::class)->setName('catering_highland_menu/delete-catering_highland_menu-delete-2'); // delete
        }
    );

    // event_orders
    $app->any('/EventOrdersList[/{id}]', EventOrdersController::class . ':list')->add(PermissionMiddleware::class)->setName('EventOrdersList-event_orders-list'); // list
    $app->any('/EventOrdersAdd[/{id}]', EventOrdersController::class . ':add')->add(PermissionMiddleware::class)->setName('EventOrdersAdd-event_orders-add'); // add
    $app->any('/EventOrdersView[/{id}]', EventOrdersController::class . ':view')->add(PermissionMiddleware::class)->setName('EventOrdersView-event_orders-view'); // view
    $app->any('/EventOrdersEdit[/{id}]', EventOrdersController::class . ':edit')->add(PermissionMiddleware::class)->setName('EventOrdersEdit-event_orders-edit'); // edit
    $app->any('/EventOrdersDelete[/{id}]', EventOrdersController::class . ':delete')->add(PermissionMiddleware::class)->setName('EventOrdersDelete-event_orders-delete'); // delete
    $app->group(
        '/event_orders',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', EventOrdersController::class . ':list')->add(PermissionMiddleware::class)->setName('event_orders/list-event_orders-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', EventOrdersController::class . ':add')->add(PermissionMiddleware::class)->setName('event_orders/add-event_orders-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', EventOrdersController::class . ':view')->add(PermissionMiddleware::class)->setName('event_orders/view-event_orders-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', EventOrdersController::class . ':edit')->add(PermissionMiddleware::class)->setName('event_orders/edit-event_orders-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', EventOrdersController::class . ':delete')->add(PermissionMiddleware::class)->setName('event_orders/delete-event_orders-delete-2'); // delete
        }
    );

    // event_timeline
    $app->any('/EventTimelineList[/{id}]', EventTimelineController::class . ':list')->add(PermissionMiddleware::class)->setName('EventTimelineList-event_timeline-list'); // list
    $app->any('/EventTimelineAdd[/{id}]', EventTimelineController::class . ':add')->add(PermissionMiddleware::class)->setName('EventTimelineAdd-event_timeline-add'); // add
    $app->any('/EventTimelineView[/{id}]', EventTimelineController::class . ':view')->add(PermissionMiddleware::class)->setName('EventTimelineView-event_timeline-view'); // view
    $app->any('/EventTimelineEdit[/{id}]', EventTimelineController::class . ':edit')->add(PermissionMiddleware::class)->setName('EventTimelineEdit-event_timeline-edit'); // edit
    $app->any('/EventTimelineDelete[/{id}]', EventTimelineController::class . ':delete')->add(PermissionMiddleware::class)->setName('EventTimelineDelete-event_timeline-delete'); // delete
    $app->group(
        '/event_timeline',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', EventTimelineController::class . ':list')->add(PermissionMiddleware::class)->setName('event_timeline/list-event_timeline-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', EventTimelineController::class . ':add')->add(PermissionMiddleware::class)->setName('event_timeline/add-event_timeline-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', EventTimelineController::class . ':view')->add(PermissionMiddleware::class)->setName('event_timeline/view-event_timeline-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', EventTimelineController::class . ':edit')->add(PermissionMiddleware::class)->setName('event_timeline/edit-event_timeline-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', EventTimelineController::class . ':delete')->add(PermissionMiddleware::class)->setName('event_timeline/delete-event_timeline-delete-2'); // delete
        }
    );

    // express_timeline
    $app->any('/ExpressTimelineList[/{id}]', ExpressTimelineController::class . ':list')->add(PermissionMiddleware::class)->setName('ExpressTimelineList-express_timeline-list'); // list
    $app->any('/ExpressTimelineAdd[/{id}]', ExpressTimelineController::class . ':add')->add(PermissionMiddleware::class)->setName('ExpressTimelineAdd-express_timeline-add'); // add
    $app->any('/ExpressTimelineView[/{id}]', ExpressTimelineController::class . ':view')->add(PermissionMiddleware::class)->setName('ExpressTimelineView-express_timeline-view'); // view
    $app->any('/ExpressTimelineEdit[/{id}]', ExpressTimelineController::class . ':edit')->add(PermissionMiddleware::class)->setName('ExpressTimelineEdit-express_timeline-edit'); // edit
    $app->any('/ExpressTimelineDelete[/{id}]', ExpressTimelineController::class . ':delete')->add(PermissionMiddleware::class)->setName('ExpressTimelineDelete-express_timeline-delete'); // delete
    $app->group(
        '/express_timeline',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', ExpressTimelineController::class . ':list')->add(PermissionMiddleware::class)->setName('express_timeline/list-express_timeline-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', ExpressTimelineController::class . ':add')->add(PermissionMiddleware::class)->setName('express_timeline/add-express_timeline-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', ExpressTimelineController::class . ':view')->add(PermissionMiddleware::class)->setName('express_timeline/view-express_timeline-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', ExpressTimelineController::class . ':edit')->add(PermissionMiddleware::class)->setName('express_timeline/edit-express_timeline-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', ExpressTimelineController::class . ':delete')->add(PermissionMiddleware::class)->setName('express_timeline/delete-express_timeline-delete-2'); // delete
        }
    );

    // feedback
    $app->any('/FeedbackList[/{id}]', FeedbackController::class . ':list')->add(PermissionMiddleware::class)->setName('FeedbackList-feedback-list'); // list
    $app->any('/FeedbackAdd[/{id}]', FeedbackController::class . ':add')->add(PermissionMiddleware::class)->setName('FeedbackAdd-feedback-add'); // add
    $app->any('/FeedbackView[/{id}]', FeedbackController::class . ':view')->add(PermissionMiddleware::class)->setName('FeedbackView-feedback-view'); // view
    $app->any('/FeedbackEdit[/{id}]', FeedbackController::class . ':edit')->add(PermissionMiddleware::class)->setName('FeedbackEdit-feedback-edit'); // edit
    $app->any('/FeedbackDelete[/{id}]', FeedbackController::class . ':delete')->add(PermissionMiddleware::class)->setName('FeedbackDelete-feedback-delete'); // delete
    $app->group(
        '/feedback',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', FeedbackController::class . ':list')->add(PermissionMiddleware::class)->setName('feedback/list-feedback-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', FeedbackController::class . ':add')->add(PermissionMiddleware::class)->setName('feedback/add-feedback-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', FeedbackController::class . ':view')->add(PermissionMiddleware::class)->setName('feedback/view-feedback-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', FeedbackController::class . ':edit')->add(PermissionMiddleware::class)->setName('feedback/edit-feedback-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', FeedbackController::class . ':delete')->add(PermissionMiddleware::class)->setName('feedback/delete-feedback-delete-2'); // delete
        }
    );

    // mealpackage
    $app->any('/MealpackageList[/{id}]', MealpackageController::class . ':list')->add(PermissionMiddleware::class)->setName('MealpackageList-mealpackage-list'); // list
    $app->any('/MealpackageAdd[/{id}]', MealpackageController::class . ':add')->add(PermissionMiddleware::class)->setName('MealpackageAdd-mealpackage-add'); // add
    $app->any('/MealpackageView[/{id}]', MealpackageController::class . ':view')->add(PermissionMiddleware::class)->setName('MealpackageView-mealpackage-view'); // view
    $app->any('/MealpackageEdit[/{id}]', MealpackageController::class . ':edit')->add(PermissionMiddleware::class)->setName('MealpackageEdit-mealpackage-edit'); // edit
    $app->any('/MealpackageDelete[/{id}]', MealpackageController::class . ':delete')->add(PermissionMiddleware::class)->setName('MealpackageDelete-mealpackage-delete'); // delete
    $app->group(
        '/mealpackage',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', MealpackageController::class . ':list')->add(PermissionMiddleware::class)->setName('mealpackage/list-mealpackage-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', MealpackageController::class . ':add')->add(PermissionMiddleware::class)->setName('mealpackage/add-mealpackage-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', MealpackageController::class . ':view')->add(PermissionMiddleware::class)->setName('mealpackage/view-mealpackage-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', MealpackageController::class . ':edit')->add(PermissionMiddleware::class)->setName('mealpackage/edit-mealpackage-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', MealpackageController::class . ':delete')->add(PermissionMiddleware::class)->setName('mealpackage/delete-mealpackage-delete-2'); // delete
        }
    );

    // restaurants
    $app->any('/RestaurantsList[/{id}]', RestaurantsController::class . ':list')->add(PermissionMiddleware::class)->setName('RestaurantsList-restaurants-list'); // list
    $app->any('/RestaurantsAdd[/{id}]', RestaurantsController::class . ':add')->add(PermissionMiddleware::class)->setName('RestaurantsAdd-restaurants-add'); // add
    $app->any('/RestaurantsView[/{id}]', RestaurantsController::class . ':view')->add(PermissionMiddleware::class)->setName('RestaurantsView-restaurants-view'); // view
    $app->any('/RestaurantsEdit[/{id}]', RestaurantsController::class . ':edit')->add(PermissionMiddleware::class)->setName('RestaurantsEdit-restaurants-edit'); // edit
    $app->any('/RestaurantsDelete[/{id}]', RestaurantsController::class . ':delete')->add(PermissionMiddleware::class)->setName('RestaurantsDelete-restaurants-delete'); // delete
    $app->group(
        '/restaurants',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RestaurantsController::class . ':list')->add(PermissionMiddleware::class)->setName('restaurants/list-restaurants-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RestaurantsController::class . ':add')->add(PermissionMiddleware::class)->setName('restaurants/add-restaurants-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RestaurantsController::class . ':view')->add(PermissionMiddleware::class)->setName('restaurants/view-restaurants-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RestaurantsController::class . ':edit')->add(PermissionMiddleware::class)->setName('restaurants/edit-restaurants-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RestaurantsController::class . ':delete')->add(PermissionMiddleware::class)->setName('restaurants/delete-restaurants-delete-2'); // delete
        }
    );

    // restaurants_slides
    $app->any('/RestaurantsSlidesList[/{id}]', RestaurantsSlidesController::class . ':list')->add(PermissionMiddleware::class)->setName('RestaurantsSlidesList-restaurants_slides-list'); // list
    $app->any('/RestaurantsSlidesAdd[/{id}]', RestaurantsSlidesController::class . ':add')->add(PermissionMiddleware::class)->setName('RestaurantsSlidesAdd-restaurants_slides-add'); // add
    $app->any('/RestaurantsSlidesView[/{id}]', RestaurantsSlidesController::class . ':view')->add(PermissionMiddleware::class)->setName('RestaurantsSlidesView-restaurants_slides-view'); // view
    $app->any('/RestaurantsSlidesEdit[/{id}]', RestaurantsSlidesController::class . ':edit')->add(PermissionMiddleware::class)->setName('RestaurantsSlidesEdit-restaurants_slides-edit'); // edit
    $app->any('/RestaurantsSlidesDelete[/{id}]', RestaurantsSlidesController::class . ':delete')->add(PermissionMiddleware::class)->setName('RestaurantsSlidesDelete-restaurants_slides-delete'); // delete
    $app->group(
        '/restaurants_slides',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RestaurantsSlidesController::class . ':list')->add(PermissionMiddleware::class)->setName('restaurants_slides/list-restaurants_slides-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RestaurantsSlidesController::class . ':add')->add(PermissionMiddleware::class)->setName('restaurants_slides/add-restaurants_slides-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RestaurantsSlidesController::class . ':view')->add(PermissionMiddleware::class)->setName('restaurants_slides/view-restaurants_slides-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RestaurantsSlidesController::class . ':edit')->add(PermissionMiddleware::class)->setName('restaurants_slides/edit-restaurants_slides-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RestaurantsSlidesController::class . ':delete')->add(PermissionMiddleware::class)->setName('restaurants_slides/delete-restaurants_slides-delete-2'); // delete
        }
    );

    // room_reservation
    $app->any('/RoomReservationList[/{id}]', RoomReservationController::class . ':list')->add(PermissionMiddleware::class)->setName('RoomReservationList-room_reservation-list'); // list
    $app->any('/RoomReservationAdd[/{id}]', RoomReservationController::class . ':add')->add(PermissionMiddleware::class)->setName('RoomReservationAdd-room_reservation-add'); // add
    $app->any('/RoomReservationView[/{id}]', RoomReservationController::class . ':view')->add(PermissionMiddleware::class)->setName('RoomReservationView-room_reservation-view'); // view
    $app->any('/RoomReservationEdit[/{id}]', RoomReservationController::class . ':edit')->add(PermissionMiddleware::class)->setName('RoomReservationEdit-room_reservation-edit'); // edit
    $app->any('/RoomReservationDelete[/{id}]', RoomReservationController::class . ':delete')->add(PermissionMiddleware::class)->setName('RoomReservationDelete-room_reservation-delete'); // delete
    $app->group(
        '/room_reservation',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RoomReservationController::class . ':list')->add(PermissionMiddleware::class)->setName('room_reservation/list-room_reservation-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RoomReservationController::class . ':add')->add(PermissionMiddleware::class)->setName('room_reservation/add-room_reservation-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RoomReservationController::class . ':view')->add(PermissionMiddleware::class)->setName('room_reservation/view-room_reservation-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RoomReservationController::class . ':edit')->add(PermissionMiddleware::class)->setName('room_reservation/edit-room_reservation-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RoomReservationController::class . ':delete')->add(PermissionMiddleware::class)->setName('room_reservation/delete-room_reservation-delete-2'); // delete
        }
    );

    // room_reservation_media
    $app->any('/RoomReservationMediaList[/{id}]', RoomReservationMediaController::class . ':list')->add(PermissionMiddleware::class)->setName('RoomReservationMediaList-room_reservation_media-list'); // list
    $app->any('/RoomReservationMediaAdd[/{id}]', RoomReservationMediaController::class . ':add')->add(PermissionMiddleware::class)->setName('RoomReservationMediaAdd-room_reservation_media-add'); // add
    $app->any('/RoomReservationMediaView[/{id}]', RoomReservationMediaController::class . ':view')->add(PermissionMiddleware::class)->setName('RoomReservationMediaView-room_reservation_media-view'); // view
    $app->any('/RoomReservationMediaEdit[/{id}]', RoomReservationMediaController::class . ':edit')->add(PermissionMiddleware::class)->setName('RoomReservationMediaEdit-room_reservation_media-edit'); // edit
    $app->any('/RoomReservationMediaDelete[/{id}]', RoomReservationMediaController::class . ':delete')->add(PermissionMiddleware::class)->setName('RoomReservationMediaDelete-room_reservation_media-delete'); // delete
    $app->group(
        '/room_reservation_media',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RoomReservationMediaController::class . ':list')->add(PermissionMiddleware::class)->setName('room_reservation_media/list-room_reservation_media-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RoomReservationMediaController::class . ':add')->add(PermissionMiddleware::class)->setName('room_reservation_media/add-room_reservation_media-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RoomReservationMediaController::class . ':view')->add(PermissionMiddleware::class)->setName('room_reservation_media/view-room_reservation_media-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RoomReservationMediaController::class . ':edit')->add(PermissionMiddleware::class)->setName('room_reservation_media/edit-room_reservation_media-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RoomReservationMediaController::class . ':delete')->add(PermissionMiddleware::class)->setName('room_reservation_media/delete-room_reservation_media-delete-2'); // delete
        }
    );

    // room_reservation_media_options
    $app->any('/RoomReservationMediaOptionsList[/{id}]', RoomReservationMediaOptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('RoomReservationMediaOptionsList-room_reservation_media_options-list'); // list
    $app->any('/RoomReservationMediaOptionsAdd[/{id}]', RoomReservationMediaOptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('RoomReservationMediaOptionsAdd-room_reservation_media_options-add'); // add
    $app->any('/RoomReservationMediaOptionsView[/{id}]', RoomReservationMediaOptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('RoomReservationMediaOptionsView-room_reservation_media_options-view'); // view
    $app->any('/RoomReservationMediaOptionsEdit[/{id}]', RoomReservationMediaOptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('RoomReservationMediaOptionsEdit-room_reservation_media_options-edit'); // edit
    $app->any('/RoomReservationMediaOptionsDelete[/{id}]', RoomReservationMediaOptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('RoomReservationMediaOptionsDelete-room_reservation_media_options-delete'); // delete
    $app->group(
        '/room_reservation_media_options',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RoomReservationMediaOptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('room_reservation_media_options/list-room_reservation_media_options-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RoomReservationMediaOptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('room_reservation_media_options/add-room_reservation_media_options-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RoomReservationMediaOptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('room_reservation_media_options/view-room_reservation_media_options-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RoomReservationMediaOptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('room_reservation_media_options/edit-room_reservation_media_options-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RoomReservationMediaOptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('room_reservation_media_options/delete-room_reservation_media_options-delete-2'); // delete
        }
    );

    // room_reservation_room
    $app->any('/RoomReservationRoomList[/{id}]', RoomReservationRoomController::class . ':list')->add(PermissionMiddleware::class)->setName('RoomReservationRoomList-room_reservation_room-list'); // list
    $app->any('/RoomReservationRoomAdd[/{id}]', RoomReservationRoomController::class . ':add')->add(PermissionMiddleware::class)->setName('RoomReservationRoomAdd-room_reservation_room-add'); // add
    $app->any('/RoomReservationRoomView[/{id}]', RoomReservationRoomController::class . ':view')->add(PermissionMiddleware::class)->setName('RoomReservationRoomView-room_reservation_room-view'); // view
    $app->any('/RoomReservationRoomEdit[/{id}]', RoomReservationRoomController::class . ':edit')->add(PermissionMiddleware::class)->setName('RoomReservationRoomEdit-room_reservation_room-edit'); // edit
    $app->any('/RoomReservationRoomDelete[/{id}]', RoomReservationRoomController::class . ':delete')->add(PermissionMiddleware::class)->setName('RoomReservationRoomDelete-room_reservation_room-delete'); // delete
    $app->group(
        '/room_reservation_room',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RoomReservationRoomController::class . ':list')->add(PermissionMiddleware::class)->setName('room_reservation_room/list-room_reservation_room-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RoomReservationRoomController::class . ':add')->add(PermissionMiddleware::class)->setName('room_reservation_room/add-room_reservation_room-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RoomReservationRoomController::class . ':view')->add(PermissionMiddleware::class)->setName('room_reservation_room/view-room_reservation_room-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RoomReservationRoomController::class . ':edit')->add(PermissionMiddleware::class)->setName('room_reservation_room/edit-room_reservation_room-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RoomReservationRoomController::class . ':delete')->add(PermissionMiddleware::class)->setName('room_reservation_room/delete-room_reservation_room-delete-2'); // delete
        }
    );

    // room_reservation_room_options
    $app->any('/RoomReservationRoomOptionsList[/{id}]', RoomReservationRoomOptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('RoomReservationRoomOptionsList-room_reservation_room_options-list'); // list
    $app->any('/RoomReservationRoomOptionsAdd[/{id}]', RoomReservationRoomOptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('RoomReservationRoomOptionsAdd-room_reservation_room_options-add'); // add
    $app->any('/RoomReservationRoomOptionsView[/{id}]', RoomReservationRoomOptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('RoomReservationRoomOptionsView-room_reservation_room_options-view'); // view
    $app->any('/RoomReservationRoomOptionsEdit[/{id}]', RoomReservationRoomOptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('RoomReservationRoomOptionsEdit-room_reservation_room_options-edit'); // edit
    $app->any('/RoomReservationRoomOptionsDelete[/{id}]', RoomReservationRoomOptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('RoomReservationRoomOptionsDelete-room_reservation_room_options-delete'); // delete
    $app->group(
        '/room_reservation_room_options',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RoomReservationRoomOptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('room_reservation_room_options/list-room_reservation_room_options-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RoomReservationRoomOptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('room_reservation_room_options/add-room_reservation_room_options-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RoomReservationRoomOptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('room_reservation_room_options/view-room_reservation_room_options-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RoomReservationRoomOptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('room_reservation_room_options/edit-room_reservation_room_options-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RoomReservationRoomOptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('room_reservation_room_options/delete-room_reservation_room_options-delete-2'); // delete
        }
    );

    // rotation
    $app->any('/RotationList[/{id}]', RotationController::class . ':list')->add(PermissionMiddleware::class)->setName('RotationList-rotation-list'); // list
    $app->any('/RotationAdd[/{id}]', RotationController::class . ':add')->add(PermissionMiddleware::class)->setName('RotationAdd-rotation-add'); // add
    $app->any('/RotationView[/{id}]', RotationController::class . ':view')->add(PermissionMiddleware::class)->setName('RotationView-rotation-view'); // view
    $app->any('/RotationEdit[/{id}]', RotationController::class . ':edit')->add(PermissionMiddleware::class)->setName('RotationEdit-rotation-edit'); // edit
    $app->any('/RotationDelete[/{id}]', RotationController::class . ':delete')->add(PermissionMiddleware::class)->setName('RotationDelete-rotation-delete'); // delete
    $app->group(
        '/rotation',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', RotationController::class . ':list')->add(PermissionMiddleware::class)->setName('rotation/list-rotation-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', RotationController::class . ':add')->add(PermissionMiddleware::class)->setName('rotation/add-rotation-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', RotationController::class . ':view')->add(PermissionMiddleware::class)->setName('rotation/view-rotation-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', RotationController::class . ':edit')->add(PermissionMiddleware::class)->setName('rotation/edit-rotation-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', RotationController::class . ':delete')->add(PermissionMiddleware::class)->setName('rotation/delete-rotation-delete-2'); // delete
        }
    );

    // session_handler
    $app->any('/SessionHandlerList[/{id}]', SessionHandlerController::class . ':list')->add(PermissionMiddleware::class)->setName('SessionHandlerList-session_handler-list'); // list
    $app->any('/SessionHandlerAdd[/{id}]', SessionHandlerController::class . ':add')->add(PermissionMiddleware::class)->setName('SessionHandlerAdd-session_handler-add'); // add
    $app->any('/SessionHandlerView[/{id}]', SessionHandlerController::class . ':view')->add(PermissionMiddleware::class)->setName('SessionHandlerView-session_handler-view'); // view
    $app->any('/SessionHandlerEdit[/{id}]', SessionHandlerController::class . ':edit')->add(PermissionMiddleware::class)->setName('SessionHandlerEdit-session_handler-edit'); // edit
    $app->any('/SessionHandlerDelete[/{id}]', SessionHandlerController::class . ':delete')->add(PermissionMiddleware::class)->setName('SessionHandlerDelete-session_handler-delete'); // delete
    $app->group(
        '/session_handler',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', SessionHandlerController::class . ':list')->add(PermissionMiddleware::class)->setName('session_handler/list-session_handler-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', SessionHandlerController::class . ':add')->add(PermissionMiddleware::class)->setName('session_handler/add-session_handler-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', SessionHandlerController::class . ':view')->add(PermissionMiddleware::class)->setName('session_handler/view-session_handler-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', SessionHandlerController::class . ':edit')->add(PermissionMiddleware::class)->setName('session_handler/edit-session_handler-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', SessionHandlerController::class . ':delete')->add(PermissionMiddleware::class)->setName('session_handler/delete-session_handler-delete-2'); // delete
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
