<?php

require_once '/path/to/google-api-php-client/vendor/autoload.php';
//Step 1: Enter you google account credentials

$g_client = new Google_Client();

$g_client->setClientId("482802102936-t05toask689iten2d1app6m4qp2b4cc5.apps.googleusercontent.com");
$g_client->setClientSecret("LoTLR61TfWbH9oMedgupIN34");
$g_client->setRedirectUri("http://127.0.0.1/google/googleloginCallback.php");
$g_client->setScopes("email");

echo "hi";

?>