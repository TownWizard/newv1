<div id="list" ontouchstart="touchStart(event,'list');" ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);">
	
      <?php 
	  while($row=mysql_fetch_array($rec))
	  {
		  
			
			$lat2=$row['geolat'];
			$lon2=$row['geolon'];
			
			
	  ?>
      
      <div style="width:100%"><strong style="font-size:15px;"><?=utf8_encode($row['title'])?></strong>
      <br /><br />
      <div style="width:100%">
	  <?php
	  $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
if(stripos($ua,'android') == true) { ?>
   <div style="width:10%;float:left;padding-right:50px;">Direcci&#243;n:</div><div style="width:100%"><a href="map.php?lat=<?=$lat2?>&long=<?=$lon2?>"><?=$row['street']?></a></div></div><br />
  
  <?php } else {
  ?>
        <div style="width:10%;float:left;padding-right:50px;">Direcci&#243;n:</div><div style="width:100%"><a href="javascript:linkClicked('APP30A:SHOWMAP:<?=$lat2?>:<?=$lon2?>')"><?=$row['street']?></a></div></div><br />
<?php } ?>
		
     <div style="width:100%">
       <div style="width:10%;float:left;padding-right:50px;">Tel&#233;fono:</div>
       <div style="width:90%"><a href="tel:<?php echo str_replace(array(' ','(',')','-','.'), '',$row[phone])?>"><?=$row[phone]?></a></div></div><br />
       <div style="width:100%"><div style="width:10%;float:left;padding-right:50px;">Distancia:</div><div style="width:100%"> <?=round(distance($lat1, $lon1, $lat2, $lon2,$dunit),'1')?>&nbsp;<?=$dunit?></div></div><br />
	<?php if ($row['url']!=''){ ?>
       <div style="width:100%"><div style="width:12.5%;float:left;padding-right:18px;">Sitio Web:</div><div style="width:90%"><a href="http://<?php echo str_replace('http://','',$row['url']); ?>" target="_blank"><?php echo str_replace('http://','',$row['url']); ?></a></div></div><br />
	<?php } ?>
	<?php if ($row['description']!=''){ ?>
       <div style="width:100%"><div style="width:10%;float:left;padding-right:50px;">Descripci&#243;n:</div><div style="width:100%"><?php echo stripJunk(utf8_encode($row['description'])); ?></div></div><br />
	<?php } ?>
      </div>
     
      <?php
	  }
	  ?>
		
	
</div>

<!--  <div id="footer">&copy; <?=date('Y');?> <?=$site_name?>, Inc. | <a href="mailto:<?=$email?>?subject=App Feedback">Contacte con nosotros</a></div> </div>-->
<div style='display:none;'><?php echo $pageglobal['googgle_map_api_keys']; ?></div>