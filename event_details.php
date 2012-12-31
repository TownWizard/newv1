<?php

require('jevents.php');
global $var;
include_once('./inc/var.php');
include_once($var->inc_path.'base.php');
_init();
//date_default_timezone_set("Asia/Calcutta");

/* code for SEF URL using rp_id by rinkal */

if(isset($var->get['rp_id'])) {
   $data = db_fetch("SELECT evd.*,rpt.rp_id,rpt.startrepeat,ev.catid,cat.title,DATE_FORMAT(rpt.startrepeat,'%h:%i %p') as timestart,DATE_FORMAT(rpt.endrepeat,'%h:%i %p') as timeend,evd.description,evd.location,evd.summary,cf.value FROM jos_jevents_vevent AS ev,jos_jevents_repetition AS rpt,jos_categories AS cat,jos_jevents_vevdetail
 AS evd, jos_jev_customfields AS cf	WHERE ev.ev_id= rpt.eventid AND ev.catid=cat.id AND rpt.eventdetail_id = evd.evdet_id AND rpt.eventdetail_id = cf.evdet_id AND rpt.rp_id =".$var->get['rp_id']." AND ev.state=1");
 
/* code end for SEF URL using rp_id by rinkal */ 
 
 
/*if(isset($var->get['event_id'])) {
  $data = db_fetch("select jjv.*, DATE_FORMAT(jjr.startrepeat,'%h:%i %p') as timestart, DATE_FORMAT(jjr.endrepeat,'%h:%i %p') as timeend from `jos_jevents_vevdetail` jjv, `jos_jevents_repetition` jjr where jjv.evdet_id = jjr.eventdetail_id and jjv.evdet_id = ".$var->get['event_id']." and jjr.rp_id = ".$var->get['rp_id']);
 */
	#DD#
	$notExists = false;
	if(!is_array($data)){
		$notExists = true;
	}
	#DD#
//$r=mysql_fetch_array($data);
	

	$data['location'] = db_fetch("select title, street, postcode, city, state, phone, geozoom, geolon, geolat, url from `jos_jev_locations` where `loc_id` = ".$data['location']);
	
  $data['q'] = str_replace(' ', '+', ($data['location']['title'].' '.$data['location']['street'].' '.$data['location']['city'].' '.$data['location']['state'].' '.$data['location']['postcode']));
} else {
  redirect($var->http_referer);
}

//fprint($data); _x();

?>

<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $var->site_name.' | Event | '.utf8_decode($var->get['title']); ?></title>
<link rel="image_src" href="http://<?php echo $_SERVER['HTTP_HOST']?>/partner/<?php echo $_SESSION['partner_folder_name']?>/images/logo/logo.png" />  
<meta property="og:image" content="http://<?php echo $_SERVER['HTTP_HOST']?>/partner/<?php echo $_SESSION['partner_folder_name']?>/images/logo/logo.png"/>
<meta property="og:title" content="<?php echo $var->site_name.' | Event | '.utf8_decode($var->get['title']); ?>"/>
<meta property="og:description" content="Check out <?php echo $data['summary'];?> on <?php echo date("Y-m-d", strtotime($var->get['date']));  ?>. Check out more local events at <?php echo $_SERVER['SERVER_NAME']?>."/>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="<?php echo $var->keywords; ?>" />
<meta name="description" content="<?php echo $var->metadesc; ?>" />
<meta name="description" content="<?php echo $var->extra_meta; ?>" />




<script>
  document.createElement('header');
  document.createElement('nav');
  document.createElement('section');
  document.createElement('article');
  document.createElement('aside');
  document.createElement('footer');
</script>
<link rel="stylesheet" type="text/css" href="common/templatecolor/<?php echo $_SESSION['style_folder_name'];?>/css/all.css" media="screen" />
<?php include("ga.php"); ?>
</head>

<body>

<header>
	<?php m_header(); ?> <!-- header -->
</header>
<div id="wrapper">
	<aside>
    <?php m_aside(); ?>
	</aside> <!-- left Column -->
	<section>

     <?php
	/* Code added for Events_details.tpl */
	require($var->tpl_path."event_details.tpl");
	?>
    
  </section> <!-- rightColumn -->
</div> <!-- wrapper -->
<footer>
	<?php m_footer(); ?> <!-- footer -->
</footer>

</body>
</html>