<?php
namespace App\Http\Controllers\MS;

use App\Http\Controllers\Controller;

class AuthController extends Controller 
{

	public function signin()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Initialize the OAuth client
        $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => env('OUTLOOK_OAUTH_APP_ID'),
            'clientSecret'            => env('OUTLOOK_OAUTH_APP_PASSWORD'),
            'redirectUri'             => env('OUTLOOK_OAUTH_REDIRECT_URI'),
            'urlAuthorize'            => env('OUTLOOK_OAUTH_AUTHORITY').env('OUTLOOK_OAUTH_AUTHORIZE_ENDPOINT'),
            'urlAccessToken'          => env('OUTLOOK_OAUTH_AUTHORITY').env('OUTLOOK_OAUTH_TOKEN_ENDPOINT'),
            'urlResourceOwnerDetails' => '',
            'scopes'                  => env('OUTLOOK_OAUTH_SCOPES')
        ]);

        // Generate the auth URL
        $authorizationUrl = $oauthClient->getAuthorizationUrl();

        // Save client state so we can validate in response
        $_SESSION['oauth_state'] = $oauthClient->getState();

        // Redirect to authorization endpoint
        header('Location: '.$authorizationUrl);
        exit();
    }

    public function gettoken()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Authorization code should be in the "code" query param
        if (isset($_GET['code'])) {
            // Check that state matches
            if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth_state'])) {
                exit('State provided in redirect does not match expected value.');
            }
        
            // Clear saved state
            unset($_SESSION['oauth_state']);
        
            // Initialize the OAuth client
            $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
                'clientId'                => env('OUTLOOK_OAUTH_APP_ID'),
                'clientSecret'            => env('OUTLOOK_OAUTH_APP_PASSWORD'),
                'redirectUri'             => env('OUTLOOK_OAUTH_REDIRECT_URI'),
                'urlAuthorize'            => env('OUTLOOK_OAUTH_AUTHORITY').env('OUTLOOK_OAUTH_AUTHORIZE_ENDPOINT'),
                'urlAccessToken'          => env('OUTLOOK_OAUTH_AUTHORITY').env('OUTLOOK_OAUTH_TOKEN_ENDPOINT'),
                'urlResourceOwnerDetails' => '',
                'scopes'                  => env('OUTLOOK_OAUTH_SCOPES')
            ]);
        
            try {
                // Make the token request
                $accessToken = $oauthClient->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);
        
                // Save the access token and refresh tokens in session
                // This is for demo purposes only. A better method would
                // be to store the refresh token in a secured database
                $tokenCache = new \App\TokenStore\TokenCache;
                $tokenCache->storeTokens($accessToken->getToken(), $accessToken->getRefreshToken(),
                $accessToken->getExpires());
        
                // Redirect back to mail page
                return redirect()->route('calendar');
            }
            catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                exit('ERROR getting tokens: '.$e->getMessage());
            }

            exit();
        }
        elseif (isset($_GET['error'])) {
            exit('ERROR: '.$_GET['error'].' - '.$_GET['error_description']);
        }
    }

    public function testToken() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $tokenCache = new \App\TokenStore\TokenCache;
        $access_token = $tokenCache->getAccessToken();
        $refresh_token = $_SESSION['refresh_token'];
        $token_expires = $_SESSION['token_expires'];
        
        echo "accesss_token : " . $access_token . '<br/>';
        echo "refresh_token : " . $refresh_token . '<br/>';
        echo "expires : " . $token_expires;
    }
}