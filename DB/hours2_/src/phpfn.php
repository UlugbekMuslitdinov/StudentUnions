<?php

/**
 * PHPMaker 2022 functions
 * Copyright (c) e.World Technology Limited. All rights reserved.
*/

namespace PHPMaker2022\project1;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Csrf\Guard;
use Slim\Routing\RouteContext;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\ParameterType;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Event\Listeners\OracleSessionInit;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Get/Set Configuration
 *
 * @return mixed
 */
function Config()
{
    global $CONFIG, $CONFIG_DATA;
    $numargs = func_num_args();
    $CONFIG_DATA = $CONFIG_DATA ?? new \Dflydev\DotAccessData\Data($CONFIG);
    $data = &$CONFIG_DATA;
    if ($numargs == 1) { // Get
        $name = func_get_arg(0);
        // Check global variables
        if (isset($GLOBALS[$name])) { // Allow overriding by global variable
            return $GLOBALS[$name];
        }
        // Check config data
        if ($data && $data->has($name)) {
            return $data->get($name);
        }
        // Fallback to $CONFIG
        if (isset($CONFIG[$name])) {
            return $CONFIG[$name];
        }
        // Check constants
        if (defined(PROJECT_NAMESPACE . $name)) {
            return constant(PROJECT_NAMESPACE . $name);
        }
        throw new \Exception("Undefined index: " . $name . " in configuration.");
    } elseif ($numargs == 2) { // Set
        list($name, $newValue) = func_get_args();
        $oldValue = $data->get($name);
        if (is_array($oldValue) && is_array($newValue)) {
            $data->set($name, array_replace_recursive($oldValue, $newValue));
        } else {
            $data->set($name, $newValue);
        }
    }
    return $CONFIG;
}

/**
 * Is development
 *
 * @return bool
 */
function IsDevelopment()
{
    return Config("ENVIRONMENT") == "development";
}

/**
 * Is production
 *
 * @return bool
 */
function IsProduction()
{
    return Config("ENVIRONMENT") == "production";
}

/**
 * Is debug mode
 *
 * @return bool
 */
function IsDebug()
{
    return Config("DEBUG");
}

/**
 * Get request object
 *
 * @return \Slim\Http\ServerRequest
 */
function Request()
{
    return $GLOBALS["Request"];
}

/**
 * Get response object (for API only)
 *
 * @return \Slim\Http\Response
 */
function Response()
{
    return $GLOBALS["Response"];
}

/**
 * Get Container
 *
 * @return Psr\Container\ContainerInterface
 */
function Container()
{
    global $container;
    if (!$container) {
        return null;
    }
    $numargs = func_num_args();
    if ($numargs == 1) { // Get
        $name = func_get_arg(0);
        if (is_string($name)) { // $name must be string
            if ($container->has($name)) {
                return $container->get($name);
            } else {
                $class = PROJECT_NAMESPACE . $name;
                if (class_exists($class)) {
                    $obj = new $class();
                    $container->set($name, $obj);
                    return $obj;
                }
            }
        }
        return null;
    } elseif ($numargs == 2) { // Set
        $container->set(func_get_arg(0), func_get_arg(1));
    }
}

/**
 * Route context
 *
 * @return \Slim\Routing\RouteContext
 */
function RouteContext()
{
    global $Request;
    $routeParser = $Request->getAttribute(RouteContext::ROUTE_PARSER);
    $routingResults = $Request->getAttribute(RouteContext::ROUTING_RESULTS);
    return ($routeParser !== null && $routingResults !== null) ? RouteContext::fromRequest($Request) : null;
}

/**
 * Current route
 *
 * @return \Slim\Interfaces\RouteInterface
 */
function GetRoute()
{
    $routeContext = RouteContext();
    return $routeContext ? $routeContext->getRoute() : null;
}

/**
 * Route parser
 *
 * @return \Slim\Routing\RouteParser
 */
function RouteParser()
{
    $routeContext = RouteContext();
    return $routeContext ? $routeContext->getRouteParser() : null;
}

/**
 * Route name
 *
 * @return null|string
 */
function RouteName()
{
    $route = GetRoute();
    return $route ? $route->getName() : null;
}

/**
 * Get URL from route name
 *
 * @param string $routeName Route name
 * @param array $data Route data
 * @param array $queryParams Query parameters
 * @return string URL
 */
function UrlFor(string $routeName, array $data = [], array $queryParams = []): string
{
    return RouteParser()->urlFor($routeName, $data, $queryParams);
}

/**
 * Get relative URL from route name
 *
 * @param string $routeName Route name
 * @param array $data Route data
 * @param array $queryParams Query parameters
 * @return string URL
 */
function RelativeUrlFor(string $routeName, array $data = [], array $queryParams = []): string
{
    return RouteParser()->relativeUrlFor($routeName, $data, $queryParams);
}

/**
 * Get full URL from route name
 *
 * @param string $routeName Route name
 * @param array $data Route data
 * @param array $queryParams Query parameters
 * @return string URL
 */
function FullUrlFor(string $routeName, array $data = [], array $queryParams = []): string
{
    global $Request;
    return RouteParser()->fullUrlFor($Request->GetUri(), $routeName, $data, $queryParams);
}

/**
 * Get base path
 *
 * @return string
 */
function BasePath($withTrailingDelimiter = false)
{
    $scriptName = ServerVar("SCRIPT_NAME");
    $basePath = str_replace("\\", "/", dirname($scriptName));
    if (strlen($basePath) > 1) {
        return $withTrailingDelimiter ? IncludeTrailingDelimiter($basePath, false) : $basePath;
    }
    return $withTrailingDelimiter ? IncludeTrailingDelimiter($basePath, false) : ""; // Root folder "/"
}

/**
 * Redirect to URL
 *
 * @param string $url URL
 * @return \Slim\Http\Response
 */
function Redirect($url)
{
    global $Response, $RouteValues, $ResponseFactory;
    $Response = $Response ?? $ResponseFactory->createResponse();
    $Response = $Response->withHeader("Location", $url)->withStatus(302);
    return $Response;
}

/**
 * Is API request
 *
 * @return bool
 */
function IsApi()
{
    return $GLOBALS["IsApi"] === true;
}

/**
 * Create JWT token
 *
 * @param string $userName User name
 * @param string $userID User ID
 * @param string $parentUserID Parent User ID
 * @param string $userLevelID User Level ID
 * @param int $minExpiry Minimum expiry time (seconds)
 * @return string JWT token
 */
function CreateJwt($userName, $userID, $parentUserID, $userLevelID, $minExpiry = 0)
{
    //$tokenId = base64_encode(mcrypt_create_iv(32));
    $tokenId = base64_encode(openssl_random_pseudo_bytes(32));
    $issuedAt = time();
    $notBefore = $issuedAt + Config("JWT.NOT_BEFORE_TIME"); // Adding not before time (seconds)
    $expire = $notBefore + Config("JWT.EXPIRE_TIME"); // Adding expire time (seconds)
    $serverName = ServerVar("SERVER_NAME");
    if ($minExpiry > 0) {
        $notBefore = 0;
        $expire = $minExpiry;
    }

    // Create the token as an array
    $ar = [
        "iat" => $issuedAt, // Issued at: time when the token was generated
        "jti" => $tokenId, // Json Token Id: a unique identifier for the token
        "iss" => $serverName, // Issuer
        "nbf" => $notBefore, // Not before
        "exp" => $expire, // Expire
        "security" => [ // Data related to the signer user
            "username" => $userName, // User name
            "userid" => $userID, // User ID
            "parentuserid" => $parentUserID, // Parent user ID
            "userlevelid" => $userLevelID // User Level ID
        ]
    ];
    $jwt = \Firebase\JWT\JWT::encode(
        $ar, // Data to be encoded in the JWT
        Config("JWT.SECRET_KEY"), // The signing key
        Config("JWT.ALGORITHM") // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
    );
    WriteCookie("JWT", $jwt, $expire, true, true); // Write HttpOnly cookie
    return ["JWT" => $jwt];
}

/**
 * Decode JWT token
 *
 * @param string $token Bearer token
 * @return array
 */
function DecodeJwt($token)
{
    try {
        $ar = (array)\Firebase\JWT\JWT::decode($token, Config("JWT.SECRET_KEY"), [Config("JWT.ALGORITHM")]);
        return (array)$ar["security"];
    } catch (\Firebase\JWT\BeforeValidException $e) {
        if (Config("DEBUG")) {
            return ["failureMessage" => "BeforeValidException: " . $e->getMessage()];
        }
    } catch (\Firebase\JWT\ExpiredException $e) {
        if (Config("DEBUG")) {
            return ["failureMessage" => "ExpiredException: " . $e->getMessage()];
        }
    } catch (\Throwable $e) {
        if (Config("DEBUG")) {
            return ["failureMessage" => "Exception: " . $e->getMessage()];
        }
    }
    return [];
}

/**
 * Get JWT token
 *
 * @return string JWT token
 */
function GetJwtToken()
{
    global $Security;
    $expiry = time() + max(Config("SESSION_TIMEOUT") * 60, Config("JWT.EXPIRE_TIME"), ini_get("session.gc_maxlifetime"));
    $token = isset($Security) ? $Security->createJwt($expiry) : CreateJwt(null, null, null, "-2", $expiry);
    return $token["JWT"] ?? "";
}

/**
 * Use Session
 *
 * @param Request $request Request
 * @return bool
 */
function UseSession($request)
{
    if (!HasParamWithPrefix(Config("CSRF_PREFIX"))) {
        return false;
    }
    $params = $request->getServerParams();
    $uri = $params["REQUEST_URI"] ?? ""; // e.g. /basepath/api/file
    $basePath = BasePath(true); // e.g. /basepath/api/
    $uri = preg_replace("/^" . preg_quote($basePath, "/")  . "/", "", $uri);
    $action = explode("/", $uri)[0];
    return !in_array($action, Config("SESSIONLESS_API_ACTIONS"));
}

/**
 * Get request method
 *
 * @return string Request method
 */
function RequestMethod()
{
    global $Request;
    return is_object($Request) ? $Request->getMethod() : ServerVar("REQUEST_METHOD");
}

/**
 * Is GET request
 *
 * @return bool
 */
function IsGet()
{
    return SameText(RequestMethod(), "GET");
}

/**
 * Is POST request
 *
 * @return bool
 */
function IsPost()
{
    return SameText(RequestMethod(), "POST");
}

/**
 * Has Param data with prefix
 *
 * @param string $prefix Prefix of parameter
 * @return bool
*/
function HasParamWithPrefix($prefix)
{
    return HasPostParamWithPrefix($prefix) || HasGetParamWithPrefix($prefix);
}

/**
 * Has querystring data with prefix
 *
 * @param string $prefix Prefix of parameter
 * @return bool
*/
function HasGetParamWithPrefix($prefix)
{
    global $Request;
    return ArrayKeyWithPrefix($Request->getQueryParams(), $prefix);
}

/**
 * Has post data with prefix
 *
 * @param string $prefix Prefix of paramter
 * @return bool
*/
function HasPostParamWithPrefix($prefix)
{
    global $Request;
    return ArrayKeyWithPrefix($Request->getParsedBody(), $prefix);
}

/**
 * Array key with prefix
 *
 * @param array $ar Array
 * @param string $prefix Prefix of paramter
 * @return bool
*/
function ArrayKeyWithPrefix($ar, $prefix)
{
    if (is_array($ar)) {
        foreach ($ar as $k => $v) {
            if (StartsString($prefix, $k)) {
                return true;
            }
        }
    }
    return false;
}

/**
 * Get querystring data
 *
 * @param string $name Name of parameter
 * @param mixed $default Default value if name not found
 * @return string
*/
function Get($name, $default = null)
{
    global $Request;
    if (is_object($Request)) {
        return $Request->getQueryParam($name, $default);
    }
    return $_GET[$name] ?? $default;
}

/**
 * Get post data
 *
 * @param string $name Name of paramter
 * @param mixed $default Default value if name not found
 * @return string
*/
function Post($name, $default = null)
{
    global $Request;
    if (is_object($Request)) {
        return $Request->getParsedBodyParam($name, $default);
    }
    return $_POST[$name] ?? $default;
}

/**
 * Get post/querystring data
 *
 * @param string $name Name of paramter
 * @param mixed $default Default value if name not found
 * @return string
*/
function Param($name, $default = null)
{
    global $Request;
    if (is_object($Request)) {
        return $Request->getParam($name, $default);
    }
    return $_POST[$name] ?? $_GET[$name] ?? $default;
}

/**
 * Get key data from Param("key")
 *
 * @param int $i The nth (0-based) key
 * @return string|null
 */
function Key($i = 0)
{
    $key = Param(Config("API_KEY_NAME"));
    if ($key !== null) {
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        return $keys[$i] ?? null;
    }
    return null;
}

/**
 * Get route data
 *
 * @param int|"key" $i The nth (0-based) route value or "key" (API only)
 * @return string|string[]|null
 */
function Route($i = null)
{
    $routeValues = $GLOBALS["RouteValues"] ?? [];
    if (IsApi() && $i === Config("API_KEY_NAME")) { // Get record key separated by key separator (for API "/file/object/field/key" action)
        $routeValues = array_slice($routeValues, 3);
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $routeValues);
    } elseif (is_string($i)) { // Get route value by name
        return $routeValues[$i] ?? null;
    } elseif (is_int($i)) { // Get route value by index
        if (IsApi() && in_array($routeValues[0], ["view", "edit", "delete"]) && ContainsString($routeValues[2], Config("COMPOSITE_KEY_SEPARATOR"))) { // Composite key
            $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $routeValues[2]);
            return $keys[$i - 2] ?? null;
        } else {
            return $routeValues[$i] ?? null;
        }
    } elseif ($i === null) { // Get all route values as array
        return $routeValues;
    }
    return null;
}

/**
 * Write data to response
 *
 * @param mixed $data Data being outputted
 * @return void
 */
function Write($data)
{
    global $Page, $Response;
    if (is_object($Response) && !($Page && $Page->RenderingView)) {
        $Response->getBody()->write($data);
    } else {
        echo $data;
    }
}

/**
 * Set HTTP response status code
 *
 * @param int $code Response status code
 * @return void
 */
function SetStatus($code)
{
    global $Response;
    if (is_object($Response)) {
        $Response = $Response->withStatus($code);
    } else {
        http_response_code($code);
    }
}

/**
 * Output JSON data (UTF-8)
 *
 * @param mixed $data Data to be encoded and outputted (non UTF-8)
 * @param int $encodingOptions optional JSON encoding options (same as that of json_encode())
 * @return void
 */
function WriteJson($data, $encodingOptions = 0)
{
    global $Response;
    $ar = IsApi() ? ["version" => PRODUCT_VERSION] : []; // If API, output as object
    if (is_array($data) && !array_key_exists(0, $data) && count($data) > 0) { // Associative array
        $data = array_merge($data, $ar);
    }
    $json = json_encode(ConvertToUtf8($data), $encodingOptions);
    if ($json === false) {
        $json = json_encode(["json_encode_error" => json_last_error()], $encodingOptions);
    }
    if (is_object($Response)) {
        $Response->getBody()->write($json);
        $Response = $Response->withHeader("Content-Type", "application/json; charset=utf-8");
    } else {
        if (!Config("DEBUG") && ob_get_length()) {
            ob_end_clean();
        }
        header("Content-Type: application/json; charset=utf-8");
        echo $json;
    }
}

/**
 * Add header
 *
 * @param string $name Header name
 * @param string $value Header value
 * @param bool $replace optional Replace a previous similar header, or add a second header of the same type. Default is true.
 * @return void
 */
function AddHeader($name, $value, $replace = true)
{
    global $Response;
    if (is_object($Response)) {
        if ($replace) { // Replace
            $Response = $Response->withHeader($name, $value);
        } else { // Append
            $Response = $Response->withAddedHeader($name, $value);
        }
    } else {
        header($name . ": " . $value, $replace);
    }
}

/**
 * Remove header
 *
 * @param string $name Header name to be removed
 * @return void
 */
function RemoveHeader($name)
{
    global $Response;
    if (is_object($Response)) {
        $Response = $Response->withoutHeader($name);
    } else {
        header_remove($name);
    }
}

/**
 * Read cookie
 *
 * @param string $name Cookie name
 * @return string
 */
function ReadCookie($name)
{
    $ar = \Delight\Cookie\Cookie::get(PROJECT_NAME);
    return $ar[$name] ?? "";
}

/**
 * User has given consent to track cookie
 *
 * @return bool
 */
function CanTrackCookie()
{
    return ReadCookie(Config("COOKIE_CONSENT_NAME")) == "1";
}

/**
 * Create cookie
 *
 * @param string $name Cookie name
 * @param string $value Cookie value
 * @param int $expiry optional Cookie expiry time
 * @param bool $httpOnly optional HTTP only
 * @return \Delight\Cookie\Cookie
 */
function CreateCookie($name, $value, $expiry = -1, $httpOnly = null)
{
    $expiry = ($expiry > -1) ? $expiry : Config("COOKIE_EXPIRY_TIME");
    $params = session_get_cookie_params();
    $cookie = new \Delight\Cookie\Cookie(PROJECT_NAME . "[" . $name . "]");
    $cookie->setValue($value);
    $cookie->setExpiryTime($expiry);
    $cookie->setSameSiteRestriction(Config("COOKIE_SAMESITE"));
    $cookie->setHttpOnly($httpOnly ?? Config("COOKIE_HTTP_ONLY"));
    $cookie->setSecureOnly(Config("COOKIE_SAMESITE") == "None" || IsHttps() && Config("COOKIE_SECURE"));
    $cookie->setDomain($params["domain"]);
    $cookie->setPath($params["path"]);
    return $cookie;
}

/**
 * Delete cookie
 *
 * @param string $name Cookie name
 * @return string
 */
function DeleteCookie($name)
{
    if (\Delight\Cookie\Cookie::exists($name)) {
        $cookie = CreateCookie($name, "");
        $cookie->delete();
    }
}

/**
 * Create consent cookie
 *
 * @return string
 */
function CreateConsentCookie()
{
    $cookie = CreateCookie(Config("COOKIE_CONSENT_NAME"), 1, -1, false); // httpOnly must be false
    return str_replace(\Delight\Cookie\Cookie::HEADER_PREFIX, "", (string)$cookie);
}

/**
 * Write cookie
 *
 * @param string $name Cookie name
 * @param string $value Cookie value
 * @param int $expiry optional Cookie expiry time. Default is Config("COOKIE_EXPIRY_TIME")
 * @param bool $essential optional Essential cookie, set even without user consent. Default is true.
 * @param bool $httpOnly optional HTTP only. Default is false.
 * @return void
 */
function WriteCookie($name, $value, $expiry = -1, $essential = true, $httpOnly = false)
{
    if ($essential || CanTrackCookie()) {
        $cookie = CreateCookie($name, $value, $expiry, $httpOnly);
        $cookie->save();
    }
}

/**
 * Get page object
 *
 * @param string $name Page name or table name
 * @return object
 */
function &Page($name = "")
{
    if (!$name) {
        return $GLOBALS["Page"];
    }
    foreach ($GLOBALS as $k => $v) {
        if (is_object($v) && $k == $name) {
            return $GLOBALS[$k];
        }
    }
    $res = null;
    return $res;
}

/**
 * Get current language ID
 *
 * @return string
 */
function CurrentLanguageID()
{
    return $GLOBALS["CurrentLanguage"];
}

/**
 * Is RTL language
 *
 * @return bool
 */
function IsRTL()
{
    global $CurrentLanguage;
    $lang = explode("-", str_replace("_", "-", $CurrentLanguage))[0];
    return in_array($lang, Config("RTL_LANGUAGES"));
}

// Get current project ID
function CurrentProjectID()
{
    if (isset($GLOBALS["Page"])) {
        return $GLOBALS["Page"]->ProjectID;
    }
    return PROJECT_ID;
}

/**
 * Get current export file name
 *
 * @return string
 */
function CurrentExportFile()
{
    return $GLOBALS["ExportFileName"];
}

/**
 * Get current page object
 *
 * @return object
 */
function &CurrentPage()
{
    return $GLOBALS["Page"];
}

/**
 * Get user table object
 *
 * @return object
 */
function &UserTable()
{
    return $GLOBALS["UserTable"];
}

// Get current main table object
function &CurrentTable()
{
    return $GLOBALS["Table"];
}

// Get current main table name
function CurrentTableName()
{
    $tbl = &CurrentTable();
    return $tbl ? $tbl->TableName : "";
}

/**
 * Get user table object
 *
 * @param string $tblVar Table Var
 * @return string
 */
function GetTableName($tblVar)
{
    global $USER_LEVEL_TABLES;
    $cnt = count($USER_LEVEL_TABLES);
    for ($i = 0; $i < $cnt; $i++) {
        if ($USER_LEVEL_TABLES[$i][1] == $tblVar) {
            return $USER_LEVEL_TABLES[$i][0]; // Return table name
        }
    }
    return $tblVar; // Not found
}

/**
 * Get current master table object
 *
 * @return object
 */
function &CurrentMasterTable()
{
    $res = null;
    $tbl = &CurrentTable();
    if ($tbl && method_exists($tbl, "getCurrentMasterTable") && $tbl->getCurrentMasterTable() != "") {
        $res = $GLOBALS[$tbl->getCurrentMasterTable()];
    }
    return $res;
}

/**
 * Get current detail table object
 *
 * @return object
 */
function &CurrentDetailTable()
{
    return $GLOBALS["Grid"];
}

/**
 * Get foreign key url
 *
 * @param string $name Key name
 * @param string $val Key value
 * @param string $dateFormat Date format
 * @return string
 */
function GetForeignKeyUrl($name, $val, $dateFormat = null)
{
    $url = $name . "=";
    if ($val === null) {
        $val = Config("NULL_VALUE");
    } elseif ($val === "") {
        $val = Config("EMPTY_VALUE");
    } elseif ($dateFormat !== null && is_numeric($dateFormat)) {
        $val = UnFormatDateTime($val, $dateFormat);
    }
    $url .= urlencode($val);
    return $url;
}

/**
 * Get foreign key SQL
 *
 * @param string $name Field name
 * @param string $val Key value
 * @param string $fldTypeName Field type name
 * @param string $dbid Dbid
 * @return string
 */
function GetForeignKeySql($name, $val, $fldTypeName, $dbid)
{
    if ($val == Config("NULL_VALUE")) {
        return $name . " IS NULL";
    } elseif ($val == Config("EMPTY_VALUE")) {
        $val = "";
    }
    return $name . "=" . QuotedValue($val, $fldTypeName, $dbid);
}

/**
 * Get foreign key value
 *
 * @param string $val Key value
 * @return string
 */
function GetForeignKeyValue($val)
{
    if ($val == Config("NULL_VALUE")) {
        return null;
    } elseif ($val == Config("EMPTY_VALUE")) {
        return "";
    }
    return $val;
}

// Validate CSRF Token
function ValidateCsrf()
{
    global $TokenNameKey, $TokenName, $TokenValueKey, $TokenValue;
    $csrf = Container("csrf");
    $TokenNameKey = $csrf->getTokenNameKey();
    $TokenValueKey = $csrf->getTokenValueKey();
    $TokenName = Param($TokenNameKey);
    $TokenValue = Param($TokenValueKey);
    return !empty($TokenName) && !empty($TokenValue) ? $csrf->validateToken($TokenName, $TokenValue) : false;
}

// Generate CSRF Token
function GenerateCsrf()
{
    global $csrf, $TokenNameKey, $TokenName, $TokenValueKey, $TokenValue;
    $csrf = Container("csrf");
    $token = $csrf->generateToken();
    $TokenNameKey = $csrf->getTokenNameKey();
    $TokenValueKey = $csrf->getTokenValueKey();
    $TokenName = $csrf->getTokenName();
    $TokenValue = $csrf->getTokenValue();
    return $token;
}

/**
 * Export document classes
 */

// Get export document object
function &GetExportDocument(&$tbl, $style)
{
    $inst = null;
    $type = strtolower($tbl->Export);
    $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $type);
    if (class_exists($class)) {
        $inst = new $class($tbl, $style);
    }
    return $inst;
}

// Get file IMG tag (for export to email or PDF only)
function GetFileImgTag($fld, $fn)
{
    $html = "";
    if ($fn != "") {
        if ($fld->UploadMultiple) {
            $wrkfiles = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $fn);
            foreach ($wrkfiles as $wrkfile) {
                if ($wrkfile != "") {
                    if ($html != "") {
                        $html .= "<br>";
                    }
                    $html .= "<img class=\"ew-image\" src=\"" . $wrkfile . "\" alt=\"\">";
                }
            }
        } else {
            $html = "<img class=\"ew-image\" src=\"" . $fn . "\" alt=\"\">";
        }
    }
    return $html;
}

// Get file A tag
function GetFileATag($fld, $fn)
{
    $wrkfiles = [];
    $wrkpath = "";
    $html = "";
    if ($fld->DataType == DATATYPE_BLOB) {
        if (!EmptyValue($fld->Upload->DbValue)) {
            $wrkfiles = [$fn];
        }
    } elseif ($fld->UploadMultiple) {
        $wrkfiles = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $fn);
        $pos = strrpos($wrkfiles[0], '/');
        if ($pos !== false) {
            $wrkpath = substr($wrkfiles[0], 0, $pos + 1); // Get path from first file name
            $wrkfiles[0] = substr($wrkfiles[0], $pos + 1);
        }
    } else {
        if (!EmptyValue($fld->Upload->DbValue)) {
            $wrkfiles = [$fn];
        }
    }
    foreach ($wrkfiles as $wrkfile) {
        if ($wrkfile != "") {
            if ($html != "") {
                $html .= "<br>";
            }
            $attrs = ["href" => FullUrl($wrkpath . $wrkfile, "href")];
            $html .= HtmlElement("a", $attrs, $fld->caption());
        }
    }
    return $html;
}

// Get file temp image
function GetFileTempImage($fld, $val)
{
    if ($fld->DataType == DATATYPE_BLOB) {
        if (!EmptyValue($fld->Upload->DbValue)) {
            $tmpimage = $fld->Upload->DbValue;
            if ($fld->ImageResize) {
                ResizeBinary($tmpimage, $fld->ImageWidth, $fld->ImageHeight);
            }
            return TempImage($tmpimage);
        }
        return "";
    } elseif ($fld->UploadMultiple) {
        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
        $cnt = count($files);
        $images = "";
        for ($i = 0; $i < $cnt; $i++) {
            if ($files[$i] != "") {
                $tmpimage = file_get_contents($fld->physicalUploadPath() . $files[$i]);
                if ($fld->ImageResize) {
                    ResizeBinary($tmpimage, $fld->ImageWidth, $fld->ImageHeight);
                }
                if ($images != "") {
                    $images .= Config("MULTIPLE_UPLOAD_SEPARATOR");
                }
                $images .= TempImage($tmpimage);
            }
        }
        return $images;
    } else {
        $tmpimage = file_get_contents($fld->physicalUploadPath() . $val);
        if ($fld->ImageResize) {
            ResizeBinary($tmpimage, $fld->ImageWidth, $fld->ImageHeight);
        }
        return TempImage($tmpimage);
    }
}

// Get file image
function GetFileImage($fld, $val, $width = 0, $height = 0, $crop = false)
{
    $image = "";
    $file = "";
    if ($fld->DataType == DATATYPE_BLOB) {
        $image = $val;
    } elseif ($fld->UploadMultiple) {
        $file = $fld->physicalUploadPath() . (explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val)[0] ?? "");
    } else {
        $file = $fld->physicalUploadPath() . $val;
    }
    if (is_file($file)) {
        $image = file_get_contents($file);
    }
    if (!EmptyValue($image) && $width > 0) {
        $func = function ($phpthumb) use ($width, $height) {
            $phpthumb->adaptiveResize($width, $height);
        };
        $plugins = $crop ? [$func] : [];
        ResizeBinary($image, $width, $height, $plugins);
        return $image;
    }
    return "";
}

// Get API action URL // PHP
function GetApiUrl($action, $query = "")
{
    return GetUrl(Config("API_URL") . $action) . ($query ? "?" : "") . $query;
}

/**
 * Get file upload URL
 *
 * @param DbField $fld Field object
 * @param mixed $val Field value
 * @param array $options optional {
 *  @var bool "resize" Resize the image
 *  @var bool "crop" Crop image
 *  @var bool "encrypt" Encrypt file path
 *  @var bool "urlencode" URL-encode file path
 * }
 * @return string URL
 */
function GetFileUploadUrl($fld, $val, $options = [])
{
    $opts = [
        "resize" => false,
        "crop" => false,
        "encrypt" => null,
        "urlencode" => true
    ];
    if (is_bool($options)) {
        $opts["resize"] = $options;
    } elseif (is_array($options)) {
        $opts = array_merge($opts, $options);
    }
    extract($opts);
    if (!EmptyString($val)) {
        $sessionId = session_id();
        $fileUrl = GetApiUrl(Config("API_FILE_ACTION")) . "/";
        if ($fld->DataType == DATATYPE_BLOB) {
            $tableVar = !EmptyString($fld->SourceTableVar) ? $fld->SourceTableVar : $fld->TableVar;
            $fn = $fileUrl . rawurlencode($tableVar) . "/" . rawurlencode($fld->Param) . "/" . rawurlencode($val);
            if ($resize) {
                $fn .= "?resize=1&width=" . $fld->ImageWidth . "&height=" . $fld->ImageHeight . ($crop ? "&crop=1" : "");
            }
        } else {
            $encrypt = $encrypt ?? Config("ENCRYPT_FILE_PATH");
            $path = ($encrypt || $resize) ? $fld->physicalUploadPath() : $fld->hrefPath();
            $key = Config("RANDOM_KEY") . $sessionId;
            if ($encrypt) {
                $fn = $fileUrl . $fld->TableVar . "/" . Encrypt($path . $val, $key);
                if ($resize) {
                    $fn .= "?width=" . $fld->ImageWidth . "&height=" . $fld->ImageHeight . ($crop ? "&crop=1" : "");
                }
            } elseif ($resize) {
                $fn = $fileUrl . $fld->TableVar . "/" . Encrypt($path . $val, $key) .
                    "?width=" . $fld->ImageWidth . "&height=" . $fld->ImageHeight . ($crop ? "&crop=1" : ""); // Encrypt the physical path
            } else {
                $fn = IsRemote($path) ? $path : UrlEncodeFilePath($path);
                $fn .= UrlEncodeFilePath($val, !IsRemote($path)); // S3 expects "+" in file name
                $fn = GetUrl($fn);
            }
        }
        $fn .= ContainsString($fn, "?") ? "&" : "?";
        $fn .= "session=" . Encrypt($sessionId) . "&" . $GLOBALS["TokenNameKey"] . "=" . $GLOBALS["TokenName"] . "&" . $GLOBALS["TokenValueKey"] . "=" . $GLOBALS["TokenValue"];
        return $fn;
    }
    return "";
}

/**
 * URL encode file path
 *
 * @param string $path File path
 * @param bool $raw Use rawurlencode() or else urlencode()
 * @return string
 */
function UrlEncodeFilePath($path, $raw = true)
{
    $ar = explode("/", $path);
    $scheme = parse_url($path, PHP_URL_SCHEME);
    foreach ($ar as &$c) {
        if ($c != $scheme . ":") {
            $c = $raw ? rawurlencode($c) : urlencode($c);
        }
    }
    return implode("/", $ar);
}

