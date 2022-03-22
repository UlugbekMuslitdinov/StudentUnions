<?php

namespace PHPMaker2021\project2;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // begalcsv
    $app->any('/BegalcsvList', BegalcsvController::class . ':list')->add(PermissionMiddleware::class)->setName('BegalcsvList-begalcsv-list'); // list
    $app->group(
        '/begalcsv',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', BegalcsvController::class . ':list')->add(PermissionMiddleware::class)->setName('begalcsv/list-begalcsv-list-2'); // list
        }
    );

    // exceptions
    $app->any('/ExceptionsList[/{id}]', ExceptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('ExceptionsList-exceptions-list'); // list
    $app->any('/ExceptionsAdd[/{id}]', ExceptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('ExceptionsAdd-exceptions-add'); // add
    $app->any('/ExceptionsView[/{id}]', ExceptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('ExceptionsView-exceptions-view'); // view
    $app->any('/ExceptionsEdit[/{id}]', ExceptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ExceptionsEdit-exceptions-edit'); // edit
    $app->any('/ExceptionsDelete[/{id}]', ExceptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ExceptionsDelete-exceptions-delete'); // delete
    $app->group(
        '/exceptions',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', ExceptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('exceptions/list-exceptions-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', ExceptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('exceptions/add-exceptions-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', ExceptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('exceptions/view-exceptions-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', ExceptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('exceptions/edit-exceptions-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', ExceptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('exceptions/delete-exceptions-delete-2'); // delete
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

    // hours
    $app->any('/HoursList[/{id}]', HoursController::class . ':list')->add(PermissionMiddleware::class)->setName('HoursList-hours-list'); // list
    $app->any('/HoursAdd[/{id}]', HoursController::class . ':add')->add(PermissionMiddleware::class)->setName('HoursAdd-hours-add'); // add
    $app->any('/HoursView[/{id}]', HoursController::class . ':view')->add(PermissionMiddleware::class)->setName('HoursView-hours-view'); // view
    $app->any('/HoursEdit[/{id}]', HoursController::class . ':edit')->add(PermissionMiddleware::class)->setName('HoursEdit-hours-edit'); // edit
    $app->any('/HoursDelete[/{id}]', HoursController::class . ':delete')->add(PermissionMiddleware::class)->setName('HoursDelete-hours-delete'); // delete
    $app->group(
        '/hours',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', HoursController::class . ':list')->add(PermissionMiddleware::class)->setName('hours/list-hours-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', HoursController::class . ':add')->add(PermissionMiddleware::class)->setName('hours/add-hours-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', HoursController::class . ':view')->add(PermissionMiddleware::class)->setName('hours/view-hours-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', HoursController::class . ':edit')->add(PermissionMiddleware::class)->setName('hours/edit-hours-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', HoursController::class . ':delete')->add(PermissionMiddleware::class)->setName('hours/delete-hours-delete-2'); // delete
        }
    );

    // hours_catering
    $app->any('/HoursCateringList[/{id}]', HoursCateringController::class . ':list')->add(PermissionMiddleware::class)->setName('HoursCateringList-hours_catering-list'); // list
    $app->any('/HoursCateringAdd[/{id}]', HoursCateringController::class . ':add')->add(PermissionMiddleware::class)->setName('HoursCateringAdd-hours_catering-add'); // add
    $app->any('/HoursCateringView[/{id}]', HoursCateringController::class . ':view')->add(PermissionMiddleware::class)->setName('HoursCateringView-hours_catering-view'); // view
    $app->any('/HoursCateringEdit[/{id}]', HoursCateringController::class . ':edit')->add(PermissionMiddleware::class)->setName('HoursCateringEdit-hours_catering-edit'); // edit
    $app->any('/HoursCateringDelete[/{id}]', HoursCateringController::class . ':delete')->add(PermissionMiddleware::class)->setName('HoursCateringDelete-hours_catering-delete'); // delete
    $app->group(
        '/hours_catering',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', HoursCateringController::class . ':list')->add(PermissionMiddleware::class)->setName('hours_catering/list-hours_catering-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', HoursCateringController::class . ':add')->add(PermissionMiddleware::class)->setName('hours_catering/add-hours_catering-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', HoursCateringController::class . ':view')->add(PermissionMiddleware::class)->setName('hours_catering/view-hours_catering-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', HoursCateringController::class . ':edit')->add(PermissionMiddleware::class)->setName('hours_catering/edit-hours_catering-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', HoursCateringController::class . ':delete')->add(PermissionMiddleware::class)->setName('hours_catering/delete-hours_catering-delete-2'); // delete
        }
    );

    // hours_default
    $app->any('/HoursDefaultList[/{hour_id}]', HoursDefaultController::class . ':list')->add(PermissionMiddleware::class)->setName('HoursDefaultList-hours_default-list'); // list
    $app->any('/HoursDefaultAdd[/{hour_id}]', HoursDefaultController::class . ':add')->add(PermissionMiddleware::class)->setName('HoursDefaultAdd-hours_default-add'); // add
    $app->any('/HoursDefaultView[/{hour_id}]', HoursDefaultController::class . ':view')->add(PermissionMiddleware::class)->setName('HoursDefaultView-hours_default-view'); // view
    $app->any('/HoursDefaultEdit[/{hour_id}]', HoursDefaultController::class . ':edit')->add(PermissionMiddleware::class)->setName('HoursDefaultEdit-hours_default-edit'); // edit
    $app->any('/HoursDefaultDelete[/{hour_id}]', HoursDefaultController::class . ':delete')->add(PermissionMiddleware::class)->setName('HoursDefaultDelete-hours_default-delete'); // delete
    $app->group(
        '/hours_default',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{hour_id}]', HoursDefaultController::class . ':list')->add(PermissionMiddleware::class)->setName('hours_default/list-hours_default-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{hour_id}]', HoursDefaultController::class . ':add')->add(PermissionMiddleware::class)->setName('hours_default/add-hours_default-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{hour_id}]', HoursDefaultController::class . ':view')->add(PermissionMiddleware::class)->setName('hours_default/view-hours_default-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{hour_id}]', HoursDefaultController::class . ':edit')->add(PermissionMiddleware::class)->setName('hours_default/edit-hours_default-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{hour_id}]', HoursDefaultController::class . ':delete')->add(PermissionMiddleware::class)->setName('hours_default/delete-hours_default-delete-2'); // delete
        }
    );

    // hours_exception
    $app->any('/HoursExceptionList', HoursExceptionController::class . ':list')->add(PermissionMiddleware::class)->setName('HoursExceptionList-hours_exception-list'); // list
    $app->group(
        '/hours_exception',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', HoursExceptionController::class . ':list')->add(PermissionMiddleware::class)->setName('hours_exception/list-hours_exception-list-2'); // list
        }
    );

    // location
    $app->any('/LocationList[/{location_id}]', LocationController::class . ':list')->add(PermissionMiddleware::class)->setName('LocationList-location-list'); // list
    $app->any('/LocationAdd[/{location_id}]', LocationController::class . ':add')->add(PermissionMiddleware::class)->setName('LocationAdd-location-add'); // add
    $app->any('/LocationView[/{location_id}]', LocationController::class . ':view')->add(PermissionMiddleware::class)->setName('LocationView-location-view'); // view
    $app->any('/LocationEdit[/{location_id}]', LocationController::class . ':edit')->add(PermissionMiddleware::class)->setName('LocationEdit-location-edit'); // edit
    $app->any('/LocationDelete[/{location_id}]', LocationController::class . ':delete')->add(PermissionMiddleware::class)->setName('LocationDelete-location-delete'); // delete
    $app->group(
        '/location',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{location_id}]', LocationController::class . ':list')->add(PermissionMiddleware::class)->setName('location/list-location-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{location_id}]', LocationController::class . ':add')->add(PermissionMiddleware::class)->setName('location/add-location-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{location_id}]', LocationController::class . ':view')->add(PermissionMiddleware::class)->setName('location/view-location-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{location_id}]', LocationController::class . ':edit')->add(PermissionMiddleware::class)->setName('location/edit-location-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{location_id}]', LocationController::class . ':delete')->add(PermissionMiddleware::class)->setName('location/delete-location-delete-2'); // delete
        }
    );

    // location_descriptions
    $app->any('/LocationDescriptionsList[/{location_id}]', LocationDescriptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('LocationDescriptionsList-location_descriptions-list'); // list
    $app->any('/LocationDescriptionsAdd[/{location_id}]', LocationDescriptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('LocationDescriptionsAdd-location_descriptions-add'); // add
    $app->any('/LocationDescriptionsView[/{location_id}]', LocationDescriptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('LocationDescriptionsView-location_descriptions-view'); // view
    $app->any('/LocationDescriptionsEdit[/{location_id}]', LocationDescriptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('LocationDescriptionsEdit-location_descriptions-edit'); // edit
    $app->any('/LocationDescriptionsDelete[/{location_id}]', LocationDescriptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('LocationDescriptionsDelete-location_descriptions-delete'); // delete
    $app->group(
        '/location_descriptions',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{location_id}]', LocationDescriptionsController::class . ':list')->add(PermissionMiddleware::class)->setName('location_descriptions/list-location_descriptions-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{location_id}]', LocationDescriptionsController::class . ':add')->add(PermissionMiddleware::class)->setName('location_descriptions/add-location_descriptions-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{location_id}]', LocationDescriptionsController::class . ':view')->add(PermissionMiddleware::class)->setName('location_descriptions/view-location_descriptions-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{location_id}]', LocationDescriptionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('location_descriptions/edit-location_descriptions-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{location_id}]', LocationDescriptionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('location_descriptions/delete-location_descriptions-delete-2'); // delete
        }
    );

    // meal_details
    $app->any('/MealDetailsList[/{id}]', MealDetailsController::class . ':list')->add(PermissionMiddleware::class)->setName('MealDetailsList-meal_details-list'); // list
    $app->any('/MealDetailsAdd[/{id}]', MealDetailsController::class . ':add')->add(PermissionMiddleware::class)->setName('MealDetailsAdd-meal_details-add'); // add
    $app->any('/MealDetailsView[/{id}]', MealDetailsController::class . ':view')->add(PermissionMiddleware::class)->setName('MealDetailsView-meal_details-view'); // view
    $app->any('/MealDetailsEdit[/{id}]', MealDetailsController::class . ':edit')->add(PermissionMiddleware::class)->setName('MealDetailsEdit-meal_details-edit'); // edit
    $app->any('/MealDetailsDelete[/{id}]', MealDetailsController::class . ':delete')->add(PermissionMiddleware::class)->setName('MealDetailsDelete-meal_details-delete'); // delete
    $app->group(
        '/meal_details',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', MealDetailsController::class . ':list')->add(PermissionMiddleware::class)->setName('meal_details/list-meal_details-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', MealDetailsController::class . ':add')->add(PermissionMiddleware::class)->setName('meal_details/add-meal_details-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', MealDetailsController::class . ':view')->add(PermissionMiddleware::class)->setName('meal_details/view-meal_details-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', MealDetailsController::class . ':edit')->add(PermissionMiddleware::class)->setName('meal_details/edit-meal_details-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', MealDetailsController::class . ':delete')->add(PermissionMiddleware::class)->setName('meal_details/delete-meal_details-delete-2'); // delete
        }
    );

    // meal_times
    $app->any('/MealTimesList[/{id}]', MealTimesController::class . ':list')->add(PermissionMiddleware::class)->setName('MealTimesList-meal_times-list'); // list
    $app->any('/MealTimesAdd[/{id}]', MealTimesController::class . ':add')->add(PermissionMiddleware::class)->setName('MealTimesAdd-meal_times-add'); // add
    $app->any('/MealTimesView[/{id}]', MealTimesController::class . ':view')->add(PermissionMiddleware::class)->setName('MealTimesView-meal_times-view'); // view
    $app->any('/MealTimesEdit[/{id}]', MealTimesController::class . ':edit')->add(PermissionMiddleware::class)->setName('MealTimesEdit-meal_times-edit'); // edit
    $app->any('/MealTimesDelete[/{id}]', MealTimesController::class . ':delete')->add(PermissionMiddleware::class)->setName('MealTimesDelete-meal_times-delete'); // delete
    $app->group(
        '/meal_times',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', MealTimesController::class . ':list')->add(PermissionMiddleware::class)->setName('meal_times/list-meal_times-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', MealTimesController::class . ':add')->add(PermissionMiddleware::class)->setName('meal_times/add-meal_times-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', MealTimesController::class . ':view')->add(PermissionMiddleware::class)->setName('meal_times/view-meal_times-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', MealTimesController::class . ':edit')->add(PermissionMiddleware::class)->setName('meal_times/edit-meal_times-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', MealTimesController::class . ':delete')->add(PermissionMiddleware::class)->setName('meal_times/delete-meal_times-delete-2'); // delete
        }
    );

    // menu_categories
    $app->any('/MenuCategoriesList[/{id}]', MenuCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('MenuCategoriesList-menu_categories-list'); // list
    $app->any('/MenuCategoriesAdd[/{id}]', MenuCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('MenuCategoriesAdd-menu_categories-add'); // add
    $app->any('/MenuCategoriesView[/{id}]', MenuCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('MenuCategoriesView-menu_categories-view'); // view
    $app->any('/MenuCategoriesEdit[/{id}]', MenuCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('MenuCategoriesEdit-menu_categories-edit'); // edit
    $app->any('/MenuCategoriesDelete[/{id}]', MenuCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('MenuCategoriesDelete-menu_categories-delete'); // delete
    $app->group(
        '/menu_categories',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', MenuCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('menu_categories/list-menu_categories-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', MenuCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('menu_categories/add-menu_categories-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', MenuCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('menu_categories/view-menu_categories-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', MenuCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('menu_categories/edit-menu_categories-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', MenuCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('menu_categories/delete-menu_categories-delete-2'); // delete
        }
    );

    // menu_items
    $app->any('/MenuItemsList[/{id}]', MenuItemsController::class . ':list')->add(PermissionMiddleware::class)->setName('MenuItemsList-menu_items-list'); // list
    $app->any('/MenuItemsAdd[/{id}]', MenuItemsController::class . ':add')->add(PermissionMiddleware::class)->setName('MenuItemsAdd-menu_items-add'); // add
    $app->any('/MenuItemsView[/{id}]', MenuItemsController::class . ':view')->add(PermissionMiddleware::class)->setName('MenuItemsView-menu_items-view'); // view
    $app->any('/MenuItemsEdit[/{id}]', MenuItemsController::class . ':edit')->add(PermissionMiddleware::class)->setName('MenuItemsEdit-menu_items-edit'); // edit
    $app->any('/MenuItemsDelete[/{id}]', MenuItemsController::class . ':delete')->add(PermissionMiddleware::class)->setName('MenuItemsDelete-menu_items-delete'); // delete
    $app->group(
        '/menu_items',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', MenuItemsController::class . ':list')->add(PermissionMiddleware::class)->setName('menu_items/list-menu_items-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', MenuItemsController::class . ':add')->add(PermissionMiddleware::class)->setName('menu_items/add-menu_items-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', MenuItemsController::class . ':view')->add(PermissionMiddleware::class)->setName('menu_items/view-menu_items-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', MenuItemsController::class . ':edit')->add(PermissionMiddleware::class)->setName('menu_items/edit-menu_items-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', MenuItemsController::class . ':delete')->add(PermissionMiddleware::class)->setName('menu_items/delete-menu_items-delete-2'); // delete
        }
    );

    // menu_specials
    $app->any('/MenuSpecialsList[/{id}]', MenuSpecialsController::class . ':list')->add(PermissionMiddleware::class)->setName('MenuSpecialsList-menu_specials-list'); // list
    $app->any('/MenuSpecialsAdd[/{id}]', MenuSpecialsController::class . ':add')->add(PermissionMiddleware::class)->setName('MenuSpecialsAdd-menu_specials-add'); // add
    $app->any('/MenuSpecialsView[/{id}]', MenuSpecialsController::class . ':view')->add(PermissionMiddleware::class)->setName('MenuSpecialsView-menu_specials-view'); // view
    $app->any('/MenuSpecialsEdit[/{id}]', MenuSpecialsController::class . ':edit')->add(PermissionMiddleware::class)->setName('MenuSpecialsEdit-menu_specials-edit'); // edit
    $app->any('/MenuSpecialsDelete[/{id}]', MenuSpecialsController::class . ':delete')->add(PermissionMiddleware::class)->setName('MenuSpecialsDelete-menu_specials-delete'); // delete
    $app->group(
        '/menu_specials',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', MenuSpecialsController::class . ':list')->add(PermissionMiddleware::class)->setName('menu_specials/list-menu_specials-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', MenuSpecialsController::class . ':add')->add(PermissionMiddleware::class)->setName('menu_specials/add-menu_specials-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', MenuSpecialsController::class . ':view')->add(PermissionMiddleware::class)->setName('menu_specials/view-menu_specials-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', MenuSpecialsController::class . ':edit')->add(PermissionMiddleware::class)->setName('menu_specials/edit-menu_specials-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', MenuSpecialsController::class . ':delete')->add(PermissionMiddleware::class)->setName('menu_specials/delete-menu_specials-delete-2'); // delete
        }
    );

    // periods
    $app->any('/PeriodsList[/{ID}]', PeriodsController::class . ':list')->add(PermissionMiddleware::class)->setName('PeriodsList-periods-list'); // list
    $app->any('/PeriodsAdd[/{ID}]', PeriodsController::class . ':add')->add(PermissionMiddleware::class)->setName('PeriodsAdd-periods-add'); // add
    $app->any('/PeriodsView[/{ID}]', PeriodsController::class . ':view')->add(PermissionMiddleware::class)->setName('PeriodsView-periods-view'); // view
    $app->any('/PeriodsEdit[/{ID}]', PeriodsController::class . ':edit')->add(PermissionMiddleware::class)->setName('PeriodsEdit-periods-edit'); // edit
    $app->any('/PeriodsDelete[/{ID}]', PeriodsController::class . ':delete')->add(PermissionMiddleware::class)->setName('PeriodsDelete-periods-delete'); // delete
    $app->group(
        '/periods',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{ID}]', PeriodsController::class . ':list')->add(PermissionMiddleware::class)->setName('periods/list-periods-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{ID}]', PeriodsController::class . ':add')->add(PermissionMiddleware::class)->setName('periods/add-periods-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{ID}]', PeriodsController::class . ':view')->add(PermissionMiddleware::class)->setName('periods/view-periods-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{ID}]', PeriodsController::class . ':edit')->add(PermissionMiddleware::class)->setName('periods/edit-periods-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{ID}]', PeriodsController::class . ':delete')->add(PermissionMiddleware::class)->setName('periods/delete-periods-delete-2'); // delete
        }
    );

    // places
    $app->any('/PlacesList', PlacesController::class . ':list')->add(PermissionMiddleware::class)->setName('PlacesList-places-list'); // list
    $app->group(
        '/places',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', PlacesController::class . ':list')->add(PermissionMiddleware::class)->setName('places/list-places-list-2'); // list
        }
    );

    // sheet1
    $app->any('/Sheet1List', Sheet1Controller::class . ':list')->add(PermissionMiddleware::class)->setName('Sheet1List-sheet1-list'); // list
    $app->group(
        '/sheet1',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', Sheet1Controller::class . ':list')->add(PermissionMiddleware::class)->setName('sheet1/list-sheet1-list-2'); // list
        }
    );

    // table_15
    $app->any('/Table15List', Table15Controller::class . ':list')->add(PermissionMiddleware::class)->setName('Table15List-table_15-list'); // list
    $app->group(
        '/table_15',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', Table15Controller::class . ':list')->add(PermissionMiddleware::class)->setName('table_15/list-table_15-list-2'); // list
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
