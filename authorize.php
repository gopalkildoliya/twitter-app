<?php
	session_start();
	require 'vendor/autoload.php';
	require "config.php";
	use Abraham\TwitterOAuth\TwitterOAuth;

	$request_token = [];
	$request_token['oauth_token'] = $_SESSION['oauth_token'];
	$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

	if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
	    // Abort! Something is wrong.
	}
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
	$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
	$_SESSION['access_token'] = $access_token;
	foreach ($access_token as $key => $value) {
		echo $key.' = '.$value.'<br>';
	}

?>