// Get file view tag
function GetFileViewTag(&$fld, $val, $tooltip = false)
{
    global $Page;
    if (!EmptyString($val)) {
        $val = $fld->htmlDecode($val);
        if ($fld->DataType == DATATYPE_BLOB) {
            $wrknames = [$val];
            $wrkfiles = [$val];
        } elseif ($fld->UploadMultiple) {
            $wrknames = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
            $wrkfiles = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $fld->htmlDecode($fld->Upload->DbValue));
        } else {
            $wrknames = [$val];
            $wrkfiles = [$fld->htmlDecode($fld->Upload->DbValue)];
        }
        $multiple = (count($wrkfiles) > 1);
        $href = $tooltip ? "" : $fld->HrefValue;
        $isLazy = $tooltip ? false : IsLazy();
        $tags = [];
        $wrkcnt = 0;
        foreach ($wrkfiles as $wrkfile) {
            $tag = "";
            if (
                $Page && ($Page->TableType == "REPORT" &&
                ($Page->isExport("excel") && Config("USE_PHPEXCEL") ||
                $Page->isExport("word") && Config("USE_PHPWORD")) ||
                $Page->TableType != "REPORT" && ($Page->CustomExport == "pdf" || $Page->CustomExport == "email"))
            ) {
                $fn = GetFileTempImage($fld, $wrkfile);
            } else {
                $fn = GetFileUploadUrl($fld, $wrkfile, ["resize" => $fld->ImageResize]);
            }
            if ($fld->ViewTag == "IMAGE" && ($fld->IsBlobImage || IsImageFile($wrkfile))) { // Image
                $fld->ViewAttrs->appendClass($fld->ImageCssClass);
                if ($isLazy) {
                    $fld->ViewAttrs->appendClass("ew-lazy");
                }
                if ($href == "" && !$fld->UseColorbox) {
                    if ($fn != "") {
                        if ($isLazy) {
                            $tag = '<img loading="lazy" alt="" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="' . $fn . '"' . $fld->viewAttributes() . '>';
                        } else {
                            $tag = '<img alt="" src="' . $fn . '"' . $fld->viewAttributes() . '>';
                        }
                    }
                } else {
                    if ($fld->UploadMultiple && ContainsString($href, '%u')) {
                        $fld->HrefValue = str_replace('%u', GetFileUploadUrl($fld, $wrkfile), $href);
                    }
                    if ($fn != "") {
                        if ($isLazy) {
                            $tag = '<a' . $fld->linkAttributes() . '><img loading="lazy" alt="" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="' . $fn . '"' . $fld->viewAttributes() . '></a>';
                        } else {
                            $tag = '<a' . $fld->linkAttributes() . '><img alt="" src="' . $fn . '"' . $fld->viewAttributes() . '></a>';
                        }
                    }
                }
            } else { // Non image
                if ($fld->DataType == DATATYPE_BLOB) {
                    $url = $href;
                    $name = ($fld->Upload->FileName != "") ? $fld->Upload->FileName : $fld->caption();
                    $ext = str_replace(".", "", ContentExtension($fld->Upload->DbValue));
                } else {
                    $url = GetFileUploadUrl($fld, $wrkfile);
                    $cnt = count($wrknames);
                    $name = $wrknames[$wrkcnt] ?? $wrknames[$cnt - 1];
                    $pathinfo = pathinfo($wrkfile);
                    $ext = strtolower(@$pathinfo["extension"]);
                }
                $isPdf = SameText($ext, "pdf");
                if ($url != "") {
                    $fld->LinkAttrs->removeClass("ew-lightbox"); // Remove colorbox class
                    if ($fld->UploadMultiple && ContainsString($href, "%u")) {
                        $fld->HrefValue = str_replace("%u", $url, $href);
                    }
                    if (Config("EMBED_PDF") && $isPdf) {
                        $pdfFile = $fld->physicalUploadPath() . $wrkfile;
                        if (IsRemote($pdfFile) || file_exists($pdfFile)) {
                            $tag = '<div class="ew-pdfobject" data-url="' . $url . '">' . $tag . '</div>';
                        }
                    } else {
                        if ($ext) {
                            $fld->LinkAttrs["data-extension"] = $ext;
                        }
                        $tag = "<a" . $fld->linkAttributes() . ">" . $name . "</a>";
                    }
                }
            }
            if ($tag != "") {
                $tags[] = $tag;
            }
            $wrkcnt += 1;
        }
        if ($multiple && count($tags) > 1) {
            return '<div class="d-flex flex-row ew-images">' . implode('', $tags) . '</div>';
        }
        return implode('', $tags);
    }
    return "";
}

// Get image view tag
function GetImageViewTag(&$fld, $val)
{
    if (!EmptyString($val)) {
        $href = $fld->HrefValue;
        $image = $val;
        if ($val && !ContainsString($val, "://") && !ContainsString($val, "\\") && !ContainsText($val, "javascript:")) {
            $fn = GetImageUrl($fld, $val, ["resize" => $fld->ImageResize]);
        } else {
            $fn = $val;
        }
        if (IsImageFile($val)) { // Image
            $fld->ViewAttrs->appendClass($fld->ImageCssClass);
            if (IsLazy()) {
                $fld->ViewAttrs->appendClass("ew-lazy");
            }
            if ($href == "" && !$fld->UseColorbox) {
                if ($fn != "") {
                    if (IsLazy()) {
                        $image = '<img loading="lazy" alt="" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="' . $fn . '"' . $fld->viewAttributes() . '>';
                    } else {
                        $image = '<img alt="" src="' . $fn . '"' . $fld->viewAttributes() . '>';
                    }
                }
            } else {
                if ($fn != "") {
                    if (IsLazy()) {
                        $image = '<a' . $fld->linkAttributes() . '><img loading="lazy" alt="" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="' . $fn . '"' . $fld->viewAttributes() . '></a>';
                    } else {
                        $image = '<a' . $fld->linkAttributes() . '><img alt="" src="' . $fn . '"' . $fld->viewAttributes() . '></a>';
                    }
                }
            }
        } else {
            $name = $val;
            if ($href != "") {
                $image = "<a" . $fld->linkAttributes() . ">" . $name . "</a>";
            } else {
                $image = $name;
            }
        }
        return $image;
    }
    return "";
}

/**
 * Get image URL
 *
 * @param DbField $fld Field object
 * @param mixed $val Field value
 * @param array $options optional {
 *  @var bool "resize" Resize the image
 *  @var bool "crop" Crop image
 *  @var bool "encrypt" Encrypt file path
 *  @var bool "urlencode" URL-encode file path
 * }
 * @return string URL
 */
function GetImageUrl($fld, $val, $options = [])
{
    $opts = [
        "resize" => false,
        "crop" => false,
        "encrypt" => null,
        "urlencode" => true
    ];
    if (is_bool($options)) {
        $opts["resize"] = $options;
    } elseif (is_array($options)) {
        $opts = array_merge($opts, $options);
    }
    extract($opts);
    if (!EmptyString($val)) {
        $sessionId = session_id();
        $key = Config("RANDOM_KEY") . $sessionId;
        $sessionQry = "session=" . Encrypt($sessionId) . "&" . $GLOBALS["TokenNameKey"] . "=" . $GLOBALS["TokenName"] . "&" . $GLOBALS["TokenValueKey"] . "=" . $GLOBALS["TokenValue"];
        $fileUrl = GetApiUrl(Config("API_FILE_ACTION")) . "/";
        $encrypt = ($encrypt === null) ? Config("ENCRYPT_FILE_PATH") : $encrypt;
        $path = ($encrypt || $resize) ? $fld->physicalUploadPath() : $fld->hrefPath();
        if ($encrypt) {
            $key = Config("RANDOM_KEY") . $sessionId;
            $fn = $fileUrl . $fld->TableVar . "/" . Encrypt($path . $val, $key) . "?" . $sessionQry;
            if ($resize) {
                $fn .= "&width=" . $fld->ImageWidth . "&height=" . $fld->ImageHeight . ($crop ? "&crop=1" : "");
            }
        } elseif ($resize) {
            $fn = $fileUrl . $fld->TableVar . "/" . Encrypt($path . $val, $key) . "?" . $sessionQry .
                "&width=" . $fld->ImageWidth . "&height=" . $fld->ImageHeight . ($crop ? "&crop=1" : "");
        } else {
            $fn = $val;
            if ($urlencode) {
                $fn = UrlEncodeFilePath($fn);
            }
            $fn = GetUrl($fn);
        }
        return $fn;
    }
    return "";
}

// Check if image file
function IsImageFile($fn)
{
    if ($fn != "") {
        $ar = parse_url($fn);
        if ($ar && array_key_exists("query", $ar)) { // Thumbnail URL
            if ($q = parse_str($ar["query"])) {
                $fn = $q["fn"];
            }
        }
        $pathinfo = pathinfo($fn);
        $ext = strtolower(@$pathinfo["extension"]);
        return in_array($ext, explode(",", Config("IMAGE_ALLOWED_FILE_EXT")));
    }
    return false;
}

// Check if lazy loading images
function IsLazy()
{
    global $ExportType, $CustomExportType;
    return Config("LAZY_LOAD") && ($ExportType == "" || $ExportType == "print" && ($CustomExportType == "" || $CustomExportType == "print"));
}

// Write HTTP header
function WriteHeader($cache)
{
    global $Response;
    $export = Get("export");
    $cacheProvider = Container("cache");
    if ($cache || IsHttps() && $export && !SameText($export, "print")) { // Allow cache
        $Response = $cacheProvider->allowCache($Response, "private", 86400, true);
    } else { // No cache
        $Response = $cacheProvider->denyCache($Response);
        $Response = $cacheProvider->withExpires($Response, "Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        $Response = $cacheProvider->withLastModified($Response, gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
    }
    $Response = $Response->withHeader("X-UA-Compatible", "IE=edge");
    if (!$export || SameText($export, "print")) {
        $ct = "text/html";
        $charset = Config("PROJECT_CHARSET");
        if ($charset != "") {
            $ct .= "; charset=" . $charset;
        }
        $Response = $Response->withHeader("Content-Type", $ct); // Charset
    }
}

// Get content file extension
function ContentExtension(&$data)
{
    $ct = ContentType($data);
    if ($ct) {
        $ext = array_search($ct, Config("MIME_TYPES"));
        if ($ext) {
            return "." . $ext;
        }
    }
    return ""; // Unknown extension
}

/**
 * Get content type
 * http://en.wikipedia.org/wiki/List_of_file_signatures
 * https://www.garykessler.net/library/file_sigs.html (mp3 / aac / flac / mp4 / m4v / mov)
 *
 * @param string $data Data of file
 * @param string $fn File path
 * @return string Content type
 */
function ContentType(&$data, $fn = "")
{
    $mp4Sig = strlen($data) >= 12 ? substr($data, 4, 8) : "";
    if (StartsString("\x47\x49\x46\x38\x37\x61", $data) || StartsString("\x47\x49\x46\x38\x39\x61", $data)) { // Check if gif
        return "image/gif";
    } elseif (StartsString("\xFF\xD8\xFF\xE0", $data) || StartsString("\xFF\xD8\xFF\xDB", $data) || StartsString("\xFF\xD8\xFF\xEE", $data) || StartsString("\xFF\xD8\xFF\xE1", $data)) { // Check if jpg
        return "image/jpeg";
    } elseif (StartsString("\x89\x50\x4E\x47\x0D\x0A\x1A\x0A", $data)) { // Check if png
        return "image/png";
    } elseif (StartsString("\x42\x4D", $data)) { // Check if bmp
        return "image/bmp";
    } elseif (StartsString("\x25\x50\x44\x46", $data)) { // Check if pdf
        return "application/pdf";
    } elseif (StartsString("\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1", $data)) { // xls/doc/ppt
        if (ContainsString($data, "\x77\x6F\x72\x6B\x62\x6F\x6F\x6B")) { // xls, find pattern "workbook"
            return Config("MIME_TYPES.xls");
        } elseif (ContainsString($data, "\x57\x6F\x72\x64\x2E\x44\x6F\x63\x75\x6D\x65\x6E\x74")) { // doc, find pattern "Word.Document"
            return Config("MIME_TYPES.doc");
        }
    } elseif (StartsString("\x50\x4B\x03\x04", $data)) { // docx/xlsx/pptx/zip
        if ($fn != "") { // Use file extension to get mime type first in case other files types with the same bytes (e.g. dotx)
            return MimeContentType($fn);
        } elseif (ContainsString($data, "\x78\x6C\x2F\x77\x6F\x72\x6B\x62\x6F\x6F\x6B")) { // xlsx, find pattern "x1/workbook"
            return Config("MIME_TYPES.xlsx");
        } elseif (ContainsString($data, "\x77\x6F\x72\x64\x2F\x5F\x72\x65\x6C")) { // docx, find pattern "word/_rel"
            return Config("MIME_TYPES.docx");
        }
    } elseif (StartsString("\x49\x44\x33", $data)) { // mp3
        return Config("MIME_TYPES.mp3");
    } elseif (StartsString("\xFF\xF1", $data) || StartsString("\xFF\xF9", $data)) { // aac
        return Config("MIME_TYPES.aac");
    } elseif (StartsString("\x66\x4C\x61\x43\x00\x00\x00\x22", $data)) { // flac
        return Config("MIME_TYPES.flac");
    } elseif (SameString("\x66\x74\x79\x70\x4D\x53\x4E\x56", $mp4Sig) || SameString("\x66\x74\x79\x70\x69\x73\x6F\x6D", $mp4Sig)) { // mp4
        return Config("MIME_TYPES.mp4");
    } elseif (SameString("\x66\x74\x79\x70\x6D\x70\x34\x32", $mp4Sig)) { // m4v
        return Config("MIME_TYPES.mp4v");
    } elseif (SameString("\x66\x74\x79\x70\x71\x74\x20\x20", $mp4Sig)) { // mov
        return Config("MIME_TYPES.mov");
    } elseif ($fn != "") { // Use file extension to get mime type
        return MimeContentType($fn);
    }
    return Config("DEFAULT_MIME_TYPE");
}

/**
 * Get content type for a file
 *
 * @param string $fn File path
 * @return string Content type
 */
function MimeContentType($fn)
{
    $ext = strtolower(substr(strrchr($fn, "."), 1));
    $types = Config("MIME_TYPES");
    $ct = $types[$ext] ?? "";
    if (!$ct && (file_exists($fn) || is_readable($fn))) {
        if (function_exists("finfo_file")) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $ct = finfo_file($finfo, $fn);
            finfo_close($finfo);
            if (strpos($ct, ";")) { // Mime type can be in 'text/plain; charset=us-ascii' form
                $ct = explode(";", $ct)[0];
            }
        } elseif (function_exists("mime_content_type")) {
            $ct = mime_content_type($fn);
        } else {
            $size = @getimagesize($filepath);
            if (!empty($size["mime"])) {
                $ct = $size["mime"];
            }
        }
    }
    return $ct ?: Config("DEFAULT_MIME_TYPE");
}

// Get connection object
function Conn($dbid = 0)
{
    $dbid = $dbid ?: "DB";
    if (isset($GLOBALS["CONNECTIONS"][$dbid])) {
        return $GLOBALS["CONNECTIONS"][$dbid];
    }
    $db = Db($dbid);
    if ($db) {
        return ConnectDb($db);
    }
    return null;
}

// Get connection object (alias of Conn())
function GetConnection($dbid = 0)
{
    return Conn($dbid);
}

// Get connection resource handle
function GetConnectionId($dbid = 0)
{
    $conn = Conn($dbid);
    $c = $conn->getWrappedConnection();
    return method_exists($c, "getWrappedResourceHandle") ? $c->getWrappedResourceHandle() : $c;
}

// Get connection info
function Db($dbid = 0)
{
    return Config("Databases." . ($dbid ?: "DB"));
}

// Get connection type
function GetConnectionType($dbid = 0)
{
    $db = Db($dbid);
    return $db ? $db["type"] : false;
}

// Connect to database
function ConnectDb($info)
{
    // Database connecting event
    Database_Connecting($info);
    $info["password"] = $info["pass"] ?? $info["password"] ?? null;
    $info["dbname"] = $info["db"] ?? $info["dbname"] ?? null;
    $dbid = @$info["id"];
    $dbtype = @$info["type"];
    if ($dbtype == "MYSQL") {
        $info["driver"] = $info["driver"] ?? "pdo_mysql";
        if (Config("MYSQL_CHARSET") != "" && !array_key_exists("charset", $info)) {
            $info["charset"] = Config("MYSQL_CHARSET");
        }
        if ($info["driver"] == "mysqli" && ArrayKeyWithPrefix($info, "ssl_")) { // SSL
            $info["driverOptions"] = array_replace_recursive($info["driverOptions"] ?? [], ["flags" => MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT]);
        }
    } elseif ($dbtype == "POSTGRESQL") {
        $info["driver"] = "pdo_pgsql";
        if (Config("POSTGRESQL_CHARSET") != "" && !array_key_exists("charset", $info)) {
            $info["charset"] = Config("POSTGRESQL_CHARSET");
        }
    } elseif ($dbtype == "MSSQL") {
        $info["driver"] = $info["driver"] ?? "sqlsrv";
        $info["driverOptions"] = $info["driverOptions"] ?? [];
        // Use TransactionIsolation = SQLSRV_TXN_READ_UNCOMMITTED to avoid record locking
        // https://docs.microsoft.com/en-us/sql/t-sql/statements/set-transaction-isolation-level-transact-sql?view=sql-server-ver15
        $info["driverOptions"]["TransactionIsolation"] = 1; // SQLSRV_TXN_READ_UNCOMMITTED
        if (SameText(Config("PROJECT_CHARSET"), "utf-8")) {
            $info["driverOptions"]["CharacterSet"] = "UTF-8";
        }
    } elseif ($dbtype == "SQLITE") {
        $info["driver"] = "pdo_sqlite";
    } elseif ($dbtype == "ORACLE") {
        $info["driver"] = "oci8";
    }

    // Decrypt user name / password if necessary
    if (Config("ENCRYPTION_ENABLED")) {
        try {
            if (array_key_exists("user", $info)) {
                $info["user"] = PhpDecrypt($info["user"]);
            }
            if (array_key_exists("password", $info)) {
                $info["password"] = PhpDecrypt($info["password"]);
            }
        } catch (\Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException $e) {
        }
    }

    // Configuration
    $config = new Configuration();
    $sqlLogger = Container("sqllogger");
    if ($sqlLogger) {
        $config->setSQLLogger($sqlLogger);
    }

    // Event manager
    $evm = new EventManager();

    // Connect
    if ($dbtype == "MYSQL" || $dbtype == "POSTGRESQL" || $dbtype == "ORACLE") {
        $dbtimezone = @$info["timezone"] ?: Config("DB_TIME_ZONE");
        if ($dbtype == "ORACLE") {
            $oraVars = ["CURRENT_SCHEMA" => QuotedName(@$info["schema"], $dbid)];
            if ($dbtimezone != "") {
                $oraVars["TIME_ZONE"] = $dbtimezone;
            }
            $evm->addEventSubscriber(new OracleSessionInit($oraVars));
        }
        $conn = DriverManager::getConnection($info, $config, $evm);
        if ($dbtype == "MYSQL") {
            if ($dbtimezone != "") {
                $conn->executeStatement("SET time_zone = '" . $dbtimezone . "'");
            }
        }
        if ($dbtype == "POSTGRESQL") {
            if ($dbtimezone != "") {
                $conn->executeStatement("SET TIME ZONE '" . $dbtimezone . "'");
            }
        }
        if ($dbtype == "POSTGRESQL") {
            // Set schema
            if (@$info["schema"] != "public" && @$info["schema"] != "") {
                $conn->executeStatement("SET search_path TO " . QuotedName($info["schema"], $dbid));
            }
        }
    } elseif ($dbtype == "SQLITE") {
        $relpath = @$info["relpath"];
        $dbname = @$info["dbname"];
        if ($relpath == "") {
            $info["path"] = realpath($GLOBALS["RELATIVE_PATH"] . $dbname);
        } elseif (StartsString("\\\\", $relpath) || ContainsString($relpath, ":")) { // Physical path
            $info["path"] = $relpath . $dbname;
        } else { // Relative to app root
            $info["path"] = ServerMapPath($relpath) . $dbname;
        }
        $conn = DriverManager::getConnection($info, $config);
    } elseif ($dbtype == "MSSQL") {
        $conn = DriverManager::getConnection($info, $config);
        $conn->executeStatement("SET DATEFORMAT ymd"); // Set date format
    }

    // Database connected event
    Database_Connected($conn);
    $GLOBALS["CONNECTIONS"][$dbid] = $conn;
    return $conn;
}

// Close database connections
function CloseConnections()
{
    foreach ($GLOBALS["CONNECTIONS"] as $dbid => $conn) {
        if ($conn) {
            $conn->close();
        }
        $GLOBALS["CONNECTIONS"][$dbid] = null;
    }
    $GLOBALS["Conn"] = null;
}

/**
 * Cast date/time field for LIKE
 *
 * @param string $fld Field expression
 * @param int $namedformat Date format
 * @param int|string $dbid Database ID
 * @return string SQL expression formatting the field to 'y-MM-dd HH:mm:ss'
 */
function CastDateFieldForLike($fld, $namedformat, $dbid = 0)
{
    global $DATE_FORMAT, $DATE_SEPARATOR, $TIME_SEPARATOR;
    $dbtype = GetConnectionType($dbid);
    $dateFormat = DbDateFormat($namedformat, $dbtype);
    if ($dateFormat) {
        if ($dbtype == "MYSQL") {
            return "DATE_FORMAT(" . $fld . ", '" . $dateFormat . "')";
        } elseif ($dbtype == "MSSQL") {
            return "FORMAT(" . $fld . ", '" . $dateFormat . "')";
        } elseif ($dbtype == "ORACLE" || $dbtype == "POSTGRESQL") {
            return "TO_CHAR(" . $fld . ", '" . $dateFormat . "')";
        } elseif ($dbtype == "SQLITE") {
            return "STRFTIME('" . $dateFormat . "', " . $fld . ")";
        }
    }
    return $fld;
}

// Append like operator
function Like($pat, $dbid = 0)
{
    return LikeOrNotLikeOperator("LIKE", $pat, $dbid);
}

// Append not like operator
function NotLike($pat, $dbid = 0)
{
    return LikeOrNotLikeOperator("NOT LIKE", $pat, $dbid);
}

// Append Like / Not Like operator
function LikeOrNotLikeOperator($opr, $pat, $dbid = 0)
{
    $dbtype = GetConnectionType($dbid);
    $opr = " " . $opr . " "; // " LIKE " / " NOT LIKE "
    if ($dbtype == "POSTGRESQL") {
        if (Config("USE_ILIKE_FOR_POSTGRESQL")) {
            $opr = str_replace(" LIKE ", " ILIKE ", $opr);
        }
        return $opr . $pat;
    } elseif ($dbtype == "MYSQL") {
        if (Config("LIKE_COLLATION_FOR_MYSQL") != "") {
            return $opr . $pat . " COLLATE " . Config("LIKE_COLLATION_FOR_MYSQL");
        } else {
            return $opr . $pat;
        }
    } elseif ($dbtype == "MSSQL") {
        if (Config("LIKE_COLLATION_FOR_MSSQL") != "") {
            return " COLLATE " . Config("LIKE_COLLATION_FOR_MSSQL") . $opr . $pat;
        } else {
            return $opr . $pat;
        }
    } else {
        return $opr . $pat;
    }
}

// Return multi-value search SQL
function GetMultiSearchSql(&$fld, $fldOpr, $fldVal, $dbid)
{
    if ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL") {
        return $fld->Expression . " " . $fldOpr;
    } else {
        $sep = Config("MULTIPLE_OPTION_SEPARATOR");
        $arVal = explode($sep, $fldVal);
        if ($fld->UseFilter) { // Use filter
            $ar = [];
            foreach ($arVal as $val) {
                $val = trim($val);
                if ($val == Config("NULL_VALUE")) {
                    $sql = $fld->Expression . " IS NULL";
                } elseif ($val == Config("NOT_NULL_VALUE")) {
                    $sql = $fld->Expression . " IS NOT NULL";
                } else {
                    $sql = $fld->Expression . " = " . QuotedValue($val, $fld->DataType, $dbid);
                }
                $ar[] = $sql;
            }
            return implode(" OR ", $ar);
        } else {
            $wrk = "";
            $dbtype = GetConnectionType($dbid);
            $searchOption = Config("SEARCH_MULTI_VALUE_OPTION");
            if ($searchOption == 1 || !IsMultiSearchOperator($fldOpr)) { // No multiple value search
                $wrk = $fld->Expression . SearchString($fldOpr, $fldVal, DATATYPE_STRING, $dbid);
            } else {
                foreach ($arVal as $val) {
                    $val = trim($val);
                    if ($val == Config("NULL_VALUE")) {
                        $sql = $fld->Expression . " IS NULL";
                    } elseif ($val == Config("NOT_NULL_VALUE")) {
                        $sql = $fld->Expression . " IS NOT NULL";
                    } else {
                        if ($dbtype == "MYSQL" && in_array($fldOpr, ["=", "<>"])) {
                            $sql = "FIND_IN_SET('" . AdjustSql($val, $dbid) . "', " . $fld->Expression . ")";
                            if ($fldOpr == "<>") {
                                $sql = "NOT " . $sql;
                            }
                        } else {
                            $sql = $fld->Expression . " = '" . AdjustSql($val, $dbid) . "' OR "; // Special case, single value
                            switch ($fldOpr) {
                                case "LIKE":
                                case "NOT LIKE":
                                    $val = "%" . $val . "%";
                                    break;
                                case "STARTS WITH":
                                    $val .= "%";
                                    break;
                                case "ENDS WITH":
                                    $val = "%" . $val;
                                    break;
                            }
                            $sql .= GetMultiSearchSqlPart($fld, $val, $dbid, $sep);
                            if (in_array($fldOpr, ["<>", "NOT LIKE"])) {
                                $sql = "NOT (" . $sql . ")";
                            }
                        }
                    }
                    if ($wrk != "") {
                        if ($searchOption == 3) {
                            $wrk .= " OR ";
                        } elseif ($searchOption == 2) {
                            $wrk .= " AND ";
                        }
                    }
                    $wrk .= "(" . $sql . ")";
                }
            }
        }
        return $wrk;
    }
}

// Multi value search operator
function IsMultiSearchOperator($opr)
{
    return in_array($opr, ["=", "<>", "LIKE", "NOT LIKE", "STARTS WITH", "ENDS WITH"]);
}

// Get multi search SQL part
function GetMultiSearchSqlPart(&$fld, $fldVal, $dbid, $sep)
{
    return $fld->Expression . Like("'" . AdjustSql($fldVal, $dbid) . $sep . "%'", $dbid) . " OR " .
        $fld->Expression . Like("'%" . $sep . AdjustSql($fldVal, $dbid) . $sep . "%'", $dbid) . " OR " .
        $fld->Expression . Like("'%" . $sep . AdjustSql($fldVal, $dbid) . "'", $dbid);
}

// Check if float format
function IsFloatFormat($fldType)
{
    return in_array($fldType, [4, 5, 131, 6]);
}

// Check if is numeric
function IsNumeric($value)
{
    return is_numeric($value) || ParseNumber($value) !== false;
}

// Get search SQL
function GetSearchSql(&$fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $dbid)
{
    $sql = "";
    $virtual = ($fld->IsVirtual && $fld->VirtualSearch);
    $fldExpression = ($virtual) ? $fld->VirtualExpression : $fld->Expression;
    $fldDataType = $fld->DataType;
    if (IsFloatFormat($fld->Type)) {
        $fldVal = ConvertToFloatString($fldVal);
        $fldVal2 = ConvertToFloatString($fldVal2);
    }
    if ($virtual) {
        $fldDataType = DATATYPE_STRING;
    }
    if ($fldDataType == DATATYPE_NUMBER) { // Fix wrong operator
        if ($fldOpr == "LIKE" || $fldOpr == "STARTS WITH" || $fldOpr == "ENDS WITH") {
            $fldOpr = "=";
        } elseif ($fldOpr == "NOT LIKE") {
            $fldOpr = "<>";
        }
        if ($fldOpr2 == "LIKE" || $fldOpr2 == "STARTS WITH" || $fldOpr2 == "ENDS WITH") {
            $fldOpr2 = "=";
        } elseif ($fldOpr2 == "NOT LIKE") {
            $fldOpr2 = "<>";
        }
    }
    if ($fldOpr == "BETWEEN") {
        $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
            ($fldDataType == DATATYPE_NUMBER && is_numeric($fldVal) && is_numeric($fldVal2));
        if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
            $sql = $fldExpression . " BETWEEN " . QuotedValue($fldVal, $fldDataType, $dbid) .
                " AND " . QuotedValue($fldVal2, $fldDataType, $dbid);
        }
    } else {
        // Handle first value
        if ($fldVal == Config("NULL_VALUE") || $fldOpr == "IS NULL") {
            $sql = $fld->Expression . " IS NULL";
        } elseif ($fldVal == Config("NOT_NULL_VALUE") || $fldOpr == "IS NOT NULL") {
            $sql = $fld->Expression . " IS NOT NULL";
        } else {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && is_numeric($fldVal));
            if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
                $sql = $fldExpression . SearchString($fldOpr, $fldVal, $fldDataType, $dbid);
                if ($fld->isBoolean() && $fldVal == $fld->FalseValue && $fldOpr == "=") {
                    $sql = "(" . $sql . " OR " . $fldExpression . " IS NULL)";
                }
            }
        }
        // Handle second value
        $sql2 = "";
        if ($fldVal2 == Config("NULL_VALUE") || $fldOpr2 == "IS NULL") {
            $sql2 = $fld->Expression . " IS NULL";
        } elseif ($fldVal2 == Config("NOT_NULL_VALUE") || $fldOpr2 == "IS NOT NULL") {
            $sql2 = $fld->Expression . " IS NOT NULL";
        } else {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && is_numeric($fldVal2));
            if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
                $sql2 = $fldExpression . SearchString($fldOpr2, $fldVal2, $fldDataType, $dbid);
                if ($fld->isBoolean() && $fldVal2 == $fld->FalseValue && $fldOpr2 == "=") {
                    $sql2 = "(" . $sql2 . " OR " . $fldExpression . " IS NULL)";
                }
            }
        }
        // Combine SQL
        AddFilter($sql, $sql2, $fldCond == "OR" ? "OR" : "AND");
    }
    return $sql;
}

// Return search string
function SearchString($fldOpr, $fldVal, $fldType, $dbid)
{
    if (strval($fldVal) == Config("NULL_VALUE") || $fldOpr == "IS NULL") {
        return " IS NULL";
    } elseif (strval($fldVal) == Config("NOT_NULL_VALUE") || $fldOpr == "IS NOT NULL") {
        return " IS NOT NULL";
    } elseif ($fldOpr == "LIKE") {
        return Like(QuotedValue("%$fldVal%", $fldType, $dbid), $dbid);
    } elseif ($fldOpr == "NOT LIKE") {
        return NotLike(QuotedValue("%$fldVal%", $fldType, $dbid), $dbid);
    } elseif ($fldOpr == "STARTS WITH") {
        return Like(QuotedValue("$fldVal%", $fldType, $dbid), $dbid);
    } elseif ($fldOpr == "ENDS WITH") {
        return Like(QuotedValue("%$fldVal", $fldType, $dbid), $dbid);
    } else {
        if ($fldType == DATATYPE_NUMBER && !is_numeric($fldVal)) { // Invalid field value
            return " = -1 AND 1 = 0"; // Always false
        } else {
            return " " . $fldOpr . " " . QuotedValue($fldVal, $fldType, $dbid);
        }
    }
}

// Check if valid operator
function IsValidOperator($opr, $fldType)
{
    return in_array($opr, ["=", "<>", "<", "<=", ">", ">="]) ||
        in_array($fldType, [DATATYPE_STRING, DATATYPE_MEMO, DATATYPE_XML]) && in_array($opr, ["LIKE", "NOT LIKE", "STARTS WITH", "ENDS WITH"]);
}

