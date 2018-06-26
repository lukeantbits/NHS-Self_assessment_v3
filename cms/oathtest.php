<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$request_token = '2dc7b6df-8cdb-488f-b749-8bf693bc0ed8';
$request_token_secret = 'RAjDwaXKqy6N_jGC1x54OvxbMqihJAbLumblmb2gSbpzq-FVyxSJaupURrikGZ1QRNs6XUtz8-KdIsl_YPU6_w';
try {
    $oauth = new OAuth('OAUTH_CONSUMER_KEY','OAUTH_CONSUMER_SECRET');
    $oauth->setToken($request_token,$request_token_secret);
    $access_token_info = $oauth->getAccessToken("https://oauth.brightcove.com/v4/access_token");
    if(!empty($access_token_info)) {
        print_r($access_token_info);
    } else {
        print "Failed fetching access token, response was: " . $oauth->getLastResponse();
    }
} catch(OAuthException $E) {
    echo "Response: ". $E->lastResponse . "\n";
}

?>