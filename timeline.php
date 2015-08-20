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
	$user = $connection->get("account/verify_credentials");
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
		<link type="text/css" rel="stylesheet" href="css/custom.css">
		<link type="text/css" rel="stylesheet" href="css/jquery.bxslider.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="js/jquery.bxslider.min.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row user-row">
				<div class="col-md-2">
					<img src="<?php echo $user->profile_image_url_https;?>" class="img-rounded">
				</div>
				<div class="col-md-10">
					<h2 class="user-name"><?php echo $user->name;?></h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<ul class="bxslider"  id="timeline"></ul>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		$(document).ready(function(){
		    $.get("gettimeline.php", function(data, status){
		        $("#timeline").html(data);
		        $('.bxslider').bxSlider({
				  auto: true,
				  autoControls: true,
				  adaptiveHeight: true,
  				  mode: 'vertical'
				});
		    });
		});
	</script>
</html>