<?php
session_start();

require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'Facebook/HttpClients/FacebookCurl.php' );
require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php' );

require_once( 'Facebook/Entities/AccessToken.php' );
require_once( 'Facebook/Entities/SignedRequest.php');

require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookSignedRequestFromInputHelper.php');
require_once( 'Facebook/FacebookCanvasLoginHelper.php');
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookOtherException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/GraphUser.php');
require_once( 'Facebook/GraphSessionInfo.php' );
 
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;

use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;

use Facebook\FacebookSession;
use Facebook\FacebookSignedRequestFromInputHelper;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;


FacebookSession::setDefaultApplication('APP-ID','APP_SECRET');

$helper = new FacebookCanvasLoginHelper();

try {
	$session = $helper->getSession();
} catch (FacebookRequestException $e) {
	echo $e->getMessage();
} catch (\Exception $ex) {
    echo $e->getMessage();
}

if ($session) {
	try {

		$request = new FacebookRequest($session, 'GET', '/me');
		$response = $request->execute();
		$me = $response->getGraphObject();
		echo $me->getProperty('name');
		echo "<br>";
		echo $me->getProperty('gender');


  	} catch(FacebookRequestException $e) {
  		echo $e->getMessage();
 	}   
} else {
	$helper = new FacebookRedirectLoginHelper('https://apps.facebook.com/APP-NAMESPACE/');
    $auth_url = $helper->getLoginUrl();
    echo "<script>window.top.location.href='".$auth_url."'</script>";
}
