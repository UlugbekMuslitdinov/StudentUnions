<?php

namespace PHPMaker2021\project2;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => function (ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    },
    "view" => function (ContainerInterface $c) {
        return new PhpRenderer("views/");
    },
    "flash" => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    },
    "audit" => function (ContainerInterface $c) {
        $logger = new Logger("audit"); // For audit trail
        $logger->pushHandler(new AuditTrailHandler("audit.log"));
        return $logger;
    },
    "log" => function (ContainerInterface $c) {
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler("log.log"));
        return $logger;
    },
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => function (ContainerInterface $c) {
        global $ResponseFactory;
        return new Guard($ResponseFactory, Config("CSRF_PREFIX"));
    },
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),

    // Tables
    "begalcsv" => \DI\create(Begalcsv::class),
    "exceptions" => \DI\create(Exceptions::class),
    "groups" => \DI\create(Groups::class),
    "hours" => \DI\create(Hours::class),
    "hours_catering" => \DI\create(HoursCatering::class),
    "hours_default" => \DI\create(HoursDefault::class),
    "hours_exception" => \DI\create(HoursException::class),
    "location" => \DI\create(Location::class),
    "location_descriptions" => \DI\create(LocationDescriptions::class),
    "meal_details" => \DI\create(MealDetails::class),
    "meal_times" => \DI\create(MealTimes::class),
    "menu_categories" => \DI\create(MenuCategories::class),
    "menu_items" => \DI\create(MenuItems::class),
    "menu_specials" => \DI\create(MenuSpecials::class),
    "periods" => \DI\create(Periods::class),
    "places" => \DI\create(Places::class),
    "sheet1" => \DI\create(Sheet1::class),
    "table_15" => \DI\create(Table15::class),
];
