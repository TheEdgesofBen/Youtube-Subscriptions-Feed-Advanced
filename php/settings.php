<?

$OAUTH2_CLIENT_ID = "INSERT-CLIENT-ID-HERE";
$OAUTH2_CLIENT_SECRET = "INSERT-CLIENT-SECRET-HERE";

/*______________________________________________________________________________
Main Var
_____________________________________________________________________________ */

$maxResults = 5;
$maxSubscriptions = 2;
$callCounterResults = 0;
$videoNumber = 0;
$oldestDate = "2017-01-01T00:00:00+00:00";

/*______________________________________________________________________________
App Settings
_____________________________________________________________________________ */

if(isset($_GET["smallTest"])){
    $maxResults = 10;
    if($maxResults < 50){
        $minMaxResults = $maxResults;
    }
    else {
        $minMaxResults = 50;
    }
    $maxSubscriptions = 4;
    $orgMaxResults = $maxResults;
    $loopCounterResults = ($maxResults/50)-1;
    $orgLoopCounterResults = $loopCounterResults;

    setcookie("settings", $maxResults.",".$orgMaxResults.",".$maxSubscriptions.",".$minMaxResults.",".$loopCounterResults.",".$orgLoopCounterResults.",".$oldestDate, time() + 86400, "/");
}

if(isset($_GET["middleTest"])){
    $maxResults = 25;
    if($maxResults < 50){
        $minMaxResults = $maxResults;
    }
    else {
        $minMaxResults = 50;
    }
    $maxSubscriptions = 10;
    $orgMaxResults = $maxResults;
    $loopCounterResults = ($maxResults/50)-1;
    $orgLoopCounterResults = $loopCounterResults;

    setcookie("settings", $maxResults.",".$orgMaxResults.",".$maxSubscriptions.",".$minMaxResults.",".$loopCounterResults.",".$orgLoopCounterResults.",".$oldestDate, time() + 86400, "/");
}

if(isset($_GET["bigTest"])){
    $maxResults = 100;
    if($maxResults < 50){
        $minMaxResults = $maxResults;
    }
    else {
        $minMaxResults = 50;
    }
    $maxSubscriptions = 50;
    $orgMaxResults = $maxResults;
    $loopCounterResults = ($maxResults/50)-1;
    $orgLoopCounterResults = $loopCounterResults;

    setcookie("settings", $maxResults.",".$orgMaxResults.",".$maxSubscriptions.",".$minMaxResults.",".$loopCounterResults.",".$orgLoopCounterResults.",".$oldestDate, time() + 86400, "/");
}

if(isset($_GET["giantTest"])){
    $maxResults = 500;
    if($maxResults < 50){
        $minMaxResults = $maxResults;
    }
    else {
        $minMaxResults = 50;
    }
    $maxSubscriptions = 50;
    $oldestDate = "2016-01-01T00:00:00+00:00";
    $orgMaxResults = $maxResults;
    $loopCounterResults = ($maxResults/50)-1;
    $orgLoopCounterResults = $loopCounterResults;

    setcookie("settings", $maxResults.",".$orgMaxResults.",".$maxSubscriptions.",".$minMaxResults.",".$loopCounterResults.",".$orgLoopCounterResults.",".$oldestDate, time() + 86400, "/");
}

if(isset($_GET["bem"])){
    $maxResults = 250;
    if($maxResults < 50){
        $minMaxResults = $maxResults;
    }
    else {
        $minMaxResults = 50;
    }
    $maxSubscriptions = 50;
    $orgMaxResults = $maxResults;
    $loopCounterResults = ($maxResults/50)-1;
    $orgLoopCounterResults = $loopCounterResults;

    setcookie("settings", $maxResults.",".$orgMaxResults.",".$maxSubscriptions.",".$minMaxResults.",".$loopCounterResults.",".$orgLoopCounterResults.",".$oldestDate, time() + 86400, "/");
}

if(isset($_POST["custom"])){

}

if(!isset($_COOKIE["settings"])) {
    $errorOutput = "Cookie named 'settings' is not set!";
}

else {
    $cookieValues = explode(",", $_COOKIE["settings"]);
    $maxResults = $cookieValues[0];
    $orgMaxResults = $cookieValues[1];
    $maxSubscriptions = $cookieValues[2];
    $minMaxResults = $cookieValues[3];
    $loopCounterResults = $cookieValues[4];
    $orgLoopCounterResults = $cookieValues[5];
    $oldestDate = $cookieValues[6];
    $errorOutput = "Cookie 'settings' is set!<br>";
    $errorOutput .= "Max Results are: ".$maxResults.", ".$maxSubscriptions."";
}

/*______________________________________________________________________________
Youtube Data Api Setup
_____________________________________________________________________________ */

require_once __DIR__ . "/google-api-php-client-2.2.0/vendor/autoload.php";
session_start();

$client = new Google_Client();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setClientSecret($OAUTH2_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube');
$redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
  FILTER_SANITIZE_URL);
$client->setRedirectUri($redirect);

$youtube = new Google_Service_YouTube($client);

$tokenSessionKey = 'token-' . $client->prepareScopes();
if (isset($_GET['code'])) {
  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
    die('The session state did not match.');
  }

  $client->authenticate($_GET['code']);
  $_SESSION[$tokenSessionKey] = $client->getAccessToken();
  header('Location: ' . $redirect);
}

if (isset($_SESSION[$tokenSessionKey])) {
  $client->setAccessToken($_SESSION[$tokenSessionKey]);
}

if (!$client->getAccessToken()) {
    $state = mt_rand();
    $client->setState($state);
    $_SESSION['state'] = $state;

    $authUrl = $client->createAuthUrl();
    $htmlBody = <<<END
    <h3>Authorization Required</h3>
    <p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
END;
}

?>
