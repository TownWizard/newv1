<?php

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

session_start();
include("connection.php");

function distance($lat1, $lon1, $lat2, $lon2, $unit) { 
$theta = $lon1 - $lon2; 
$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
$dist = acos($dist); 
$dist = rad2deg($dist); 
$miles = $dist * 60 * 1.1515;
$unit = strtoupper($unit);
	if($unit == "KMS") {
		return ($miles * 1.609344); 
	}else if($unit == "N"){
		return ($miles * 0.8684);
	}else{
		return $miles;
		}
}
$eid=$_REQUEST['eid'];

if (isset($_REQUEST['lat']) && $_REQUEST['lat'] != "" )
{$_SESSION['lat_device1']=$_REQUEST['lat'];
$lat1=$_SESSION['lat_device1'];
}

if (isset($_REQUEST['lon']) && $_REQUEST['lon'] != "" )
{$_SESSION['lon_device1']=$_REQUEST['lon'];
$lon1=$_SESSION['lon_device1'];
}

if ($_REQUEST['d']=="")
	$today=date('d');
else
	$today=$_REQUEST['d'];
if ($_REQUEST['m']=="")
	$tomonth=date('m');
else
	$tomonth=$_REQUEST['m'];
if ($_REQUEST['Y']=="")
	$toyear=date('Y');
else
	$toyear=$_REQUEST['Y'];
$todaestring=date('D, M j', mktime(0, 0, 0, $tomonth, $today, $toyear));
$query="select *,DATE_FORMAT(`startrepeat`,'%h:%i %p') as timestart, DATE_FORMAT(`endrepeat`,'%h:%i%p') as timeend from jos_jevents_repetition where rp_id=$eid";
$rec=mysql_query($query) or die(mysql_error());
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="image_src" href="http://<?php echo $_SERVER['HTTP_HOST']?>/partner/<?php echo $_SESSION['partner_folder_name']?>/images/logo/logo.png" />   	
<meta property="og:image" content="http://<?php echo $_SERVER['HTTP_HOST']?>/partner/<?php echo $_SESSION['partner_folder_name']?>/images/logo/logo.png"/>
<meta property="og:title" content="<?php echo $site_name.' | Event';?>"/>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="index,follow" name="robots" />
<meta content="text/html; charset=ISO-8859-1" http-equiv="Content-Type" />
<link href="pics/homescreen.gif" rel="apple-touch-icon" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<!--<link href="css/style.css" rel="stylesheet" media="screen" type="text/css" />-->
<link href="/components/com_shines/css/style_new_24oct2011.css" rel="stylesheet" media="screen" type="text/css" />
<script type="text/javascript">
var iWebkit;if(!iWebkit){iWebkit=window.onload=function(){function fullscreen(){var a=document.getElementsByTagName("a");for(var i=0;i<a.length;i++){if(a[i].className.match("noeffect")){}else{a[i].onclick=function(){window.location=this.getAttribute("href");return false}}}}function hideURLbar(){window.scrollTo(0,0.9)}iWebkit.init=function(){fullscreen();hideURLbar()};iWebkit.init()}}
</script>
<script language="javascript">
			function linkClicked(link) { document.location = link; } 
