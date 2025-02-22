<h1>
	<a href="index.php" title="HOME"> <img src="./partner/<?php echo $_SESSION['partner_folder_name']?>/images/logo/logo.png" height="150" width="245" /> </a>
</h1>
<div id="banner">
<?php m_show_banner('Website Top 468x60'); ?>
</div> <!-- banner -->
<nav>
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="events.php">Events</a></li>
    <li><a href="restaurants.php">Restaurants</a></li>
    <li><a href="locations.php">Places</a></li>
    <li><a href="photo_albums.php">Photos</a></li>
    <!--li><a href="visiting.php">Visiting</a></li-->
    <li><a href="videos.php">Videos</a></li>
    <!--<li><a href="contact_us.php">Contact</a></li>-->
  </ul>
</nav>

<?php require ("./inc/config.php"); 
$handle = fopen($query, "r");
$xml = '';
// Applying condition for $handle variable to check weather it is null or not
if($handle != null || !empty($handle)){
	while (!feof($handle)) {
  		$xml.= fread($handle, 8192);
	}
}
fclose($handle);
$data = XML_unserialize($xml);
?>
<div id="weather">
  <?php
echo str_replace('N/A','--',$data[weather][cc][tmp]) . "&#176; ";
echo " <a href='http://www.weather.com/weather/today/$var->location_code' target='_blank'><IMG SRC='common/images/weather/" . $data[weather][cc][icon] . ".png' height='27' border='0'></a>";
?>
</div> 
 
<!-- weather -->
<a id="facebook" href="<?php echo $var->facebook?>" target="_blank">Become a fan</a>
<!--<a id="download" href="<?php echo $var->iphone?>" target="_blank">Download our FREE iPhone App!</a> -->

<div id="download">
		<?php if($var->iphone != "" || $var->android != ""):?>
				<p>Download our FREE mobile App!</p>
		<?php endif;?>		
		<?php if($var->iphone && $var->iphone != ""):?>
				<a href="<?php echo $var->iphone?>" target="_blank" id="iPhone" title="Download our FREE iPhone app">iPhone</a>
		<?php endif;?>
		<?php if($var->android && $var->android != ""):?>
				<a href="<?php echo $var->android?>" target="_blank" id="android" title="Download our FREE Android app">Android</a>
		<?php endif;?>
</div>