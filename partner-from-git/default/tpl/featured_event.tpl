<h2>Featured Event</h2>
<div class="infoBox" style="margin-top:-12px;">
  <table cellspacing="10" style="width:350px;float:left;margin-left:-9px;margin-right:10px;"><tbody>
    <tr>
      <td colspan="2">
        <h3><?php echo $data['summary']; ?></h3>
      </td>
    </tr>
    <tr>
      <td><strong>Date:</strong></td>
      <td><?php $datearr=explode('-',$data['_date']); echo date("l, F j ",mktime(0,0,0,$datearr[1],$datearr[2],$datearr[0])); ?></td>
    </tr>
    <?php if(!strstr($data['timestart'], '00:00')) { ?>
    <tr>
      <td><strong>Time:</strong></td>
      <td>
      <?php 
        if($data['noendtime']==1) {
          echo $data['timestart'];
        } else {
          echo $data['timestart'].' - '.$data['timeend'];
        }
      ?>
      </td>
    </tr>
    <?php } ?>
    <tr>
      <td><strong>Where:</strong></td>
      <td><?php echo $data['location']['title']; ?></td>
    </tr>
    <tr>
      <td colspan="2">
        <p><?php echo $data['description']; ?></p>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <a class="button" href="event_details.php?event_id=<?php echo $data['evdet_id']; ?>&title=<?php echo $data['summary']; ?>&date=<?php echo $data['_date']; ?>&rp_id=<?php echo $data['rp_id']; ?>" style="float:left;" >More Info</a><br /><br /><br /><br /><br />
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
      </td>
    </tr>
  </tbody></table>
  <div class="adThreeHunderd" style="margin-top:12px;">
    <?php m_show_banner('Website Front Page Feature'); ?>
  </div> <!-- adThreeHunderd -->
</div>