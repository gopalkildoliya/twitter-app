<?php
session_start();
require('fpdf.php');
require 'vendor/autoload.php';
	
	
	define('CONSUMER_KEY', getenv('CONSUMER_KEY'));
	define('CONSUMER_SECRET', getenv('CONSUMER_SECRET'));
	define('OAUTH_CALLBACK', getenv('OAUTH_CALLBACK'));
	use Abraham\TwitterOAuth\TwitterOAuth;
	

	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$currentuser = $connection->get("account/verify_credentials");
	$timeline = $connection->get("statuses/home_timeline", array("count" => 10));
	
////////////////Extended Class///////////
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image($currentuser->profile_image_url_https,10,6);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    $this->Write(0, $user->name);
    $this->Ln(20);
}
function AcceptPageBreak()
{
    if($this->col<2)
    {
        // Go to next column
        $this->SetCol($this->col+1);
        $this->SetY(10);
        return false;
    }
    else
    {
        // Go back to first column and issue page break
        $this->SetCol(0);
        return true;
    }
}
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
///////////////////////////////

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
foreach ($timeline as $story) {
		$user=$story->user;
		$pdf->Cell(0,0, $user->name);
		$pdf->Ln(10);
		$pdf->SetFont('Arial','',12);
		$pdf->MultiCell(0,5, $story->text);
		$pdf->Ln(10);
		$pdf->SetFont('Arial','B',16);
	}
$pdf->Output();
?>