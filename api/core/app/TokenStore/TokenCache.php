<?php

namespace App\TokenStore;

use App\Model\Outlook\TokenCache as TokenCacheModel;

class TokenCache {
    public function storeTokens($access_token, $refresh_token, $expires) {
        // $_SESSION['access_token'] = $access_token;
        // $_SESSION['refresh_token'] = $refresh_token;
        // $_SESSION['token_expires'] = $expires;
        $TokenCache = New TokenCacheModel;
        $update = TokenCacheModel::where('id', 1)->update(['access_token' => $access_token, 'refresh_token' => $refresh_token, 'token_expires' => $expires]);
    }

    public function clearTokens() {
        unset($_SESSION['access_token']);
        unset($_SESSION['refresh_token']);
        unset($_SESSION['token_expires']);
    }

    public function getAccessToken() {
        $tokenCache = New TokenCacheModel;
        $tokens = $tokenCache->where('id', 1)->first();

        // Check if tokens exist
        if (empty($tokens->access_token)) {
            return '';
        }

        // Check if token is expired
        //Get current time + 5 minutes (to allow for time differences)
        $now = time() + 300;
        if ($tokens->token_expires <= $now) {
            // Token is expired (or very close to it)
            // so let's refresh

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
                $newToken = $oauthClient->getAccessToken('refresh_token', [
                    'refresh_token' => $tokens->refresh_token
                ]);

                // Store the new values
                $this->storeTokens($newToken->getToken(), $newToken->getRefreshToken(),
                $newToken->getExpires());

                return $newToken->getToken();
            }
            catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                return '';
            }
        }
        else {
            // Token is still valid, just return it
            return $tokens->access_token;
        }
    }
}