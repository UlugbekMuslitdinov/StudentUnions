<?php

namespace PHPMaker2022\project1;

use Slim\Routing\RouteContext;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpException;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpNotImplementedException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Handlers\ErrorHandler;
use Exception;
use Throwable;

class HttpErrorHandler extends ErrorHandler
{
    // Log error
    protected function logError(string $error): void
    {
        Log($error);
    }

    // Respond
    protected function respond(): ResponseInterface
    {
        global $Request, $Language, $Breadcrumb, $Error;
        $exception = $this->exception;
        $statusCode = $exception->getCode();
        $Language = Container("language");
        $type = $Language->phrase("Error");
        $description = $Language->phrase("ServerError");
        $error = [
            "statusCode" => 0,
            "error" => [
                "class" => "text-danger",
                "type" => $type,
                "description" => $description,
            ],
        ];
        if ($exception instanceof HttpException) {
            $description = $exception->getMessage();
            if (
                $exception instanceof HttpNotFoundException || // 404
                $exception instanceof HttpMethodNotAllowedException || // 405
                $exception instanceof HttpUnauthorizedException || // 401
                $exception instanceof HttpForbiddenException || // 403
                $exception instanceof HttpBadRequestException || // 400
                $exception instanceof HttpInternalServerErrorException || // 500
                $exception instanceof HttpNotImplementedException // 501
            ) {
                $type = $Language->phrase($statusCode);
                $description = $Language->phrase($statusCode . "Desc");
                $error = [
                    "statusCode" => $statusCode,
                    "error" => [
                        "class" => ($exception instanceof HttpInternalServerErrorException) ? "text-danger" : "text-warning",
                        "type" => $type,
                        "description" => $description,
                    ],
                ];
            }
        }
        if (!($exception instanceof HttpException) && ($exception instanceof Exception || $exception instanceof Throwable)) {
            if ($this->displayErrorDetails) {
                if ($exception instanceof \ErrorException) {
                    $severity = $exception->getSeverity();
                    if ($severity === E_WARNING) {
                        $error["error"]["class"] = "text-warning";
                        $error["error"]["type"] = $Language->phrase("Warning");
                    } elseif ($severity === E_NOTICE) {
                        $error["error"]["class"] = "text-warning";
                        $error["error"]["type"] = $Language->phrase("Notice");
                    }
                }
                $description = $exception->getFile() . "(" . $exception->getLine() . "): " . $exception->getMessage();
                $error["error"]["description"] = $description;
                $error["error"]["trace"] = $exception->getTraceAsString();
            }
        }

        // Create response object
        $response = $this->responseFactory->createResponse();

        // Show error as JSON
        $routeName = RouteName();
        if (
            IsApi() || // API request
            $routeName === null || // No route context
            preg_match('/\-preview(\-2)?$/', $routeName) || // Preview page
            $Request->getParam("modal") == "1" || // Modal request
            $Request->getParam("d") == "1" // Drilldown request
        ) {
            return $response->withJson(ConvertToUtf8($error), @$error["statusCode"] ?: null);
        }

        // Error page (Avoid infinite redirect)
        if ($routeName == "error") {
            if ($this->contentType == "text/html") { // HTML
                $view = Container("view");
                $Error = $error;
                $title = $Language->phrase("Error");
                $html = sprintf(
                    '<html>' .
                    '   <head>' .
                    '       <meta charset="utf-8">' .
                    '       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' .
                    '       <title>%s</title>' .
                    '       <link rel="stylesheet" href="adminlte3/css/' . CssFile("adminlte.css") . '">' .
                    '       <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">' .
                    '       <link rel="stylesheet" href="' . CssFile(Config("PROJECT_STYLESHEET_FILENAME")) . '">' .
                    '   </' . 'head>' .
                    '   <body class="container-fluid">' .
                    '       <div>%s</div>' .
                    '   </body>' .
                    '</html>',
                    $title,
                    $view->fetch("Error.php", $GLOBALS)
                );
                return $response->write($html);
            } else { // JSON
                return $response->withJson(ConvertToUtf8($error), @$error["statusCode"] ?: null);
            }
        }

        // Set flash message for next request
        Container("flash")->addMessage("error", $error);

        // Redirect
        return $response->withStatus(302)->withHeader("Location", GetUrl("error"));
    }
}
