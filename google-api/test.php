<?php
/**
 * 测试 google api.
 * User: qiuyu
 * Date: 2018/5/2
 * Time: 下午3:16
 */

include __DIR__ . '/../vendor/autoload.php';

// 1. Follow the instructions to Create Web Application Credentials
// https://developers.google.com/api-client-library/php/auth/service-accounts#creatinganaccount

// 2. Download the JSON credentials

// 3. Set the path to these credentials using Google_Client::setAuthConfig:
$client = new Google_Client();
$client->setAuthConfig('/path/to/client_credentials.json');

// 4. Set the scopes required for the API you are going to call
$client->addScope(Google_Service_Drive::DRIVE);

// 5. Set your application's redirect URI

// Your redirect URI can be any registered URI, but in this example
// we redirect back to this same page
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$client->setRedirectUri($redirect_uri);

// 6. In the script handling the redirect URI, exchange the authorization code for an access token:
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
}

