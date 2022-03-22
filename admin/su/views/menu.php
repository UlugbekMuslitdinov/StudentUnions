<?php

namespace PHPMaker2021\project1;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(1, "mi_accounts", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "AccountsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_accounts_events", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "AccountsEventsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(3, "mi_admin_access", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "AdminAccessList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi_admin_group", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "AdminGroupList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_admin_routes", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "AdminRoutesList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(6, "mi_admin_screens", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "AdminScreensList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(7, "mi_admin_users", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "AdminUsersList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(8, "mi_box_choice", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "BoxChoiceList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(9, "mi_box_menu", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "BoxMenuList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(10, "mi_box_order", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "BoxOrderList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(11, "mi_catering", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "CateringList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(12, "mi_catering_event_requests", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "CateringEventRequestsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(13, "mi_catering_highland", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "CateringHighlandList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(14, "mi_catering_highland_burrito", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "CateringHighlandBurritoList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(15, "mi_catering_highland_menu", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "CateringHighlandMenuList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(16, "mi_event_orders", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "EventOrdersList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(17, "mi_event_timeline", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "EventTimelineList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(18, "mi_express_timeline", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "ExpressTimelineList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(19, "mi_feedback", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "FeedbackList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(20, "mi_mealpackage", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "MealpackageList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(21, "mi_restaurants", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "RestaurantsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(22, "mi_restaurants_slides", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "RestaurantsSlidesList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(23, "mi_room_reservation", $MenuLanguage->MenuPhrase("23", "MenuText"), $MenuRelativePath . "RoomReservationList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(24, "mi_room_reservation_media", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "RoomReservationMediaList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(25, "mi_room_reservation_media_options", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "RoomReservationMediaOptionsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(26, "mi_room_reservation_room", $MenuLanguage->MenuPhrase("26", "MenuText"), $MenuRelativePath . "RoomReservationRoomList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(27, "mi_room_reservation_room_options", $MenuLanguage->MenuPhrase("27", "MenuText"), $MenuRelativePath . "RoomReservationRoomOptionsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(28, "mi_rotation", $MenuLanguage->MenuPhrase("28", "MenuText"), $MenuRelativePath . "RotationList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(29, "mi_session_handler", $MenuLanguage->MenuPhrase("29", "MenuText"), $MenuRelativePath . "SessionHandlerList", -1, "", true, false, false, "", "", false);
echo $sideMenu->toScript();
