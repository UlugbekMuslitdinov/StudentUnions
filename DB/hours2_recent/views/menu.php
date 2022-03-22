<?php

namespace PHPMaker2022\project2;

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
$sideMenu->addMenuItem(1, "mi_begalcsv", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "BegalcsvList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_exceptions", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "ExceptionsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(3, "mi_groups", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "GroupsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi_hours", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "HoursList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_hours_catering", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "HoursCateringList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(6, "mi_hours_default", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "HoursDefaultList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(7, "mi_hours_exception", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "HoursExceptionList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(8, "mi_location", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "LocationList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(9, "mi_location_descriptions", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "LocationDescriptionsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(10, "mi_meal_details", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "MealDetailsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(11, "mi_meal_times", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "MealTimesList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(12, "mi_menu_categories", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "MenuCategoriesList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(13, "mi_menu_items", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "MenuItemsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(14, "mi_menu_specials", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "MenuSpecialsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(15, "mi_periods", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "PeriodsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(16, "mi_places", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "PlacesList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(17, "mi_sheet1", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "Sheet1List", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(18, "mi_table15", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "Table15List", -1, "", true, false, false, "", "", false);
echo $sideMenu->toScript();
