<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'Kx9KV3IUAn35bBhpAKHRdpnSf');
define('CONSUMER_SECRET', 'rUpGE1NEthAEA9h8IcVDP5Se5xapXzTQbmTc8vJu1ZTJkBIKsN');
define('OAUTH_CALLBACK', 'https://gopaltapp.herokuapp.com/authorize.php');

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-md-offset-5" style="position:fixed; top:45%">
					<a href="<?php echo $url;?>" class="btn btn-primary">Start with Twitter</a>
				</div>
			</div>
		</div>
	</body>
</html>
