<?php

namespace PHPMaker2022\project1;

use Slim\Routing\RouteContext;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Nyholm\Psr7\Factory\Psr17Factory;

/**
 * Permission middleware
 */
class ApiPermissionMiddleware
{
    // Handle slim request
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        global $UserProfile, $Security, $Language, $ResponseFactory;

        // Create Response
        $response = $ResponseFactory->createResponse();
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        $args = $route->getArguments();
        $name = $route->getName(); // (api/action)
        $isCustom = $name == "custom";
        $ar = explode("/", $name);
        $action = @$ar[1];

        // Validate CSRF
        $checkTokenActions = [
            Config("API_JQUERY_UPLOAD_ACTION"),
            Config("API_SESSION_ACTION"),
            Config("API_PROGRESS_ACTION"),
            Config("API_EXPORT_CHART_ACTION"),
            Config("API_2FA_ACTION")
        ];
        if (in_array($action, $checkTokenActions)) { // Check token
            if (Config("CHECK_TOKEN") && !ValidateCsrf()) {
                return $response->withStatus(401); // Not authorized
            }
        }

        // Get route data
        $params = $args["params"] ?? ""; // Get route
        if ($isCustom && !EmptyValue($params)) { // Other API actions
            $ar = explode("/", $params);
            $action = array_shift($ar);
            $params = implode("/", $ar);
        }

        // Set up Route
        $routeValues = $params == "" ? [] : explode("/", $params);
        $GLOBALS["RouteValues"] = array_merge([$action], $routeValues);
        $table = $isCustom ? "" : ($routeValues[0] ?? Post(Config("API_OBJECT_NAME"))); // Get from Post

        // Set up request
        $GLOBALS["Request"] = $request;

        // Set up language
        $Language = Container("language");

        // Load Security
        $UserProfile = Container("profile");
        $Security = Container("security");

        // No security
        $authorised = true;
        if (!$authorised) {
            return $response->withStatus(401); // Not authorized
        }

        // Handle request
        return $handler->handle($request);
    }
}
