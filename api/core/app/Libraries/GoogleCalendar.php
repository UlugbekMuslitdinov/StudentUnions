<?php
namespace App\Libraries;

use Google_Client;
use Google_Service_Calendar;

class GoogleCalendar {

    public static function getClient()
    {
        // define('STDIN',fopen("php://stdin","r"));
        $client = new Google_Client();
        $client->setApplicationName('Student Union');
        $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
        $client->setAuthConfig(dirname(__FILE__).'/GoogleCalendarCredentials.json');
        $client->setAccessType('offline');
        // $client->setPrompt('select_account consent');
        // $client->setPrompt('consent');
        $client->setApprovalPrompt('force');
        $client->setSubject('azstudentunion@gmail.com');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = dirname(__FILE__).'/token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            $refreshtoken = '';
            if ($client->getRefreshToken()) {
                $refreshtoken = $client->getRefreshToken();
                // var_dump($refreshtoken); exit();
                $client->fetchAccessTokenWithRefreshToken($refreshtoken);
            } else {
                // Request authorization from the user.
                // $authUrl = $client->createAuthUrl();
                // echo $authUrl;
                // echo '<br>';
                // exit();

                // $authCode = trim('4/KQHzpXKICTdyJhTMlxmil82UEhbVKaz1jpViU2-a_Ja0JHmMR-xWIWykr0KSHCUL3igJTUFuaEnndPQYgvu7QIA');

                // // // // Exchange authorization code for an access token.
                // $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                // $client->setAccessToken($accessToken);

                // // Check to see if there was an error.
                // if (array_key_exists('error', $accessToken)) {
                //     throw new Exception(join(', ', $accessToken));
                // }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            $tokens = $client->getAccessToken();
            $tokens['refresh_token'] = $refreshtoken;
            file_put_contents($tokenPath, json_encode($tokens));
        }
        return $client;
    }

}