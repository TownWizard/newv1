<?php 
setlocale(LC_TIME,"spanish");
$todaestring=ucwords(strftime ('%a, %b %d',mktime(0, 0, 0, $tomonth, $today, $toyear)));
?>

<div id="topbar">
<div id="title"><?=$todaestring?></div>
<div id="leftnav">   
<a href="events.php?d=<?=date('d',mktime(0, 0, 0,$tomonth ,$today-1, $toyear));?>&m=<?=date('m',mktime(0, 0, 0,$tomonth ,$today-1, $toyear));?>&Y=<?=date('Y',mktime(0, 0, 0,$tomonth ,$today-1, $toyear));?>&lat=<?=$lat1?>&lon=<?=$lon1?>">Espalda</a>
        </div>
        
        
<div id="rightnav">
<a href="events.php?d=<?=date('d',mktime(0, 0, 0,$tomonth ,$today+1, $toyear));?>&m=<?=date('m',mktime(0, 0, 0,$tomonth ,$today+1, $toyear));?>&Y=<?=date('Y',mktime(0, 0, 0,$tomonth ,$today+1, $toyear));?>&lat=<?=$lat1?>&lon=<?=$lon1?>">Pr�ximo</a>
    
</div></div>


<div id="content">
  <ul class="pageitem">
	<li class="textbox">

    <div style="float:right;width:18%" class="dist">distancia</div>
    </li>	
      <?php 
	   $n = 0;
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
			$lat2=$rowlocdetail[geolat];
			$lon2=$rowlocdetail[geolon];
			
			}
			
			#DD#
			$displayTime = '';
			if($evrawdata['allDayEvent']=='on')
			{
				$displayTime.='All Day Event';
			}
			else
			{
				$displayTime.= ltrim($row[timestart], "0");
				if($evrawdata['NOENDTIME']!=1){
					$displayTime.='-'.ltrim($row[timeend], "0");
				}
			}	
			#DD#
	  ?>
      <li class="textbox">
      <div  style="float:left;padding-right:10px;width:20%" class="small"><?=$displayTime?></div><div style="float:left;width:55%"><strong><?=$rowvevdetail['summary']?></strong><br /><span class="grayplan"><?=$rowlocdetail['title']?></span><br /><a href="tel:<?=$rowlocdetail['phone']?>"><?=$rowlocdetail['phone']?></a> | <a href="events_details.php?eid=<?=$row['rp_id']?>&d=<?=$today?>&m=<?=$tomonth?>&Y=<?=$toyear?>&lat=<?=$lat1?>&lon=<?=$lon1?>">m�s informaci�n</a></div><div style="float:right;width:15%"><?=round(distance($lat1, $lon1, $lat2, $lon2,$dunit),'1')?>&nbsp;<?=$dunit?></div>
  
      </li>
     <?php
	 $rowlocdetail['title']="";
	  ++$n;
	  }
	  
	  if(0 == $n)
	  {
	  	
     	echo '<style>.dist{display:none;}</style><div style="padding-bottom: 10px;text-align:center;font-size: 15px;">Hoy No Hay Eventos</div>';
     
	  }  
	  ?>
		
	</ul>
</div>

<!-- Bottom Nav -->
<div id="tributton2">
	<div class="links">
		<a href="events.php?d=<?=date('d',mktime(0, 0, 0,$tomonth ,$today-1, $toyear));?>&m=<?=date('m',mktime(0, 0, 0,$tomonth ,$today-1, $toyear));?>&Y=<?=date('Y',mktime(0, 0, 0,$tomonth ,$today-1, $toyear));?>&lat=<?=$lat1?>&lon=<?=$lon1?>">Anterior</a><a id="pressed" href="#"><?=$todaestring?></a><a href="events.php?d=<?=date('d',mktime(0, 0, 0,$tomonth ,$today+1, $toyear));?>&m=<?=date('m',mktime(0, 0, 0,$tomonth ,$today+1, $toyear));?>&Y=<?=date('Y',mktime(0, 0, 0,$tomonth ,$today+1, $toyear));?>&lat=<?=$lat1?>&lon=<?=$lon1?>">Pr�ximo</a></div>
</div>
<div id="footer">&copy; <?=date('Y');?> <?=$site_name?> | <a href="mailto:<?=$email?>?subject=Feedback">Contacte con nosotros</a></div>
<div style='display:none;'><?php echo $pageglobal['googgle_map_api_keys']; ?></div>