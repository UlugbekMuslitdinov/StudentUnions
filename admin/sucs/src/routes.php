<?php

namespace PHPMaker2021\project4;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // building_access_request_access
    $app->any('/BuildingAccessRequestAccessList[/{id}]', BuildingAccessRequestAccessController::class . ':list')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestAccessList-building_access_request_access-list'); // list
    $app->any('/BuildingAccessRequestAccessAdd[/{id}]', BuildingAccessRequestAccessController::class . ':add')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestAccessAdd-building_access_request_access-add'); // add
    $app->any('/BuildingAccessRequestAccessView[/{id}]', BuildingAccessRequestAccessController::class . ':view')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestAccessView-building_access_request_access-view'); // view
    $app->any('/BuildingAccessRequestAccessEdit[/{id}]', BuildingAccessRequestAccessController::class . ':edit')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestAccessEdit-building_access_request_access-edit'); // edit
    $app->any('/BuildingAccessRequestAccessDelete[/{id}]', BuildingAccessRequestAccessController::class . ':delete')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestAccessDelete-building_access_request_access-delete'); // delete
    $app->group(
        '/building_access_request_access',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BuildingAccessRequestAccessController::class . ':list')->add(PermissionMiddleware::class)->setName('building_access_request_access/list-building_access_request_access-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BuildingAccessRequestAccessController::class . ':add')->add(PermissionMiddleware::class)->setName('building_access_request_access/add-building_access_request_access-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BuildingAccessRequestAccessController::class . ':view')->add(PermissionMiddleware::class)->setName('building_access_request_access/view-building_access_request_access-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BuildingAccessRequestAccessController::class . ':edit')->add(PermissionMiddleware::class)->setName('building_access_request_access/edit-building_access_request_access-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BuildingAccessRequestAccessController::class . ':delete')->add(PermissionMiddleware::class)->setName('building_access_request_access/delete-building_access_request_access-delete-2'); // delete
        }
    );

    // building_access_request_locations
    $app->any('/BuildingAccessRequestLocationsList[/{id}]', BuildingAccessRequestLocationsController::class . ':list')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestLocationsList-building_access_request_locations-list'); // list
    $app->any('/BuildingAccessRequestLocationsAdd[/{id}]', BuildingAccessRequestLocationsController::class . ':add')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestLocationsAdd-building_access_request_locations-add'); // add
    $app->any('/BuildingAccessRequestLocationsView[/{id}]', BuildingAccessRequestLocationsController::class . ':view')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestLocationsView-building_access_request_locations-view'); // view
    $app->any('/BuildingAccessRequestLocationsEdit[/{id}]', BuildingAccessRequestLocationsController::class . ':edit')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestLocationsEdit-building_access_request_locations-edit'); // edit
    $app->any('/BuildingAccessRequestLocationsDelete[/{id}]', BuildingAccessRequestLocationsController::class . ':delete')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestLocationsDelete-building_access_request_locations-delete'); // delete
    $app->group(
        '/building_access_request_locations',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BuildingAccessRequestLocationsController::class . ':list')->add(PermissionMiddleware::class)->setName('building_access_request_locations/list-building_access_request_locations-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BuildingAccessRequestLocationsController::class . ':add')->add(PermissionMiddleware::class)->setName('building_access_request_locations/add-building_access_request_locations-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BuildingAccessRequestLocationsController::class . ':view')->add(PermissionMiddleware::class)->setName('building_access_request_locations/view-building_access_request_locations-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BuildingAccessRequestLocationsController::class . ':edit')->add(PermissionMiddleware::class)->setName('building_access_request_locations/edit-building_access_request_locations-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BuildingAccessRequestLocationsController::class . ':delete')->add(PermissionMiddleware::class)->setName('building_access_request_locations/delete-building_access_request_locations-delete-2'); // delete
        }
    );

    // building_access_requests
    $app->any('/BuildingAccessRequestsList[/{id}]', BuildingAccessRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestsList-building_access_requests-list'); // list
    $app->any('/BuildingAccessRequestsAdd[/{id}]', BuildingAccessRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestsAdd-building_access_requests-add'); // add
    $app->any('/BuildingAccessRequestsView[/{id}]', BuildingAccessRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestsView-building_access_requests-view'); // view
    $app->any('/BuildingAccessRequestsEdit[/{id}]', BuildingAccessRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestsEdit-building_access_requests-edit'); // edit
    $app->any('/BuildingAccessRequestsDelete[/{id}]', BuildingAccessRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('BuildingAccessRequestsDelete-building_access_requests-delete'); // delete
    $app->group(
        '/building_access_requests',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', BuildingAccessRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('building_access_requests/list-building_access_requests-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', BuildingAccessRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('building_access_requests/add-building_access_requests-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', BuildingAccessRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('building_access_requests/view-building_access_requests-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', BuildingAccessRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('building_access_requests/edit-building_access_requests-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', BuildingAccessRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('building_access_requests/delete-building_access_requests-delete-2'); // delete
        }
    );

    // computer_access_requests
    $app->any('/ComputerAccessRequestsList[/{id}]', ComputerAccessRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('ComputerAccessRequestsList-computer_access_requests-list'); // list
    $app->any('/ComputerAccessRequestsAdd[/{id}]', ComputerAccessRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('ComputerAccessRequestsAdd-computer_access_requests-add'); // add
    $app->any('/ComputerAccessRequestsView[/{id}]', ComputerAccessRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('ComputerAccessRequestsView-computer_access_requests-view'); // view
    $app->any('/ComputerAccessRequestsEdit[/{id}]', ComputerAccessRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ComputerAccessRequestsEdit-computer_access_requests-edit'); // edit
    $app->any('/ComputerAccessRequestsDelete[/{id}]', ComputerAccessRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ComputerAccessRequestsDelete-computer_access_requests-delete'); // delete
    $app->group(
        '/computer_access_requests',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', ComputerAccessRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('computer_access_requests/list-computer_access_requests-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', ComputerAccessRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('computer_access_requests/add-computer_access_requests-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', ComputerAccessRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('computer_access_requests/view-computer_access_requests-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', ComputerAccessRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('computer_access_requests/edit-computer_access_requests-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', ComputerAccessRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('computer_access_requests/delete-computer_access_requests-delete-2'); // delete
        }
    );

    // departmental_access_request_account
    $app->any('/DepartmentalAccessRequestAccountList[/{id}]', DepartmentalAccessRequestAccountController::class . ':list')->add(PermissionMiddleware::class)->setName('DepartmentalAccessRequestAccountList-departmental_access_request_account-list'); // list
    $app->any('/DepartmentalAccessRequestAccountAdd[/{id}]', DepartmentalAccessRequestAccountController::class . ':add')->add(PermissionMiddleware::class)->setName('DepartmentalAccessRequestAccountAdd-departmental_access_request_account-add'); // add
    $app->any('/DepartmentalAccessRequestAccountView[/{id}]', DepartmentalAccessRequestAccountController::class . ':view')->add(PermissionMiddleware::class)->setName('DepartmentalAccessRequestAccountView-departmental_access_request_account-view'); // view
    $app->any('/DepartmentalAccessRequestAccountEdit[/{id}]', DepartmentalAccessRequestAccountController::class . ':edit')->add(PermissionMiddleware::class)->setName('DepartmentalAccessRequestAccountEdit-departmental_access_request_account-edit'); // edit
    $app->any('/DepartmentalAccessRequestAccountDelete[/{id}]', DepartmentalAccessRequestAccountController::class . ':delete')->add(PermissionMiddleware::class)->setName('DepartmentalAccessRequestAccountDelete-departmental_access_request_account-delete'); // delete
    $app->group(
        '/departmental_access_request_account',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', DepartmentalAccessRequestAccountController::class . ':list')->add(PermissionMiddleware::class)->setName('departmental_access_request_account/list-departmental_access_request_account-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', DepartmentalAccessRequestAccountController::class . ':add')->add(PermissionMiddleware::class)->setName('departmental_access_request_account/add-departmental_access_request_account-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', DepartmentalAccessRequestAccountController::class . ':view')->add(PermissionMiddleware::class)->setName('departmental_access_request_account/view-departmental_access_request_account-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', DepartmentalAccessRequestAccountController::class . ':edit')->add(PermissionMiddleware::class)->setName('departmental_access_request_account/edit-departmental_access_request_account-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', DepartmentalAccessRequestAccountController::class . ':delete')->add(PermissionMiddleware::class)->setName('departmental_access_request_account/delete-departmental_access_request_account-delete-2'); // delete
        }
    );

    // departmental_access_requests
    $app->any('/DepartmentalAccessRequestsList[/{id}]', DepartmentalAccessRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('DepartmentalAccessRequestsList-departmental_access_requests-list'); // list
    $app->any('/DepartmentalAccessRequestsAdd[/{id}]', DepartmentalAccessRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('DepartmentalAccessRequestsAdd-departmental_access_requests-add'); // add
    $app->any('/DepartmentalAccessRequestsView[/{id}]', DepartmentalAccessRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('DepartmentalAccessRequestsView-departmental_access_requests-view'); // view
    $app->any('/DepartmentalAccessRequestsEdit[/{id}]', DepartmentalAccessRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('DepartmentalAccessRequestsEdit-departmental_access_requests-edit'); // edit
    $app->any('/DepartmentalAccessRequestsDelete[/{id}]', DepartmentalAccessRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('DepartmentalAccessRequestsDelete-departmental_access_requests-delete'); // delete
    $app->group(
        '/departmental_access_requests',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', DepartmentalAccessRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('departmental_access_requests/list-departmental_access_requests-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', DepartmentalAccessRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('departmental_access_requests/add-departmental_access_requests-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', DepartmentalAccessRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('departmental_access_requests/view-departmental_access_requests-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', DepartmentalAccessRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('departmental_access_requests/edit-departmental_access_requests-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', DepartmentalAccessRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('departmental_access_requests/delete-departmental_access_requests-delete-2'); // delete
        }
    );

    // departmental_account_requests
    $app->any('/DepartmentalAccountRequestsList[/{id}]', DepartmentalAccountRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('DepartmentalAccountRequestsList-departmental_account_requests-list'); // list
    $app->any('/DepartmentalAccountRequestsAdd[/{id}]', DepartmentalAccountRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('DepartmentalAccountRequestsAdd-departmental_account_requests-add'); // add
    $app->any('/DepartmentalAccountRequestsView[/{id}]', DepartmentalAccountRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('DepartmentalAccountRequestsView-departmental_account_requests-view'); // view
    $app->any('/DepartmentalAccountRequestsEdit[/{id}]', DepartmentalAccountRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('DepartmentalAccountRequestsEdit-departmental_account_requests-edit'); // edit
    $app->any('/DepartmentalAccountRequestsDelete[/{id}]', DepartmentalAccountRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('DepartmentalAccountRequestsDelete-departmental_account_requests-delete'); // delete
    $app->group(
        '/departmental_account_requests',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', DepartmentalAccountRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('departmental_account_requests/list-departmental_account_requests-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', DepartmentalAccountRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('departmental_account_requests/add-departmental_account_requests-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', DepartmentalAccountRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('departmental_account_requests/view-departmental_account_requests-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', DepartmentalAccountRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('departmental_account_requests/edit-departmental_account_requests-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', DepartmentalAccountRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('departmental_account_requests/delete-departmental_account_requests-delete-2'); // delete
        }
    );

    // exch_departments
    $app->any('/ExchDepartmentsList[/{department_id}]', ExchDepartmentsController::class . ':list')->add(PermissionMiddleware::class)->setName('ExchDepartmentsList-exch_departments-list'); // list
    $app->any('/ExchDepartmentsAdd[/{department_id}]', ExchDepartmentsController::class . ':add')->add(PermissionMiddleware::class)->setName('ExchDepartmentsAdd-exch_departments-add'); // add
    $app->any('/ExchDepartmentsView[/{department_id}]', ExchDepartmentsController::class . ':view')->add(PermissionMiddleware::class)->setName('ExchDepartmentsView-exch_departments-view'); // view
    $app->any('/ExchDepartmentsEdit[/{department_id}]', ExchDepartmentsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ExchDepartmentsEdit-exch_departments-edit'); // edit
    $app->any('/ExchDepartmentsDelete[/{department_id}]', ExchDepartmentsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ExchDepartmentsDelete-exch_departments-delete'); // delete
    $app->group(
        '/exch_departments',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{department_id}]', ExchDepartmentsController::class . ':list')->add(PermissionMiddleware::class)->setName('exch_departments/list-exch_departments-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{department_id}]', ExchDepartmentsController::class . ':add')->add(PermissionMiddleware::class)->setName('exch_departments/add-exch_departments-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{department_id}]', ExchDepartmentsController::class . ':view')->add(PermissionMiddleware::class)->setName('exch_departments/view-exch_departments-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{department_id}]', ExchDepartmentsController::class . ':edit')->add(PermissionMiddleware::class)->setName('exch_departments/edit-exch_departments-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{department_id}]', ExchDepartmentsController::class . ':delete')->add(PermissionMiddleware::class)->setName('exch_departments/delete-exch_departments-delete-2'); // delete
        }
    );

    // groups
    $app->any('/GroupsList[/{group_id}]', GroupsController::class . ':list')->add(PermissionMiddleware::class)->setName('GroupsList-groups-list'); // list
    $app->any('/GroupsAdd[/{group_id}]', GroupsController::class . ':add')->add(PermissionMiddleware::class)->setName('GroupsAdd-groups-add'); // add
    $app->any('/GroupsView[/{group_id}]', GroupsController::class . ':view')->add(PermissionMiddleware::class)->setName('GroupsView-groups-view'); // view
    $app->any('/GroupsEdit[/{group_id}]', GroupsController::class . ':edit')->add(PermissionMiddleware::class)->setName('GroupsEdit-groups-edit'); // edit
    $app->any('/GroupsDelete[/{group_id}]', GroupsController::class . ':delete')->add(PermissionMiddleware::class)->setName('GroupsDelete-groups-delete'); // delete
    $app->group(
        '/groups',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{group_id}]', GroupsController::class . ':list')->add(PermissionMiddleware::class)->setName('groups/list-groups-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{group_id}]', GroupsController::class . ':add')->add(PermissionMiddleware::class)->setName('groups/add-groups-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{group_id}]', GroupsController::class . ':view')->add(PermissionMiddleware::class)->setName('groups/view-groups-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{group_id}]', GroupsController::class . ':edit')->add(PermissionMiddleware::class)->setName('groups/edit-groups-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{group_id}]', GroupsController::class . ':delete')->add(PermissionMiddleware::class)->setName('groups/delete-groups-delete-2'); // delete
        }
    );

    // kronos_managers
    $app->any('/KronosManagersList', KronosManagersController::class . ':list')->add(PermissionMiddleware::class)->setName('KronosManagersList-kronos_managers-list'); // list
    $app->group(
        '/kronos_managers',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', KronosManagersController::class . ':list')->add(PermissionMiddleware::class)->setName('kronos_managers/list-kronos_managers-list-2'); // list
        }
    );

    // memberships
    $app->any('/MembershipsList[/{membership_id}]', MembershipsController::class . ':list')->add(PermissionMiddleware::class)->setName('MembershipsList-memberships-list'); // list
    $app->any('/MembershipsAdd[/{membership_id}]', MembershipsController::class . ':add')->add(PermissionMiddleware::class)->setName('MembershipsAdd-memberships-add'); // add
    $app->any('/MembershipsView[/{membership_id}]', MembershipsController::class . ':view')->add(PermissionMiddleware::class)->setName('MembershipsView-memberships-view'); // view
    $app->any('/MembershipsEdit[/{membership_id}]', MembershipsController::class . ':edit')->add(PermissionMiddleware::class)->setName('MembershipsEdit-memberships-edit'); // edit
    $app->any('/MembershipsDelete[/{membership_id}]', MembershipsController::class . ':delete')->add(PermissionMiddleware::class)->setName('MembershipsDelete-memberships-delete'); // delete
    $app->group(
        '/memberships',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{membership_id}]', MembershipsController::class . ':list')->add(PermissionMiddleware::class)->setName('memberships/list-memberships-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{membership_id}]', MembershipsController::class . ':add')->add(PermissionMiddleware::class)->setName('memberships/add-memberships-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{membership_id}]', MembershipsController::class . ':view')->add(PermissionMiddleware::class)->setName('memberships/view-memberships-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{membership_id}]', MembershipsController::class . ':edit')->add(PermissionMiddleware::class)->setName('memberships/edit-memberships-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{membership_id}]', MembershipsController::class . ':delete')->add(PermissionMiddleware::class)->setName('memberships/delete-memberships-delete-2'); // delete
        }
    );

    // nutrition_class
    $app->any('/NutritionClassList[/{id}]', NutritionClassController::class . ':list')->add(PermissionMiddleware::class)->setName('NutritionClassList-nutrition_class-list'); // list
    $app->any('/NutritionClassAdd[/{id}]', NutritionClassController::class . ':add')->add(PermissionMiddleware::class)->setName('NutritionClassAdd-nutrition_class-add'); // add
    $app->any('/NutritionClassView[/{id}]', NutritionClassController::class . ':view')->add(PermissionMiddleware::class)->setName('NutritionClassView-nutrition_class-view'); // view
    $app->any('/NutritionClassEdit[/{id}]', NutritionClassController::class . ':edit')->add(PermissionMiddleware::class)->setName('NutritionClassEdit-nutrition_class-edit'); // edit
    $app->any('/NutritionClassDelete[/{id}]', NutritionClassController::class . ':delete')->add(PermissionMiddleware::class)->setName('NutritionClassDelete-nutrition_class-delete'); // delete
    $app->group(
        '/nutrition_class',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', NutritionClassController::class . ':list')->add(PermissionMiddleware::class)->setName('nutrition_class/list-nutrition_class-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', NutritionClassController::class . ':add')->add(PermissionMiddleware::class)->setName('nutrition_class/add-nutrition_class-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', NutritionClassController::class . ':view')->add(PermissionMiddleware::class)->setName('nutrition_class/view-nutrition_class-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', NutritionClassController::class . ':edit')->add(PermissionMiddleware::class)->setName('nutrition_class/edit-nutrition_class-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', NutritionClassController::class . ':delete')->add(PermissionMiddleware::class)->setName('nutrition_class/delete-nutrition_class-delete-2'); // delete
        }
    );

    // permissions2
    $app->any('/Permissions2List[/{permission_id}]', Permissions2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('Permissions2List-permissions2-list'); // list
    $app->any('/Permissions2Add[/{permission_id}]', Permissions2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('Permissions2Add-permissions2-add'); // add
    $app->any('/Permissions2View[/{permission_id}]', Permissions2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('Permissions2View-permissions2-view'); // view
    $app->any('/Permissions2Edit[/{permission_id}]', Permissions2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('Permissions2Edit-permissions2-edit'); // edit
    $app->any('/Permissions2Delete[/{permission_id}]', Permissions2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('Permissions2Delete-permissions2-delete'); // delete
    $app->group(
        '/permissions2',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{permission_id}]', Permissions2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('permissions2/list-permissions2-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{permission_id}]', Permissions2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('permissions2/add-permissions2-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{permission_id}]', Permissions2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('permissions2/view-permissions2-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{permission_id}]', Permissions2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('permissions2/edit-permissions2-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{permission_id}]', Permissions2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('permissions2/delete-permissions2-delete-2'); // delete
        }
    );

    // phone_requests
    $app->any('/PhoneRequestsList[/{ID}]', PhoneRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('PhoneRequestsList-phone_requests-list'); // list
    $app->any('/PhoneRequestsAdd[/{ID}]', PhoneRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('PhoneRequestsAdd-phone_requests-add'); // add
    $app->any('/PhoneRequestsView[/{ID}]', PhoneRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('PhoneRequestsView-phone_requests-view'); // view
    $app->any('/PhoneRequestsEdit[/{ID}]', PhoneRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('PhoneRequestsEdit-phone_requests-edit'); // edit
    $app->any('/PhoneRequestsDelete[/{ID}]', PhoneRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('PhoneRequestsDelete-phone_requests-delete'); // delete
    $app->group(
        '/phone_requests',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ID}]', PhoneRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('phone_requests/list-phone_requests-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ID}]', PhoneRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('phone_requests/add-phone_requests-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ID}]', PhoneRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('phone_requests/view-phone_requests-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ID}]', PhoneRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('phone_requests/edit-phone_requests-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{ID}]', PhoneRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('phone_requests/delete-phone_requests-delete-2'); // delete
        }
    );

    // pos_access_requests
    $app->any('/PosAccessRequestsList[/{id}]', PosAccessRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('PosAccessRequestsList-pos_access_requests-list'); // list
    $app->any('/PosAccessRequestsAdd[/{id}]', PosAccessRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('PosAccessRequestsAdd-pos_access_requests-add'); // add
    $app->any('/PosAccessRequestsView[/{id}]', PosAccessRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('PosAccessRequestsView-pos_access_requests-view'); // view
    $app->any('/PosAccessRequestsEdit[/{id}]', PosAccessRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('PosAccessRequestsEdit-pos_access_requests-edit'); // edit
    $app->any('/PosAccessRequestsDelete[/{id}]', PosAccessRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('PosAccessRequestsDelete-pos_access_requests-delete'); // delete
    $app->group(
        '/pos_access_requests',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', PosAccessRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('pos_access_requests/list-pos_access_requests-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', PosAccessRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('pos_access_requests/add-pos_access_requests-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', PosAccessRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('pos_access_requests/view-pos_access_requests-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', PosAccessRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('pos_access_requests/edit-pos_access_requests-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', PosAccessRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('pos_access_requests/delete-pos_access_requests-delete-2'); // delete
        }
    );

    // print_logs
    $app->any('/PrintLogsList', PrintLogsController::class . ':list')->add(PermissionMiddleware::class)->setName('PrintLogsList-print_logs-list'); // list
    $app->group(
        '/print_logs',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', PrintLogsController::class . ':list')->add(PermissionMiddleware::class)->setName('print_logs/list-print_logs-list-2'); // list
        }
    );

    // resources
    $app->any('/ResourcesList[/{resource_id}]', ResourcesController::class . ':list')->add(PermissionMiddleware::class)->setName('ResourcesList-resources-list'); // list
    $app->any('/ResourcesAdd[/{resource_id}]', ResourcesController::class . ':add')->add(PermissionMiddleware::class)->setName('ResourcesAdd-resources-add'); // add
    $app->any('/ResourcesView[/{resource_id}]', ResourcesController::class . ':view')->add(PermissionMiddleware::class)->setName('ResourcesView-resources-view'); // view
    $app->any('/ResourcesEdit[/{resource_id}]', ResourcesController::class . ':edit')->add(PermissionMiddleware::class)->setName('ResourcesEdit-resources-edit'); // edit
    $app->any('/ResourcesDelete[/{resource_id}]', ResourcesController::class . ':delete')->add(PermissionMiddleware::class)->setName('ResourcesDelete-resources-delete'); // delete
    $app->group(
        '/resources',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{resource_id}]', ResourcesController::class . ':list')->add(PermissionMiddleware::class)->setName('resources/list-resources-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{resource_id}]', ResourcesController::class . ':add')->add(PermissionMiddleware::class)->setName('resources/add-resources-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{resource_id}]', ResourcesController::class . ':view')->add(PermissionMiddleware::class)->setName('resources/view-resources-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{resource_id}]', ResourcesController::class . ':edit')->add(PermissionMiddleware::class)->setName('resources/edit-resources-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{resource_id}]', ResourcesController::class . ':delete')->add(PermissionMiddleware::class)->setName('resources/delete-resources-delete-2'); // delete
        }
    );

    // users
    $app->any('/UsersList[/{user_id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('UsersList-users-list'); // list
    $app->any('/UsersAdd[/{user_id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('UsersAdd-users-add'); // add
    $app->any('/UsersView[/{user_id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('UsersView-users-view'); // view
    $app->any('/UsersEdit[/{user_id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('UsersEdit-users-edit'); // edit
    $app->any('/UsersDelete[/{user_id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('UsersDelete-users-delete'); // delete
    $app->group(
        '/users',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{user_id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('users/list-users-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{user_id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('users/add-users-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{user_id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('users/view-users-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{user_id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('users/edit-users-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{user_id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('users/delete-users-delete-2'); // delete
        }
    );

    // web_support
    $app->any('/WebSupportList[/{id}]', WebSupportController::class . ':list')->add(PermissionMiddleware::class)->setName('WebSupportList-web_support-list'); // list
    $app->any('/WebSupportAdd[/{id}]', WebSupportController::class . ':add')->add(PermissionMiddleware::class)->setName('WebSupportAdd-web_support-add'); // add
    $app->any('/WebSupportView[/{id}]', WebSupportController::class . ':view')->add(PermissionMiddleware::class)->setName('WebSupportView-web_support-view'); // view
    $app->any('/WebSupportEdit[/{id}]', WebSupportController::class . ':edit')->add(PermissionMiddleware::class)->setName('WebSupportEdit-web_support-edit'); // edit
    $app->any('/WebSupportDelete[/{id}]', WebSupportController::class . ':delete')->add(PermissionMiddleware::class)->setName('WebSupportDelete-web_support-delete'); // delete
    $app->group(
        '/web_support',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', WebSupportController::class . ':list')->add(PermissionMiddleware::class)->setName('web_support/list-web_support-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', WebSupportController::class . ':add')->add(PermissionMiddleware::class)->setName('web_support/add-web_support-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', WebSupportController::class . ':view')->add(PermissionMiddleware::class)->setName('web_support/view-web_support-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', WebSupportController::class . ':edit')->add(PermissionMiddleware::class)->setName('web_support/edit-web_support-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', WebSupportController::class . ':delete')->add(PermissionMiddleware::class)->setName('web_support/delete-web_support-delete-2'); // delete
        }
    );

    // web_support_files
    $app->any('/WebSupportFilesList[/{id}]', WebSupportFilesController::class . ':list')->add(PermissionMiddleware::class)->setName('WebSupportFilesList-web_support_files-list'); // list
    $app->any('/WebSupportFilesAdd[/{id}]', WebSupportFilesController::class . ':add')->add(PermissionMiddleware::class)->setName('WebSupportFilesAdd-web_support_files-add'); // add
    $app->any('/WebSupportFilesView[/{id}]', WebSupportFilesController::class . ':view')->add(PermissionMiddleware::class)->setName('WebSupportFilesView-web_support_files-view'); // view
    $app->any('/WebSupportFilesEdit[/{id}]', WebSupportFilesController::class . ':edit')->add(PermissionMiddleware::class)->setName('WebSupportFilesEdit-web_support_files-edit'); // edit
    $app->any('/WebSupportFilesDelete[/{id}]', WebSupportFilesController::class . ':delete')->add(PermissionMiddleware::class)->setName('WebSupportFilesDelete-web_support_files-delete'); // delete
    $app->group(
        '/web_support_files',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', WebSupportFilesController::class . ':list')->add(PermissionMiddleware::class)->setName('web_support_files/list-web_support_files-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', WebSupportFilesController::class . ':add')->add(PermissionMiddleware::class)->setName('web_support_files/add-web_support_files-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', WebSupportFilesController::class . ':view')->add(PermissionMiddleware::class)->setName('web_support_files/view-web_support_files-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', WebSupportFilesController::class . ':edit')->add(PermissionMiddleware::class)->setName('web_support_files/edit-web_support_files-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', WebSupportFilesController::class . ':delete')->add(PermissionMiddleware::class)->setName('web_support_files/delete-web_support_files-delete-2'); // delete
        }
    );

    // workstation_access_requests
    $app->any('/WorkstationAccessRequestsList[/{id}]', WorkstationAccessRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('WorkstationAccessRequestsList-workstation_access_requests-list'); // list
    $app->any('/WorkstationAccessRequestsAdd[/{id}]', WorkstationAccessRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('WorkstationAccessRequestsAdd-workstation_access_requests-add'); // add
    $app->any('/WorkstationAccessRequestsView[/{id}]', WorkstationAccessRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('WorkstationAccessRequestsView-workstation_access_requests-view'); // view
    $app->any('/WorkstationAccessRequestsEdit[/{id}]', WorkstationAccessRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('WorkstationAccessRequestsEdit-workstation_access_requests-edit'); // edit
    $app->any('/WorkstationAccessRequestsDelete[/{id}]', WorkstationAccessRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('WorkstationAccessRequestsDelete-workstation_access_requests-delete'); // delete
    $app->group(
        '/workstation_access_requests',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', WorkstationAccessRequestsController::class . ':list')->add(PermissionMiddleware::class)->setName('workstation_access_requests/list-workstation_access_requests-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', WorkstationAccessRequestsController::class . ':add')->add(PermissionMiddleware::class)->setName('workstation_access_requests/add-workstation_access_requests-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', WorkstationAccessRequestsController::class . ':view')->add(PermissionMiddleware::class)->setName('workstation_access_requests/view-workstation_access_requests-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', WorkstationAccessRequestsController::class . ':edit')->add(PermissionMiddleware::class)->setName('workstation_access_requests/edit-workstation_access_requests-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', WorkstationAccessRequestsController::class . ':delete')->add(PermissionMiddleware::class)->setName('workstation_access_requests/delete-workstation_access_requests-delete-2'); // delete
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

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
