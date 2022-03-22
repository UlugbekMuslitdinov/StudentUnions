<?php

namespace PHPMaker2022\mealplans;

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
$sideMenu->addMenuItem(1, "mi_bursar_payment", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "BursarPaymentList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_card_info", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "CardInfoList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(3, "mi_cashier_access", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "CashierAccessList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi_charge_payment", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "ChargePaymentList", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_config2", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "Config2List", -1, "", true, false, false, "", "", false);
$sideMenu->addMenuItem(6, "mi_control", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "ControlList", -1, "", true, false, false, "", "", false);
echo $sideMenu->toScript();
