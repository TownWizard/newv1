<div id="topbar">
<div id="title">Event Info</div>
<div id="leftnav">   
<a href="events.php?d=<?=$today?>&m=<?=$tomonth?>&Y=<?=$toyear?>&lat=<?=$lat1?>&lon=<?=$lon1?>" >Back</a></div>
        
        
<div id="rightnav"></div>
</div>

<div id="content">
	<ul class="pageitem">	
      <?php 
	  while($row=mysql_fetch_array($rec))
	  {
	  	//#DD#
		  $ev=mysql_query("select *  from jos_jevents_vevent where ev_id=".$row['eventid']) or die(mysql_error());
		  $evDetails=mysql_fetch_array($ev);
		  $evrawdata = unserialize($evDetails['rawdata']);
		  //#DD#	
		  
			//$queryvevdetail="select *  from jos_jevents_vevdetail where evdet_id=".$row['eventid'];
			$queryvevdetail="select *  from jos_jevents_vevdetail where evdet_id=".$row['eventdetail_id'];
			$recvevdetail=mysql_query($queryvevdetail) or die(mysql_error());
			$rowvevdetail=mysql_fetch_array($recvevdetail);
			if ((int) ($rowvevdetail['location']))
			{
			$querylocdetail="select *  from jos_jev_locations where loc_id=".$rowvevdetail['location'];
			$reclocdetail=mysql_query($querylocdetail) or die(mysql_error());
			$rowlocdetail=mysql_fetch_array($reclocdetail);
			$lat2=$rowlocdetail['geolat'];
			$lon2=$rowlocdetail['geolon'];
			
			}
	  ?>
      <li class="textbox">
      <div style="width:100%"><strong><?=$rowvevdetail['summary']?></strong>
      <br /><br />
      <div style="width:100%"><div class="gray" style="width:10%;float:left;padding-right:50px;">Date:</div><div style="width:100%"><?=$todaestring?></div></div><br />
     <div style="width:100%"><div class="gray" style="width:10%;float:left;padding-right:50px;">Time:</div><div style="width:100%">
			<?php
				//#DD#
				if($evrawdata['allDayEvent']=='on'){
					echo 'All Day Event';
				}else{
					$displayTime.= ltrim($row[timestart], "0");
					if($evrawdata['NOENDTIME']!=1){
						$displayTime.='-'.ltrim($row[timeend], "0");
					}
						echo $displayTime;
				}
				//#DD#
			?>      	
     </div></div><br />
     <div style="width:100%"><div class="gray" style="width:10%;float:left;padding-right:50px;">Location:</div><div style="width:100%"><?=$rowlocdetail['title']?></div></div><br />
     <div style="width:100%"><div class="gray" style="width:10%;float:left;padding-right:50px;">Address:</div><div style="width:100%"><a href="map.php?lat=<?=$lat2?>&long=<?=$lon2?>"><?=$rowlocdetail['street']?></a></div></div><br />
     <div style="width:100%"><div class="gray" style="width:10%;float:left;padding-right:50px;">Phone:</div><div style="width:100%"><a href="tel:<?=$rowlocdetail['phone']?>"><?=$rowlocdetail['phone']?></a></div></div><br />
     <div style="width:100%"><div class="gray" style="width:10%;float:left;padding-right:50px;">Distance:</div><div style="width:100%"> <?=round(distance($lat1, $lon1, $lat2, $lon2,$dunit),'1')?>&nbsp;<?=$dunit?></div></div><br />
	<?php if(trim($rowlocdetail['url']) != '') { ?>
     <div style="width:100%"><div class="gray" style="width:10%;float:left;padding-right:50px;">Website:</div><div style="width:100%"><a href="http://<?php echo str_replace('http://','',$rowlocdetail['url']); ?>" target="_blank"><?php echo str_replace('http://','',$rowlocdetail['url']); ?></a></div></div><br />
	<?php } ?>
     <div style="width:100%"><div class="gray" style="width:10%;float:left;padding-right:50px;">Description:</div><div style="width:100%"><?=$rowvevdetail['description']?></div></div><br />
      </div>
      </li>
      <?php
	  }
	  ?>

<!-- Added by yogi for Facebook Share feature Begin -->
<?php 
$eddate_array = explode(" ",$rowvevdetail['modified']);
$ev_detail_date = $eddate_array[0];
$ev_detail_title = $rowvevdetail['summary'];
$ev_detail_id = $rowvevdetail['evdet_id'];
$host = $_SERVER[HTTP_HOST];

$eurl = rawurlencode("http://$host/event_details.php?event_id=$ev_detail_id&title=$ev_detail_title&date=$ev_detail_date&rp_id=$eid");
$egurl = str_replace('%20','%2B',$eurl);
?>
<!-- Added by yogi for Facebook Share feature End -->

 <div style='float:left;padding:3px 3px 3px 8px;'>
		<a expr:share_url='data:post.url' href='http://www.facebook.com/share.php?u=<?php echo $eurl ?>' name='fb_share' type='box_count'><img src="images/facebook_share_icon.png"/></a>
		<!-- <script src='http://static.ak.fbcdn.net/connect.php/js/FB.Share' type='text/javascript'></script> -->		
</div>

<div style='float:left;padding:3px 3px 3px 8px;'>
	<a href="https://plus.google.com/share?url=<?php echo $egurl ?>" onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
		<img src="images/google-share-button.jpg" alt="Share on Google+"/>
	</a>
</div>

		
	</ul>
</div>

<div id="footer">

	&copy; <?=date('Y');?> <?=$site_name?> | <a href="mailto:<?=$email?>?subject=Feedback">Contact Us</a></div></div>
<div style='display:none;'><?php echo $pageglobal['googgle_map_api_keys']; ?></div>