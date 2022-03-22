<?php

namespace PHPMaker2021\project1;

use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\MiddlewareInterface;

/**
 * JWT middleware
 */
class JwtMiddleware implements MiddlewareInterface
{
    // Create JWT token
    public function create(Request $request, RequestHandler $handler): Response
    {
        global $Security, $ResponseFactory;

        // Get response
        $response = $handler->handle($request);

        // Return JWT
        $Security = Container("security");
        $response = $ResponseFactory->createResponse();
        if ($Security->isLoggedIn()) {
            $jwt = $this->createJWT($Security->currentUserName(), $Security->CurrentUserID, $Security->CurrentParentUserID, $Security->CurrentUserLevelID);
            return $response->withJson($jwt); // Return JWT
        } else {
            return $response->withStatus(401); // Not authorized
        }
    }

    // Validate JWT token
    public function process(Request $request, RequestHandler $handler): Response
    {
        global $UserProfile, $Security, $ResponseFactory;

        // Set up security from auth header
        $UserProfile = Container("profile");
        $Security = Container("security");
        $authHeader = $request->getHeader(Config("JWT.AUTH_HEADER"));
        if ($authHeader) {
            $jwt = $this->decodeJWT($authHeader);
            // Login user
            if (is_array($jwt) && @$jwt["username"] != "") {
                $Security->loginUser(@$jwt["username"], @$jwt["userid"], @$jwt["parentuserid"], @$jwt["userlevelid"]);
            } elseif (is_array($jwt)) { // JWT error
                $response = $ResponseFactory->createResponse();
                $json = array_merge($jwt, ["success" => false, "version" => PRODUCT_VERSION]);
                return $response->withJson($json);
            }
        }

        // Process request
        return $handler->handle($request);
    }

    // Create JWT
    protected function createJWT($userName, $userID, $parentUserID, $userLevelID)
    {
        //$tokenId = base64_encode(mcrypt_create_iv(32));
        $tokenId = base64_encode(openssl_random_pseudo_bytes(32));
        $issuedAt = time();
        $notBefore = $issuedAt + Config("JWT.NOT_BEFORE_TIME"); // Adding not before time (seconds)
        $expire = $notBefore + Config("JWT.EXPIRE_TIME"); // Adding expire time (seconds)
        $serverName = ServerVar("SERVER_NAME");

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
        $result = ["JWT" => $jwt];
        return $result;
    }

    // Decode JWT
    protected function decodeJWT($header)
    {
        if (is_array($header) && count($header) > 0) {
            $jwt = $header[0];
            $jwt = preg_replace('/^Bearer\s+/', "", $jwt);
            try {
                $ar = (array)\Firebase\JWT\JWT::decode($jwt, Config("JWT.SECRET_KEY"), [Config("JWT.ALGORITHM")]);
                return (array)$ar["security"];
            } catch (\Firebase\JWT\BeforeValidException $e) {
                return ["failureMessage" => "BeforeValidException: " . $e->getMessage()];
            } catch (\Firebase\JWT\ExpiredException $e) {
                return ["failureMessage" => "ExpiredException: " . $e->getMessage()];
            } catch (\Throwable $e) {
                return ["failureMessage" => "Exception: " . $e->getMessage()];
            }
        }
        return [];
    }
}