// Quote table/field name based on dbid
function QuotedName($name, $dbid = 0)
{
    $db = Config("Databases." . ($dbid ?: "DB"));
    if ($db) {
        $qs = $db["qs"];
        $qe = $db["qe"];
        $name = str_replace($qe, $qe . $qe, $name);
        return $qs . $name . $qe;
    }
    return $name;
}

// Quote field value based on dbid
function QuotedValue($value, $fldType, $dbid = 0)
{
    if ($value === null) {
        return "NULL";
    }
    $dbtype = GetConnectionType($dbid);
    switch ($fldType) {
        case DATATYPE_STRING:
        case DATATYPE_MEMO:
            if (Config("REMOVE_XSS")) {
                $value = RemoveXss($value);
            }
            if ($dbtype == "MSSQL") {
                return "N'" . AdjustSql($value, $dbid) . "'";
            }
            return "'" . AdjustSql($value, $dbid) . "'";
        case DATATYPE_TIME:
            return "'" . AdjustSql($value, $dbid) . "'";
        case DATATYPE_XML:
            return "'" . AdjustSql($value, $dbid) . "'";
        case DATATYPE_BLOB:
            if ($dbtype == "MYSQL") {
                return "'" . addslashes($value) . "'";
            }
            return $value;
        case DATATYPE_DATE:
            return "'" . AdjustSql($value, $dbid) . "'";
        case DATATYPE_GUID:
            return "'" . $value . "'";
        case DATATYPE_BOOLEAN:
            if ($dbtype == "MYSQL" || $dbtype == "POSTGRESQL") {
                return "'" . $value . "'"; // 'Y'|'N' or 'y'|'n' or '1'|'0' or 't'|'f'
            }
            return $value;
        case DATATYPE_BIT: // $dbtype == "MYSQL" || $dbtype == "POSTGRESQL"
            return "b'" . $value . "'";
        case DATATYPE_NUMBER:
            if (IsNumeric($value)) {
                return $value;
            }
            return "NULL"; // Treat as null
        default:
            return $value;
    }
}

/**
 * Get parameter type
 *
 * @param DbField $fld Field Object
 * @param string $dbid Database ID
 * @return ParameterType
 */
function GetParameterType($fld, $value, $dbid = 0)
{
    if (in_array($fld->Type, [2, 3, 16, 17, 18, 19, 20, 21])) {
        return ParameterType::INTEGER;
    }
    $dbtype = GetConnectionType($dbid);
    switch ($fld->DataType) {
        case DATATYPE_BLOB:
            if ($dbtype == "MYSQL" || $dbtype == "POSTGRESQL") {
                return ParameterType::BINARY;
            }
            return ParameterType::LARGE_OBJECT;
        case DATATYPE_BOOLEAN:
            if ($dbtype == "MYSQL" || $dbtype == "POSTGRESQL") {
                return ParameterType::STRING; // 'Y'|'N' or 'y'|'n' or '1'|'0' or 't'|'f'
            }
            return ParameterType::BOOLEAN;
        case DATATYPE_BIT: // $dbtype == "MYSQL" || $dbtype == "POSTGRESQL"
            return ParameterType::INTEGER;
        default:
            return ParameterType::STRING;
    }
}

// Concat string
function Concat($str1, $str2, $sep)
{
    $str1 = trim($str1);
    $str2 = trim($str2);
    if ($str1 != "" && $sep != "" && !EndsString($sep, $str1)) {
        $str1 .= $sep;
    }
    return $str1 . $str2;
}

// Write message to debug file
function Trace($msg)
{
    $filename = "debug.txt";
    if (!$handle = fopen($filename, 'a')) {
        exit;
    }
    if (is_writable($filename)) {
        fwrite($handle, $msg . "\n");
    }
    fclose($handle);
}

// Compare values with special handling for null values
function CompareValue($v1, $v2)
{
    if ($v1 === null && $v2 === null) {
        return true;
    } elseif ($v1 === null || $v2 === null) {
        return false;
    } else {
        return ($v1 == $v2);
    }
}

// Check if boolean value is true
function ConvertToBool($value)
{
    return $value === true || SameText($value, "1") || SameText($value, "y") || SameText($value, "t") || SameText($value, "true");
}

// Add message
function AddMessage(&$msg, $newmsg, $sep = "<br>")
{
    if (strval($newmsg) != "") {
        if (strval($msg) != "") {
            $msg .= $sep;
        }
        $msg .= $newmsg;
    }
}

/**
 * Add filter
 *
 * @param string $filter Filter
 * @param string|callable $newfilter New filter
 * @param string $cond Condition (AND / OR)
 * @return void
 */
function AddFilter(&$filter, $newfilter, $cond = "AND")
{
    if (is_callable($newfilter)) {
        $newfilter = $newfilter();
    }
    if (trim($newfilter) == "") {
        return;
    }
    if (trim($filter) != "") {
        $filter = AddBracketsForFilter(AddBracketsForFilter($filter, $cond) .
            " " . $cond . " " . AddBracketsForFilter($newfilter, $cond), $cond);
    } else {
        $filter = $newfilter;
    }
}

/**
 * Add brackets to filter if necessary
 *
 * @param string $filter Filter
 * @param string $cond Condition (AND / OR)
 * @return string
 */
function AddBracketsForFilter($filter, $cond = "AND")
{
    if (trim($filter) != "") {
        if (preg_match('/\sOR\s/i', $filter) && SameText($cond, "AND") && !preg_match('/^\(.+\)$/', $filter)) {
            $filter = "(" . $filter . ")";
        }
    }
    return $filter;
}

// Adjust SQL based on dbid
function AdjustSql($val, $dbid = 0)
{
    $dbtype = GetConnectionType($dbid);
    if ($dbtype == "MYSQL") {
        $val = addslashes(trim($val));
    } else {
        $val = str_replace("'", "''", trim($val)); // Adjust for single quote
    }
    return $val;
}

/**
 * Write audit trail
 *
 * @param string $pfx Optional log file prefix (for backward compatibility only, not used)
 * @param string $dt Optional DateTime (for backward compatibility)
 * @param string $script Optional script name (for backward compatibility)
 * @param string $usr User ID or user name
 * @param string $action Action
 * @param string $table Table
 * @param string $field Field
 * @param string $keyvalue Key value
 * @param string $oldvalue Old value
 * @param string $newvalue New value
 * @return void
 */
function WriteAuditTrail($pfx, $dt, $script, $usr, $action, $table, $field, $keyvalue, $oldvalue, $newvalue)
{
    if ($table === Config("AUDIT_TRAIL_TABLE_NAME")) {
        return;
    }
    $usrwrk = $usr;
    if ($usrwrk == "") { // Assume Administrator if no user
        $usrwrk = "-1";
    }
    if (Config("AUDIT_TRAIL_TO_DATABASE")) {
        $rsnew = [
            Config("AUDIT_TRAIL_FIELD_NAME_DATETIME") => $dt,
            Config("AUDIT_TRAIL_FIELD_NAME_SCRIPT") => $script,
            Config("AUDIT_TRAIL_FIELD_NAME_USER") => $usrwrk,
            Config("AUDIT_TRAIL_FIELD_NAME_ACTION") => $action,
            Config("AUDIT_TRAIL_FIELD_NAME_TABLE") => $table,
            Config("AUDIT_TRAIL_FIELD_NAME_FIELD") => $field,
            Config("AUDIT_TRAIL_FIELD_NAME_KEYVALUE") => $keyvalue,
            Config("AUDIT_TRAIL_FIELD_NAME_OLDVALUE") => $oldvalue,
            Config("AUDIT_TRAIL_FIELD_NAME_NEWVALUE") => $newvalue
        ];
    } else {
        $rsnew = [
            "datetime" => $dt,
            "script" => $script,
            "user" => $usrwrk,
            "ew-action" => $action,
            "table" => $table,
            "field" => $field,
            "keyvalue" => $keyvalue,
            "oldvalue" => $oldvalue,
            "newvalue" => $newvalue
        ];
    }

    // Call AuditTrail Inserting event
    $writeAuditTrail = AuditTrail_Inserting($rsnew);
    if ($writeAuditTrail) {
        if (Config("AUDIT_TRAIL_TO_DATABASE")) {
            $tbl = Container(Config("AUDIT_TRAIL_TABLE_VAR"));
            if ($tbl->rowInserting(null, $rsnew)) {
                if ($tbl->insert($rsnew)) {
                    $tbl->rowInserted(null, $rsnew);
                }
            }
        } else {
            $logger = Container("audit");
            $logger->info(__FUNCTION__, $rsnew);
        }
    }
}

/**
 * Write audit trail
 *
 * @param string $usr User ID or user name
 * @param string $action Action
 * @param string $table Table
 * @param string $field Field
 * @param string $keyvalue Key value
 * @param string $oldvalue Old value
 * @param string $newvalue New value
 * @return void
 */
function WriteAuditLog($usr, $action, $table, $field, $keyvalue, $oldvalue, $newvalue)
{
    WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $action, $table, $field, $keyvalue, $oldvalue, $newvalue);
}

/**
 * Unformat date time
 *
 * @param string $dt Date/Time string
 * @param int|string $dateFormat Formatter pattern
 * @return string
 */
function UnFormatDateTime($dt, $dateFormat = "")
{
    global $CurrentLocale, $TIME_ZONE;
    $dt = trim($dt);
    if (
        EmptyValue($dt) ||
        preg_match('/^([0-9]{4})-([0][1-9]|[1][0-2])-([0][1-9]|[1|2][0-9]|[3][0|1])( (0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])(:([0-5][0-9]))?)?$/', $dt) || // Date/Time
        preg_match('/^(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])(:([0-5][0-9]))?$/', $dt)
    ) { // Time
        return $dt;
    }
    $dateFormat = DateFormat($dateFormat);
    $fmt = new \IntlDateFormatter($CurrentLocale, null, null, $TIME_ZONE, null, $dateFormat);
    $ts = $fmt->parse($dt); // Parse by $dateFormat
    if ($ts !== false) {
        if (ContainsText($dateFormat, "y") && ContainsText($dateFormat, "h")) { // Date/Time
            return date("Y-m-d H:i:s", $ts);
        } elseif (ContainsText($dateFormat, "y")) { // Date
            return date("Y-m-d", $ts);
        } elseif (ContainsText($dateFormat, "h")) { // Time
            return date("H:i:s", $ts);
        }
    }
    return $dt;
}

/**
 * Format a timestamp, datetime, date or time field
 *
 * @param int|string $ts Timestamp or Date/Time string
 * @param int|string $dateformat Formatter pattern
 * @return string
 */
function FormatDateTime($ts, $dateFormat = "")
{
    global $CurrentLocale, $TIME_ZONE;
    $dt = false;
    if (is_numeric($ts)) { // Timestamp
        $dt = date_create_immutable()->setTimestamp((int)$ts);
    } elseif (is_string($ts) && !EmptyValue($ts)) {
        $dt = date_create_immutable(trim($ts));
    }
    if ($dt !== false) {
        if ($dateFormat == 8) { // Handle edit format (show time part only if exists)
            $dateFormat = intval($dt->format('His')) == 0 ? DateFormat(0) : DateFormat(1);
        } else {
            $dateFormat = DateFormat($dateFormat);
        }
        $fmt = new \IntlDateFormatter($CurrentLocale, null, null, $TIME_ZONE, null, $dateFormat);
        return $fmt->format($dt);
    }
    return $ts;
}

/**
 * Is formatted
 *
 * @param string $value Value
 */
function IsFormatted($value)
{
    if (is_float($value) || is_int($value)) { // Number, not formatted
        return false;
    }
    if (!is_numeric($value)) { // Contains non-numeric characters, assume formatted
        return true;
    }
    global $GROUPING_SEPARATOR;
    $value = strval($value);
    if ($GROUPING_SEPARATOR == "." && ContainsString($value, ".")) { // Contains one ".", e.g. 123.456
        if (ParseInteger($value) == str_replace(".", "", $value)) { // Can be parsed, "." is grouping separator
            return true;
        }
    }
    return false;
}

/**
 * Format currency
 *
 * @param float $value Value
 * @param string $pattern Formatter pattern
 * @return string
 */
function FormatCurrency($value, $pattern = "")
{
    if (IsFormatted($value)) {
        $value = ParseNumber($value);
    }
    global $CurrentLocale, $CURRENCY_FORMAT, $CURRENCY_SYMBOL;
    $fmt = new \NumberFormatter($CurrentLocale, \NumberFormatter::CURRENCY);
    $fmt->setPattern($pattern ?: $CURRENCY_FORMAT);
    $fmt->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, $CURRENCY_SYMBOL);
    $res = $fmt->format((float)$value);
    return $res !== false ? $res : $value;
}

/**
 * Parse currency
 *
 * @param string $value Value (Must match the locale pattern, e.g. "100\xc2\xa€")
 * @param string $pattern Formatter pattern
 * @return float
 */
function ParseCurrency($value, $pattern = "")
{
    global $CurrentLocale, $CURRENCY_FORMAT, $CURRENCY_SYMBOL;
    $fmt = new \NumberFormatter($CurrentLocale, \NumberFormatter::CURRENCY);
    $fmt->setPattern($pattern ?: $CURRENCY_FORMAT);
    $fmt->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, $CURRENCY_SYMBOL);
    $res = $fmt->parse($value);
    return $res !== false ? $res : $value;
}

/**
 * Format number
 *
 * @param float $value Value
 * @param string $pattern Formatter pattern. If null, keep number of decimal digits.
 * @return string
 */
function FormatNumber($value, $pattern = "")
{
    if (IsFormatted($value)) {
        return $value;
    }
    global $CurrentLocale, $NUMBER_FORMAT;
    $fmt = new \NumberFormatter($CurrentLocale, \NumberFormatter::PATTERN_DECIMAL, $pattern ?: $NUMBER_FORMAT);
    if ($pattern === null) {
        $fmt->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 1000);
    }
    $res = $fmt->format((float)$value);
    return $res !== false ? $res : $value;
}

/**
 * Format integer
 *
 * @param int $value Value
 * @return string
 */
function FormatInteger($value)
{
    if (IsFormatted($value)) {
        return $value;
    }
    global $CurrentLocale;
    $fmt = new \NumberFormatter($CurrentLocale, \NumberFormatter::TYPE_INT32); // TYPE_INT64 does not work
    $res = $fmt->format((int)$value);
    return $res !== false ? $res : $value;
}

/**
 * Parse number
 *
 * @param string $value Value
 * @param string $pattern Formatter pattern
 * @return float|false
 */
function ParseNumber($value, $pattern = "")
{
    global $CurrentLocale, $NUMBER_FORMAT, $PERCENT_SYMBOL;
    if (ContainsString($value, $PERCENT_SYMBOL)) {
        return ParsePercent($value, $pattern);
    }
    $fmt = new \NumberFormatter($CurrentLocale, \NumberFormatter::PATTERN_DECIMAL, $pattern ?: $NUMBER_FORMAT);
    $res = $fmt->parse($value);
    return $res !== false ? $res : $value;
}

/**
 * Parse integer
 *
 * @param string $value Value
 * @param string $pattern Formatter pattern
 * @param int $type Integer type (\NumberFormatter::TYPE_INT64 = 2 or \NumberFormatter::TYPE_INT32 = 1)
 * @return int|false
 */
function ParseInteger($value, $pattern = "", $type = 0)
{
    global $CurrentLocale, $NUMBER_FORMAT;
    $fmt = new \NumberFormatter($CurrentLocale, \NumberFormatter::PATTERN_DECIMAL, $pattern ?: $NUMBER_FORMAT);
    $type = in_array($type, [\NumberFormatter::TYPE_INT64, \NumberFormatter::TYPE_INT32])
        ? $type
        : (PHP_INT_SIZE == 8 ? \NumberFormatter::TYPE_INT64 : \NumberFormatter::TYPE_INT32);
    $res = $fmt->parse($value, $type);
    return $res !== false ? $res : $value;
}

/**
 * Convert string to float (as string)
 *
 * @param string $value Value
 * @param string $pattern Formatter pattern
 * @return string|false
 */
function ConvertToFloatString($v, $pattern = "")
{
    if (EmptyValue($v)) {
        return $v;
    }
    $result = ParseNumber($v, $pattern);
    return $result !== false ? strval($result) : false;
}

/**
 * Format percent
 *
 * @param float $value Value
 * @param string $pattern Formatter pattern
 * @return string
 */
function FormatPercent($value, $pattern = "")
{
    if (IsFormatted($value)) {
        $value = ParseNumber($value);
    }
    global $CurrentLocale, $PERCENT_FORMAT, $PERCENT_SYMBOL;
    $fmt = new \NumberFormatter($CurrentLocale, \NumberFormatter::PERCENT);
    $fmt->setPattern($pattern ?: $PERCENT_FORMAT);
    $fmt->setSymbol(\NumberFormatter::PERCENT_SYMBOL, $PERCENT_SYMBOL);
    $res = $fmt->format((float)$value);
    return $res !== false ? $res : $value;
}

/**
 * Parse percent
 *
 * @param string $value Value (Must match the locale pattern, e.g. "100\xc2\xa0%")
 * @param string $pattern Formatter pattern
 * @return float
 */
function ParsePercent($value, $pattern = "")
{
    global $CurrentLocale, $PERCENT_FORMAT, $PERCENT_SYMBO;
    $fmt = new \NumberFormatter($CurrentLocale, \NumberFormatter::PERCENT);
    $fmt->setPattern($pattern ?: $PERCENT_FORMAT);
    $fmt->setSymbol(\NumberFormatter::PERCENT_SYMBOL, $PERCENT_SYMBOL);
    $res = $fmt->parse($value);
    return $res !== false ? $res : $value;
}

// Format sequence number
function FormatSequenceNumber($seq)
{
    global $Language;
    return str_replace("%s", $seq, $Language->phrase("SequenceNumber"));
}

/**
 * Display field value separator
 *
 * @param int $idx Display field index (1|2|3)
 * @param DbField $fld field object
 * @return string
 */
function ValueSeparator($idx, $fld)
{
    $sep = $fld ? $fld->DisplayValueSeparator : ", ";
    return is_array($sep) ? @$sep[$idx - 1] : $sep;
}

/**
 * Get temp upload path
 *
 * @param mixed $fld DbField
 *  If false, return href path of the temp upload folder.
 *  If NULL, return physical path of the temp upload folder.
 *  If string, return physical path of the temp upload folder with the parameter as part of the subpath.
 *  If object (DbField), return physical path of the temp upload folder with tblvar/fldvar as part of the subpath.
 * @param int $idx Index of the field
 * @param bool $tableLevel Table level or field level
 * @return string
 */
function UploadTempPath($fld = null, $idx = -1, $tableLevel = false)
{
    if ($fld !== false) { // Physical path
        $path = (Config("UPLOAD_TEMP_PATH") && Config("UPLOAD_TEMP_HREF_PATH")) ? IncludeTrailingDelimiter(Config("UPLOAD_TEMP_PATH"), true) : UploadPath(true);
        if (is_object($fld)) { // Normal upload
            $fldvar = ($idx < 0) ? $fld->FieldVar : substr($fld->FieldVar, 0, 1) . $idx . substr($fld->FieldVar, 1);
            $tblvar = $fld->TableVar;
            $path = IncludeTrailingDelimiter($path . Config("UPLOAD_TEMP_FOLDER_PREFIX") . session_id(), true);
            $path = IncludeTrailingDelimiter($path . $tblvar, true);
            if (!$tableLevel) {
                $path = IncludeTrailingDelimiter($path . $fldvar, true);
            }
        } elseif (is_string($fld)) { // API upload ($fld as token)
            $path = IncludeTrailingDelimiter($path . Config("UPLOAD_TEMP_FOLDER_PREFIX") . $fld, true);
        }
        return $path;
    } else { // Href path
        return (Config("UPLOAD_TEMP_PATH") && Config("UPLOAD_TEMP_HREF_PATH")) ? IncludeTrailingDelimiter(Config("UPLOAD_TEMP_HREF_PATH"), false) : UploadPath(false);
    }
}

// Render upload field to temp path
function RenderUploadField(&$fld, $idx = -1)
{
    global $Language, $Table;
    if ($Table !== null && $Table->EventCancelled) { // Skip render if insert/update cancelled
        return;
    }
    global $Language;
    $folder = UploadTempPath($fld, $idx);
    CleanUploadTempPaths(); // Clean all old temp folders
    CleanPath($folder); // Clean the upload folder
    if (!file_exists($folder)) {
        if (!CreateFolder($folder)) {
            throw new \Exception("Cannot create folder: " . $folder); //** side effect
        }
    }
    $physical = !IsRemote($folder);
    $thumbnailfolder = PathCombine($folder, Config("UPLOAD_THUMBNAIL_FOLDER"), $physical);
    if (!file_exists($thumbnailfolder)) {
        if (!CreateFolder($thumbnailfolder)) {
            throw new \Exception("Cannot create folder: " . $thumbnailfolder); //** side effect
        }
    }
    $imageFileTypes = explode(",", Config("IMAGE_ALLOWED_FILE_EXT"));
    if ($fld->DataType == DATATYPE_BLOB) { // Blob field
        $data = $fld->Upload->DbValue;
        if (!EmptyValue($data)) {
            // Create upload file
            $filename = ($fld->Upload->FileName != "") ? $fld->Upload->FileName : $fld->Param;
            $f = IncludeTrailingDelimiter($folder, $physical) . $filename;
            CreateUploadFile($f, $data);
            // Create thumbnail file
            $f = IncludeTrailingDelimiter($thumbnailfolder, $physical) . $filename;
            $ext = ContentExtension($data);
            if ($ext != "" && in_array(substr($ext, 1), $imageFileTypes)) {
                $width = Config("UPLOAD_THUMBNAIL_WIDTH");
                $height = Config("UPLOAD_THUMBNAIL_HEIGHT");
                ResizeBinary($data, $width, $height);
                CreateUploadFile($f, $data);
            }
            $fld->Upload->FileName = basename($f); // Update file name
        }
    } else { // Upload to folder
        $fld->Upload->FileName = $fld->htmlDecode($fld->Upload->DbValue); // Update file name
        if (!EmptyValue($fld->Upload->FileName)) {
            // Create upload file
            if ($fld->UploadMultiple) {
                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $fld->Upload->FileName);
            } else {
                $files = [$fld->Upload->FileName];
            }
            $cnt = count($files);
            for ($i = 0; $i < $cnt; $i++) {
                $filename = $files[$i];
                if ($filename != "") {
                    $pathinfo = pathinfo($filename);
                    $filename = $pathinfo["basename"];
                    $dirname = @$pathinfo["dirname"];
                    $ext = strtolower(@$pathinfo["extension"]);
                    $filepath = ($dirname != "" && $dirname != ".") ? PathCombine($fld->UploadPath, $dirname, !IsRemote($fld->UploadPath)) : $fld->UploadPath;
                    $srcfile = ServerMapPath($filepath) . $filename;
                    $f = IncludeTrailingDelimiter($folder, $physical) . $filename;
                    $tf = IncludeTrailingDelimiter($thumbnailfolder, $physical) . $filename; // Thumbnail
                    if (!is_dir($srcfile) && file_exists($srcfile)) { // File found
                        $data = file_get_contents($srcfile);
                        CreateUploadFile($f, $data);
                        if (in_array($ext, $imageFileTypes)) {
                            $w = Config("UPLOAD_THUMBNAIL_WIDTH");
                            $h = Config("UPLOAD_THUMBNAIL_HEIGHT");
                            ResizeBinary($data, $w, $h); // Resize as thumbnail
                            CreateUploadFile($tf, $data); // Create thumbnail
                        }
                    } else { // File not found
                        $data = Config("FILE_NOT_FOUND");
                        file_put_contents($f, base64_decode($data));
                    }
                }
            }
        }
    }
}

// Write uploaded file
function CreateUploadFile(&$f, $data)
{
    $handle = fopen($f, "w");
    fwrite($handle, $data);
    fclose($handle);
    $pathinfo = pathinfo($f);
    $extension = $pathinfo["extension"] ?? "";
    if ($extension == "") { // No file extension
        $extension = ContentExtension($data);
        if ($extension) {
            rename($f, $f .= $extension);
        }
    }
}

/**
 * Get uploaded file name(s) (as comma separated value) by file token
 *
 * @param string $filetoken File token returned by API
 * @param bool $fullPath Includes full path or not
 * @return string
 */
function GetUploadedFileName($filetoken, $fullPath = true)
{
    return (new HttpUpload())->getUploadedFileName($filetoken, $fullPath);
}

/**
 * Get uploaded file names (as array) by file token
 *
 * @param string $filetoken File token returned by API
 * @param bool $fullPath Includes full path or not
 * @return array
 */
function GetUploadedFileNames($filetoken, $fullPath = true)
{
    return (new HttpUpload())->getUploadedFileNames($filetoken, $fullPath);
}

// Clean temp upload folders
function CleanUploadTempPaths($sessionid = "")
{
    $folder = (Config("UPLOAD_TEMP_PATH")) ? IncludeTrailingDelimiter(Config("UPLOAD_TEMP_PATH"), true) : UploadPath(true);
    if (@is_dir($folder) && ($dh = opendir($folder))) {
        // Load temp folders
        while (($entry = readdir($dh)) !== false) {
            if ($entry == "." || $entry == "..") {
                continue;
            }
            $temp = $folder . $entry;
            if (@is_dir($temp) && StartsString(Config("UPLOAD_TEMP_FOLDER_PREFIX"), $entry)) { // Upload temp folder
                if (Config("UPLOAD_TEMP_FOLDER_PREFIX") . $sessionid == $entry) { // Clean session folder
                    CleanPath($temp, true);
                } else {
                    if (Config("UPLOAD_TEMP_FOLDER_PREFIX") . session_id() != $entry) {
                        if (IsEmptyPath($temp)) { // Empty folder
                            CleanPath($temp, true);
                        } else { // Old folder
                            $lastmdtime = filemtime($temp);
                            if ((time() - $lastmdtime) / 60 > Config("UPLOAD_TEMP_FOLDER_TIME_LIMIT") || count(@scandir($temp)) == 2) {
                                CleanPath($temp, true);
                            }
                        }
                    }
                }
            } elseif (@is_file($temp) && EndsString(".tmp.png", $entry)) { // Temp images
                $lastmdtime = filemtime($temp);
                if ((time() - $lastmdtime) / 60 > Config("UPLOAD_TEMP_FOLDER_TIME_LIMIT")) {
                    @gc_collect_cycles();
                    @unlink($temp);
                }
            }
        }
        closedir($dh);
    }
}

// Clean temp upload folder
function CleanUploadTempPath($fld, $idx = -1)
{
    $folder = UploadTempPath($fld, $idx);
    CleanPath($folder, true); // Clean the upload folder
    // Remove table temp folder if empty
    $folder = UploadTempPath($fld, $idx, true);
    $files = @scandir($folder);
    if (is_array($files) && count($files) <= 2) {
        CleanPath($folder, true);
    }
}

// Clean folder
function CleanPath($folder, $delete = false)
{
    $folder = IncludeTrailingDelimiter($folder, true);
    try {
        if (@is_dir($folder)) {
            if ($dir_handle = @opendir($folder)) {
                while (($entry = readdir($dir_handle)) !== false) {
                    if ($entry == "." || $entry == "..") {
                        continue;
                    }
                    if (@is_file($folder . $entry)) { // File
                        @gc_collect_cycles(); // Forces garbase collection (for S3)
                        @unlink($folder . $entry);
                    } elseif (@is_dir($folder . $entry)) { // Folder
                        CleanPath($folder . $entry, $delete);
                    }
                }
                @closedir($dir_handle);
            }
            if ($delete) {
                @rmdir($folder);
            }
        }
    } catch (\Throwable $e) {
        if (Config("DEBUG")) {
            throw $e;
        }
    }
}

// Check if empty folder
function IsEmptyPath($folder)
{
    $IsEmptyPath = true;
    // Check folder
    $folder = IncludeTrailingDelimiter($folder, true);
    if (is_dir($folder)) {
        if (count(@scandir($folder)) > 2) {
            return false;
        }
        if ($dir_handle = @opendir($folder)) {
            while (false !== ($subfolder = readdir($dir_handle))) {
                $tempfolder = PathCombine($folder, $subfolder, true);
                if ($subfolder == "." || $subfolder == "..") {
                    continue;
                }
                if (is_dir($tempfolder)) {
                    $IsEmptyPath = IsEmptyPath($tempfolder);
                }
                if (!$IsEmptyPath) {
                    return false; // No need to check further
                }
            }
        }
    } else {
        $IsEmptyPath = false;
    }
    return $IsEmptyPath;
}

/**
 * Truncate memo field based on specified length, string truncated to nearest whitespace
 *
 * @param string $memostr String to be truncated
 * @param int $maxlen Max. length
 * @param bool $removehtml Remove HTML or not
 * @return string
 */
function TruncateMemo($memostr, $maxlen, $removehtml = false)
{
    $str = $removehtml ? RemoveHtml($memostr) : $memostr;
    $str = preg_replace('/\s+/', " ", $str);
    $len = strlen($str);
    if ($len > 0 && $len > $maxlen) {
        $i = 0;
        while ($i >= 0 && $i < $len) {
            $j = strpos($str, " ", $i);
            if ($j === false) { // No whitespaces
                return substr($str, 0, $maxlen) . "..."; // Return the first part only
            } else {
                // Get nearest whitespace
                if ($j > 0) {
                    $i = $j;
                }
                // Get truncated text
                if ($i >= $maxlen) {
                    return substr($str, 0, $i) . "...";
                } else {
                    $i++;
                }
            }
        }
    }
    return $str;
}

// Remove HTML tags from text
function RemoveHtml($str)
{
    return preg_replace('/<[^>]*>/', '', strval($str));
}

