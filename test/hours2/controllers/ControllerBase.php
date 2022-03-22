<?php

namespace PHPMaker2022\project1;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;

/**
 * Controller base class
 */
class ControllerBase
{
    protected $container;

    // Constructor
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    // Run page
    protected function runPage(Request $request, Response $response, array $args, string $pageName, bool $useLayout = true): Response
    {
        global $RouteValues;

        // Route values
        // Note: $RouteValues[0] set up in PermissionMiddleWare
        $RouteValues = array_merge($RouteValues, $args, array_values($args));

        // Generate new CSRF token
        GenerateCsrf();

        // Create page
        $pageClass = PROJECT_NAMESPACE . $pageName;
        if (class_exists($pageClass)) {
            // Set up response object
            $GLOBALS["Response"] = &$response; // Note: global $Response does not work

            // Create page object
            $page = new $pageClass();
            $GLOBALS["Page"] = &$page;

            // Write header
            $cache = ($page->PageID != "preview") ? Config("CACHE") : false; // No cache for preview
            WriteHeader($cache);

            // Run the page
            $page->run();

            // Render page if not terminated
            if (!$page->isTerminated()) {
                $view = $this->container->get("view");
                if (
                    !$page->UseLayout || // No layout
                    property_exists($page, "IsModal") && $page->IsModal || // Modal
                    $request->getQueryParam(Config("PAGE_LAYOUT")) !== null // Multi-Column List page
                ) { // Partial view
                    $useLayout = false;
                }
                if ($useLayout) {
                    $view->setLayout("layout.php");
                }

                // Render view with $GLOBALS
                $page->RenderingView = true;
                $template = $page->View ?? $pageName . ".php"; // View
                $GLOBALS["Title"] = $GLOBALS["Title"] ?? $page->Title; // Title
                try {
                    return $view->render($response, $template, $GLOBALS);
                } finally {
                    $page->RenderingView = false;
                    $page->terminate(); // Terminate page and clean up
                }
            }
            return $response;
        }

        // Page not found
        throw new HttpNotFoundException($request);
    }
}
