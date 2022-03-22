<?php

namespace PHPMaker2022\project1;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Routing\RouteContext;

/**
 * CORS middleware
 */
final class CorsMiddleware implements MiddlewareInterface
{
    public $Config;
    protected $Default = [
        "Access-Control-Allow-Origin" => "*",
        "Access-Control-Allow-Headers" => "",
        "Access-Control-Allow-Methods" => "GET, POST, PUT, PATCH, DELETE, OPTIONS",
        "Access-Control-Allow-Credentials" => true
    ];

    /**
     * Constructor
     */
    public function __construct($config = [])
    {
        $this->Config = array_merge($this->Default, $config);
    }

    /**
     * Invoke middleware
     *
     * @param ServerRequestInterface $request The request
     * @param RequestHandlerInterface $handler The handler
     *
     * @return ResponseInterface The response
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $response = $handler->handle($request);
        $headers = array_keys($this->Config);

        // Access-Control-Allow-Origin
        if (in_array("Access-Control-Allow-Origin", $headers)) {
            $response = $response->withHeader("Access-Control-Allow-Origin", $this->Config["Access-Control-Allow-Origin"] ?: "*");
        }

        // Access-Control-Allow-Methods
        if (in_array("Access-Control-Allow-Methods", $headers)) {
            if ($this->Config["Access-Control-Allow-Methods"]) {
                $response = $response->withHeader("Access-Control-Allow-Methods", $this->Config["Access-Control-Allow-Methods"]);
            } else { // Default
                $routeContext = RouteContext::fromRequest($request);
                $routingResults = $routeContext->getRoutingResults();
                $methods = $routingResults->getAllowedMethods();
                $response = $response->withHeader("Access-Control-Allow-Methods", implode(", ", array_unique($methods)));
            }
        }

        // Access-Control-Allow-Headers
        if (in_array("Access-Control-Allow-Headers", $headers)) {
            if ($this->Config["Access-Control-Allow-Headers"]) {
                $response = $response->withHeader("Access-Control-Allow-Headers", $this->Config["Access-Control-Allow-Headers"]);
            } else { // Default
                $requestHeaders = $request->getHeaderLine("Access-Control-Request-Headers");
                $response = $response->withHeader("Access-Control-Allow-Headers", $requestHeaders);
            }
        }

        // Access-Control-Allow-Credentials
        if ($this->Config["Access-Control-Allow-Credentials"] === true) {
            $response = $response->withHeader("Access-Control-Allow-Credentials", "true"); // The only valid value for this header is true (case-sensitive)
        }
        return $response;
    }
}