// Function to send email
function SendEmail($fromEmail, $toEmail, $ccEmail, $bccEmail, $subject, $mailContent, $format, $charset, $smtpSecure = "", $attachments = [], $images = [], $members = null)
{
    global $Language;
    $mail = new \PHPMailer\PHPMailer\PHPMailer();

    // Set up mailer
    $mailer = Config("SMTP.PHPMAILER_MAILER");
    $methods = ["smtp" => "isSMTP", "mail" => "isMail", "sendmail" => "isSendmail", "qmail" => "isQmail"];
    $method = $methods[$mailer] ?? "isSMTP";
    $mail->$method();

    // Set up server settings
    $smtpServerUsername = Config("SMTP.SERVER_USERNAME");
    $smtpServerPassword = Config("SMTP.SERVER_PASSWORD");
    if (Config("ENCRYPTION_ENABLED")) {
        try {
            if ($smtpServerUsername != "") {
                $smtpServerUsername = PhpDecrypt($smtpServerUsername);
            }
            if ($smtpServerPassword != "") {
                $smtpServerPassword = PhpDecrypt($smtpServerPassword);
            }
        } catch (\Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException $e) {
            $smtpServerUsername = Config("SMTP.SERVER_USERNAME");
            $smtpServerPassword = Config("SMTP.SERVER_PASSWORD");
        }
    }
    $mail->Host = Config("SMTP.SERVER");
    $mail->SMTPAuth = ($smtpServerUsername != "" && $smtpServerPassword != "");
    $mail->Username = $smtpServerUsername;
    $mail->Password = $smtpServerPassword;
    $mail->Port = Config("SMTP.SERVER_PORT");
    if (Config("DEBUG")) {
        $mail->SMTPDebug = 2; // DEBUG_SERVER
        $mail->Debugoutput = PROJECT_NAMESPACE . "SetDebugMessage";
    }
    if ($smtpSecure != "") {
        $mail->SMTPSecure = $smtpSecure;
        $mail->SMTPOptions = ["ssl" => ["verify_peer" => false, "verify_peer_name" => false, "allow_self_signed" => true]];
    }
    if (preg_match('/^(.+)<([\w.%+-]+@[\w.-]+\.[A-Z]{2,6})>$/i', trim($fromEmail), $m)) {
        $mail->From = $m[2];
        $mail->FromName = trim($m[1]);
    } else {
        $mail->From = $fromEmail;
        $mail->FromName = $fromEmail;
    }
    $mail->Subject = $subject;
    if (SameText($format, "html")) {
        $mail->isHTML(true);
        $mail->Body = $mailContent;
    } else {
        $mail->isHTML(false);
        if (strip_tags($mailContent) != $mailContent) { // Contains HTML tags
            $mail->Body = HtmlToText($mailContent);
        } else {
            $mail->Body = $mailContent;
        }
    }
    if ($charset && !SameText($charset, "iso-8859-1")) {
        $mail->CharSet = $charset;
    }
    $toEmail = str_replace(";", ",", $toEmail);
    $arTo = explode(",", $toEmail);
    foreach ($arTo as $to) {
        if (preg_match('/^(.+)<([\w.%+-]+@[\w.-]+\.[A-Z]{2,6})>$/i', trim($to), $m)) {
            $mail->addAddress($m[2], trim($m[1]));
        } else {
            $mail->addAddress(trim($to));
        }
    }
    if ($ccEmail != "") {
        $ccEmail = str_replace(";", ",", $ccEmail);
        $arCc = explode(",", $ccEmail);
        foreach ($arCc as $cc) {
            if (preg_match('/^(.+)<([\w.%+-]+@[\w.-]+\.[A-Z]{2,6})>$/i', trim($cc), $m)) {
                $mail->addCC($m[2], trim($m[1]));
            } else {
                $mail->addCC(trim($cc));
            }
        }
    }
    if ($bccEmail != "") {
        $bccEmail = str_replace(";", ",", $bccEmail);
        $arBcc = explode(",", $bccEmail);
        foreach ($arBcc as $bcc) {
            if (preg_match('/^(.+)<([\w.%+-]+@[\w.-]+\.[A-Z]{2,6})>$/i', trim($bcc), $m)) {
                $mail->addBCC($m[2], trim($m[1]));
            } else {
                $mail->addBCC(trim($bcc));
            }
        }
    }
    if (is_array($attachments)) {
        foreach ($attachments as $attachment) {
            $filename = @$attachment["filename"];
            $content = @$attachment["content"];
            if ($content != "" && $filename != "") {
                $mail->addStringAttachment($content, $filename);
            } elseif ($filename != "") {
                $mail->addAttachment($filename);
            }
        }
    }
    if (is_array($images)) {
        foreach ($images as $tmpImage) {
            $file = UploadTempPath() . $tmpImage;
            $cid = TempImageLink($tmpImage, "cid");
            $mail->addEmbeddedImage($file, $cid, $tmpImage);
        }
    }
    if (is_array($members)) {
        foreach ($members as $name => $value) {
            if (property_exists($mail, $name)) {
                $mail->set($name, $value);
            } elseif (method_exists($mail, $name)) {
                if (!$value) {
                    $value = [];
                } elseif (!is_array($value)) {
                    $value = [$value];
                }
                $mail->$name(...$value);
            }
        }
    }
    $res = $mail->send() ?: $mail->ErrorInfo;
    if ($res !== true && Config("DEBUG")) { // Error
        SetDebugMessage($res, $mail->SMTPDebug);
        Log($res);
    }
    return $res; // True on success, error info on error
}

// Clean email content
function CleanEmailContent($content)
{
    $content = preg_replace('/\s+class="card ew-grid \w+"/', "", $content);
    $content = preg_replace('/\s+class="(table-responsive(-sm|-md|-lg|-xl)? )?card-body ew-grid-middle-panel"/', "", $content);
    $content = str_replace("table ew-table", "ew-export-table", $content);
    return $content;
}

// Field data type
function FieldDataType($fldtype)
{
    switch ($fldtype) {
        case 20:
        case 3:
        case 2:
        case 16:
        case 4:
        case 5:
        case 131:
        case 139:
        case 6:
        case 17:
        case 18:
        case 19:
        case 21: // Numeric
            return DATATYPE_NUMBER;
        case 7:
        case 133:
        case 135: // Date
        case 146: // DateTiemOffset
            return DATATYPE_DATE;
        case 134: // Time
        case 145: // Time
            return DATATYPE_TIME;
        case 201:
        case 203: // Memo
            return DATATYPE_MEMO;
        case 129:
        case 130:
        case 200:
        case 202: // String
            return DATATYPE_STRING;
        case 11: // Boolean
            return DATATYPE_BOOLEAN;
        case 72: // GUID
            return DATATYPE_GUID;
        case 128:
        case 204:
        case 205: // Binary
            return DATATYPE_BLOB;
        case 141: // XML
            return DATATYPE_XML;
        default:
            return DATATYPE_OTHER;
    }
}

/**
 * Root relative path
 *
 * @return string Root relative path
 */
function RootRelativePath()
{
    global $RELATIVE_PATH;
    return $RELATIVE_PATH;
}

/**
 * Application root
 *
 * @param bool $phyPath
 * @return string Path of the application root
 */
function AppRoot($phyPath)
{
    $root = RootRelativePath(); // Use root relative path
    if ($phyPath) {
        $path = realpath($root ?: ".");
        $path = preg_replace('/(?<!^)\\\\\\\\/', PATH_DELIMITER, $path); // Replace '\\' (not at the start of path) by path delimiter
    } else {
        $path = $root;
    }
    return IncludeTrailingDelimiter($path, $phyPath);
}

/**
 * Upload path
 *
 * @param bool $phyPath Physical path or not
 * @param string $destPath Destination path
 * @return string If $phyPath is true, return physical path on the server. If $phyPath is false, return relative URL.
 */
function UploadPath($phyPath, $destPath = "")
{
    $destPath = $destPath ?: Config("UPLOAD_DEST_PATH");
    if (IsRemote($destPath)) { // Remote
        $path = $destPath;
        $phyPath = false;
    } elseif ($phyPath) { // Physical
        $destPath = str_replace("/", PATH_DELIMITER, $destPath);
        $path = PathCombine(AppRoot(true), $destPath, true);
    } else { // Relative
        $path = PathCombine(AppRoot(false), $destPath, false);
    }
    return IncludeTrailingDelimiter($path, $phyPath);
}

// Get physical path relative to application root
function ServerMapPath($path, $isFile = false)
{
    $pathinfo = IsRemote($path) ? [] : pathinfo($path);
    if ($isFile && @$pathinfo["basename"] != "" || @$pathinfo["extension"] != "") { // File
        return UploadPath(true, $pathinfo["dirname"]) . $pathinfo["basename"];
    } else { // Folder
        return UploadPath(true, $path);
    }
}

// Write info for config/debug only
function Info()
{
    echo "UPLOAD_DEST_PATH = " . Config("UPLOAD_DEST_PATH") . "<br>";
    echo "AppRoot(true) = " . AppRoot(true) . "<br>";
    echo "AppRoot(false) = " . AppRoot(false) . "<br>";
    echo "realpath('.') = " . realpath(".") . "<br>";
    echo "DOCUMENT_ROOT = " . ServerVar("DOCUMENT_ROOT") . "<br>";
    echo "__FILE__ = " . __FILE__ . "<br>";
    echo "CurrentUserName() = " . CurrentUserName() . "<br>";
    echo "CurrentUserID() = " . CurrentUserID() . "<br>";
    echo "CurrentParentUserID() = " . CurrentParentUserID() . "<br>";
    echo "IsLoggedIn() = " . (IsLoggedIn() ? "true" : "false") . "<br>";
    echo "IsAdmin() = " . (IsAdmin() ? "true" : "false") . "<br>";
    echo "IsSysAdmin() = " . (IsSysAdmin() ? "true" : "false") . "<br>";
    Security()->showUserLevelInfo();
}

/**
 * Generate a unique file name for a folder (filename(n).ext)
 *
 * @param string|string[] $folders Output folder(s)
 * @param string $orifn Original file name
 * @param bool $indexed Index starts from '(n)' at the end of the original file name
 * @return string
 */
function UniqueFilename($folders, $orifn, $indexed = false)
{
    if ($orifn == "") {
        $orifn = date("YmdHis") . ".bin";
    }
    $fn = $orifn;
    $folders = is_array($folders) ? $folders : [$folders];
    foreach ($folders as $folder) {
        $info = pathinfo($fn);
        $newfn = $info["basename"];
        $destpath = $folder . $newfn;
        $i = 1;
        if ($indexed && preg_match('/\(\d+\)$/', $newfn, $matches)) { // Match '(n)' at the end of the file name
            $i = (int)$matches[1];
        }
        if (!file_exists($folder) && !CreateFolder($folder)) {
            throw new \Exception("Folder does not exist: " . $folder); //** side effect
        }
        while (file_exists(Convert(PROJECT_ENCODING, FILE_SYSTEM_ENCODING, $destpath))) {
            $file_name = preg_replace('/\(\d+\)$/', '', $info["filename"]); // Remove "(n)" at the end of the file name
            $newfn = $file_name . "(" . $i++ . ")." . $info["extension"];
            $destpath = $folder . $newfn;
        }
        $fn = $newfn;
    }
    return $fn;
}

// Get refer URL
function ReferUrl()
{
    return ServerVar("HTTP_REFERER");
}

// Get refer page name
function ReferPageName()
{
    return GetPageName(ReferUrl());
}

// Get script physical folder
function ScriptFolder()
{
    $folder = "";
    $path = ServerVar("SCRIPT_FILENAME");
    $p = strrpos($path, PATH_DELIMITER);
    if ($p !== false) {
        $folder = substr($path, 0, $p);
    }
    return ($folder != "") ? $folder : realpath(".");
}

// Get a temp folder for temp file
function TempFolder()
{
    $folders = [];
    if (IS_WINDOWS) {
        $folders[] = ServerVar("TEMP");
        $folders[] = ServerVar("TMP");
    } else {
        if (Config("USER_UPLOAD_TEMP_PATH") != "") {
            $folders[] = ServerMapPath(Config("USER_UPLOAD_TEMP_PATH"));
        }
        $folders[] = '/tmp';
    }
    if (ini_get('upload_tmp_dir')) {
        $folders[] = ini_get('upload_tmp_dir');
    }
    foreach ($folders as $folder) {
        if (is_dir($folder)) {
            return $folder;
        }
    }
    return null;
}

/**
 * Create folder
 *
 * AWS SDK maps mode 7xx to ACL_PUBLIC, 6xx to ACL_AUTH_READ and others to ACL_PRIVATE.
 * mkdir() does not use the 3rd argument.
 * If bucket key not found, createBucket(), otherwise createSubfolder().
 * See https://github.com/aws/aws-sdk-php/blob/master/src/S3/StreamWrapper.php
 *
 * @param string $dir Directory
 * @param int $mode Permissions
 * @return bool
 */
function CreateFolder($dir, $mode = 0)
{
    return is_dir($dir) || ($mode ? @mkdir($dir, $mode, true) : (@mkdir($dir, 0777, true) || @mkdir($dir, 0666, true) || @mkdir($dir, 0444, true)));
}

// Save file
function SaveFile($folder, $fn, $filedata)
{
    $fn = Convert(PROJECT_ENCODING, FILE_SYSTEM_ENCODING, $fn);
    $res = false;
    if (CreateFolder($folder)) {
        $file = IncludeTrailingDelimiter($folder, true) . $fn;
        if (IsRemote($file)) { // Support S3 only
            $res = file_put_contents($file, $filedata);
        } else {
            $res = file_put_contents($file, $filedata, Config("SAVE_FILE_OPTIONS"));
        }
        if ($res !== false) {
            @chmod($file, Config("UPLOADED_FILE_MODE"));
        }
    }
    return $res;
}

// Copy file
function CopyFile($folder, $fn, $file)
{
    $fn = Convert(PROJECT_ENCODING, FILE_SYSTEM_ENCODING, $fn);
    if (file_exists($file)) {
        if (CreateFolder($folder)) {
            $newfile = IncludeTrailingDelimiter($folder, true) . $fn;
            return copy($file, $newfile);
        }
    }
    return false;
}

/**
 * Set cache
 *
 * @param string $key Key or token
 * @param array|object $val Values
 * @return int|false Number of bytes written to the file, or false on failure
 */
function SetCache($key, $val)
{
    $val = var_export($val, true);
    $val = str_replace("stdClass::__set_state", "(object)", $val);
    $path = IncludeTrailingDelimiter(UploadPath(true) . Config("UPLOAD_TEMP_FOLDER_PREFIX") . $key, true);
    $file = $key . ".txt";
    return SaveFile($path, $file, '<?php $val = ' . $val . ';');
}

/**
 * Get cache
 *
 * @param string $key Key or token
 * @return array|object Values
 */
function GetCache($key)
{
    $path = IncludeTrailingDelimiter(UploadPath(true) . Config("UPLOAD_TEMP_FOLDER_PREFIX") . $key, true);
    $file = $key . ".txt";
    @include $path . $file;
    return $val ?? false;
}

/**
 * Generate random number
 *
 * @param int $length Number of digits
 * @return int
 */
function Random($length = 8)
{
    $min = pow(10, $length - 1);
    $max = pow(10, $length) - 1;
    return mt_rand($min, $max);
}

// Calculate field hash
function GetFieldHash($value)
{
    return md5(GetFieldValueAsString($value));
}

// Get field value as string
function GetFieldValueAsString($value)
{
    if ($value === null) {
        return "";
    }
    if (strlen($value) > 65535) { // BLOB/TEXT
        if (Config("BLOB_FIELD_BYTE_COUNT") > 0) {
            return substr($value, 0, Config("BLOB_FIELD_BYTE_COUNT"));
        } else {
            return $value;
        }
    }
    return strval($value);
}

// Create file with unique file name
function TempFileName($folder, $prefix)
{
    if (IsRemote($folder)) {
        $file = $folder . $prefix . dechex(mt_rand(0, 65535)) . ".tmp";
        file_put_contents($file, ""); // Add a blank file
        return $file;
    }
    return @tempnam($folder, $prefix);
}

// Create temp image file from binary data
function TempImage(&$filedata)
{
    global $TempImages;
    $export = Param("export") ?? Post("exporttype");
    $folder = UploadTempPath();
    $f = TempFileName($folder, "tmp");
    $handle = fopen($f, 'w');
    fwrite($handle, $filedata);
    fclose($handle);
    $ct = MimeContentType($f);
    switch ($ct) {
        case "image/gif":
            rename($f, $f .= ".gif");
            break;
        case "image/jpeg":
            rename($f, $f .= ".jpg");
            break;
        case "image/png":
            rename($f, $f .= ".png");
            break;
        case "image/bmp":
            rename($f, $f .= ".bmp");
            break;
        default:
            return "";
    }
    $tmpimage = basename($f);
    $TempImages[] = $tmpimage;
    return TempImageLink($tmpimage, $export);
}

// Get temp image path
function TempImageLink($file, $lnktype = "")
{
    if ($file == "") {
        return "";
    }
    if ($lnktype == "email" || $lnktype == "cid") {
        $ar = explode(".", $file);
        $lnk = implode(".", array_slice($ar, 0, count($ar) - 1));
        if ($lnktype == "email") {
            $lnk = "cid:" . $lnk;
        }
        return $lnk;
    }
    // If Config("UPLOAD_TEMP_PATH"), returns physical path, else returns relative path.
    return UploadTempPath(Config("UPLOAD_TEMP_PATH") && Config("UPLOAD_TEMP_HREF_PATH")) . $file;
}

// Delete temp images
function DeleteTempImages()
{
    global $TempImages;
    foreach ($TempImages as $tmpimage) {
        @gc_collect_cycles();
        @unlink(UploadTempPath() . $tmpimage);
    }
}

// Add query string to URL
function UrlAddQuery($url, $qry)
{
    if (strval($qry) == "") {
        return $url;
    }
    return $url . (ContainsString($url, "?") ? "&" : "?") . $qry;
}

// Add "hash" parameter to URL
function UrlAddHash($url, $hash)
{
    return UrlAddQuery($url, "hash=" . $hash);
}

/**
 * Functions for image resize
 */

// Resize binary to thumbnail
function ResizeBinary(&$filedata, &$width, &$height, $quality = 100, $plugins = [])
{
    if ($width <= 0 && $height <= 0) {
        return false;
    }
    if (is_array($quality) && count($plugins) == 0) {
        $plugins = $quality;
    }
    $f = @tempnam(TempFolder(), "tmp");
    $handle = @fopen($f, 'wb');
    if ($handle) {
        fwrite($handle, $filedata);
        fclose($handle);
    }
    $format = "";
    if (file_exists($f) && filesize($f) > 0) { // Temp file created
        $info = @getimagesize($f);
        @gc_collect_cycles();
        @unlink($f);
        if (!$info || !in_array($info[2], [1, 2, 3])) { // Not gif/jpg/png
            return false;
        } elseif ($info[2] == 1) {
            $format = "GIF";
        } elseif ($info[2] == 2) {
            $format = "JPG";
        } elseif ($info[2] == 3) {
            $format = "PNG";
        }
    } else { // Temp file not created
        if (StartsString("\x47\x49\x46\x38\x37\x61", $filedata) || StartsString("\x47\x49\x46\x38\x39\x61", $filedata)) {
            $format = "GIF";
        } elseif (StartsString("\xFF\xD8\xFF\xE0", $filedata) && substr($filedata, 6, 5) == "\x4A\x46\x49\x46\x00") {
            $format = "JPG";
        } elseif (StartsString("\x89\x50\x4E\x47\x0D\x0A\x1A\x0A", $filedata)) {
            $format = "PNG";
        } else {
            return false;
        }
    }
    $cls = Config("THUMBNAIL_CLASS");
    $thumb = new $cls($filedata, Config("RESIZE_OPTIONS") + ["isDataStream" => true, "format" => $format], $plugins);
    return $thumb->resizeEx($filedata, $width, $height);
}

// Resize file to thumbnail file
function ResizeFile($fn, $tn, &$width, &$height, $plugins = [])
{
    $info = @getimagesize($fn);
    if (!$info || !in_array($info[2], [1, 2, 3]) || $width <= 0 && $height <= 0) {
        if ($fn != $tn) {
            copy($fn, $tn);
        }
        return;
    }
    $cls = Config("THUMBNAIL_CLASS");
    $thumb = new $cls($fn, Config("RESIZE_OPTIONS"), $plugins);
    $fdata = null;
    if (!$thumb->resizeEx($fdata, $width, $height, $tn)) {
        if ($fn != $tn) {
            copy($fn, $tn);
        }
    }
}

// Resize file to binary
function ResizeFileToBinary($fn, &$width, &$height, $plugins = [])
{
    $info = @getimagesize($fn);
    if (!$info) {
        return null;
    }
    if (!in_array($info[2], [1, 2, 3]) || $width <= 0 && $height <= 0) {
        $fdata = file_get_contents($fn);
    } else {
        $cls = Config("THUMBNAIL_CLASS");
        $thumb = new $cls($fn, Config("RESIZE_OPTIONS"), $plugins);
        $fdata = null;
        if (!$thumb->resizeEx($fdata, $width, $height)) {
            $fdata = file_get_contents($fn);
        }
    }
    return $fdata;
}

/**
 * Functions for Auto-Update fields
 */

// Get user IP
function CurrentUserIP()
{
    return ServerVar("HTTP_CLIENT_IP") ?: ServerVar("HTTP_X_FORWARDED_FOR") ?: ServerVar("HTTP_X_FORWARDED") ?:
        ServerVar("HTTP_FORWARDED_FOR") ?: ServerVar("HTTP_FORWARDED") ?: ServerVar("REMOTE_ADDR");
}

// Is local host
function IsLocal()
{
    return in_array(CurrentUserIP(), ["127.0.0.1", "::1"]);
}

// Get current host name, e.g. "www.mycompany.com"
function CurrentHost()
{
    return ServerVar("HTTP_HOST");
}

// Get current Windows user (for Windows Authentication)
function CurrentWindowsUser()
{
    return ServerVar("AUTH_USER"); // REMOTE_USER or LOGON_USER or AUTH_USER
}

/**
 * Get current date in default date format
 *
 * @param int $namedformat Format = -1|5|6|7 (see comment for FormatDateTime)
 * @return string
 */
function CurrentDate($namedformat = -1)
{
    if (in_array($namedformat, [5, 6, 7, 9, 10, 11, 12, 13, 14, 15, 16, 17])) {
        if ($namedformat == 5 || $namedformat == 9 || $namedformat == 12 || $namedformat == 15) {
            $dt = FormatDateTime(date('Y-m-d'), 5);
        } elseif ($namedformat == 6 || $namedformat == 10 || $namedformat == 13 || $namedformat == 16) {
            $dt = FormatDateTime(date('Y-m-d'), 6);
        } else {
            $dt = FormatDateTime(date('Y-m-d'), 7);
        }
        return $dt;
    } else {
        return date('Y-m-d');
    }
}

// Get current time in hh:mm:ss format
function CurrentTime()
{
    return date("H:i:s");
}

/**
 * Get current date in default date format with time in hh:mm:ss format
 *
 * @param int $namedformat Format = -1, 5-7, 9-11 (see comment for FormatDateTime)
 * @return string
 */
function CurrentDateTime($namedformat = -1)
{
    if (in_array($namedformat, [5, 6, 7, 9, 10, 11, 12, 13, 14, 15, 16, 17])) {
        if ($namedformat == 5 || $namedformat == 9 || $namedformat == 12 || $namedformat == 15) {
            $dt = FormatDateTime(date('Y-m-d H:i:s'), 9);
        } elseif ($namedformat == 6 || $namedformat == 10 || $namedformat == 13 || $namedformat == 16) {
            $dt = FormatDateTime(date('Y-m-d H:i:s'), 10);
        } else {
            $dt = FormatDateTime(date('Y-m-d H:i:s'), 11);
        }
        return $dt;
    } else {
        return date('Y-m-d H:i:s');
    }
}

// Get current date in standard format (yyyy/mm/dd)
function StdCurrentDate()
{
    return date('Y/m/d');
}

// Get date in standard format (yyyy/mm/dd)
function StdDate($ts)
{
    return date('Y/m/d', $ts);
}

// Get current date and time in standard format (yyyy/mm/dd hh:mm:ss)
function StdCurrentDateTime()
{
    return date('Y/m/d H:i:s');
}

// Get date/time in standard format (yyyy/mm/dd hh:mm:ss)
function StdDateTime($ts)
{
    return date('Y/m/d H:i:s', $ts);
}

// Get current date and time in database format (yyyy-mm-dd hh:mm:ss)
function DbCurrentDateTime()
{
    return date('Y-m-d H:i:s');
}

// Encrypt password
function EncryptPassword($input, $salt = '')
{
    if (Config("PASSWORD_HASH")) {
        return password_hash($input, PASSWORD_DEFAULT);
    } else {
        return (strval($salt) != "") ? md5($input . $salt) . ":" . $salt : md5($input);
    }
}

/**
 * Compare password
 * Note: If salted, password must be stored in '<hashedstring>:<salt>'
 *
 * @param string $pwd Password to compare
 * @param string $input Input password
 * @return bool
 */
function ComparePassword($pwd, $input)
{
    if (preg_match('/^\$[HP]\$/', $pwd)) { // phpass
        $ar = Config("PHPASS_ITERATION_COUNT_LOG2");
        foreach ($ar as $i) {
            $hasher = new \PasswordHash($i, true);
            if ($hasher->CheckPassword($input, $pwd)) {
                return true;
            }
        }
        return false;
    } elseif (ContainsString($pwd, ':')) { // <hashedstring>:<salt>
        @list($crypt, $salt) = explode(":", $pwd, 2);
        return ($pwd == EncryptPassword($input, $salt));
    } else {
        if (Config("CASE_SENSITIVE_PASSWORD")) {
            if (Config("ENCRYPTED_PASSWORD")) {
                if (Config("PASSWORD_HASH")) {
                    return password_verify($input, $pwd);
                } else {
                    return ($pwd == EncryptPassword($input));
                }
            } else {
                return ($pwd == $input);
            }
        } else {
            if (Config("ENCRYPTED_PASSWORD")) {
                if (Config("PASSWORD_HASH")) {
                    return password_verify(strtolower($input), $pwd);
                } else {
                    return ($pwd == EncryptPassword(strtolower($input)));
                }
            } else {
                return SameText($pwd, $input);
            }
        }
    }
}

// Get security object
function Security()
{
    global $Security;
    $Security = $Security ?? Container("security") ?? new AdvancedSecurity();
    return $Security;
}

/**
 * Session helper
 *
 * @return mixed Session value or HttpSession
 */
function Session()
{
    $numargs = func_num_args();
    if ($numargs == 1) { // Get
        $name = func_get_arg(0);
        return $_SESSION[$name] ?? null;
    } elseif ($numargs == 2) { // Set
        list($name, $value) = func_get_args();
        $_SESSION[$name] = $value;
    }
    global $Session;
    $Session = $Session ?? Container("session");
    return $Session;
}

// Get profile value
function Profile()
{
    global $UserProfile;
    $UserProfile = $UserProfile ?? Container("profile");
    $numargs = func_num_args();
    if ($numargs == 1) { // Get
        $name = func_get_arg(0);
        return $UserProfile->get($name);
    } elseif ($numargs == 2) { // Set
        list($name, $value) = func_get_args();
        $UserProfile->set($name, $value);
        $UserProfile->save();
    }
    return $UserProfile;
}

// Get language object
function Language()
{
    return Container("language");
}

// Get breadcrumb object
function Breadcrumb()
{
    return $GLOBALS["Breadcrumb"];
}

// Get Logger
function Logger()
{
    return Container("log");
}

 /**
 * Adds a log record at the DEBUG level
 *
 * @param string $message The log message
 * @param array  $context The log context
 */
function Log($msg, array $context = [])
{
    Logger()->debug($msg, $context);
}

/**
 * Functions for backward compatibility
 */

// Get current user name
function CurrentUserName()
{
    return isset($_SESSION[SESSION_USER_NAME]) ? strval($_SESSION[SESSION_USER_NAME]) : Security()->currentUserName();
}

// Get current user ID
function CurrentUserID()
{
    return Security()->currentUserID();
}

// Get current parent user ID
function CurrentParentUserID()
{
    return Security()->currentParentUserID();
}

// Get current user level
function CurrentUserLevel()
{
    return Security()->currentUserLevelID();
}

// Get current user level name
function CurrentUserLevelName()
{
    return Security()->currentUserLevelName();
}

// Get current user level list
function CurrentUserLevelList()
{
    return Security()->userLevelList();
}

// Get current user email
function CurrentUserEmail()
{
    global $UserProfile;
    return $UserProfile->get(Config("USER_EMAIL_FIELD_NAME")) ?? "";
}

// Get current user image as base 64 string
function CurrentUserImageBase64()
{
    global $UserProfile;
    return $UserProfile->get(Config("USER_PROFILE_IMAGE")) ?? "";
}

// Get Current user info
function CurrentUserInfo($fldname)
{
    global $Security, $UserTable;
    if (isset($Security)) {
        return $Security->currentUserInfo($fldname);
    } elseif (Config("USER_TABLE") && !IsSysAdmin()) {
        $info = null;
        $filter = GetUserFilter(Config("LOGIN_USERNAME_FIELD_NAME"), CurrentUserName());
        if ($filter != "") {
            $UserTable = Container("usertable");
            $sql = $UserTable->getSql($filter);
            if ($row = Conn($UserTable->Dbid)->fetchAssociative($sql)) {
                $info = GetUserInfo($fldname, $row);
            }
        }
        return $info;
    }
    return null;
}

// Get user info
function GetUserInfo($fieldName, $row)
{
    global $UserTable;
    $info = null;
    if ($row) {
        $info = $row[$fieldName] ?? null;
        if (Config("USER_TABLE")) {
            $UserTable = Container("usertable");
        }
        if (($fld = @$UserTable->Fields[$fieldName]) && $fld->isEncrypt()) {
            try {
                $info = PhpDecrypt(strval($info));
            } catch (\Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException $e) {
            }
        }
        if ($fieldName == Config("LOGIN_PASSWORD_FIELD_NAME") && !Config("ENCRYPTED_PASSWORD")) { // Password is saved HTML-encoded
            $info = HtmlDecode($info);
        }
    }
    return $info;
}

// Get user filter
function GetUserFilter($fieldName, $val)
{
    global $UserTable;
    if (Config("USER_TABLE")) {
        $UserTable = Container("usertable");
    }
    if ($fld = @$UserTable->Fields[$fieldName]) {
        return "(" . QuotedName($fld->Name, Config("USER_TABLE_DBID")) . " = " . QuotedValue($val, $fld->DataType, Config("USER_TABLE_DBID")) . ")";
    }
    return "(0=1)"; // Show no records
}

// Get current page ID
function CurrentPageID()
{
    if (property_exists($GLOBALS["Page"] ?? new \stdClass(), "PageID")) {
        return $GLOBALS["Page"]->PageID;
    } elseif (defined(PROJECT_NAMESPACE . "PAGE_ID")) {
        return PAGE_ID;
    }
    return "";
}

// Allow list
function AllowList($tableName)
{
    return Security()->allowList($tableName);
}

// Allow add
function AllowAdd($tableName)
{
    return Security()->allowAdd($tableName);
}

// Is password expired
function IsPasswordExpired()
{
    return Session(SESSION_STATUS) == "passwordexpired";
}

// Set session password expired
function SetSessionPasswordExpired()
{
    return Security()->setSessionPasswordExpired();
}

// Is password reset
function IsPasswordReset()
{
    return Session(SESSION_STATUS) == "passwordreset";
}

// Is logging in
function IsLoggingIn()
{
    return Session(SESSION_STATUS) == "loggingin";
}

// Is logging in (2FA)
function IsLoggingIn2FA()
{
    return Session(SESSION_STATUS) == "loggingin2fa";
}

// Is logged in
function IsLoggedIn()
{
    return Session(SESSION_STATUS) == "login" || Security()->isLoggedIn();
}

// Is admin
function IsAdmin()
{
    return Session(SESSION_SYS_ADMIN) === 1 || Security()->isAdmin();
}

// Is system admin
function IsSysAdmin()
{
    return Session(SESSION_SYS_ADMIN) === 1 || Security()->isSysAdmin();
}

// Is Windows authenticated
function IsAuthenticated()
{
    return CurrentWindowsUser() != "";
}

// Is Export
function IsExport($format = "")
{
    global $ExportType;
    if ($format) {
        return SameText($ExportType, $format);
    } else {
        return ($ExportType != "");
    }
}

// Encrypt
function Encrypt($str, $key = "")
{
    return Tea::encrypt($str, $key ?: Config("RANDOM_KEY"));
}

// Decrypt
function Decrypt($str, $key = "")
{
    return Tea::decrypt($str, $key ?: Config("RANDOM_KEY"));
}

// Encrypt with php-encryption
function PhpEncrypt($str, $key = "")
{
    return PhpEncryption::encryptWithPassword($str, $key ?: Config("ENCRYPTION_KEY"));
}

// Decrypt with php-encryption
function PhpDecrypt($str, $key = "")
{
    return PhpEncryption::decryptWithPassword($str, $key ?: Config("ENCRYPTION_KEY"));
}

// Remove XSS
function RemoveXss($val)
{
    global $PurifierConfig, $Purifier;
    if ($Purifier === null) {
        $Purifier = new \HTMLPurifier($PurifierConfig);
    }
    if (is_array($val)) {
        return array_map(function ($v) use ($Purifier) {
            return $Purifier->purify($v);
        }, $val);
    } else {
        return $Purifier->purify($val);
    }
}

