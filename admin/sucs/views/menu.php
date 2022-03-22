<?php

namespace PHPMaker2021\project4;

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
$sideMenu->addMenuItem(1, "mi_building_access_request_access", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "BuildingAccessRequestAccessList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_building_access_request_locations", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "BuildingAccessRequestLocationsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(3, "mi_building_access_requests", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "BuildingAccessRequestsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi_computer_access_requests", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "ComputerAccessRequestsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_departmental_access_request_account", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "DepartmentalAccessRequestAccountList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(6, "mi_departmental_access_requests", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "DepartmentalAccessRequestsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(7, "mi_departmental_account_requests", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "DepartmentalAccountRequestsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(8, "mi_exch_departments", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "ExchDepartmentsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(9, "mi_groups", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "GroupsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(10, "mi_kronos_managers", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "KronosManagersList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(11, "mi_memberships", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "MembershipsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(12, "mi_nutrition_class", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "NutritionClassList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(13, "mi_permissions2", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "Permissions2List", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(14, "mi_phone_requests", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "PhoneRequestsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(15, "mi_pos_access_requests", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "PosAccessRequestsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(16, "mi_print_logs", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "PrintLogsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(17, "mi_resources", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "ResourcesList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(18, "mi_users", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "UsersList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(19, "mi_web_support", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "WebSupportList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(20, "mi_web_support_files", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "WebSupportFilesList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(21, "mi_workstation_access_requests", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "WorkstationAccessRequestsList", -1, "", true, false, false, "", "", false);
echo $sideMenu->toScript();
