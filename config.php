<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('959833781425-qk92ph8ng9q3s6gtcagrapn258v2ub72.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/LOGIN-OAUTH/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');
?>