<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require 'vendor/autoload.php';
	
	
	define('CONSUMER_KEY', getenv('CONSUMER_KEY'));
	define('CONSUMER_SECRET', getenv('CONSUMER_SECRET'));
	define('OAUTH_CALLBACK', getenv('OAUTH_CALLBACK'));
	use Abraham\TwitterOAuth\TwitterOAuth;

	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$timeline = $connection->get("statuses/home_timeline");
	foreach ($timeline as $story) {
		$user=$story->user;
		echo '<div class="media">
  				<div class="media-left">
    				<a href="#">
      					<img class="media-object" src="..." alt="...">
    				</a>
  				</div>
  				<div class="media-body">
    			<h4 class="media-heading">'.$user->name;.'</h4>'.
    				$story->text;
  				.'</div>
			</div>'
	}
?>