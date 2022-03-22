<?php

namespace PHPMaker2021\project2;

use PHPMaker2021\project2\{UserProfile, Language, AdvancedSecurity, Timer, HttpErrorHandler};
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use DI\Container as Container;
use DI\ContainerBuilder;
use Selective\SameSiteCookie\SameSiteCookieConfiguration;
use Selective\SameSiteCookie\SameSiteCookieMiddleware;
use Selective\SameSiteCookie\SameSiteSessionMiddleware;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;
use Slim\Exception\HttpInternalServerErrorException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

// Auto load
require_once "../../vendor/autoload.php";

// Require files
$RELATIVE_PATH = "../";
require_once "../src/constants.php";
require_once "../src/config.php";
require_once "../src/phpfn.php";
require_once "../src/userfn.php";

// Environment
$isProduction = IsProduction();
$isDebug = IsDebug();

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

// Add definitions
$containerBuilder->addDefinitions("../src/definitions.php");
if (function_exists(PROJECT_NAMESPACE . "Container_Build")) {
    Container_Build($containerBuilder);
}

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();
$callableResolver = $app->getCallableResolver();

// Display error details
$displayErrorDetails = $isDebug;
$logErrors = $isDebug;
$logErrorDetails = $isDebug;

// Create request object from globals
$serverRequestCreator = ServerRequestCreatorFactory::create();
$Request = $serverRequestCreator->createServerRequestFromGlobals();

// Create error handler
$ResponseFactory = $app->getResponseFactory();
$errorHandler = new HttpErrorHandler($callableResolver, $ResponseFactory);

// Create shutdown handler
if (!$isDebug) {
    $shutdownHandler = new ShutdownHandler($Request, $errorHandler, $displayErrorDetails);
    register_shutdown_function($shutdownHandler);
}

// Add body parsing middleware
$app->addBodyParsingMiddleware();

// Add CORS middleware
$app->add(new CorsMiddleware());

// Add routing middleware (after CORS middleware so routing is performed first)
$app->addRoutingMiddleware();

// Set base path
$app->setBasePath(BasePath());

// Register routes (Add permission middleware)
(require_once "../src/apiroutes.php")($app);

// Enable same site cookie if CSRF token exists
if (HasParamWithPrefix(Config("CSRF_PREFIX"))) {
    $cookieConfiguration = new SameSiteCookieConfiguration();
    $cookieConfiguration->sameSite = Config("COOKIE_SAMESITE");
    $cookieConfiguration->httpOnly = Config("COOKIE_HTTP_ONLY");
    $cookieConfiguration->secure = Config("COOKIE_SECURE");
    $app->add(new SameSiteCookieMiddleware($cookieConfiguration));
    $app->add(new SameSiteSessionMiddleware($cookieConfiguration));
}

// Add error handling middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, $logErrors, $logErrorDetails);
$errorMiddleware->setDefaultErrorHandler($errorHandler);

// Run app
$app->run();