/**
 * HTTP request by cURL
 * Note: cURL must be enabled in PHP
 *
 * @param string $url URL
 * @param string $postdata Data for the request
 * @param string $method Request method, "GET"(default) or "POST"
 * @return mixed Returns true on success or false on failure
 *  If the CURLOPT_RETURNTRANSFER option is set, returns the result on success, false on failure.
 */
function ClientUrl($url, $postdata = "", $method = "GET")
{
    if (!function_exists("curl_init")) {
        throw new \Exception("cURL not installed."); //** side effect
    }
    $ch = curl_init();
    $method = strtoupper($method);
    if ($method == "POST") {
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    } elseif ($method == "GET") {
        curl_setopt($ch, CURLOPT_URL, $url . "?" . $postdata);
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

/**
 * Calculate date difference
 *
 * @param string $dateTimeBegin Begin date
 * @param string $dateTimeEnd End date
 * @param string $interval Interval: "s": Seconds, "n": Minutes, "h": Hours, "d": Days (default), "w": Weeks, "ww": Calendar weeks, "m": Months, or "yyyy": Years
 * @return int
 */
function DateDiff($dateTimeBegin, $dateTimeEnd, $interval = "d")
{
    $dateTimeBegin = strtotime($dateTimeBegin);
    if ($dateTimeBegin === -1 || $dateTimeBegin === false) {
        return false;
    }
    $dateTimeEnd = strtotime($dateTimeEnd);
    if ($dateTimeEnd === -1 || $dateTimeEnd === false) {
        return false;
    }
    $dif = $dateTimeEnd - $dateTimeBegin;
    $arBegin = getdate($dateTimeBegin);
    $dateBegin = mktime(0, 0, 0, $arBegin["mon"], $arBegin["mday"], $arBegin["year"]);
    $arEnd = getdate($dateTimeEnd);
    $dateEnd = mktime(0, 0, 0, $arEnd["mon"], $arEnd["mday"], $arEnd["year"]);
    $difDate = $dateEnd - $dateBegin;
    switch ($interval) {
        case "s": // Seconds
            return $dif;
        case "n": // Minutes
            return ($dif > 0) ? floor($dif / 60) : ceil($dif / 60);
        case "h": // Hours
            return ($dif > 0) ? floor($dif / 3600) : ceil($dif / 3600);
        case "d": // Days
            return ($difDate > 0) ? floor($difDate / 86400) : ceil($difDate / 86400);
        case "w": // Weeks
            return ($difDate > 0) ? floor($difDate / 604800) : ceil($difDate / 604800);
        case "ww": // Calendar weeks
            $difWeek = (($dateEnd - $arEnd["wday"] * 86400) - ($dateBegin - $arBegin["wday"] * 86400)) / 604800;
            return ($difWeek > 0) ? floor($difWeek) : ceil($difWeek);
        case "m": // Months
            return (($arEnd["year"] * 12 + $arEnd["mon"]) - ($arBegin["year"] * 12 + $arBegin["mon"]));
        case "yyyy": // Years
            return ($arEnd["year"] - $arBegin["year"]);
    }
}

// Get SQL log
function GetSqlLog()
{
    $sqlLogger = Container("debugstack");
    $msg = "";
    foreach ($sqlLogger->queries as $query) {
        $values = [];
        foreach ($query as $key => $value) {
            if (is_array($value)) {
                if (count($value) > 0) {
                    $values[] = $key . ": " . print_r($value, true);
                }
            } elseif (strlen($value) > 0) {
                $values[] = $key . ": " . $value;
            }
        }
        $msg .= "<p>" . implode(", ", $values) . "</p>";
    }
    return $msg;
}

// Read global debug message
function GetDebugMessage()
{
    if (!Config("DEBUG")) {
        return "";
    }
    global $DebugMessage, $ExportType, $Language;
    $msg = $DebugMessage . GetSqlLog();
    $DebugMessage = "";
    return ($ExportType == "" && $msg != "") ? str_replace(["%t", "%s"], [$Language->phrase("Debug") ?: "Debug", $msg], CONFIG("DEBUG_MESSAGE_TEMPLATE")) : "";
}

// Set global debug message (2nd argument not used but required)
function SetDebugMessage($v, $level = 0)
{
    global $DebugMessage, $DebugTimer;
    $ar = preg_split('/<(hr|br)>/', trim($v));
    $ar = array_filter($ar, function ($s) {
        return trim($s);
    });
    $v = implode("; ", $ar);
    $DebugMessage .= "<p><samp>" . (isset($DebugTimer) ? $DebugTimer->getFormattedElapsedTime() . ": " : "") . $v . "</samp></p>";
}

// Save global debug message
function SaveDebugMessage()
{
    global $DebugMessage;
    if (Config("DEBUG")) {
        $_SESSION["DEBUG_MESSAGE"] = $DebugMessage . GetSqlLog();
    }
}

// Load global debug message
function LoadDebugMessage()
{
    global $DebugMessage;
    if (Config("DEBUG")) {
        $DebugMessage = Session("DEBUG_MESSAGE");
        $_SESSION["DEBUG_MESSAGE"] = "";
    }
}

// Permission denied message
function DeniedMessage()
{
    return str_replace("%s", ScriptName(), Container("language")->phrase("NoPermission"));
}

// Init array
function InitArray($len, $value)
{
    if ($len > 0) {
        return array_fill(0, $len, $value);
    }
    return [];
}

// Init 2D array
function Init2DArray($len1, $len2, $value)
{
    return InitArray($len1, InitArray($len2, $value));
}

/**
 * Validation functions
 */

/**
 * Check date
 *
 * @param string $value Value
 * @param int|string Formatter pattern
 * @return bool
 */
function CheckDate($value, $format = "")
{
    global $CurrentLocale, $TIME_ZONE;
    if (strval($value) == "") {
        return true;
    }
    $dt = trim($value);
    if (preg_match('/^([0-9]{4})-([0][1-9]|[1][0-2])-([0][1-9]|[1|2][0-9]|[3][0|1])( (0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])(:([0-5][0-9]))?)?$/', $dt)) { // Date/Time
        return true;
    }
    $fmt = new \IntlDateFormatter($CurrentLocale, null, null, $TIME_ZONE, null, DateFormat($format));
    return $fmt->parse($dt) !== false; // Parse by $format
}

/**
 * Check time
 *
 * @param string $value Value
 * @param int|string Formatter pattern
 * @return bool
 */
function CheckTime($value, $format = "")
{
    global $CurrentLocale, $TIME_ZONE;
    if (strval($value) == "") {
        return true;
    }
    $dt = trim($value);
    if (preg_match('/^(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])(:([0-5][0-9]))?$/', $dt)) { // Date/Time
        return true;
    }
    $fmt = new \IntlDateFormatter($CurrentLocale, null, null, $TIME_ZONE, null, DateFormat($format));
    return $fmt->parse($dt) !== false; // Parse by $format
}

// Check integer
function CheckInteger($value)
{
    if (strval($value) == "") {
        return true;
    }
    return IsNumeric($value) && ParseInteger($value) !== false;
}

// Check number
function CheckNumber($value)
{
    if (strval($value) == "") {
        return true;
    }
    return IsNumeric($value) && ParseNumber($value) !== false;
}

/**
 * Check range (number)
 *
 * @param int|float $value Value
 * @param int|float $min Min value
 * @param int|float $max Max value
 * @return bool
 */
function CheckRange($value, $min, $max)
{
    if (strval($value) == "") {
        return true;
    }
    if (is_int($min) || is_float($min) || is_int($max) || is_float($max)) { // Number
        $value = ParseNumber($value);
        if ($value === false) { // Not number format
            return false;
        }
    }
    if ($min != null && $value < $min || $max != null && $value > $max) {
        return false;
    }
    return true;
}

// Check US phone number
function CheckPhone($value)
{
    if (strval($value) == "") {
        return true;
    }
    return preg_match('/^\(\d{3}\) ?\d{3}( |-)?\d{4}|^\d{3}( |-)?\d{3}( |-)?\d{4}$/', $value);
}

// Check US zip code
function CheckZip($value)
{
    if (strval($value) == "") {
        return true;
    }
    return preg_match('/^\d{5}$|^\d{5}-\d{4}$/', $value);
}

// Check credit card
function CheckCreditCard($value, $type = "")
{
    if (strval($value) == "") {
        return true;
    }
    $creditcard = [
        "visa" => "/^4\d{3}[ -]?\d{4}[ -]?\d{4}[ -]?\d{4}$/",
        "mastercard" => "/^5[1-5]\d{2}[ -]?\d{4}[ -]?\d{4}[ -]?\d{4}$/",
        "discover" => "/^6011[ -]?\d{4}[ -]?\d{4}[ -]?\d{4}$/",
        "amex" => "/^3[4,7]\d{13}$/",
        "diners" => "/^3[0,6,8]\d{12}$/",
        "bankcard" => "/^5610[ -]?\d{4}[ -]?\d{4}[ -]?\d{4}$/",
        "jcb" => "/^[3088|3096|3112|3158|3337|3528]\d{12}$/",
        "enroute" => "/^[2014|2149]\d{11}$/",
        "switch" => "/^[4903|4911|4936|5641|6333|6759|6334|6767]\d{12}$/"
    ];
    if (empty($type)) {
        $match = false;
        foreach ($creditcard as $type => $pattern) {
            if (@preg_match($pattern, $value) == 1) {
                $match = true;
                break;
            }
        }
        return ($match) ? CheckSum($value) : false;
    } else {
        if (!preg_match($creditcard[strtolower(trim($type))], $value)) {
            return false;
        }
        return CheckSum($value);
    }
}

// Check sum
function CheckSum($value)
{
    $value = str_replace(['-', ' '], ['', ''], $value);
    $checksum = 0;
    for ($i = (2 - (strlen($value) % 2)); $i <= strlen($value); $i += 2) {
        $checksum += (int)($value[$i - 1]);
    }
    for ($i = (strlen($value) % 2) + 1; $i < strlen($value); $i += 2) {
        $digit = (int)($value[$i - 1]) * 2;
        $checksum += ($digit < 10) ? $digit : ($digit - 9);
    }
    return ($checksum % 10 == 0);
}

// Check US social security number
function CheckSsn($value)
{
    if (strval($value) == "") {
        return true;
    }
    return preg_match('/^(?!000)([0-6]\d{2}|7([0-6]\d|7[012]))([ -]?)(?!00)\d\d\3(?!0000)\d{4}$/', $value);
}

// Check emails
function CheckEmails($value, $count)
{
    if (strval($value) == "") {
        return true;
    }
    $list = str_replace(",", ";", $value);
    $ar = explode(";", $list);
    $cnt = count($ar);
    if ($cnt > $count && $count > 0) {
        return false;
    }
    foreach ($ar as $email) {
        if (!CheckEmail($email)) {
            return false;
        }
    }
    return true;
}

// Check email
function CheckEmail($value)
{
    if (strval($value) == "") {
        return true;
    }
    return preg_match('/^[\w.%+-]+@[\w.-]+\.[A-Z]{2,18}$/i', trim($value));
}

// Check GUID
function CheckGuid($value)
{
    if (strval($value) == "") {
        return true;
    }
    return preg_match('/^(\{\w{8}-\w{4}-\w{4}-\w{4}-\w{12}\}|\w{8}-\w{4}-\w{4}-\w{4}-\w{12})$/', $value);
}

// Check file extension
function CheckFileType($value, $exts = "")
{
    if (strval($value) == "") {
        return true;
    }
    $extension = substr(strtolower(strrchr($value, ".")), 1);
    $exts = $exts ?: Config("UPLOAD_ALLOWED_FILE_EXT");
    $allowExt = explode(",", strtolower($exts));
    return (in_array($extension, $allowExt) || trim($exts) == "");
}

// Check empty string
function EmptyString($value)
{
    $str = strval($value);
    if (preg_match('/&[^;]+;/', $str)) { // Contains HTML entities
        $str = @html_entity_decode($str, ENT_COMPAT | ENT_HTML5, PROJECT_ENCODING);
    }
    $str = str_replace(SameText(PROJECT_ENCODING, "UTF-8") ? "\xC2\xA0" : "\xA0", " ", $str); // Remove utf-8 non-breaking space
    return trim($str) == "";
}

// Check empty value // PHP
function EmptyValue($value)
{
    return $value === null || is_string($value) && strlen($value) == 0;
}

// Check masked password
function IsMaskedPassword($value)
{
    return preg_match('/^\*+$/', strval($value));
}

// Check by preg
function CheckByRegEx($value, $pattern)
{
    if (strval($value) == "") {
        return true;
    }
    return preg_match($pattern, $value);
}

// Check URL
function CheckUrl($value)
{
    return CheckByRegEx($value, Config("URL_PATTERN"));
}

// Check special characters for user name
function CheckUsername($value)
{
    return preg_match("/[" . preg_quote(Config("INVALID_USERNAME_CHARACTERS")) . "]/", strval($value));
}

// Check special characters for password
function CheckPassword($value)
{
    return preg_match("/[" . preg_quote(Config("INVALID_PASSWORD_CHARACTERS")) . "]/", strval($value));
}

/**
 * Convert to UTF-8
 *
 * @param mixed $val Value being converted
 * @return mixed
 */
function ConvertToUtf8($val)
{
    if (Config("IS_UTF8")) {
        return $val;
    }
    if (is_string($val)) {
        return Convert(PROJECT_ENCODING, "UTF-8", $val);
    } elseif (is_array($val) || is_object($val)) {
        $isObject = is_object($val);
        if ($isObject) {
            $val = (array)$val;
        }
        $res = [];
        foreach ($val as $key => $value) {
            $res[ConvertToUtf8($key)] = ConvertToUtf8($value);
        }
        return ($isObject) ? (object)$res : $res;
    }
    return $val;
}

/**
 * Convert from UTF-8
 *
 * @param mixed $val Value being converted
 * @return mixed
 */
function ConvertFromUtf8($val)
{
    if (Config("IS_UTF8")) {
        return $val;
    }
    if (is_string($val)) {
        return Convert("UTF-8", PROJECT_ENCODING, $val);
    } elseif (is_array($val) || is_object($val)) {
        $isObject = is_object($val);
        if ($isObject) {
            $val = (array)$val;
        }
        $res = [];
        foreach ($val as $key => $value) {
            $res[ConvertFromUtf8($key)] = ConvertFromUtf8($value);
        }
        return ($isObject) ? (object)$res : $res;
    }
    return $val;
}

/**
 * Convert encoding
 *
 * @param string $from Encoding (from)
 * @param string $to Encoding (to)
 * @param string $str String being converted
 * @return string
 */
function Convert($from, $to, $str)
{
    if (is_string($str) && $from != "" && $to != "" && !SameText($from, $to)) {
        if (function_exists("iconv")) {
            return iconv($from, $to, $str);
        } elseif (function_exists("mb_convert_encoding")) {
            return mb_convert_encoding($str, $to, $from);
        } else {
            return $str;
        }
    } else {
        return $str;
    }
}

/**
 * Returns the JSON representation of a value
 *
 * @param mixed $val The value being encoded
 * @param string $type optional Specifies data type: "boolean", "string", "date" or "number"
 * @return string (No conversion to UTF-8)
 */
function VarToJson($val, $type = null)
{
    if ($val === null) {
        return "null";
    }
    $type = strtolower($type);
    if ($type == "boolean" || is_bool($val)) {
        return ConvertToBool($val) ? "true" : "false";
    } elseif ($type == "date") {
        return 'new Date("' . $val . '")';
    } elseif ($type == "number") {
        return (float)$val;
    } elseif ($type == "string" || is_string($val)) {
        if (ContainsString($val, "\0")) { // Contains null byte
            $val = "binary";
        } elseif (strlen($val) > Config("DATA_STRING_MAX_LENGTH")) {
            $val = substr($val, 0, Config("DATA_STRING_MAX_LENGTH"));
        }
        return '"' . JsEncode($val) . '"';
    }
    return $val;
}

/**
 * Convert array to JSON
 * If asscociative array, elements with integer key will not be outputted.
 *
 * @param array $ar The array being encoded
 * @param int $offset The number of entries to skip
 * @return string (No conversion to UTF-8)
 */
function ArrayToJson(array $ar, $offset = 0)
{
    if ($offset > 0) {
        $ar = array_slice($ar, $offset);
    }
    $isObject = ArraySome("is_string", array_keys($ar));
    $res = [];
    if ($isObject) {
        foreach ($ar as $key => $val) {
            if (!is_int($key)) { // If object, skip element with integer key
                $res[] = VarToJson($key, "string") . ":" . JsonEncode($val);
            }
        }
        return IsDebug() ? "{\n" . implode(",\n", $res) . "\n}" : "{" . implode(",", $res) . "}";
    } else {
        foreach ($ar as $val) {
            $res[] = JsonEncode($val);
        }
        return IsDebug() ? "[\n" . implode(",\n", $res) . "\n]" : "[" . implode(",", $res) . "]";
    }
}

/**
 * JSON encode
 *
 * @param mixed $val The value being encoded
 * @param int|string $option optional Specifies offset if $val is array, or else specifies data type
 * @return string (non UTF-8)
 */
function JsonEncode($val, $option = null)
{
    if (is_array($val)) {
        return ArrayToJson($val, (int)$option);
    } elseif (is_object($val)) {
        return ArrayToJson((array)$val);
    } else {
        return VarToJson($val, $option);
    }
}

/**
 * JSON decode
 *
 * @param string $val The JSON string being decoded (non UTF-8)
 * @param bool $assoc optional When true, returned objects will be converted into associative arrays.
 * @param int $depth optional User specified recursion depth
 * @param int $options optional Bitmask of JSON decode options:
 *  JSON_BIGINT_AS_STRING - allows casting big integers to string instead of floats
 *  JSON_OBJECT_AS_ARRAY - same as setting assoc to true
 * @return void NULL is returned if the json cannot be decoded or if the encoded data is deeper than the recursion limit.
 */
function JsonDecode($val, $assoc = false, $depth = 512, $options = 0)
{
    if (!Config("IS_UTF8")) {
        $val = ConvertToUtf8($val); // Convert to UTF-8
    }
    $res = json_decode($val, $assoc, $depth, $options);
    if (!Config("IS_UTF8")) {
        $res = ConvertFromUtf8($res);
    }
    return $res;
}

/**
 * Check if a predicate is true for at least one element
 *
 * @param callable $callback Predicate
 * @param array $arr Array being tested
 * @return bool
 */
function ArraySome(callable $callback, array $ar)
{
    foreach ($ar as $element) {
        if ($callback($element)) {
            return true;
        }
    }
    return false;
}

/**
 * Add <script> tag (async) by script
 *
 * @param string $src Path of script
 * @return void
 */
function AddClientScript($src, $id = "", $options = null)
{
    LoadJs($src, $id, $options);
}

/**
 * Add <link> tag by script
 *
 * @param string $src Path of stylesheet
 * @return void
 */
function AddStylesheet($src, $id = "")
{
    LoadJs("css!" . $src, $id);
}

/**
 * Load JavaScript or Stylesheet by loadjs
 *
 * @param string $src Path of script/stylesheet
 * @param string $id (optional) ID of the script
 * @param array $options (optional) Options (async and numRetries), see https://github.com/muicss/loadjs
 * @return void
 */
function LoadJs($src, $id = "", $options = null)
{
    $prefix = "";
    if (preg_match('/^css!/i', $src, $matches)) {
        $src = preg_replace('/^css!/i', '', $src);
        $prefix = "css!";
    }
    $basePath = BasePath(true);
    if (!IsRemote($src) && $basePath != "" && !StartsString($basePath, $src)) { // PHP
        $src = $basePath . $src;
    }
    echo '<script>loadjs("' . $prefix . $src . '"' . ($id ? ', "' . $id . '"' : '') . (is_array($options) ? ', ' . json_encode($options) : '') . ');</script>';
}

/**
 * Check boolean attribute
 *
 * @param string $attr Attribute name
 * @return bool
 */
function IsBooleanAttribute($attr)
{
    return in_array(strtolower($attr), Config("BOOLEAN_HTML_ATTRIBUTES"));
}

/**
 * Build HTML element
 *
 * @param string $tagname Tag name
 * @param array|Attributes $attrs Attributes
 * @param string $innerhtml Inner HTML
 * @return string HTML string
 */
function HtmlElement($tagname, $attrs = [], $innerhtml = "")
{
    $tagname = strtolower($tagname);
    if (is_array($attrs)) {
        $attrs = new Attributes($attrs);
    } elseif (!$attrs instanceof Attributes) {
        $attrs = new Attributes();
    }
    $html = "<" . $tagname . $attrs->toString() . ">";
    if (!in_array($tagname, Config("HTML_SINGLETON_TAGS"))) { // Not singleton
        if (strval($innerhtml) != "") {
            $html .= $innerhtml;
        }
        $html .= "</" . $tagname . ">";
    }
    return $html;
}

/**
 * Get HTML <a> tag
 *
 * @param string $phraseId Phrase ID for inner HTML
 * @param string|array|Attributes $attrs The href attribute, or array of attributes, or Attributes object
 * @return string HTML string
 */
function GetLinkHtml($attrs, $phraseId)
{
    global $Language;
    if (is_string($attrs)) {
        $attrs = new Attributes(["href" => $attrs]);
    } elseif (is_array($attrs)) {
        $attrs = new Attributes($attrs);
    } elseif (!$attrs instanceof Attributes) {
        $attrs = new Attributes();
    }
    $attrs->checkLinkAttributes();
    $phrase = $Language->phrase($phraseId);
    $title = $attrs["title"];
    if (!$title) {
        $title = HtmlTitle($phrase);
        $attrs["title"] = $title;
    }
    if ($title && !$attrs["data-caption"]) {
        $attrs["data-caption"] = $title;
    }
    return HtmlElement("a", $attrs, $phrase);
}

/**
 * Encode HTML
 *
 * @param string $exp String to encode
 * @return string Encoded string
 */
function HtmlEncode($exp)
{
    return @htmlspecialchars(strval($exp), ENT_COMPAT | ENT_HTML5, PROJECT_ENCODING);
}

/**
 * Decode HTML
 *
 * @param string $exp String to decode
 * @return string Decoded string
 */
function HtmlDecode($exp)
{
    return @htmlspecialchars_decode(strval($exp), ENT_COMPAT | ENT_HTML5);
}

// Get title
function HtmlTitle($name)
{
    if (
        preg_match('/<span class=([\'"])visually-hidden\\1>([\s\S]*?)<\/span>/i', $name, $matches) || // Match span.visually-hidden
        preg_match('/\s+title\s*=\s*([\'"])([\s\S]*?)\\1/i', $name, $matches) || // Match title='title'
        preg_match('/\s+data-caption\s*=\s*([\'"])([\s\S]*?)\\1/i', $name, $matches) // Match data-caption='caption'
    ) {
        return $matches[2];
    }
    return $name;
}

/**
 * Get HTML for an option
 *
 * @param mixed $val Value of the option
 * @return string HTML
 */
function OptionHtml($val)
{
    return preg_replace('/\{value\}/', $val, Config("OPTION_HTML_TEMPLATE"));
}

/**
 * Get HTML for all option
 *
 * @param array $values Array of values
 * @return string HTML
 */
function OptionsHtml(array $values)
{
    $html = "";
    foreach ($values as $val) {
        $html .= OptionHtml($val);
    }
    return $html;
}

// XML tag name
function XmlTagName($name)
{
    if (!preg_match('/\A(?!XML)[a-z][\w0-9-]*/i', $name)) {
        $name = "_" . $name;
    }
    return $name;
}

// Convert XML to array
function Xml2Array($contents)
{
    if (!$contents) {
        return [];
    }

    // Get the XML Parser of PHP
    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); // Always return in utf-8
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);
    if (!is_array($xml_values)) {
        return [];
    }
    $xml_array = [];
    $parents = [];
    $opened_tags = [];
    $arr = [];
    $current = &$xml_array;
    $repeated_tag_index = []; // Multiple tags with same name will be turned into an array
    foreach ($xml_values as $data) {
        unset($attributes, $value); // Remove existing values

        // Extract these variables into the foreach scope
        // - tag(string), type(string), level(int), attributes(array)
        extract($data);
        $result = [];
        if (isset($value)) {
            $result["value"] = $value; // Put the value in a assoc array
        }

        // Set the attributes
        if (isset($attributes)) {
            foreach ($attributes as $attr => $val) {
                $result["attr"][$attr] = $val; // Set all the attributes in a array called 'attr'
            }
        }

        // See tag status and do the needed
        if ($type == "open") { // The starting of the tag '<tag>'
            $parent[$level - 1] = &$current;
            if (!is_array($current) || !in_array($tag, array_keys($current))) { // Insert New tag
                if ($tag != 'ew-language' && @$result["attr"]["id"] != '') {
                    $last_item_index = $result["attr"]["id"];
                    $current[$tag][$last_item_index] = $result;
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    $current = &$current[$tag][$last_item_index];
                } else {
                    $current[$tag] = $result;
                    $repeated_tag_index[$tag . '_' . $level] = 0;
                    $current = &$current[$tag];
                }
            } else { // Another element with the same tag name
                if ($repeated_tag_index[$tag . '_' . $level] > 0) { // If there is a 0th element it is already an array
                    if (@$result["attr"]["id"] != '') {
                        $last_item_index = $result["attr"]["id"];
                    } else {
                        $last_item_index = $repeated_tag_index[$tag . '_' . $level];
                    }
                    $current[$tag][$last_item_index] = $result;
                    $repeated_tag_index[$tag . '_' . $level]++;
                } else { // Make the value an array if multiple tags with the same name appear together
                    $temp = $current[$tag];
                    $current[$tag] = [];
                    if (@$temp["attr"]["id"] != '') {
                        $current[$tag][$temp["attr"]["id"]] = $temp;
                    } else {
                        $current[$tag][] = $temp;
                    }
                    if (@$result["attr"]["id"] != '') {
                        $last_item_index = $result["attr"]["id"];
                    } else {
                        $last_item_index = 1;
                    }
                    $current[$tag][$last_item_index] = $result;
                    $repeated_tag_index[$tag . '_' . $level] = 2;
                }
                $current = &$current[$tag][$last_item_index];
            }
        } elseif ($type == "complete") { // Tags that ends in one line '<tag />'
            if (!isset($current[$tag])) { // New key
                $current[$tag] = []; // Always use array for "complete" type
                if (@$result["attr"]["id"] != '') {
                    $current[$tag][$result["attr"]["id"]] = $result;
                } else {
                    $current[$tag][] = $result;
                }
                $repeated_tag_index[$tag . '_' . $level] = 1;
            } else { // Existing key
                if (@$result["attr"]["id"] != '') {
                    $current[$tag][$result["attr"]["id"]] = $result;
                } else {
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                }
                $repeated_tag_index[$tag . '_' . $level]++;
            }
        } elseif ($type == 'close') { // End of tag '</tag>'
            $current = &$parent[$level - 1];
        }
    }
    return $xml_array;
}

// Encode value for double-quoted Javascript string
function JsEncode($val)
{
    $val = strval($val);
    if (IS_DOUBLE_BYTE) {
        $val = ConvertToUtf8($val);
    }
    $val = str_replace("\\", "\\\\", $val);
    $val = str_replace("\"", "\\\"", $val);
    $val = str_replace("\t", "\\t", $val);
    $val = str_replace("\r", "\\r", $val);
    $val = str_replace("\n", "\\n", $val);
    if (IS_DOUBLE_BYTE) {
        $val = ConvertFromUtf8($val);
    }
    return $val;
}

// Encode value to single-quoted Javascript string for HTML attributes
function JsEncodeAttribute($val)
{
    $val = strval($val);
    if (IS_DOUBLE_BYTE) {
        $val = ConvertToUtf8($val);
    }
    $val = str_replace("&", "&amp;", $val);
    // $val = str_replace("\"", "&quot;", $val); // No need to replace since attribute is single-quoted
    $val = str_replace("'", "&apos;", $val);
    $val = str_replace("<", "&lt;", $val);
    $val = str_replace(">", "&gt;", $val);
    if (IS_DOUBLE_BYTE) {
        $val = ConvertFromUtf8($val);
    }
    return $val;
}

// Convert array to JSON for single quoted HTML attributes
function ArrayToJsonAttribute($ar)
{
    $str = ArrayToJson($ar);
    return JsEncodeAttribute($str);
}

/**
 * Get current page URL
 *
 * @param bool $withArgs Whether with arguments
 * @return string URL
 */
function CurrentPageUrl($withArgs = true)
{
    $route = GetRoute();
    $args = $route->getArguments();
    if (!$withArgs) {
        foreach ($args as $key => &$val) {
            $val = "";
        }
        unset($val);
    }
    return rtrim(UrlFor($route->getName(), $args), "/");
}

// Get current page name (does not contain path)
function CurrentPageName()
{
    return GetPageName(CurrentPageUrl());
}

// Get page name
function GetPageName($url)
{
    $pageName = "";
    if ($url != "") {
        $pageName = $url;
        $p = strpos($pageName, "?");
        if ($p !== false) {
            $pageName = substr($pageName, 0, $p); // Remove QueryString
        }
        $host = ServerVar("HTTP_HOST");
        $p = strpos($pageName, $host);
        if ($p !== false) {
            $pageName = substr($pageName, $p + strlen($host)); // Remove host
        }
        $basePath = BasePath();
        if ($basePath != "" && StartsString($basePath, $pageName)) { // Remove base path
            $pageName = substr($pageName, strlen($basePath));
        }
        if (StartsString("/", $pageName)) { // Remove first "/"
            $pageName = substr($pageName, 1);
        }
        if (ContainsString($pageName, "/")) {
            $pageName = explode("/", $pageName)[0];
        }
    }
    return $pageName;
}

// Get current user levels as array of user level IDs
function CurrentUserLevels()
{
    return Security()->UserLevelID;
}

// Check if menu item is allowed for current user level
function AllowListMenu($tableName)
{
    if (IsLoggedIn()) { // Get user level ID list as array
        $userlevels = CurrentUserLevels(); // Get user level ID list as array
    } else { // Get anonymous user level ID
        $userlevels = [-2];
    }
    if (in_array("-1", $userlevels)) {
        return true;
    } else {
        $priv = 0;
        $rows = Session(SESSION_AR_USER_LEVEL_PRIV);
        if (is_array($rows)) {
            foreach ($rows as $row) {
                if (SameString($row[0], $tableName) && in_array($row[1], $userlevels)) {
                    $thispriv = $row[2] ?? 0;
                    $thispriv = (int)$thispriv;
                    $priv = $priv | $thispriv;
                }
            }
        }
        return ($priv & ALLOW_LIST);
    }
}

// Get script name
function ScriptName()
{
    $route = GetRoute();
    return $route
        ? UrlFor($route->getName(), $route->getArguments())
        : explode("?", $_SERVER["REQUEST_URI"] ?? "")[0];
}

// Get server variable by name
function ServerVar($name)
{
    return $_SERVER[$name] ?? $_ENV[$name] ?? "";
}

// Get CSS file
function CssFile($f, $rtl = null, $min = null)
{
    $rtl = $rtl ?? IsRTL();
    $min = $min ?? Config("USE_COMPRESSED_STYLESHEET");
    return $rtl
        ? ($min ? preg_replace('/(.css)$/i', ".rtl.min.css", $f) : preg_replace('/(.css)$/i', ".rtl.css", $f))
        : ($min ? preg_replace('/(.css)$/i', ".min.css", $f) : $f);
}

// Check if HTTPS
function IsHttps()
{
    return ServerVar("HTTPS") != "" && ServerVar("HTTPS") != "off" || ServerVar("SERVER_PORT") == 443 ||
        ServerVar("HTTP_X_FORWARDED_PROTO") != "" && ServerVar("HTTP_X_FORWARDED_PROTO") == "https";
}

