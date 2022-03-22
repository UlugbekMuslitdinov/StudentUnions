<?php

namespace PHPMaker2021\project4;

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
        global $RELATIVE_PATH;
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler($RELATIVE_PATH . "log.log"));
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
    "session" => \DI\create(HttpSession::class),

    // Tables
    "building_access_request_access" => \DI\create(BuildingAccessRequestAccess::class),
    "building_access_request_locations" => \DI\create(BuildingAccessRequestLocations::class),
    "building_access_requests" => \DI\create(BuildingAccessRequests::class),
    "computer_access_requests" => \DI\create(ComputerAccessRequests::class),
    "departmental_access_request_account" => \DI\create(DepartmentalAccessRequestAccount::class),
    "departmental_access_requests" => \DI\create(DepartmentalAccessRequests::class),
    "departmental_account_requests" => \DI\create(DepartmentalAccountRequests::class),
    "exch_departments" => \DI\create(ExchDepartments::class),
    "groups" => \DI\create(Groups::class),
    "kronos_managers" => \DI\create(KronosManagers::class),
    "memberships" => \DI\create(Memberships::class),
    "nutrition_class" => \DI\create(NutritionClass::class),
    "permissions2" => \DI\create(Permissions2::class),
    "phone_requests" => \DI\create(PhoneRequests::class),
    "pos_access_requests" => \DI\create(PosAccessRequests::class),
    "print_logs" => \DI\create(PrintLogs::class),
    "resources" => \DI\create(Resources::class),
    "users" => \DI\create(Users::class),
    "web_support" => \DI\create(WebSupport::class),
    "web_support_files" => \DI\create(WebSupportFiles::class),
    "workstation_access_requests" => \DI\create(WorkstationAccessRequests::class),
];
