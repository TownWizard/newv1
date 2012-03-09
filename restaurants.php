<?php

global $var;
include_once('./inc/var.php');
include_once($var->inc_path.'base.php');
_init();

//#DD#
$searchdata = '';
if($_POST['search_rcd']=="Search Restaurants") {
	$searchdata = trim($_POST['searchvalue']);
}


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
<link rel="stylesheet" type="text/css" href="common/templatecolor/<?php echo $_SESSION['style_folder_name'];?>/css/all.css" media="screen" />
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="common/templatecolor/<?php echo $_SESSION['style_folder_name'];?>/css/ie7.css" media="screen" /><![endif]-->
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
    <h2><?php echo $var->site_name; ?> Restaurants</h2>
    <div style="width:350px;display:block;float:left;">
      <p>
        <?php m_dining_intro(); ?>
      </p>
      <br /><br />
		<div style="padding-left: 2px; float: left; width: 63px;">
			<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
			<g:plusone size="medium" width: 65px;></g:plusone>
		</div>
      <a name="fb_share" type="button" href="http://www.facebook.com/sharer.php" style="float:left;">Share</a>
      <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
      &nbsp;&nbsp;<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
      <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
      <a style="outline: medium none;margin-left:-15px;margin-top:-5px;" href="mailto:?body=Check%20this%20out:%20<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" rel="nofollow">
        <img src="common/images/btn_email.gif" border="0" />
      </a>
    </div>
    <div class="adThreeHunderd" style="float:left;">
      <?php m_show_banner('Website Front Page Feature'); ?>
    </div> <!-- adThreeHunderd -->
    
    <!--#DD#--> 
    <div style="text-align:center;">
    <form action="" method="post" name="location_form">
    <input type="text" name="searchvalue" value="<?php echo $searchdata; ?>" size="35" style="margin-top:20px;" />
    <input type="submit" name="search_rcd" value="Search Restaurants" style="margin-top:20px;" />
    </form>
    </div>
    <!--#DD#--> 


    <?php
	$rec=mysql_query("select * from jos_categories where 	(parent_id=152 OR id=152) AND section='com_jevlocations2' and published=1 order by `ordering`") or die(mysql_error());
	while($row=mysql_fetch_array($rec))
	{
		if (m_location_count($row['title'],false, $searchdata))
		{
	?>
    <div style="float:left;width:720px;display:block;">
    <h2><?=$row['title'];?></h2>
      
        <?php m_location_list($row['title'],false, $searchdata); ?>
     
     <br clear="all"> 
     </div>
    <?php
	}}
	?>
	</section> <!-- rightColumn -->
</div> <!-- wrapper -->
<footer>
	<?php m_footer(); ?> <!-- footer -->
</footer>

</body>
</html>