// Get domain URL
function DomainUrl()
{
    $ssl = IsHttps();
    $port = strval(ServerVar("SERVER_PORT"));
    if (ServerVar("HTTP_X_FORWARDED_PROTO") != "" && strval(ServerVar("HTTP_X_FORWARDED_PORT")) != "") {
        $port = strval(ServerVar("HTTP_X_FORWARDED_PORT"));
    }
    $port = in_array($port, ["80", "443"]) ? "" : (":" . $port);
    return ($ssl ? "https" : "http") . "://" . ServerVar("SERVER_NAME") . $port;
}

// Get current URL
function CurrentUrl()
{
    $s = ScriptName();
    $q = ServerVar("QUERY_STRING");
    if ($q != "") {
        $s .= "?" . $q;
    }
    return $s;
}

// Get full URL (relative to the current script)
function FullUrl($url = "", $type = "")
{
    if (IsRemote($url)) { // Remote
        return $url;
    }
    if (StartsString("/", $url)) { // Absolute
        return DomainUrl() . $url;
    }
    $route = GetRoute();
    $fullUrl = FullUrlFor($route->getName());
    $baseUrl = substr($fullUrl, 0, strrpos($fullUrl, "/") + 1); // Get path of current script
    if ($url != "") {
        $fullUrl = RemoveTrailingDelimiter(PathCombine($baseUrl, $url, false), false); // Combine input URL
    }
    if ($type != "") {
        $protocol = Config("FULL_URL_PROTOCOLS." . $type);
        if ($protocol) {
            $fullUrl = preg_replace('/^\w+(?=:\/\/)/i', $protocol, $fullUrl);
        }
    }
    return $fullUrl;
}

// Get URL with base path
function GetUrl($url)
{
    global $RELATIVE_PATH;
    if ($url != "" && !StartsString("/", $url) && !ContainsString($url, "://") && !ContainsString($url, "\\") && !ContainsString($url, "javascript:")) {
        $basePath = BasePath(true);
        if ($RELATIVE_PATH != "") {
            $basePath = PathCombine($basePath, $RELATIVE_PATH, false);
        }
        return $basePath . $url;
    }
    return $url;
}

// Check if mobile device
function IsMobile()
{
    global $MobileDetect, $IsMobile;
    if (isset($IsMobile)) {
        return $IsMobile;
    }
    if (!isset($MobileDetect)) {
        $MobileDetect = new \Mobile_Detect();
        $IsMobile = $MobileDetect->isMobile();
    }
    return $IsMobile;
}

// Get responsive table class
function ResponsiveTableClass()
{
    $className = Config("RESPONSIVE_TABLE_CLASS");
    return (Config("USE_RESPONSIVE_TABLE") && $className) ? $className . " " : "";
}

/**
 * Execute query and get result statement
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @param int $mode Fetch mode
 * @return ResultStatement The executed statement
 */
function ExecuteQuery($sql, $c = null)
{
    if (is_string($c)) { // $sql, $DbId
        $c = Conn($c);
    }
    $conn = $c ?? $GLOBALS["Conn"] ?? Conn();
    return $conn->executeQuery($sql);
}

/**
 * Load recordset
 * @param string $sql SQL to execute
 * @param Connection $c optional Connection object
 * @return Recordset
 */
function LoadRecordset($sql, $c = null)
{
    $result = ExecuteQuery($sql, $c);
    return $result ? new Recordset($result, $sql) : false;
}

/**
 * Execute SELECT statement
 *
 * @param string $sql SQL to execute
 * @param mixed $fn Callback function to be called for each row
 * @param Connection|string $c optional Connection object or database ID
 * @return Recordset
 */
function Execute($sql, $fn = null, $c = null)
{
    if ($c === null && (is_string($fn) || $fn instanceof Connection)) {
        $c = $fn;
    }
    $sql = trim($sql);
    if (preg_match('/^(UPDATE|INSERT|DELETE)\s/i', $sql)) {
        return ExecuteStatement($sql, $c);
    }
    $result = ExecuteQuery($sql, $c);
    if (is_callable($fn)) {
        $rows = ExecuteRows($sql, $c);
        foreach ($rows as $row) {
            $fn(row);
        }
    }
    return new Recordset($result, $sql);
}

/**
 * Execute SELECT statment to get record count
 *
 * @param string|QueryBuilder $sql SQL or QueryBuilder
 * @param Connection $c Connection
 * @return int Record count
 */
function ExecuteRecordCount($sql, $c = null)
{
    $cnt = -1;
    $rs = null;
    if ($sql instanceof QueryBuilder) { // Query builder
        $queryBuider = clone $sql;
        $sqlwrk = $queryBuider->resetQueryPart("orderBy")->getSQL();
        $conn = $queryBuider->getConnection();
    } else {
        $conn = $c ?? $GLOBALS["Conn"] ?? Conn();
        $sqlwrk = $sql;
    }
    if ($stmt = $conn->executeQuery($sqlwrk)) {
        $cnt = $stmt->rowCount();
        if ($cnt <= 0) { // Unable to get record count, count directly
            $cnt = 0;
            while ($stmt->fetch()) {
                $cnt++;
            }
        }
        return $cnt;
    }
    return $cnt;
}

/**
 * Execute UPDATE, INSERT, or DELETE statements
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @return int Rows affected
 */
function ExecuteStatement($sql, $c = null)
{
    if (is_string($c)) { // $sql, $DbId
        $c = Conn($c);
    }
    $conn = $c ?? $GLOBALS["Conn"] ?? Conn();
    return $conn->executeStatement($sql);
}

/**
 * Execute UPDATE, INSERT, or DELETE statements (deprecated, for backward compatibility only)
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @return int Rows affected
 */
function ExecuteUpdate($sql, $c = null)
{
    return ExecuteStatement($sql, $c);
}

/**
 * Get QueryBuilder
 *
 * @param Connection|string $c optional Connection object or database ID
 * @return QueryBuilder
 */
function QueryBuilder($c = null)
{
    if (is_string($c)) { // $sql, $DbId
        $c = Conn($c);
    }
    $conn = $c ?? $GLOBALS["Conn"] ?? Conn();
    return $conn->createQueryBuilder();
}

/**
 * Get QueryBuilder for UPDATE
 *
 * @param string $t Table
 * @param Connection|string $c optional Connection object or database ID
 * @return QueryBuilder
 */
function Update($t, $c = null)
{
    return QueryBuilder($c)->update($t);
}

/**
 * Get QueryBuilder for INSERT
 *
 * @param string $t Table
 * @param Connection|string $c optional Connection object or database ID
 * @return QueryBuilder
 */
function Insert($t, $c = null)
{
    return QueryBuilder($c)->insert($t);
}

/**
 * Get QueryBuilder for DELETE
 *
 * @param string $t Table
 * @param Connection|string $c optional Connection object or database ID
 * @return QueryBuilder
 */
function Delete($t, $c = null)
{
    return QueryBuilder($c)->delete($t);
}

/**
 * Executes query and returns the first column of the first row
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @return mixed
 */
function ExecuteScalar($sql, $c = null)
{
    $result = ExecuteQuery($sql, $c);
    return $result->fetchOne();
}

/**
 * Executes the query, and returns the first row
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @param int $mode Fetch mode
 * @return mixed
 */
function ExecuteRow($sql, $c = null, $mode = FetchMode::ASSOCIATIVE)
{
    switch ($mode) {
        case FetchMode::ASSOCIATIVE:
            return ExecuteRowAssociative($sql, $c);
        case FetchMode::NUMERIC:
            return ExecuteRowNumeric($sql, $c);
        case FetchMode::COLUMN:
            return ExecuteScalar($sql, $c);
    }
    throw new LogicException('Only fetch modes declared on Doctrine\DBAL\FetchMode are supported.');
}

/**
 * Executes query and returns the first row (Associative)
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @return array<string,mixed>|false
 */
function ExecuteRowAssociative($sql, $c = null)
{
    $result = ExecuteQuery($sql, $c);
    return $result->fetchAssociative();
}

/**
 * Executes query and returns the first row (Numeric)
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @return list<mixed>|false
 */
function ExecuteRowNumeric($sql, $c = null)
{
    $result = ExecuteQuery($sql, $c);
    return $result->fetchNumeric();
}

/**
 * Executes query and returns all rows
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @param int $mode Fetch mode
 * @return list<mixed>
 */
function ExecuteRows($sql, $c = null, $mode = FetchMode::ASSOCIATIVE)
{
    switch ($mode) {
        case FetchMode::ASSOCIATIVE:
            return ExecuteRowsAssociative($sql, $c);
        case FetchMode::NUMERIC:
            return ExecuteRowsNumeric($sql, $c);
        case FetchMode::COLUMN:
            return ExecuteFirstColumn($sql, $c);
    }
    throw new LogicException('Only fetch modes declared on Doctrine\DBAL\FetchMode are supported.');
}

/**
 * Executes query and returns all rows (Associative)
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @return array<string,mixed>|false
 */
function ExecuteRowsAssociative($sql, $c = null)
{
    $result = ExecuteQuery($sql, $c);
    return $result->fetchAllAssociative();
}

/**
 * Executes query and returns all rows (Numeric)
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @return list<mixed>|false
 */
function ExecuteRowsNumeric($sql, $c = null)
{
    $result = ExecuteQuery($sql, $c);
    return $result->fetchAllNumeric();
}

/**
 * Executes query and returns an associative array with the keys mapped to the first column and the values being
 * an associative array representing the rest of the columns and their values
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @return array<mixed,array<string,mixed>>
 */
function ExecuteRowsAssociativeIndexed($sql, $c = null)
{
    $result = ExecuteQuery($sql, $c);
    return $result->fetchAllAssociativeIndexed();
}

/**
 * Executes query and an array containing the values of the first column of the result
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @return array<mixed,array<string,mixed>>
 */
function ExecuteRowsKeyValue($sql, $c = null)
{
    $result = ExecuteQuery($sql, $c);
    return $result->fetchAllKeyValue();
}

/**
 * Executes query and returns first column of all rows
 *
 * @param string $sql SQL to execute
 * @param Connection|string $c optional Connection object or database ID
 * @return list<mixed>
 */
function ExecuteFirstColumn($sql, $c = null)
{
    $result = ExecuteQuery($sql, $c);
    return $result->fetchFirstColumn();
}

/**
 * Executes query and returns all rows as JSON
 *
 * @param string $sql SQL to execute
 * @param array $options {
 *  @var bool "utf8" Convert to UTF-8, default: true
 *  @var bool "array" Output as array
 *  @var bool "firstonly" Output first row only
 *  @var bool "datatypes" Array of data types, key of array must be same as row(s)
 * }
 * @param Connection|string $c Connection object or DB ID
 * @return string
 */
function ExecuteJson($sql, $options = null, $c = null)
{
    $ar = is_array($options) ? $options : [];
    if (is_bool($options)) { // First only, backward compatibility
        $ar["firstonly"] = $options;
    }
    if ($c === null && is_object($options) && method_exists($options, "execute")) { // ExecuteJson($sql, $c)
        $c = $options;
    }
    $res = "false";
    $header = !array_key_exists("header", $ar) || $ar["header"]; // Set header for JSON
    $utf8 = $header || array_key_exists("utf8", $ar) && $ar["utf8"]; // Convert to utf-8
    $firstonly = array_key_exists("firstonly", $ar) && $ar["firstonly"];
    $datatypes = array_key_exists("datatypes", $ar) && is_array($ar["datatypes"]) ? $ar["datatypes"] : null;
    $array = array_key_exists("array", $ar) && $ar["array"];
    $mode = $array ? FetchMode::NUMERIC : FetchMode::ASSOCIATIVE;
    $rows = $firstonly ? [ExecuteRow($sql, $c, $mode)] : ExecuteRows($sql, $c, $mode);
    if (is_array($rows)) {
        $arOut = [];
        foreach ($rows as $row) {
            $arwrk = [];
            foreach ($row as $k => $v) {
                if ($array && is_string($k) || !$array && is_int($k)) {
                    continue;
                }
                $key = $array ? '' : '"' . JsEncode($k) . '":';
                $datatype = $datatypes ? @$datatypes[$k] : null;
                $val = VarToJson($v, $datatype);
                $arwrk[] = $key . $val;
            }
            if ($array) { // Array
                $arOut[] = "[" . implode(",", $arwrk) . "]";
            } else { // Object
                $arOut[] = "{" . implode(",", $arwrk) . "}";
            }
        }
        $res = $firstonly ? $arOut[0] : "[" . implode(",", $arOut) . "]";
        if ($utf8) {
            $res = ConvertToUtf8($res);
        }
    }
    return $res;
}

/**
 * Get query result in HTML table
 *
 * @param string $sql SQL to execute
 * @param array $options optional {
 *  @var bool|array "fieldcaption"
 *    true Use caption and use language object
 *    false Use field names directly
 *    array An associative array for looking up the field captions by field name
 *  @var bool "horizontal" Specifies if the table is horizontal, default: false
 *  @var string|array "tablename" Table name(s) for the language object
 *  @var string "tableclass" CSS class names of the table, default: "table table-bordered table-sm ew-db-table"
 *  @var Language "language" Language object, default: the global Language object
 * }
 * @param Connection|string $c optional Connection object or DB ID
 * @return string HTML string
 */
function ExecuteHtml($sql, $options = null, $c = null)
{
    // Internal function to get field caption
    $getFieldCaption = function ($key) use ($options) {
        $caption = "";
        if (!is_array($options)) {
            return $key;
        }
        $tableName = @$options["tablename"];
        $lang = $options["language"] ?? $GLOBALS["Language"];
        $useCaption = (array_key_exists("fieldcaption", $options) && $options["fieldcaption"]);
        if ($useCaption) {
            if (is_array($options["fieldcaption"])) {
                $caption = @$options["fieldcaption"][$key];
            } elseif (isset($lang)) {
                if (is_array($tableName)) {
                    foreach ($tableName as $tbl) {
                        $caption = @$lang->FieldPhrase($tbl, $key, "FldCaption");
                        if ($caption != "") {
                            break;
                        }
                    }
                } elseif ($tableName != "") {
                    $caption = @$lang->FieldPhrase($tableName, $key, "FldCaption");
                }
            }
        }
        return $caption ?: $key;
    };
    $options = is_array($options) ? $options : [];
    $horizontal = array_key_exists("horizontal", $options) && $options["horizontal"];
    $rs = LoadRecordset($sql, $c);
    if (!$rs || $rs->EOF || $rs->fieldCount() < 1) {
        return "";
    }
    $html = "";
    $class = $options["tableclass"] ?? "table table-sm ew-db-table"; // Table CSS class name
    if ($rs->recordCount() > 1 || $horizontal) { // Horizontal table
        $cnt = $rs->fieldCount();
        $html = "<table class=\"" . $class . "\">";
        $html .= "<thead><tr>";
        $row = &$rs->fields;
        foreach ($row as $key => $value) {
            $html .= "<th>" . $getFieldCaption($key) . "</th>";
        }
        $html .= "</tr></thead>";
        $html .= "<tbody>";
        $rowcnt = 0;
        while (!$rs->EOF) {
            $html .= "<tr>";
            $row = &$rs->fields;
            foreach ($row as $key => $value) {
                $html .= "<td>" . $value . "</td>";
            }
            $html .= "</tr>";
            $rs->moveNext();
        }
        $html .= "</tbody></table>";
    } else { // Single row, vertical table
        $html = "<table class=\"" . $class . "\"><tbody>";
        $row = &$rs->fields;
        foreach ($row as $key => $value) {
            $html .= "<tr><td>" . $getFieldCaption($key) . "</td><td>" . $value . "</td></tr>";
        }
        $html .= "</tbody></table>";
    }
    return $html;
}

/**
 * Prepend CSS class name(s)
 *
 * @param string &$attr Class name(s)
 * @param string $className Class name(s) to prepend
 * @return string Class name(s)
 */
function PrependClass(&$attr, $className)
{
    if ($className) {
        $attr = $className . " " . $attr;
    }
    if ($attr != "") {
        $ar = array_filter(explode(" ", $attr)); // Remove empty values
        $attr = implode(" ", array_unique($ar));
    }
    return $attr;
}

/**
 * Append CSS class name(s)
 *
 * @param string &$attr Class name(s)
 * @param string $className Class name(s) to append
 * @return string Class name(s)
 */
function AppendClass(&$attr, $className)
{
    if ($className) {
        $attr .= " " . $className;
    }
    if ($attr != "") {
        $ar = array_filter(explode(" ", $attr)); // Remove empty values
        $attr = implode(" ", array_unique($ar));
    }
    return $attr;
}

/**
 * Remove CSS class name(s)
 *
 * @param string &$attr Class name(s)
 * @param string $className Class name(s) to remove
 * @return string Class name(s)
 */
function RemoveClass(&$attr, $className)
{
    $ar = explode(" ", $attr);
    if ($className) {
        $classes = explode(" ", $className);
        $ar = array_diff($ar, $classes);
    }
    $ar = array_filter($ar); // Remove empty values
    $attr = implode(" ", array_unique($ar));
    return $attr;
}

/**
 * Get locale information
 */
function LocaleConvert()
{
    global $DATE_SEPARATOR, $TIME_SEPARATOR, $CURRENCY_CODE, $TIME_ZONE, $CurrentLocale;
    $langid = CurrentLanguageID();
    $localefile = Config("LOCALE_FOLDER") . $langid . ".json";
    if (file_exists($localefile)) { // Load from locale file
        $locale = array_merge(["id" => $langid], json_decode(file_get_contents($localefile), true));
    } else { // Load from PHP intl extension
        $locales = \ResourceBundle::getLocales("");
        if (!in_array(str_replace("-", "_", $langid), $locales)) { // Locale not supported by server
            Log("Locale " . $langid . " not supported by server.");
            $langid = "en-US"; // Fallback to "en-US"
        }
        $locale = [
            "id" => $langid,
            "desc" => \Locale::getDisplayName($langid),
        ];
    }
    $CurrentLocale = $locale["id"];
    $fmt = new \NumberFormatter($CurrentLocale, \NumberFormatter::DECIMAL);
    $currfmt = new \NumberFormatter($CurrentLocale, \NumberFormatter::CURRENCY);
    $pctfmt = new \NumberFormatter($CurrentLocale, \NumberFormatter::PERCENT);
    $currcode = $locale["currency_code"] ?? $currfmt->getTextAttribute(\NumberFormatter::CURRENCY_CODE);
    $locale["currency_code"] = $currcode != "XXX" ? $currcode : $CURRENCY_CODE;
    $locale["number"] = $locale["number"] ?? $fmt->getPattern();
    $locale["currency"] = $locale["currency"] ?? $currfmt->getPattern();
    $locale["percent"] = $locale["percent"] ?? $pctfmt->getPattern();
    $locale["percent_symbol"] = $locale["percent_symbol"] ?? $pctfmt->getSymbol(\NumberFormatter::PERCENT_SYMBOL);
    $locale["currency_symbol"] = $locale["currency_symbol"] ?? $currfmt->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
    $locale["date"] = $locale["date"] ?? (new \IntlDateFormatter($CurrentLocale, \IntlDateFormatter::SHORT, \IntlDateFormatter::NONE))->getPattern();
    $locale["time"] = $locale["time"] ?? (new \IntlDateFormatter($CurrentLocale, \IntlDateFormatter::NONE, \IntlDateFormatter::SHORT))->getPattern();
    $locale["decimal_separator"] = $locale["decimal_separator"] ?? $fmt->getSymbol(\NumberFormatter::DECIMAL_SEPARATOR_SYMBOL);
    $locale["grouping_separator"] = $locale["grouping_separator"] ?? $fmt->getSymbol(\NumberFormatter::GROUPING_SEPARATOR_SYMBOL);
    $locale["date_separator"] = $locale["date_separator"] ?? preg_grep('/\W/', str_split($locale["date"]))[0] ?? $DATE_SEPARATOR;
    $locale["time_separator"] = $locale["time_separator"] ?? preg_grep('/\W/', str_split($locale["time"]))[0] ?? $TIME_SEPARATOR;
    $locale["time_zone"] = $locale["time_zone"] ?? $TIME_ZONE;
    return $locale;
}

/**
 * Get ICU date/time format pattern
 *
 * @param int|string $dateFormat Date format
 * @return string ICU date format
 */
function DateFormat($dateFormat)
{
    global $DATE_SEPARATOR, $TIME_SEPARATOR, $DATE_FORMAT, $TIME_FORMAT;
    if (is_numeric($dateFormat)) { // Predefined format
        $id = intval($dateFormat);
        if ($id == 1) {
            return $DATE_FORMAT . " " . $TIME_FORMAT; // DateTime
        } elseif ($id == 0 || $id == 2) {
            return $DATE_FORMAT; // Date
        } elseif ($id == 3) {
            return $TIME_FORMAT; // Time
        } else { // Predefined formats
            $formats = Config("DATE_FORMATS");
            if (array_key_exists($id, $formats)) {
                return str_replace(["/", ":"], [$DATE_SEPARATOR, $TIME_SEPARATOR], $formats[$id]);
            }
        }
    } elseif (is_string($dateFormat) && !EmptyValue($dateFormat)) { // User defined format
        return $dateFormat;
    }
    return ""; // Unknown
}

/**
 * Get database date/time format pattern
 *
 * @param int|string $dateFormat Date format
 * @param string $dbtype Database type
 * @return string Database date format
 */
function DbDateFormat($dateFormat, $dbtype)
{
    global $DATE_SEPARATOR, $TIME_SEPARATOR;
    $dateFormat = DateFormat($dateFormat);
    $tokens = array_reverse(preg_split('/[_\W]/', $dateFormat, -1, PREG_SPLIT_OFFSET_CAPTURE));
    $symbols = Config("DB_DATE_FORMATS." . $dbtype);
    foreach ($tokens as $token) {
        $t = $token[0];
        $dateFormat = substr_replace($dateFormat, $symbols[$t] ?? $t, $token[1], strlen($t));
    }
    return str_replace(["/", ":"], [$DATE_SEPARATOR, $TIME_SEPARATOR], $dateFormat);
}

// Get path relative to a base path
function PathCombine($basePath, $relPath, $phyPath)
{
    if (IsRemote($relPath)) { // Allow remote file
        return $relPath;
    }
    $phyPath = !IsRemote($basePath) && $phyPath;
    $delimiter = ($phyPath) ? PATH_DELIMITER : '/';
    if ($basePath != $delimiter) { // If BasePath = root, do not remove delimiter
        $basePath = RemoveTrailingDelimiter($basePath, $phyPath);
    }
    $relPath = ($phyPath) ? str_replace(['/', '\\'], PATH_DELIMITER, $relPath) : str_replace('\\', '/', $relPath);
    $relPath = IncludeTrailingDelimiter($relPath, $phyPath);
    if ($basePath == $delimiter && !$phyPath) { // If BasePath = root and not physical path, just return relative path(?)
        return $relPath;
    }
    $p1 = strpos($relPath, $delimiter);
    $path2 = "";
    while ($p1 !== false) {
        $path = substr($relPath, 0, $p1 + 1);
        if ($path == $delimiter || $path == '.' . $delimiter) {
            // Skip
        } elseif ($path == ".." . $delimiter) {
            $p2 = strrpos($basePath, $delimiter);
            if ($p2 === 0) { // BasePath = "/xxx", cannot move up
                $basePath = $delimiter;
            } elseif ($p2 !== false && !EndsString("..", $basePath)) {
                $basePath = substr($basePath, 0, $p2);
            } elseif ($basePath != "" && $basePath != "." && $basePath != "..") {
                $basePath = "";
            } else {
                $path2 .= ".." . $delimiter;
            }
        } else {
            $path2 .= $path;
        }
        $relPath = substr($relPath, $p1 + 1);
        if ($relPath === false) {
            $relPath = "";
        }
        $p1 = strpos($relPath, $delimiter);
    }
    return (($basePath === "" || $basePath === ".") ? "" : IncludeTrailingDelimiter($basePath, $phyPath)) . $path2 . $relPath;
}

// Remove the last delimiter for a path
function RemoveTrailingDelimiter($path, $phyPath)
{
    $delimiter = (!IsRemote($path) && $phyPath) ? PATH_DELIMITER : '/';
    while (substr($path, -1) == $delimiter) {
        $path = substr($path, 0, strlen($path) - 1);
    }
    return $path;
}

// Include the last delimiter for a path
function IncludeTrailingDelimiter($path, $phyPath)
{
    $path = RemoveTrailingDelimiter($path, $phyPath);
    $delimiter = (!IsRemote($path) && $phyPath) ? PATH_DELIMITER : '/';
    return $path . $delimiter;
}

// Get session timeout time (seconds)
function SessionTimeoutTime()
{
    if (Config("SESSION_TIMEOUT") > 0) { // User specified timeout time
        $mlt = Config("SESSION_TIMEOUT") * 60;
    } else { // Get max life time from php.ini
        $mlt = (int)ini_get("session.gc_maxlifetime");
    }
    if ($mlt <= 0) {
        $mlt = 1440; // PHP default (1440s = 24min)
    }
    return $mlt - 30; // Add some safety margin
}

// Contains a substring (case-sensitive)
function ContainsString($haystack, $needle, $offset = 0)
{
    return strpos($haystack, $needle, $offset) !== false;
}

// Contains a substring (case-insensitive)
function ContainsText($haystack, $needle, $offset = 0)
{
    return stripos($haystack, $needle, $offset) !== false;
}

// Starts with a substring (case-sensitive)
function StartsString($needle, $haystack)
{
    return strpos($haystack, $needle) === 0;
}

// Starts with a substring (case-insensitive)
function StartsText($needle, $haystack)
{
    return stripos($haystack, $needle) === 0;
}

// Ends with a substring (case-sensitive)
function EndsString($needle, $haystack)
{
    return strrpos($haystack, $needle) === strlen($haystack) - strlen($needle);
}

// Ends with a substring (case-insensitive)
function EndsText($needle, $haystack)
{
    return strripos($haystack, $needle) === strlen($haystack) - strlen($needle);
}

// Same trimmed strings (case-sensitive)
function SameString($str1, $str2)
{
    return strcmp(trim($str1), trim($str2)) === 0;
}

// Same trimmed strings (case-insensitive)
function SameText($str1, $str2)
{
    return strcasecmp(trim($str1), trim($str2)) === 0;
}

// Convert to constant case (e.g. KEY_NAME)
function ConstantCase($str)
{
    return strtoupper(preg_replace('/([a-z]+)[ _]?([A-Z0-9])/', "$1_$2", $str));
}

// Set client variable
function SetClientVar($key, $value)
{
    global $ClientVariables;
    $key = strval($key);
    if (is_array($value) && is_array($ClientVariables[$key] ?? null)) {
        $ClientVariables[$key] = array_replace_recursive($ClientVariables[$key], $value);
    } else {
        $ClientVariables[$key] = $value;
    }
}

// Get client variable
function GetClientVar($key = "", $subkey = "")
{
    global $ClientVariables;
    if (!$key) {
        return $ClientVariables;
    }
    $value = $ClientVariables[$key] ?? null;
    if ($subkey) {
        $value = $value[$subkey] ?? null;
    }
    return $value;
}

// Get config client variables
function ConfigClientVars()
{
    global $CONFIG;
    $names = $CONFIG["CONFIG_CLIENT_VARS"];
    $values = [];
    foreach ($names as $name) {
        if (isset($CONFIG[$name])) {
            $values[$name] = $CONFIG[$name];
        }
    }
    // Update PROJECT_STYLESHEET_FILENAME
    $values["PROJECT_STYLESHEET_FILENAME"] = CssFile(Config("PROJECT_STYLESHEET_FILENAME"));
    return $values;
}

// Get global client variables
function GlobalClientVars()
{
    global $CURRENCY_FORMAT;
    $names = Config("GLOBAL_CLIENT_VARS");
    $values = [];
    foreach ($names as $name) {
        if (isset($GLOBALS[$name])) {
            $values[ConstantCase($name)] = $GLOBALS[$name]; // Convert key to constant case
        }
    }
    return array_merge([
        "CURRENCY_FORMAT" => str_replace('¤', '$', $CURRENCY_FORMAT),
        "CURRENT_USER_NAME" => CurrentUserName(),
        "IS_LOGGEDIN" => IsLoggedIn(),
        "IS_SYS_ADMIN" => IsSysAdmin(),
        "IS_RTL" => IsRTL(),
        "IS_AUTOLOGIN" => IsAutoLogin(),
        "LANGUAGE_ID" => str_replace("_", "-", CurrentLanguageID()),
        "PATH_BASE" => BasePath(true), // Path base // PHP
        "PROJECT_NAME" => PROJECT_NAME,
        "SESSION_ID" => Encrypt(session_id()), // Session ID // PHP
        "ANTIFORGERY_TOKEN_KEY" => $GLOBALS["TokenValueKey"], // "csrf_value" // PHP
        "ANTIFORGERY_TOKEN" => $GLOBALS["TokenValue"], // CSRF token // PHP
        "API_JWT_AUTHORIZATION_HEADER" => "X-Authorization", // API JWT authorization header
        "API_JWT_TOKEN" => GetJwtToken(), // API JWT token
        "IMAGE_FOLDER" => "images/", // Image folder
        "SESSION_TIMEOUT" => Config("SESSION_TIMEOUT") > 0 ? SessionTimeoutTime() : 0, // Session timeout time (seconds)
        "TIMEOUT_URL" => GetUrl("logout"), // Timeout URL // PHP
        "USE_JAVASCRIPT_MESSAGE" => true,
        "USE_OVERLAY_SCROLLBARS" => false
    ], $values);
}

// Get/Set global login status array
function LoginStatus($name = "", $value = null)
{
    global $LoginStatus;
    $numargs = func_num_args();
    if ($numargs == 1) { // Get
        return $LoginStatus[$name] ?? null;
    } elseif ($numargs == 2) { // Set
        $LoginStatus[$name] = $value;
    }
    return $LoginStatus;
}

// Set up login status
function SetupLoginStatus()
{
    global $LoginStatus, $Language;
    $LoginStatus["isLoggedIn"] = IsLoggedIn();
    $LoginStatus["currentUserName"] = CurrentUserName();
    $currentPage = CurrentPageName();

    // Logout page
    $logoutPage = "logout";
    $logoutUrl = GetUrl($logoutPage);
    $LoginStatus["logout"] = [
        "ew-action" => "redirect",
        "url" => $logoutUrl
    ];
    $LoginStatus["logoutUrl"] = $logoutUrl;
    $LoginStatus["logoutText"] = $Language->phrase("Logout", null);
    $LoginStatus["canLogout"] = $logoutPage && IsLoggedIn();

    // Login page
    $loginPage = "login";
    $loginUrl = GetUrl($loginPage);
    $LoginStatus["login"] = [];
    if ($currentPage != $loginPage) {
        if (Config("USE_MODAL_LOGIN") && !IsMobile()) {
            $LoginStatus["login"] = [
                "ew-action" => "modal",
                "footer" => false,
                "caption" => $Language->phrase("Login", true),
                "size" => "modal-md",
                "url" => $loginUrl
            ];
        } else {
            $LoginStatus["login"] = [
                "ew-action" => "redirect",
                "url" => $loginUrl
            ];
        }
    } else {
        $LoginStatus["login"]["url"] = $loginUrl;
    }
    $LoginStatus["loginTitle"] = $Language->phrase("Login", true);
    $LoginStatus["loginText"] = $Language->phrase("Login");
    $LoginStatus["canLogin"] = $currentPage != $loginPage && $loginUrl && !IsLoggedIn() && !IsLoggingIn2FA();
}

// Is remote path
function IsRemote($path)
{
    return preg_match(Config("REMOTE_FILE_PATTERN"), $path);
}

// Is auto login
function IsAutoLogin()
{
    return (Session(SESSION_USER_LOGIN_TYPE) == "a");
}

