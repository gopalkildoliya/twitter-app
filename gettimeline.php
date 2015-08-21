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
	$timeline = $connection->get("statuses/home_timeline", array("count" => 10));
	if(isset($_GET['id']){
		$timeline = $connection->get("statuses/home_timeline", array("count" => 10, "user_id" => $_GET['id']));
	}
	foreach ($timeline as $story) {
		$user=$story->user;
		echo ('<li><div class="media">
  				<div class="media-left">
    				<a href="'.$user->url.'">
      					<img class="media-object img-rounded" src="'.$user->profile_image_url_https.'" alt="'.$user->name.'">
    				</a>
  				</div>
  				<div class="media-body">
    			<a href="'.$user->url.'"><h4 class="media-heading">'.$user->name.'</h4></a>'.$story->text.'</div>
			</div></li>');
	}
?>