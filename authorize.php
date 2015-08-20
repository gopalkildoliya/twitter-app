<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require 'vendor/autoload.php';
	
	
	define('CONSUMER_KEY', getenv('CONSUMER_KEY'));
	define('CONSUMER_SECRET', getenv('CONSUMER_SECRET'));
	define('OAUTH_CALLBACK', getenv('OAUTH_CALLBACK'));
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
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$user = $connection->get("account/verify_credentials");
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<img src="<?php echo $user->profile_image_url_https;?>">
				</div>
				<div class="col-md-10">
					<h2><?php echo $user->name;?></h2>
				</div>
			</div>
			<div class="row" id="timeline">
			</div>
		</div>
	</body>
	<script type="text/javascript">
		$(document).ready(function(){
		    $.get("gettimeline.php", function(data, status){
		        $("#timeline").html(data);
		    });
		});
	</script>
</html>