// Get current page heading
function CurrentPageHeading()
{
    global $Language, $Page;
    if (Config("PAGE_TITLE_STYLE") != "Title" && isset($Page) && method_exists($Page, "pageHeading")) {
        $heading = $Page->pageHeading();
        if ($heading != "") {
            return $heading;
        }
    }
    return $Language->ProjectPhrase("BodyTitle");
}

// Get current page subheading
function CurrentPageSubheading()
{
    global $Page;
    $heading = "";
    if (Config("PAGE_TITLE_STYLE") != "Title" && isset($Page) && method_exists($Page, "pageSubheading")) {
        $heading = $Page->pageSubheading();
    }
    return $heading;
}

// Convert HTML to text
function HtmlToText($html)
{
    return \Soundasleep\Html2Text::convert($html);
}

// Get captcha object
function Captcha()
{
    global $Captcha, $CaptchaClass, $Page;
    $class = PROJECT_NAMESPACE . $CaptchaClass;
    if (!isset($Captcha) || !($Captcha instanceof $class)) {
        $Captcha = new $class();
    }
    return $Captcha;
}

/**
 * Get DB helper (for backward compatibility only)
 *
 * @param int|string $dbid - DB ID
 * @return DbHelper
 */
function &DbHelper($dbid = 0)
{
    $dbHelper = new DbHelper($dbid);
    return $dbHelper;
}

// Attributes for drill down
function DrillDownAttributes($url, $id, $hdr, $popover = true)
{
    if (trim($url) == "") {
        return [];
    } else {
        if ($popover) {
            return [
                "data-ew-action" => "drilldown",
                "data-url" => preg_replace('/&(?!amp;)/', '&amp;', $url), // Replace & to &amp;
                "data-id" => $id,
                "data-hdr" => $hdr
            ];
        } else {
            return [
                "data-ew-action" => "redirect",
                "data-url" => str_replace("?d=1&", "?d=2&", $url) // Change d parameter to 2
            ];
        }
    }
}

/**
 * Get Opacity
 *
 * @param int $alpha Alpha (0-100)
 * @return float Opacity (0.0 - 1.0)
 */
function GetOpacity($alpha)
{
    if ($alpha !== null) {
        $alpha = (int)$alpha;
        if ($alpha > 100) {
            $alpha = 100;
        } elseif ($alpha <= 0) {
            $alpha = 50; // Use default
        }
        return (float)$alpha / 100;
    }
    return null;
}

/**
 * Get Rgba color
 *
 * @param string $color Color
 * @param mixed $opacity Opacity
 * @return string Rgba color
 */
function GetRgbaColor($color, $opacity = null)
{
    // Check opacity
    if ($opacity === null) {
        return $color;
    } else {
        if (!is_float($opacity)) {
            $opacity = (float)$opacity;
        }
        if ($opacity > 1) {
            $opacity = 1.0;
        } elseif ($opacity < 0) {
            $opacity = 0.0;
        }
    }

    // Check if color has 6 or 3 characters and get values
    if (preg_match('/^#?(\w{2})(\w{2})(\w{2})$/', $color, $m)) { // 123456
        $hex = array_splice($m, 1);
    } elseif (preg_match('/^#?(\w)(\w)(\w)$/', $color, $m)) { // 123 => 112233
        $hex = [$m[1] . $m[1], $m[2] . $m[2], $m[3] . $m[3]];
    } else { // Unknown
        return $color;
    }

    // Convert hexadec to rgb
    $rgb = array_map("hexdec", $hex);

    // Check if opacity is set
    if (is_float($opacity)) {
        $color = "rgba(" . implode(",", $rgb) . "," . $opacity . ")";
    } else {
        $color = "rgb(" . implode(",", $rgb) . ")";
    }

    // Return rgb(a) color string
    return $color;
}

/**
 * Convert field value for dropdown
 *
 * @param string $t Date type
 * @param mixed $val Field value
 * @return string Converted value
 */
function ConvertDisplayValue($t, $val)
{
    if ($val === null) {
        return Config("NULL_VALUE");
    } elseif ($val === "") {
        return Config("EMPTY_VALUE");
    }
    if (is_float($val)) {
        $val = (float)$val;
    }
    if ($t == "") {
        return $val;
    }
    if ($ar = explode(" ", $val)) {
        $ar = explode("-", $ar[0]);
    } else {
        return $val;
    }
    if (!$ar || count($ar) != 3) {
        return $val;
    }
    list($year, $month, $day) = $ar;
    switch (strtolower($t)) {
        case "year":
            return $year;
        case "quarter":
            return "$year|" . ceil(intval($month) / 3);
        case "month":
            return "$year|$month";
        case "day":
            return "$year|$month|$day";
        case "date":
            return "$year-$month-$day";
    }
}

/**
 * Get dropdown display value
 *
 * @param mixed $v Field value
 * @param string $t Date type
 * @param int $fmt Date format
 * @return string Display value of the field value
 */
function GetDropDownDisplayValue($v, $t = "", $fmt = 0)
{
    global $Language;
    if (SameString($v, Config("NULL_VALUE"))) {
        return $Language->phrase("NullLabel");
    } elseif (SameString($v, Config("EMPTY_VALUE"))) {
        return $Language->phrase("EmptyLabel");
    } elseif (SameText($t, "boolean")) {
        return BooleanName($v);
    }
    if ($t == "") {
        return $v;
    }
    $ar = explode("|", strval($v));
    $t = strtolower($t);
    if (in_array($t, ["y", "year", "q", "quarter"])) {
        return (count($ar) >= 2) ? QuarterName($ar[1]) . " " . $ar[0] : $v;
    } elseif (in_array($t, ["m", "month"])) {
        return (count($ar) >= 2) ?  MonthName($ar[1]) . " " . $ar[0] : $v;
    } elseif (in_array($t, ["w", "week"])) {
        return (count($ar) >= 2) ? $Language->phrase("Week") . " " . $ar[1] . ", " . $ar[0] : $v;
    } elseif (in_array($t, ["d", "day"])) {
        return (count($ar) >= 3) ? FormatDateTime($ar[0] . "-" . $ar[1] . "-" . $ar[2], $fmt) : $v;
    } elseif (in_array($t, ["date"])) {
        return FormatDateTime($v, $fmt);
    }
    return $v;
}

/**
 * Get dropdown edit value
 *
 * @param object $fld Field object
 * @param mixed $v Field value
 */
function GetDropDownEditValue($fld, $v)
{
    global $Language;
    $val = trim(strval($v));
    $ar = [];
    if ($val != "") {
        $arwrk = $fld->SelectMultiple ? explode(",", $val) : [$val];
        foreach ($arwrk as $wrk) {
            $format = $fld->DateFilter != "" ? $fld->DateFilter : "date";
            $ar[] = ["lf" => $wrk, "df" => GetDropDownDisplayValue($wrk, $format, $fld->DateTimeFormat)];
        }
    }
    return $ar;
}

/**
 * Get Boolean Name
 *
 * @param mixed $v Value, treat "T", "True", "Y", "Yes", "1" as true
 * @return string
 */
function BooleanName($v)
{
    global $Language;
    if ($v === null) {
        return $Language->phrase("NullLabel");
    } elseif (strtoupper($v) == "T" || strtoupper($v) == "true" || strtoupper($v) == "Y" || strtoupper($v) == "YES" or strval($v) == "1") {
        return $Language->phrase("BooleanYes");
    } else {
        return $Language->phrase("BooleanNo");
    }
}

// Quarter name
function QuarterName($q)
{
    $t = mktime(1, 0, 0, $q * 3);
    return FormatDateTime($t, Config("QUARTER_PATTERN"));
}

// Month name
function MonthName($m)
{
    $t = mktime(1, 0, 0, $m);
    return FormatDateTime($t, Config("MONTH_PATTERN"));
}

// Join array
function JoinArray($ar, $sep, $ft, $pos = 0, $dbid = 0)
{
    if (!is_array($ar)) {
        return "";
    }
    $arwrk = array_slice($ar, $pos); // Return array from position pos
    $cntar = count($arwrk);
    for ($i = 0; $i < $cntar; $i++) {
        $arwrk[$i] = QuotedValue($arwrk[$i], $ft, $dbid);
    }
    return implode($sep, $arwrk);
}

// Get current year
function CurrentYear()
{
    return intval(date('Y'));
}

// Get current quarter
function CurrentQuarter()
{
    return ceil(intval(date('n')) / 3);
}

// Get current month
function CurrentMonth()
{
    return intval(date('n'));
}

// Get current day
function CurrentDay()
{
    return intval(date('j'));
}

/**
 * Update sort fields
 *
 * @param string $orderBy Order By clause
 * @param string $sort Sort fields
 * @param int $opt Option (1: merge all fields, 2: merge $orderBy fields only)
 * @return string Order By clause
 */
function UpdateSortFields($orderBy, $sort, $opt)
{
    $arOrderBy = GetSortFields($orderBy);
    $cntOrderBy = count($arOrderBy);
    $arSort = GetSortFields($sort);
    $cntSort = count($arSort);
    $orderfld = "";
    for ($i = 0; $i < $cntSort; $i++) {
        $sortfld = $arSort[$i][0]; // Get sort field
        for ($j = 0; $j < $cntOrderBy; $j++) {
            $orderfld = $arOrderBy[$j][0]; // Get orderby field
            if ($orderfld == $sortfld) {
                $arOrderBy[$j][1] = $arSort[$i][1]; // Replace field
                break;
            }
        }
        if ($opt == 1) { // Append field
            if ($orderfld != $sortfld) {
                $arOrderBy[] = $arSort[$i];
            }
        }
    }
    return $arOrderBy;
}

// Get sort fields as array of [fieldName, sortDirection]
function GetSortFields($flds)
{
    $ar = [];
    if (is_array($flds)) {
        $ar = $flds;
    } elseif (is_string($flds)) {
        $temp = "";
        $tok = strtok($flds, ",");
        while ($tok !== false) {
            $temp .= $tok;
            if (substr_count($temp, "(") === substr_count($temp, ")")) { // Make sure not inside parentheses
                $ar[] = $temp;
                $temp = "";
            } else {
                $temp .= ",";
            }
            $tok = strtok(",");
        }
    }
    $ar = array_filter($ar, function ($fld) {
        return is_array($fld) || is_string($fld) && trim($fld) !== "";
    });
    return array_map(function ($fld) {
        if (is_array($fld)) {
            return $fld;
        }
        $fld = trim($fld);
        if (preg_match('/\s(ASC|DESC)$/i', $fld, $matches)) {
            return [trim(substr($fld, 0, -4)), $matches[1]];
        }
        return [trim($fld), ""];
    }, $ar);
}

// Get reverse sort
function ReverseSort($sorttype)
{
    return ($sorttype == "ASC") ? "DESC" : "ASC";
}

// Construct a crosstab field name
function CrosstabFieldExpression($smrytype, $smryfld, $colfld, $datetype, $val, $qc, $alias = "", $dbid = 0)
{
    if (SameString($val, Config("NULL_VALUE"))) {
        $wrkval = "NULL";
        $wrkqc = "";
    } elseif (SameString($val, Config("EMPTY_VALUE"))) {
        $wrkval = "";
        $wrkqc = $qc;
    } else {
        $wrkval = $val;
        $wrkqc = $qc;
    }
    switch ($smrytype) {
        case "SUM":
            $fld = $smrytype . "(" . $smryfld . "*" . SqlDistinctFactor($colfld, $datetype, $wrkval, $wrkqc, $dbid) . ")";
            break;
        case "COUNT":
            $fld = "SUM(" . SqlDistinctFactor($colfld, $datetype, $wrkval, $wrkqc, $dbid) . ")";
            break;
        case "MIN":
        case "MAX":
            $dbtype = GetConnectionType($dbid);
            $aggwrk = SqlDistinctFactor($colfld, $datetype, $wrkval, $wrkqc, $dbid);
            $fld = $smrytype . "(IF(" . $aggwrk . "=0,NULL," . $smryfld . "))";
            if ($dbtype == "MSSQL" || $dbtype == "ORACLE" || $dbtype == "SQLITE") {
                $fld = $smrytype . "(CASE " . $aggwrk . " WHEN 0 THEN NULL ELSE " . $smryfld . " END)";
            } elseif ($dbtype == "MYSQL" || $dbtype == "POSTGRESQL") {
                $fld = $smrytype . "(IF(" . $aggwrk . "=0,NULL," . $smryfld . "))";
            }
            break;
        case "AVG":
            $sumwrk = "SUM(" . $smryfld . "*" . SqlDistinctFactor($colfld, $datetype, $wrkval, $wrkqc, $dbid) . ")";
            if ($alias != "") {
//          $sumwrk .= " AS SUM_" . $alias;
                $sumwrk .= " AS " . QuotedName("sum_" . $alias, $dbid);
            }
            $cntwrk = "SUM(" . SqlDistinctFactor($colfld, $datetype, $wrkval, $wrkqc, $dbid) . ")";
            if ($alias != "") {
//          $cntwrk .= " AS CNT_" . $alias;
                $cntwrk .= " AS " . QuotedName("cnt_" . $alias, $dbid);
            }
            return $sumwrk . ", " . $cntwrk;
    }
    if ($alias != "") {
        $fld .= " AS " . QuotedName($alias, $dbid);
    }
    return $fld;
}

/**
 * Construct SQL Distinct factor
 * - ACCESS
 * y: IIf(Year(FieldName)=1996,1,0)
 * q: IIf(DatePart(""q"",FieldName,1,0)=1,1,0))
 * m: (IIf(DatePart(""m"",FieldName,1,0)=1,1,0)))
 * others: (IIf(FieldName=val,1,0)))
 * - MS SQL
 * y: (1-ABS(SIGN(Year(FieldName)-1996)))
 * q: (1-ABS(SIGN(DatePart(q,FieldName)-1)))
 * m: (1-ABS(SIGN(DatePart(m,FieldName)-1)))
 * - MySQL
 * y: IF(YEAR(FieldName)=1996,1,0))
 * q: IF(QUARTER(FieldName)=1,1,0))
 * m: IF(MONTH(FieldName)=1,1,0))
 * - SQLITE
 * y: (CASE CAST(STRFTIME('%Y',FieldName) AS INTEGER) WHEN 1996 THEN 1 ELSE 0 END)
 * q: (CASE (CAST(STRFTIME('%m',FieldName) AS INTEGER)+2)/3 WHEN 1 THEN 1 ELSE 0 END)
 * m: (CASE CAST(STRFTIME('%m',FieldName) AS INTEGER) WHEN 1 THEN 1 ELSE 0 END)
 * - PostgreSQL
 * y: CASE WHEN TO_CHAR(FieldName,'YYYY')='1996' THEN 1 ELSE 0 END
 * q: CASE WHEN TO_CHAR(FieldName,'Q')='1' THEN 1 ELSE 0 END
 * m: CASE WHEN TO_CHAR(FieldName,'MM')=LPAD('1',2,'0') THEN 1 ELSE 0 END
 * - Oracle
 * y: DECODE(TO_CHAR(FieldName,'YYYY'),'1996',1,0)
 * q: DECODE(TO_CHAR(FieldName,'Q'),'1',1,0)
 * m: DECODE(TO_CHAR(FieldName,'MM'),LPAD('1',2,'0'),1,0)
 *
 * @param DbField $fld Field
 * @param int $dateType Date type
 * @param mixed $val Value
 * @param string $qc Quote character
 * @param int $dbid Database ID
 * @return string
 */
function SqlDistinctFactor($fld, $dateType, $val, $qc, $dbid = 0)
{
    $dbtype = GetConnectionType($dbid);
    if ($dbtype == "MSSQL") {
        if ($dateType == "y" && is_numeric($val)) {
            return "(1-ABS(SIGN(Year(" . $fld . ")-" . $val . ")))";
        } elseif (($dateType == "q" || $dateType == "m") && is_numeric($val)) {
            return "(1-ABS(SIGN(DatePart(" . $dateType . "," . $fld . ")-" . $val . ")))";
        } else {
            if ($val == "NULL") {
                return "(CASE WHEN " . $fld . " IS NULL THEN 1 ELSE 0 END)";
            } else {
                return "(CASE " . $fld . " WHEN " . $qc . AdjustSql($val, $dbid) . $qc . " THEN 1 ELSE 0 END)";
            }
        }
    } elseif ($dbtype == "MYSQL") {
        if ($dateType == "y" && is_numeric($val)) {
            return "IF(YEAR(" . $fld . ")=" . $val . ",1,0)";
        } elseif ($dateType == "q" && is_numeric($val)) {
            return "IF(QUARTER(" . $fld . ")=" . $val . ",1,0)";
        } elseif ($dateType == "m" && is_numeric($val)) {
            return "IF(MONTH(" . $fld . ")=" . $val . ",1,0)";
        } else {
            if ($val == "NULL") {
                return "IF(" . $fld . " IS NULL,1,0)";
            } else {
                return "IF(" . $fld . "=" . $qc . AdjustSql($val, $dbid) . $qc . ",1,0)";
            }
        }
    } elseif ($dbtype == "SQLITE") {
        if ($dateType == "y" && is_numeric($val)) {
            return "(CASE CAST(STRFTIME('%Y', " . $fld . ") AS INTEGER) WHEN " . $val . " THEN 1 ELSE 0 END)";
        } elseif ($dateType == "q" && is_numeric($val)) {
            return "(CASE (CAST(STRFTIME('%m', " . $fld . ") AS INTEGER)+2)/3 WHEN " . $val . " THEN 1 ELSE 0 END)";
        } elseif ($dateType == "m" && is_numeric($val)) {
            return "(CASE CAST(STRFTIME('%m', " . $fld . ") AS INTEGER) WHEN " . $val . " THEN 1 ELSE 0 END)";
        } elseif ($dateType == "d") {
            return "(CASE STRFTIME('%Y-%m-%d'," . $fld . ") WHEN " . $qc . AdjustSql($val, $dbid) . $qc . " THEN 1 ELSE 0 END)";
        } else {
            if ($val == "NULL") {
                return "(CASE WHEN " . $fld . " IS NULL THEN 1 ELSE 0 END)";
            } else {
                return "(CASE " . $fld . " WHEN " . $qc . AdjustSql($val, $dbid) . $qc . " THEN 1 ELSE 0 END)";
            }
        }
    } elseif ($dbtype == "POSTGRESQL") {
        if ($dateType == "y" && is_numeric($val)) {
            return "CASE WHEN TO_CHAR(" . $fld . ",'YYYY')='" . $val . "' THEN 1 ELSE 0 END";
        } elseif ($dateType == "q" && is_numeric($val)) {
            return "CASE WHEN TO_CHAR(" . $fld . ",'Q')='" . $val . "' THEN 1 ELSE 0 END";
        } elseif ($dateType == "m" && is_numeric($val)) {
            return "CASE WHEN TO_CHAR(" . $fld . ",'MM')=LPAD('" . $val . "',2,'0') THEN 1 ELSE 0 END";
        } else {
            if ($val == "NULL") {
                return "CASE WHEN " . $fld . " IS NULL THEN 1 ELSE 0 END";
            } else {
                return "CASE WHEN " . $fld . "=" . $qc . AdjustSql($val, $dbid) . $qc . " THEN 1 ELSE 0 END";
            }
        }
    } elseif ($dbtype == "ORACLE") {
        if ($dateType == "y" && is_numeric($val)) {
            return "DECODE(TO_CHAR(" . $fld . ",'YYYY'),'" . $val . "',1,0)";
        } elseif ($dateType == "q" && is_numeric($val)) {
            return "DECODE(TO_CHAR(" . $fld . ",'Q'),'" . $val . "',1,0)";
        } elseif ($dateType == "m" && is_numeric($val)) {
            return "DECODE(TO_CHAR(" . $fld . ",'MM'),LPAD('" . $val . "',2,'0'),1,0)";
        } elseif ($dateType == "d") {
            return "DECODE(" . $fld . ",TO_DATE(" . $qc . AdjustSql($val, $dbid) . $qc . ",'YYYY/MM/DD'),1,0)";
        } elseif ($dateType == "dt") {
            return "DECODE(" . $fld . ",TO_DATE(" . $qc . AdjustSql($val, $dbid) . $qc . ",'YYYY/MM/DD HH24:MI:SS'),1,0)";
        } else {
            if ($val == "NULL") {
                return "(CASE WHEN " . $fld . " IS NULL THEN 1 ELSE 0 END)";
            } else {
                return "DECODE(" . $fld . "," . $qc . AdjustSql($val, $dbid) . $qc . ",1,0)";
            }
        }
    }
}

// Evaluate summary value
function SummaryValue($val1, $val2, $ityp)
{
    if (in_array($ityp, ["SUM", "COUNT", "AVG"])) {
        if ($val2 === null || !is_numeric($val2)) {
            return $val1;
        } else {
            return ($val1 + $val2);
        }
    } elseif ($ityp == "MIN") {
        if ($val2 === null || !is_numeric($val2)) {
            return $val1; // Skip null and non-numeric
        } elseif ($val1 === null) {
            return $val2; // Initialize for first valid value
        } elseif ($val1 < $val2) {
            return $val1;
        } else {
            return $val2;
        }
    } elseif ($ityp == "MAX") {
        if ($val2 === null || !is_numeric($val2)) {
            return $val1; // Skip null and non-numeric
        } elseif ($val1 === null) {
            return $val2; // Initialize for first valid value
        } elseif ($val1 > $val2) {
            return $val1;
        } else {
            return $val2;
        }
    }
}

// Match filter value
function MatchedFilterValue($ar, $value)
{
    if (!is_array($ar)) {
        return (strval($ar) == strval($value));
    } else {
        foreach ($ar as $val) {
            if (strval($val) == strval($value)) {
                return true;
            }
        }
        return false;
    }
}

/**
 * Render repeat column table
 *
 * @param int $totcnt Total count
 * @param int $rowcnt Zero based row count
 * @param int $repeatcnt Repeat count
 * @param int $rendertype Render type (1 or 2)
 * @return string HTML
 */
function RepeatColumnTable($totcnt, $rowcnt, $repeatcnt, $rendertype)
{
    $wrk = "";
    if ($rendertype == 1) { // Render control start
        if ($rowcnt == 0) {
            $wrk .= "<table class=\"ew-item-table\">";
        }
        if ($rowcnt % $repeatcnt == 0) {
            $wrk .= "<tr>";
        }
        $wrk .= "<td>";
    } elseif ($rendertype == 2) { // Render control end
        $wrk .= "</td>";
        if ($rowcnt % $repeatcnt == $repeatcnt - 1) {
            $wrk .= "</tr>";
        } elseif ($rowcnt == $totcnt - 1) {
            for ($i = ($rowcnt % $repeatcnt) + 1; $i < $repeatcnt; $i++) {
                $wrk .= "<td></td>";
            }
            $wrk .= "</tr>";
        }
        if ($rowcnt == $totcnt - 1) {
            $wrk .= "</table>";
        }
    }
    return $wrk;
}

// Check if the value is selected
function IsSelectedValue(&$ar, $value, $ft)
{
    if (!is_array($ar)) {
        return true;
    }
    $af = StartsString("@@", $value);
    foreach ($ar as $val) {
        if ($af || StartsString("@@", $val)) { // Advanced filters
            if ($val == $value) {
                return true;
            }
        } elseif (SameString($value, Config("NULL_VALUE")) && $value == $val) {
                return true;
        } else {
            if (CompareValueByFieldType($val, $value, $ft)) {
                return true;
            }
        }
    }
    return false;
}

// Check if advanced filter value
function IsAdvancedFilterValue($v)
{
    if (is_array($v) && count($v) > 0) {
        foreach ($v as $val) {
            if (!StartsString("@@", $val)) {
                return false;
            }
        }
        return true;
    } elseif (StartsString("@@", $v)) {
        return true;
    }
    return false;
}

// Compare values based on field type
function CompareValueByFieldType($v1, $v2, $ft)
{
    switch ($ft) {
    // Case adBigInt, adInteger, adSmallInt, adTinyInt, adUnsignedTinyInt, adUnsignedSmallInt, adUnsignedInt, adUnsignedBigInt
        case 20:
        case 3:
        case 2:
        case 16:
        case 17:
        case 18:
        case 19:
        case 21:
            if (is_numeric($v1) && is_numeric($v2)) {
                return (intval($v1) == intval($v2));
            }
            break;
    // Case adSingle, adDouble, adNumeric, adCurrency
        case 4:
        case 5:
        case 131:
        case 6:
            if (is_numeric($v1) && is_numeric($v2)) {
                return ((float)$v1 == (float)$v2);
            }
            break;
    //  Case adDate, adDBDate, adDBTime, adDBTimeStamp
        case 7:
        case 133:
        case 135:
        case 146:
        case 134:
        case 145:
            if (is_numeric(strtotime($v1)) && is_numeric(strtotime($v2))) {
                return (strtotime($v1) == strtotime($v2));
            }
            break;
        default:
            return (strcmp($v1, $v2) == 0); // Treat as string
    }
}

// Register filter group
function RegisterFilterGroup(&$fld, $groupName)
{
    global $Language;
    $filters = Config("REPORT_ADVANCED_FILTERS." . $groupName) ?: [];
    foreach ($filters as $id => $functionName) {
        RegisterFilter($fld, "@@" . $id, $Language->phrase($id), $functionName);
    }
}

// Register filter
function RegisterFilter(&$fld, $id, $name, $functionName = "")
{
    if (!is_array($fld->AdvancedFilters)) {
        $fld->AdvancedFilters = [];
    }
    $wrkid = StartsString("@@", $id) ? $id : "@@" . $id;
    $key = substr($wrkid, 2);
    $fld->AdvancedFilters[$key] = new AdvancedFilter($wrkid, $name, $functionName);
}

// Unregister filter
function UnregisterFilter(&$fld, $id)
{
    if (is_array($fld->AdvancedFilters)) {
        $wrkid = StartsString("@@", $id) ? $id : "@@" . $id;
        $key = substr($wrkid, 2);
        foreach ($fld->AdvancedFilters as $filter) {
            if ($filter->ID == $wrkid) {
                unset($fld->AdvancedFilters[$key]);
                break;
            }
        }
    }
}

// Return date value
function DateValue($fldOpr, $fldVal, $valType, $dbId = 0)
{
    // Compose date string
    switch (strtolower($fldOpr)) {
        case "year":
            if ($valType == 1) {
                $wrkVal = "$fldVal-01-01";
            } elseif ($valType == 2) {
                $wrkVal = "$fldVal-12-31";
            }
            break;
        case "quarter":
            @list($y, $q) = explode("|", $fldVal);
            if (intval($y) == 0 || intval($q) == 0) {
                $wrkVal = "0000-00-00";
            } else {
                if ($valType == 1) {
                    $m = ($q - 1) * 3 + 1;
                    $m = str_pad($m, 2, "0", STR_PAD_LEFT);
                    $wrkVal = "$y-$m-01";
                } elseif ($valType == 2) {
                    $m = ($q - 1) * 3 + 3;
                    $m = str_pad($m, 2, "0", STR_PAD_LEFT);
                    $wrkVal = "$y-$m-" . DaysInMonth($y, $m);
                }
            }
            break;
        case "month":
            @list($y, $m) = explode("|", $fldVal);
            if (intval($y) == 0 || intval($m) == 0) {
                $wrkVal = "0000-00-00";
            } else {
                if ($valType == 1) {
                    $m = str_pad($m, 2, "0", STR_PAD_LEFT);
                    $wrkVal = "$y-$m-01";
                } elseif ($valType == 2) {
                    $m = str_pad($m, 2, "0", STR_PAD_LEFT);
                    $wrkVal = "$y-$m-" . DaysInMonth($y, $m);
                }
            }
            break;
        case "day":
        default:
            $wrkVal = str_replace("|", "-", $fldVal);
            $wrkVal = preg_replace('/\s+\d{2}\:\d{2}(\:\d{2})$/', "", $wrkVal); // Remove trailing time
    }

    // Add time if necessary
    if (preg_match('/(\d{4}|\d{2})-(\d{1,2})-(\d{1,2})/', $wrkVal)) { // Date without time
        if ($valType == 1) {
            $wrkVal .= " 00:00:00";
        } elseif ($valType == 2) {
            $wrkVal .= " 23:59:59";
        }
    }

    // Check if datetime
    if (preg_match('/(\d{4}|\d{2})-(\d{1,2})-(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})/', $wrkVal)) { // DateTime
        $dateVal = $wrkVal;
    } else {
        $dateVal = "";
    }

    // Change date format if necessary
    $dbType = GetConnectionType($dbId);
    if (!SameText($dbType, "MYSQL") && !SameText($dbType, "SQLITE")) {
        $dateVal = str_replace("-", "/", $dateVal);
    }
    return $dateVal;
}

// Past
function IsPast($fldExpr, $dbid = 0)
{
    $dt = date("Y-m-d H:i:s");
    $dbType = GetConnectionType($dbid);
    if (!SameText($dbType, "MYSQL") && !SameText($dbType, "SQLITE")) {
        $dt = str_replace("-", "/", $dt);
    }
    return "(" . $fldExpr . " < " . QuotedValue($dt, DATATYPE_DATE, $dbid) . ")";
}

// Future;
function IsFuture($fldExpr, $dbid = 0)
{
    $dt = date("Y-m-d H:i:s");
    $dbType = GetConnectionType($dbid);
    if (!SameText($dbType, "MYSQL") && !SameText($dbType, "SQLITE")) {
        $dt = str_replace("-", "/", $dt);
    }
    return "(" . $fldExpr . " > " . QuotedValue($dt, DATATYPE_DATE, $dbid) . ")";
}

/**
 * WHERE class for between 2 dates
 *
 * @param string $fldExpr Field expression
 * @param string $dt1 Begin date (>=)
 * @param string $dt2 End date (<)
 * @return string
 */
function IsBetween($fldExpr, $dt1, $dt2, $dbid = 0)
{
    $dbType = GetConnectionType($dbid);
    if (!SameText($dbType, "MYSQL") && !SameText($dbType, "SQLITE")) {
        $dt1 = str_replace("-", "/", $dt1);
        $dt2 = str_replace("-", "/", $dt2);
    }
    return "(" . $fldExpr . " >= " . QuotedValue($dt1, DATATYPE_DATE, $dbid) . " AND " . $fldExpr . " < " . QuotedValue($dt2, DATATYPE_DATE, $dbid) . ")";
}

