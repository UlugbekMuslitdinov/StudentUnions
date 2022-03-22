<?php

namespace PHPMaker2021\project3;

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
$sideMenu->addMenuItem(1, "mi_current", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "CurrentList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_defaults", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "DefaultsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(3, "mi_dimensions", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "DimensionsList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi_displayblock", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "DisplayblockList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_history", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "HistoryList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(6, "mi_pages", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "PagesList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(7, "mi_randomfeed", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "RandomfeedList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(8, "mi_resource", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "ResourceList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(9, "mi_scriptcounter", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "ScriptcounterList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(10, "mi_sequentialfeed", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "SequentialfeedList", -1, "", true, false, false, "", "", false);
echo $sideMenu->toScript();
