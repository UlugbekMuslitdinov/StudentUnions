<?php

namespace PHPMaker2022\project1;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;

/**
 * Class others controller
 */
class OthersController extends ControllerBase
{
    // error
    public function error(Request $request, Response $response, array $args): Response
    {
        global $Error;
        $Error = $this->container->get("flash")->getFirstMessage("error");
        return $this->runPage($request, $response, $args, "Error");
    }

    // Swagger
    public function swagger(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $basePath = $routeContext->getBasePath();
        $lang = $this->container->get("language");
        $title = $lang->phrase("ApiTitle");
        if (!$title || $title == "ApiTitle") {
            $title = "REST API"; // Default
        }
        $data = [
            "title" => $title,
            "version" => Config("API_VERSION"),
            "basePath" => $basePath
        ];
        $view = $this->container->get("view");
        return $view->render($response, "swagger.php", $data);
    }

    // Index
    public function index(Request $request, Response $response, array $args): Response
    {
        $url = "BegalcsvList";
        if ($url == "") {
            $error = [
                "statusCode" => "200",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => DeniedMessage()
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withHeader("Location", GetUrl("error"))->withStatus(302); // Redirect to error page
        }
        return $response->withHeader("Location", $url)->withStatus(302);
    }
}