// Last 30 days
function IsLast30Days($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m-d", strtotime("-29 days"));
    $dt2 = date("Y-m-d", strtotime("+1 days"));
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Last 14 days
function IsLast14Days($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m-d", strtotime("-13 days"));
    $dt2 = date("Y-m-d", strtotime("+1 days"));
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Last 7 days
function IsLast7Days($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m-d", strtotime("-6 days"));
    $dt2 = date("Y-m-d", strtotime("+1 days"));
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Next 30 days
function IsNext30Days($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m-d");
    $dt2 = date("Y-m-d", strtotime("+30 days"));
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Next 14 days
function IsNext14Days($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m-d");
    $dt2 = date("Y-m-d", strtotime("+14 days"));
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Next 7 days
function IsNext7Days($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m-d");
    $dt2 = date("Y-m-d", strtotime("+7 days"));
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Yesterday
function IsYesterday($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m-d", strtotime("-1 days"));
    $dt2 = date("Y-m-d");
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Today
function IsToday($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m-d");
    $dt2 = date("Y-m-d", strtotime("+1 days"));
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Tomorrow
function IsTomorrow($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m-d", strtotime("+1 days"));
    $dt2 = date("Y-m-d", strtotime("+2 days"));
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Last month
function IsLastMonth($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m", strtotime("-1 months")) . "-01";
    $dt2 = date("Y-m") . "-01";
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// This month
function IsThisMonth($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m") . "-01";
    $dt2 = date("Y-m", strtotime("+1 months")) . "-01";
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Next month
function IsNextMonth($fldExpr, $dbid = 0)
{
    $dt1 = date("Y-m", strtotime("+1 months")) . "-01";
    $dt2 = date("Y-m", strtotime("+2 months")) . "-01";
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Last two weeks
function IsLast2Weeks($fldExpr, $dbid = 0)
{
    if (strtotime("this Sunday") == strtotime("today")) {
        $dt1 = date("Y-m-d", strtotime("-14 days this Sunday"));
        $dt2 = date("Y-m-d", strtotime("this Sunday"));
    } else {
        $dt1 = date("Y-m-d", strtotime("-14 days last Sunday"));
        $dt2 = date("Y-m-d", strtotime("last Sunday"));
    }
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Last week
function IsLastWeek($fldExpr, $dbid = 0)
{
    if (strtotime("this Sunday") == strtotime("today")) {
        $dt1 = date("Y-m-d", strtotime("-7 days this Sunday"));
        $dt2 = date("Y-m-d", strtotime("this Sunday"));
    } else {
        $dt1 = date("Y-m-d", strtotime("-7 days last Sunday"));
        $dt2 = date("Y-m-d", strtotime("last Sunday"));
    }
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// This week
function IsThisWeek($fldExpr, $dbid = 0)
{
    if (strtotime("this Sunday") == strtotime("today")) {
        $dt1 = date("Y-m-d", strtotime("this Sunday"));
        $dt2 = date("Y-m-d", strtotime("+7 days this Sunday"));
    } else {
        $dt1 = date("Y-m-d", strtotime("last Sunday"));
        $dt2 = date("Y-m-d", strtotime("+7 days last Sunday"));
    }
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Next week
function IsNextWeek($fldExpr, $dbid = 0)
{
    if (strtotime("this Sunday") == strtotime("today")) {
        $dt1 = date("Y-m-d", strtotime("+7 days this Sunday"));
        $dt2 = date("Y-m-d", strtotime("+14 days this Sunday"));
    } else {
        $dt1 = date("Y-m-d", strtotime("+7 days last Sunday"));
        $dt2 = date("Y-m-d", strtotime("+14 days last Sunday"));
    }
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Next two week
function IsNext2Weeks($fldExpr, $dbid = 0)
{
    if (strtotime("this Sunday") == strtotime("today")) {
        $dt1 = date("Y-m-d", strtotime("+7 days this Sunday"));
        $dt2 = date("Y-m-d", strtotime("+21 days this Sunday"));
    } else {
        $dt1 = date("Y-m-d", strtotime("+7 days last Sunday"));
        $dt2 = date("Y-m-d", strtotime("+21 days last Sunday"));
    }
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Last year
function IsLastYear($fldExpr, $dbid = 0)
{
    $dt1 = date("Y", strtotime("-1 years")) . "-01-01";
    $dt2 = date("Y") . "-01-01";
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// This year
function IsThisYear($fldExpr, $dbid = 0)
{
    $dt1 = date("Y") . "-01-01";
    $dt2 = date("Y", strtotime("+1 years")) . "-01-01";
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Next year
function IsNextYear($fldExpr, $dbid = 0)
{
    $dt1 = date("Y", strtotime("+1 years")) . "-01-01";
    $dt2 = date("Y", strtotime("+2 years")) . "-01-01";
    return IsBetween($fldExpr, $dt1, $dt2, $dbid);
}

// Days in month
function DaysInMonth($y, $m)
{
    if (in_array($m, [1, 3, 5, 7, 8, 10, 12])) {
        return 31;
    } elseif (in_array($m, [4, 6, 9, 11])) {
        return 30;
    } elseif ($m == 2) {
        return ($y % 4 == 0) ? 29 : 28;
    }
    return 0;
}

/**
 * Get group value
 * Field type:
 *  1: numeric, 2: date, 3: string
 * Group type:
 *  numeric: i = interval, n = normal
 *  date: d = Day, w = Week, m = Month, q = Quarter, y = Year
 *  string: f = first nth character, n = normal
 *
 * @param DbField $fld Field
 * @param mixed $val Value
 * @return mixed
 */
function GroupValue(&$fld, $val)
{
    $ft = $fld->Type;
    $grp = $fld->GroupByType;
    $intv = $fld->GroupInterval;
    if (in_array($ft, [20, 3, 2, 16, 4, 5, 131, 6, 17, 18, 19, 21])) { // adBigInt, adInteger, adSmallInt, adTinyInt, adSingle, adDouble, adNumeric, adCurrency, adUnsignedTinyInt, adUnsignedSmallInt, adUnsignedInt, adUnsignedBigInt (numeric)
        if (!is_numeric($val)) {
            return $val;
        }
        $wrkIntv = intval($intv);
        if ($wrkIntv <= 0) {
            $wrkIntv = 10;
        }
        return ($grp == "i") ? intval($val / $wrkIntv) : $val;
    } elseif (in_array($ft, [201, 203, 129, 130, 200, 202])) { // adLongVarChar, adLongVarWChar, adChar, adWChar, adVarChar, adVarWChar (string)
        $wrkIntv = intval($intv);
        if ($wrkIntv <= 0) {
            $wrkIntv = 1;
        }
        return ($grp == "f") ? substr($val, 0, $wrkIntv) : $val;
    }
    return $val;
}

// Display group value
function DisplayGroupValue(&$fld, $val)
{
    global $Language;
    $ft = $fld->Type;
    $grp = $fld->GroupByType;
    $intv = $fld->GroupInterval;
    if ($val === null) {
        return $Language->phrase("NullLabel");
    }
    if ($val == "") {
        return $Language->phrase("EmptyLabel");
    }
    switch ($ft) {
        // Case adBigInt, adInteger, adSmallInt, adTinyInt, adSingle, adDouble, adNumeric, adCurrency, adUnsignedTinyInt, adUnsignedSmallInt, adUnsignedInt, adUnsignedBigInt (numeric)
        case 20:
        case 3:
        case 2:
        case 16:
        case 4:
        case 5:
        case 131:
        case 6:
        case 17:
        case 18:
        case 19:
        case 21:
            $wrkIntv = intval($intv);
            if ($wrkIntv <= 0) {
                $wrkIntv = 10;
            }
            switch ($grp) {
                case "i":
                    return strval($val * $wrkIntv) . " - " . strval(($val + 1) * $wrkIntv - 1);
                default:
                    return $val;
            }
            break;
        // Case adDate, adDBDate, adDBTime, adDBTimeStamp (date)
        case 7:
        case 133:
        case 135:
        case 146:
        case 134:
        case 145:
            $ar = explode("|", $val);
            switch ($grp) {
                case "y":
                    return $ar[0];
                case "q":
                    if (count($ar) < 2) {
                        return $val;
                    }
                    return FormatQuarter($ar[0], $ar[1]);
                case "m":
                    if (count($ar) < 2) {
                        return $val;
                    }
                    return FormatMonth($ar[0], $ar[1]);
                case "w":
                    if (count($ar) < 2) {
                        return $val;
                    }
                    return FormatWeek($ar[0], $ar[1]);
                case "d":
                    if (count($ar) < 3) {
                        return $val;
                    }
                    return FormatDay($ar[0], $ar[1], $ar[2]);
                case "h":
                    return FormatHour($ar[0]);
                case "min":
                    return FormatMinute($ar[0]);
                default:
                    return $val;
            }
            break;
        default: // String and others
            return $val; // Ignore
    }
}

// Format quarter
function FormatQuarter($y, $q)
{
    return "Q" . $q . "/" . $y;
}

// Format month
function FormatMonth($y, $m)
{
    return $m . "/" . $y;
}

// Format week
function FormatWeek($y, $w)
{
    return "WK" . $w . "/" . $y;
}

// Format day
function FormatDay($y, $m, $d)
{
    return $y . "-" . $m . "-" . $d;
}

// Format hour
function FormatHour($h)
{
    if (intval($h) == 0) {
        return "12 AM";
    } elseif (intval($h) < 12) {
        return $h . " AM";
    } elseif (intval($h) == 12) {
        return "12 PM";
    } else {
        return ($h - 12) . " PM";
    }
}

// Format minute
function FormatMinute($n)
{
    return $n . " MIN";
}

// Return detail filter SQL
function DetailFilterSql(&$fld, $fn, $val, $dbid = 0)
{
    $ft = $fld->DataType;
    if ($fld->GroupSql != "") {
        $ft = DATATYPE_STRING;
    }
    $ar = is_array($val) ? $val : [$val];
    $sqlwrk = "";
    foreach ($ar as $v) {
        if ($sqlwrk != "") {
            $sqlwrk .= " OR ";
        }
        $sqlwrk .= $fn;
        if ($v === null) {
            $sqlwrk .= " IS NULL";
        } else {
            $sqlwrk .= " = " . QuotedValue($v, $ft, $dbid);
        }
    }
    return $sqlwrk;
}

// Return Advanced Filter SQL
function AdvancedFilterSql(&$af, $fn, $val, $dbid = 0)
{
    if (!is_array($af) || $val === null) {
        return null;
    } else {
        foreach ($af as $filter) {
            if (SameString($val, $filter->ID) && $filter->Enabled && ($func = $filter->FunctionName)) {
                $func = function_exists($func) ? $func : PROJECT_NAMESPACE . $func;
                if (function_exists($func)) {
                    return $func($fn, $dbid);
                } else {
                    return null;
                }
            }
        }
        return null;
    }
}

// Compare values by custom sequence
function CompareValueCustom($v1, $v2, $seq)
{
    if ($seq == "_number") { // Number
        if (is_numeric($v1) && is_numeric($v2)) {
            return ((float)$v1 > (float)$v2);
        }
    } elseif ($seq == "_date") { // Date
        if (is_numeric(strtotime($v1)) && is_numeric(strtotime($v2))) {
            return (strtotime($v1) > strtotime($v2));
        }
    } elseif ($seq != "") { // Custom sequence
        if (is_array($seq)) {
            $ar = $seq;
        } else {
            $ar = explode(",", $seq);
        }
        if (in_array($v1, $ar) && in_array($v2, $ar)) {
            return (array_search($v1, $ar) > array_search($v2, $ar));
        } else {
            return in_array($v2, $ar);
        }
    }
    return ($v1 > $v2);
}

// Function to Match array
function MatchedArray($ar1, $ar2)
{
    if (!is_array($ar1) && !is_array($ar2)) {
        return true;
    } elseif (is_array($ar1) && is_array($ar2)) {
        return (count(array_diff($ar1, $ar2)) == 0);
    }
    return false;
}

// Escape chars for XML
function XmlEncode($val)
{
    return htmlspecialchars(strval($val));
}

// Adjust email content
function AdjustEmailContent($content)
{
    $content = preg_replace('/\s+class="(table-responsive(-sm|-md|-lg|-xl)? )?ew-grid(-middle-panel)?"/', "", $content);
    $content = str_replace("table ew-table", "ew-export-table", $content);
    $tableStyles = "border-collapse: collapse;";
    $cellStyles = "border: 1px solid #dddddd; padding: 5px;";
    $doc = new \DOMDocument("1.0", "utf-8");
    @$doc->loadHTML('<?xml encoding="utf-8">' . ConvertToUtf8($content)); // Convert to utf-8
    $tables = $doc->getElementsByTagName("table");
    foreach ($tables as $table) {
        if (ContainsText($table->getAttribute("class"), "ew-export-table")) {
            if ($table->hasAttribute("style")) {
                $table->setAttribute("style", $table->getAttribute("style") . $tableStyles);
            } else {
                $table->setAttribute("style", $tableStyles);
            }
            $rows = $table->getElementsByTagName("tr");
            $rowcnt = $rows->length;
            for ($i = 0; $i < $rowcnt; $i++) {
                $row = $rows->item($i);
                $cells = $row->childNodes;
                $cellcnt = $cells->length;
                for ($j = 0; $j < $cellcnt; $j++) {
                    $cell = $cells->item($j);
                    if ($cell->nodeType != XML_ELEMENT_NODE || $cell->tagName != "td") {
                        continue;
                    }
                    if ($cell->hasAttribute("style")) {
                        $cell->setAttribute("style", $cell->getAttribute("style") . $cellStyles);
                    } else {
                        $cell->setAttribute("style", $cellStyles);
                    }
                }
            }
        }
    }
    $content = $doc->saveHTML();
    $content = ConvertFromUtf8($content);
    return $content;
}

// Load drop down list
function LoadDropDownList(&$list, $val)
{
    if (is_array($val)) {
        $ar = $val;
    } elseif ($val != Config("INIT_VALUE") && $val != Config("ALL_VALUE") && $val != "") {
        $ar = [$val];
    } else {
        $ar = [];
    }
    $list = [];
    foreach ($ar as $v) {
        if ($v != Config("INIT_VALUE") && $v != "" && !StartsString("@@", $v)) {
            $list[] = $v;
        }
    }
}

// Get quick search keywords
function GetQuickSearchKeywords($search, $searchType)
{
    if ($searchType != "=") {
        $ar = [];
        // Match quoted keywords (i.e.: "...")
        if (preg_match_all('/"([^"]*)"/i', $search, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $p = strpos($search, $match[0]);
                $str = substr($search, 0, $p);
                $search = substr($search, $p + strlen($match[0]));
                if (strlen(trim($str)) > 0) {
                    $ar = array_merge($ar, explode(" ", trim($str)));
                }
                $ar[] = $match[1]; // Save quoted keyword
            }
        }
        // Match individual keywords
        if (strlen(trim($search)) > 0) {
            $ar = array_merge($ar, explode(" ", trim($search)));
        }
    } else {
        $ar = [$search];
    }
    return $ar;
}

// Get quick search filter
function GetQuickSearchFilter($flds, $arKeywords, $searchType, $searchAnyFields, $dbid = "DB")
{
    // Search keyword in any fields
    if ((SameText($searchType, "OR") || SameText($searchType, "AND")) && $searchAnyFields) {
        $filter = "";
        foreach ($arKeywords as $keyword) {
            if ($keyword != "") {
                $ar = [$keyword];
                $thisFilter = array_reduce($flds, function ($res, $fld) use ($ar, $searchType, $dbid) {
                    AddFilter($res, GetQuickSearchFilterForField($fld, $ar, $searchType, $dbid), "OR");
                    return $res;
                }, "");
                AddFilter($filter, $thisFilter, $searchType);
            }
        }
    } else {
        $searchType = SameText($searchType, "OR") ? "OR" : "AND";
        $filter = array_reduce($flds, function ($res, $fld) use ($arKeywords, $searchType, $dbid) {
            AddFilter($res, GetQuickSearchFilterForField($fld, $arKeywords, $searchType, $dbid), "OR");
            return $res;
        }, "");
    }
    return $filter;
}

// Get quick search filter for field
function GetQuickSearchFilterForField($fld, $arKeywords, $searchType, $dbid)
{
    $defCond = SameText($searchType, "OR") ? "OR" : "AND";
    $arSql = []; // Array for SQL parts
    $arCond = []; // Array for search conditions
    $cnt = count($arKeywords);
    $j = 0; // Number of SQL parts
    for ($i = 0; $i < $cnt; $i++) {
        $keyword = $arKeywords[$i];
        $keyword = trim($keyword);
        if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
            $keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
            $ar = explode("\\", $keyword);
        } else {
            $ar = [$keyword];
        }
        foreach ($ar as $keyword) {
            if ($keyword != "") {
                $wrk = "";
                if ($keyword == "OR" && $searchType == "") {
                    if ($j > 0) {
                        $arCond[$j - 1] = "OR";
                    }
                } elseif ($keyword == Config("NULL_VALUE")) {
                    $wrk = $fld->Expression . " IS NULL";
                } elseif ($keyword == Config("NOT_NULL_VALUE")) {
                    $wrk = $fld->Expression . " IS NOT NULL";
                } elseif ($fld->IsVirtual && $fld->Visible) {
                    $wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $dbid), $dbid);
                } elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
                    $wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $dbid), $dbid);
                }
                if ($wrk != "") {
                    $arSql[$j] = $wrk;
                    $arCond[$j] = $defCond;
                    $j += 1;
                }
            }
        }
    }
    $cnt = count($arSql);
    $quoted = false;
    $sql = "";
    if ($cnt > 0) {
        for ($i = 0; $i < $cnt - 1; $i++) {
            if ($arCond[$i] == "OR") {
                if (!$quoted) {
                    $sql .= "(";
                }
                $quoted = true;
            }
            $sql .= $arSql[$i];
            if ($quoted && $arCond[$i] != "OR") {
                $sql .= ")";
                $quoted = false;
            }
            $sql .= " " . $arCond[$i] . " ";
        }
        $sql .= $arSql[$cnt - 1];
        if ($quoted) {
            $sql .= ")";
        }
    }
    return $sql;
}

// Get extended filter
function GetExtendedFilter(&$fld, $default = false, $dbid = 0)
{
    $dbtype = GetConnectionType($dbid);
    $fldName = $fld->Name;
    $fldExpression = $fld->Expression;
    $fldDataType = $fld->DataType;
    $fldDateTimeFormat = $fld->DateTimeFormat;
    $fldVal1 = $default ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
    if (IsFloatFormat($fld->Type)) {
        $fldVal1 = ConvertToFloatString($fldVal1);
    }
    $fldOpr1 = $default ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
    $fldCond = $default ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
    $fldVal2 = $default ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
    if (IsFloatFormat($fld->Type)) {
        $fldVal2 = ConvertToFloatString($fldVal2);
    }
    $fldOpr2 = $default ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
    $wrk = "";
    $fldOpr1 = strtoupper(trim($fldOpr1));
    if ($fldOpr1 == "") {
        $fldOpr1 = "=";
    }
    $fldOpr2 = strtoupper(trim($fldOpr2));
    if ($fldOpr2 == "") {
        $fldOpr2 = "=";
    }
    $wrkFldVal1 = $fldVal1;
    $wrkFldVal2 = $fldVal2;
    if ($fld->isBoolean()) {
        if ($wrkFldVal1 != "") {
            $wrkFldVal1 = ($wrkFldVal1 == "1") ? "1" : "0";
        }
        if ($wrkFldVal2 != "") {
            $wrkFldVal2 = ($wrkFldVal2 == "1") ? "1" : "0";
        }
    } elseif ($fldDataType == DATATYPE_DATE || $fldDataType == DATATYPE_TIME) {
        if ($wrkFldVal1 != "") {
            $wrkFldVal1 = UnFormatDateTime($wrkFldVal1, $fld->formatPattern());
        }
        if ($wrkFldVal2 != "") {
            $wrkFldVal2 = UnFormatDateTime($wrkFldVal2, $fld->formatPattern());
        }
    }
    if ($fldOpr1 == "BETWEEN") {
        $isValidValue = ($fldDataType != DATATYPE_NUMBER ||
            ($fldDataType == DATATYPE_NUMBER && is_numeric($wrkFldVal1) && is_numeric($wrkFldVal2)));
        if ($wrkFldVal1 != "" && $wrkFldVal2 != "" && $isValidValue) {
            $wrk = $fldExpression . " BETWEEN " . QuotedValue($wrkFldVal1, $fldDataType, $dbid) .
                " AND " . QuotedValue($wrkFldVal2, $fldDataType, $dbid);
        }
    } else {
        // Handle first value
        if (SameString($fldVal1, Config("NULL_VALUE")) || $fldOpr1 == "IS NULL") {
            $wrk = $fldExpression . " IS NULL";
        } elseif (SameString($fldVal1, Config("NOT_NULL_VALUE")) || $fldOpr1 == "IS NOT NULL") {
            $wrk = $fldExpression . " IS NOT NULL";
        } else {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER ||
                ($fldDataType == DATATYPE_NUMBER && is_numeric($wrkFldVal1)));
            if ($wrkFldVal1 != "" && $isValidValue && IsValidOperator($fldOpr1, $fldDataType)) {
                $wrk = $fldExpression . GetFilterSql($fldOpr1, $wrkFldVal1, $fldDataType, $dbid);
            }
        }
        // Handle second value
        $wrk2 = "";
        if (SameString($fldVal2, Config("NULL_VALUE")) || $fldOpr2 == "IS NULL") {
            $wrk2 = $fldExpression . " IS NULL";
        } elseif (SameString($fldVal2, Config("NOT_NULL_VALUE")) || $fldOpr2 == "IS NOT NULL") {
            $wrk2 = $fldExpression . " IS NOT NULL";
        } else {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER ||
                ($fldDataType == DATATYPE_NUMBER && is_numeric($wrkFldVal2)));
            if ($wrkFldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
                $wrk2 = $fldExpression . GetFilterSql($fldOpr2, $wrkFldVal2, $fldDataType, $dbid);
            }
        }
        // Combine SQL
        AddFilter($wrk, $wrk2, $fldCond == "OR" ? "OR" : "AND");
    }
    return $wrk;
}

// Return search string
function GetFilterSql($fldOpr, $fldVal, $fldType, $dbid = 0)
{
    if (SameString($fldVal, Config("NULL_VALUE")) || $fldOpr == "IS NULL") {
        return " IS NULL";
    } elseif (SameString($fldVal, Config("NOT_NULL_VALUE")) || $fldOpr == "IS NOT NULL") {
        return " IS NOT NULL";
    } elseif ($fldOpr == "LIKE") {
        return Like(QuotedValue("%$fldVal%", $fldType, $dbid), $dbid);
    } elseif ($fldOpr == "NOT LIKE") {
        return NotLike(QuotedValue("%$fldVal%", $fldType, $dbid), $dbid);
    } elseif ($fldOpr == "STARTS WITH") {
        return Like(QuotedValue("$fldVal%", $fldType, $dbid), $dbid);
    } elseif ($fldOpr == "ENDS WITH") {
        return Like(QuotedValue("%$fldVal", $fldType, $dbid), $dbid);
    } else {
        return " $fldOpr " . QuotedValue($fldVal, $fldType, $dbid);
    }
}

// Return date search string
function GetDateFilterSql($fldExpr, $fldOpr, $fldVal, $fldType, $dbid = 0)
{
    if ($fldOpr == "Year" && $fldVal != "") { // Year filter
        return GroupSql($fldExpr, "y", 0, $dbid) . " = " . $fldVal;
    } else {
        $wrkVal1 = DateValue($fldOpr, $fldVal, 1, $dbid);
        $wrkVal2 = DateValue($fldOpr, $fldVal, 2, $dbid);
        if ($wrkVal1 != "" && $wrkVal2 != "") {
            return $fldExpr . " BETWEEN " . QuotedValue($wrkVal1, $fldType, $dbid) . " AND " . QuotedValue($wrkVal2, $fldType, $dbid);
        } else {
            return "";
        }
    }
}

// Group filter
function GroupSql($fldExpr, $grpType, $grpInt = 0, $dbid = 0)
{
    $dbtype = GetConnectionType($dbid);
    switch ($grpType) {
        case "f": // First n characters
            if ($dbtype == "MSSQL" || $dbtype == "MYSQL") { // MSSQL / MySQL
                return "SUBSTRING(" . $fldExpr . ",1," . $grpInt . ")";
            } else { // SQLite / PostgreSQL / Oracle
                return "SUBSTR(" . $fldExpr . ",1," . $grpInt . ")";
            }
            break;
        case "i": // Interval
            if ($dbtype == "MSSQL") { // MSSQL
                return "(" . $fldExpr . "/" . $grpInt . ")";
            } elseif ($dbtype == "MYSQL") { // MySQL
                return "(" . $fldExpr . " DIV " . $grpInt . ")";
            } elseif ($dbtype == "SQLITE") { // SQLite
                return "CAST(" . $fldExpr . "/" . $grpInt . " AS TEXT)";
            } elseif ($dbtype == "POSTGRESQL") { // PostgreSQL
                return "(" . $fldExpr . "/" . $grpInt . ")";
            } else { // Oracle
                return "FLOOR(" . $fldExpr . "/" . $grpInt . ")";
            }
            break;
        case "y": // Year
            if ($dbtype == "MSSQL" || $dbtype == "MYSQL") { // MSSQL / MySQL
                return "YEAR(" . $fldExpr . ")";
            } elseif ($dbtype == "SQLITE") { // SQLite
                return "CAST(STRFTIME('%Y'," . $fldExpr . ") AS INTEGER)";
            } else { // PostgreSQL / Oracle
                return "TO_CHAR(" . $fldExpr . ",'YYYY')";
            }
            break;
        case "xq": // Quarter
            if ($dbtype == "MSSQL") { // MSSQL
                return "DATEPART(QUARTER," . $fldExpr . ")";
            } elseif ($dbtype == "MYSQL") { // MySQL
                return "QUARTER(" . $fldExpr . ")";
            } elseif ($dbtype == "SQLITE") { // SQLite
                return "CAST(STRFTIME('%m'," . $fldExpr . ") AS INTEGER)+2)/3";
            } else { // PostgreSQL / Oracle
                return "TO_CHAR(" . $fldExpr . ",'Q')";
            }
            break;
        case "q": // Quarter (with year)
            if ($dbtype == "MSSQL") { // MSSQL
                return "(STR(YEAR(" . $fldExpr . "),4) + '|' + STR(DATEPART(QUARTER," . $fldExpr . "),1))";
            } elseif ($dbtype == "MYSQL") { // MySQL
                return "CONCAT(CAST(YEAR(" . $fldExpr . ") AS CHAR(4)), '|', CAST(QUARTER(" . $fldExpr . ") AS CHAR(1)))";
            } elseif ($dbtype == "SQLITE") { // SQLite
                return "(CAST(STRFTIME('%Y'," . $fldExpr . ") AS TEXT) || '|' || CAST((CAST(STRFTIME('%m'," . $fldExpr . ") AS INTEGER)+2)/3 AS TEXT))";
            } else { // PostgreSQL / Oracle
                return "(TO_CHAR(" . $fldExpr . ",'YYYY') || '|' || TO_CHAR(" . $fldExpr . ",'Q'))";
            }
            break;
        case "xm": // Month
            if ($dbtype == "MSSQL" || $dbtype == "MYSQL") { // MSSQL / MySQL
                return "MONTH(" . $fldExpr . ")";
            } elseif ($dbtype == "SQLITE") { // SQLite
                return "CAST(STRFTIME('%m'," . $fldExpr . ") AS INTEGER)";
            } else { // PostgreSQL / Oracle
                return "TO_CHAR(" . $fldExpr . ",'MM')";
            }
            break;
        case "m": // Month (with year)
            if ($dbtype == "MSSQL") { // MSSQL
                return "(STR(YEAR(" . $fldExpr . "),4) + '|' + REPLACE(STR(MONTH(" . $fldExpr . "),2,0),' ','0'))";
            } elseif ($dbtype == "MYSQL") { // MySQL
                return "CONCAT(CAST(YEAR(" . $fldExpr . ") AS CHAR(4)), '|', CAST(LPAD(MONTH(" . $fldExpr . "),2,'0') AS CHAR(2)))";
            } elseif ($dbtype == "SQLITE") { // SQLite
                return "CAST(STRFTIME('%Y|%m'," . $fldExpr . ") AS TEXT)";
            } else { // PostgreSQL / Oracle
                return "(TO_CHAR(" . $fldExpr . ",'YYYY') || '|' || TO_CHAR(" . $fldExpr . ",'MM'))";
            }
            break;
        case "w":
            if ($dbtype == "MSSQL") { // MSSQL
                return "(STR(YEAR(" . $fldExpr . "),4) + '|' + REPLACE(STR(DATEPART(WEEK," . $fldExpr . "),2,0),' ','0'))";
            } elseif ($dbtype == "MYSQL") { // MySQL
                //return "CONCAT(CAST(YEAR(" . $fldExpr . ") AS CHAR(4)), '|', CAST(LPAD(WEEKOFYEAR(" . $fldExpr . "),2,'0') AS CHAR(2)))";
                return "CONCAT(CAST(YEAR(" . $fldExpr . ") AS CHAR(4)), '|', CAST(LPAD(WEEK(" . $fldExpr . ",0),2,'0') AS CHAR(2)))";
            } elseif ($dbtype == "SQLITE") { // SQLite
                return "CAST(STRFTIME('%Y|%W'," . $fldExpr . ") AS TEXT)";
            } else {
                return "(TO_CHAR(" . $fldExpr . ",'YYYY') || '|' || TO_CHAR(" . $fldExpr . ",'WW'))";
            }
            break;
        case "d":
            if ($dbtype == "MSSQL") { // MSSQL
                return "(STR(YEAR(" . $fldExpr . "),4) + '|' + REPLACE(STR(MONTH(" . $fldExpr . "),2,0),' ','0') + '|' + REPLACE(STR(DAY(" . $fldExpr . "),2,0),' ','0'))";
            } elseif ($dbtype == "MYSQL") { // MySQL
                return "CONCAT(CAST(YEAR(" . $fldExpr . ") AS CHAR(4)), '|', CAST(LPAD(MONTH(" . $fldExpr . "),2,'0') AS CHAR(2)), '|', CAST(LPAD(DAY(" . $fldExpr . "),2,'0') AS CHAR(2)))";
            } elseif ($dbtype == "SQLITE") { // SQLite
                return "CAST(STRFTIME('%Y|%m|%d'," . $fldExpr . ") AS TEXT)";
            } else {
                return "(TO_CHAR(" . $fldExpr . ",'YYYY') || '|' || LPAD(TO_CHAR(" . $fldExpr . ",'MM'),2,'0') || '|' || LPAD(TO_CHAR(" . $fldExpr . ",'DD'),2,'0'))";
            }
            break;
        case "h":
            if ($dbtype == "MSSQL" || $dbtype == "MYSQL") { // Access / MSSQL / MySQL
                return "HOUR(" . $fldExpr . ")";
            } elseif ($dbtype == "SQLITE") { // SQLite
                return "CAST(STRFTIME('%H'," . $fldExpr . ") AS INTEGER)";
            } else {
                return "TO_CHAR(" . $fldExpr . ",'HH24')";
            }
            break;
        case "min":
            if ($dbtype == "MSSQL" || $dbtype == "MYSQL") { // Access / MSSQL / MySQL
                return "MINUTE(" . $fldExpr . ")";
            } elseif ($dbtype == "SQLITE") { // SQLite
                return "CAST(STRFTIME('%M'," . $fldExpr . ") AS INTEGER)";
            } else {
                return "TO_CHAR(" . $fldExpr . ",'MI')";
            }
            break;
    }
    return "";
}

// Get temp chart image
function TempChartImage($id, $custom = false)
{
    global $TempImages;
    $exportid = Param("exportid", "");
    if ($exportid != "") {
        $file = $exportid . "_" . $id . ".png";
        $folder = UploadPath(true);
        $f = $folder . $file;
        if (file_exists($f)) {
            $tmpimage = basename($f);
            $TempImages[] = $tmpimage;
            $export = $custom ? "print" : Param("export", "");
            return TempImageLink($tmpimage, $export);
        }
        return "";
    }
}

// Check HTML for export
function CheckHtml($html)
{
    $p1 = 'class="ew-table"';
    $p2 = ' data-page-break="before"';
    $pageBreak = Config("PAGE_BREAK_HTML");
    $p = '/' . preg_quote($p1, '/') . '|' . preg_quote($p2, '/') . '|' . preg_quote($pageBreak, '/') . '/';
    if (preg_match_all($p, $html, $matches, PREG_OFFSET_CAPTURE)) {
        foreach ($matches[0] as $match) {
            if ($match[0] == $p1) { // If table, break
                break;
            } elseif ($match[0] == $pageBreak) { // If page breaks (no table before), remove and continue
                $html = preg_replace('/' . preg_quote($match[0], "/") . '/', "", $html, 1);
                continue;
            } elseif ($match[0] == $p2) { // If page breaks (no table before), remove and break
                $html = preg_replace('/' . preg_quote($match[0], '/') . '/', "", $html, 1);
                break;
            }
        }
    }
    return $html;
}
