<?php

namespace PHPMaker2022\project1;

use Slim\Routing\RouteContext;
use Slim\Exception\HttpBadRequestException;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Nyholm\Psr7\Factory\Psr17Factory;

/**
 * Permission middleware
 */
class PermissionMiddleware
{
    // Invoke
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        global $Language, $UserProfile, $Security, $ResponseFactory;

        // Non-API call
        $GLOBALS["IsApi"] = false;

        // Set up request
        $GLOBALS["Request"] = $request;
        $response = $ResponseFactory->createResponse();
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();
        //$basePath = $routeContext->getBasePath();
        //$routeParser = $routeContext->getRouteParser();
        $pageAction = $route->getName();
        $ar = explode("-", $pageAction);
        $currentPageName = @$ar[0]; // Get current page name
        $GLOBALS["RouteValues"] = [$currentPageName];
        if (count($ar) > 2) {
            list(, $table, $pageAction) = $ar;
        }

        // Set up Page ID
        if (!defined(PROJECT_NAMESPACE . "PAGE_ID")) {
            define(PROJECT_NAMESPACE . "PAGE_ID", $pageAction);
        }

        // Set up language
        $Language = Container("language");

        // Load Security
        $UserProfile = Container("profile");
        $Security = Container("security");

        // Set up current table
        if (isset($table) && $table != "") {
            $GLOBALS["Table"] = Container($table);
        }

        // Validate CSRF
        if (Config("CHECK_TOKEN") && IsPost() && !ValidateCsrf()) {
            throw new HttpBadRequestException($request, $Language->phrase("InvalidPostRequest"));
        }

        // Handle request
        return $handler->handle($request);
    }

    // Get response for redirection
    public function getRedirectResponse(Request $request, Response $response, string $url = "login")
    {
        $isModal = $request->getQueryParam("modal") == "1";
        if ($isModal) {
            if ($url == "login" && Config("USE_MODAL_LOGIN")) { // Redirect to login
                return $response->withHeader("Location", UrlFor($url))->withStatus(302);
            } else {
                return $response->withJson(["url" => UrlFor($url)]);
            }
        } else {
            return $response->withHeader("Location", UrlFor($url))->withStatus(302);
        }
    }
}
