<?php
if (count($_GET) || count($_POST))
{
include("indexiphone.php");
exit;
}
require('jevents.php');

if (isset($_SESSION['__default']['application.queue'][0]['message']))
{
	$_SESSION['displayeventupload']="Thank you for submitting your event. Our team will review and promote your information as soon as possible! Please complete this form again to submit other events.";
	header("Location: event_submit.php?option=com_jevents&view=icalevent&task=icalevent.edit&Itemid=111&tmpl=component");
	exit;
}
global $var;
include_once('./inc/var.php');
include_once($var->inc_path.'base.php');
_init();

?>

<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $var->site_name.' | '.$var->page_title; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
<link rel="stylesheet" type="text/css" href="common/css/all.css" media="screen" />
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="common/css/ie7.css" media="screen" /><![endif]-->
<link rel="stylesheet" type="text/css" href="common/css/jquery-ui.css" media="screen" />
<script type="text/javascript" src="common/js/jquery.min.js"></script>
<script type="text/javascript" src="common/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="common/js/default.js"></script>

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
    <?php m_featured_event(); ?> <!-- featuredEvent -->
    <?php m_photos_mini(); ?>  <!-- photos -->
    <br /><br />
    <?php m_events_this_week(); ?>
	</section> <!-- rightColumn -->
</div> <!-- wrapper -->
<footer>
	<?php m_footer(); ?> <!-- footer -->
</footer>

</body>
</html> 