<?php

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
    <div style="float:left;">
      <h2>Visit <?php echo $var->beach; ?></h2>
      <div style="float:left;width:350px;display:block;">
        <?php m_visiting_intro(); ?>
      </div>
      <div class="adThreeHunderd">
        <?php m_show_banner('Website Front Page Feature'); ?>
      </div> <!-- adThreeHunderd -->
    </div>
	</section> <!-- rightColumn -->
</div> <!-- wrapper -->
<footer>
	<?php m_footer(); ?> <!-- footer -->
</footer>

</body>
</html> 