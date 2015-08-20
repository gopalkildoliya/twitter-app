<?php
try {
	session_start();
} catch (Exception $e) {
	echo 'Caught exception Session Start: ',  $e->getMessage(), "\n";
}

try {
	require "vendor/autoload.php";
} catch (Exception $e) {
	echo 'Caught exception loading vendor/ autoload: ',  $e->getMessage(), "\n";
}



use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'Kx9KV3IUAn35bBhpAKHRdpnSf');
define('CONSUMER_SECRET', 'rUpGE1NEthAEA9h8IcVDP5Se5xapXzTQbmTc8vJu1ZTJkBIKsN');
define('OAUTH_CALLBACK', 'https://gopaltapp.herokuapp.com/authorize.php');

try {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
} catch (Exception $e) {
	echo 'Caught exception first connection and request token: ',  $e->getMessage(), "\n";
}


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
