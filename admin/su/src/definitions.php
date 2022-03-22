<?php

namespace PHPMaker2021\project1;

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
    "accounts" => \DI\create(Accounts::class),
    "accounts_events" => \DI\create(AccountsEvents::class),
    "admin_access" => \DI\create(AdminAccess::class),
    "admin_group" => \DI\create(AdminGroup::class),
    "admin_routes" => \DI\create(AdminRoutes::class),
    "admin_screens" => \DI\create(AdminScreens::class),
    "admin_users" => \DI\create(AdminUsers::class),
    "box_choice" => \DI\create(BoxChoice::class),
    "box_menu" => \DI\create(BoxMenu::class),
    "box_order" => \DI\create(BoxOrder::class),
    "catering" => \DI\create(Catering::class),
    "catering_event_requests" => \DI\create(CateringEventRequests::class),
    "catering_highland" => \DI\create(CateringHighland::class),
    "catering_highland_burrito" => \DI\create(CateringHighlandBurrito::class),
    "catering_highland_menu" => \DI\create(CateringHighlandMenu::class),
    "event_orders" => \DI\create(EventOrders::class),
    "event_timeline" => \DI\create(EventTimeline::class),
    "express_timeline" => \DI\create(ExpressTimeline::class),
    "feedback" => \DI\create(Feedback::class),
    "mealpackage" => \DI\create(Mealpackage::class),
    "restaurants" => \DI\create(Restaurants::class),
    "restaurants_slides" => \DI\create(RestaurantsSlides::class),
    "room_reservation" => \DI\create(RoomReservation::class),
    "room_reservation_media" => \DI\create(RoomReservationMedia::class),
    "room_reservation_media_options" => \DI\create(RoomReservationMediaOptions::class),
    "room_reservation_room" => \DI\create(RoomReservationRoom::class),
    "room_reservation_room_options" => \DI\create(RoomReservationRoomOptions::class),
    "rotation" => \DI\create(Rotation::class),
    "session_handler" => \DI\create(SessionHandler::class),
];
