<div class="infoBox">
  <h2><?php echo $header; ?></h2>
  <div style="width:350px;display:block;float:left;margin-bottom:20px;">
    <?php echo $intro; ?>
  </div>
  <div class="adThreeHunderd" style="float:left;">
    <?php m_show_banner('Website Front Page Feature'); ?>
  </div> <!-- adThreeHunderd -->
	<div style="padding-left: 2px; float: left; width: 63px;">
		<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
		<g:plusone size="medium" width: 65px;></g:plusone>
	</div>
  <a name="fb_share" type="button" href="http://www.facebook.com/sharer.php" style="float:left; padding-right:7px;">Share</a>
  <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
  &nbsp;&nbsp;&nbsp;&nbsp;<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
  <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
  <a style="outline: medium none;margin-left:-15px;margin-top:-5px;" href="mailto:?body=Check%20this%20out:%20<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" rel="nofollow">
    <img src="common/images/btn_email.gif" border="0" />
  </a><br /><br />
  <!--a class="btn" href="#" onclick="return false;">list my events&nbsp&raquo;</a-->
</div>