</script>
<title><?php echo $site_name.' | Event';?></title>
<script type="text/javascript">
	// TOUCH-EVENTS SINGLE-FINGER SWIPE-SENSING JAVASCRIPT
	// this script can be used with one or more page elements to perform actions based on them being swiped with a single finger
	var triggerElementID = null; // this variable is used to identity the triggering element
	var fingerCount = 0;
	var startX = 0;
	var startY = 0;
	var curX = 0;
	var curY = 0;
	var deltaX = 0;
	var deltaY = 0;
	var horzDiff = 0;
	var vertDiff = 0;
	var minLength = 72; // the shortest distance the user may swipe
	var swipeLength = 0;
	var swipeAngle = null;
	var swipeDirection = null;	
	// The 4 Touch Event Handlers
	// NOTE: the touchStart handler should also receive the ID of the triggering element
	// make sure its ID is passed in the event call placed in the element declaration, like:
	// <div id="picture-frame" ontouchstart="touchStart(event,'picture-frame');"  ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);">
	function touchStart(event,passedName) {
		// disable the standard ability to select the touched object
		// event.preventDefault();
		// get the total number of fingers touching the screen
		fingerCount = event.touches.length;
		// since we're looking for a swipe (single finger) and not a gesture (multiple fingers),
		// check that only one finger was used
		if ( fingerCount == 1 ) {
			// get the coordinates of the touch
			startX = event.touches[0].pageX;
			startY = event.touches[0].pageY;
			// store the triggering element ID
			triggerElementID = passedName;
		} else {
			// more than one finger touched so cancel
			touchCancel(event);
		}
}

	function touchMove(event) {
		//event.preventDefault();
		if ( event.touches.length == 1 ) {
			curX = event.touches[0].pageX;
			curY = event.touches[0].pageY;
		} else {
			touchCancel(event);
		}
}	

	function touchEnd(event) {
		event.preventDefault();
		// check to see if more than one finger was used and that there is an ending coordinate
		if ( fingerCount == 1 && curX != 0 ) {
			// use the Distance Formula to determine the length of the swipe
			swipeLength = Math.round(Math.sqrt(Math.pow(curX - startX,2) + Math.pow(curY - startY,2)));
			// if the user swiped more than the minimum length, perform the appropriate action
			if ( swipeLength >= minLength ) {
				caluculateAngle();
				determineSwipeDirection();
				processingRoutine();
				touchCancel(event); // reset the variables
			} else {
				touchCancel(event);
			}	
		} else {
			touchCancel(event);
		}
}

	function touchCancel(event) {
		// reset the variables back to default values
		fingerCount = 0;
		startX = 0;
		startY = 0;
		curX = 0;
		curY = 0;
		deltaX = 0;
		deltaY = 0;
		horzDiff = 0;
		vertDiff = 0;
		swipeLength = 0;
		swipeAngle = null;
		swipeDirection = null;
		triggerElementID = null;
	}

	function caluculateAngle() {
		var X = startX-curX;
		var Y = curY-startY
		var Z = Math.round(Math.sqrt(Math.pow(X,2)+Math.pow(Y,2))); //the distance - rounded - in pixels
		var r = Math.atan2(Y,X); //angle in radians (Cartesian system)
		swipeAngle = Math.round(r*180/Math.PI); //angle in degrees
		if ( swipeAngle < 0 ) { swipeAngle =  360 - Math.abs(swipeAngle); }
	}

	function determineSwipeDirection() {
		if ( (swipeAngle <= 45) && (swipeAngle >= 0) ) {
			swipeDirection = 'left';
		} else if ( (swipeAngle <= 360) && (swipeAngle >= 315) ) {
			swipeDirection = 'left';
		} else if ( (swipeAngle >= 135) && (swipeAngle <= 225) ) {
			swipeDirection = 'right';
		} else if ( (swipeAngle > 45) && (swipeAngle < 135) ) {
			swipeDirection = 'down';
		} else {
			swipeDirection = 'up';
		}
	}

	function processingRoutine() {
		var swipedElement = document.getElementById(triggerElementID);
		if ( swipeDirection == 'right' ) {
			// REPLACE WITH YOUR ROUTINES
			window.history.back()
		} 
	}

</script>
<meta content="destin, vacactions in destin florida, destin, florida, real estate, sandestin resort, beaches, destin fl, maps of florida, hotels, hotels in florida, destin fishing, destin hotels, best florida beaches, florida beach house rentals, destin vacation rentals for destin, destin real estate, best beaches in florida, condo rentals in destin, vacaction rentals, fort walton beach, destin fishing, fl hotels, destin restaurants, florida beach hotels, hotels in destin, beaches in florida, destin, destin fl" name="keywords" />

<meta content="Destin Florida's FREE iPhone application and website guide to local events, live music, restaurants and attractions" name="description" />

<?php include($_SERVER['DOCUMENT_ROOT']."/ga.php"); ?>
	</head>
	<body>
	<!--Google Adsense -->
	<?php
		/* Code added for iphone_places.tpl */
		require($_SERVER['DOCUMENT_ROOT']."/partner/".$_SESSION['tpl_folder_name']."/tpl/iphone_events_details.tpl");
		?>
	</body>
</html>