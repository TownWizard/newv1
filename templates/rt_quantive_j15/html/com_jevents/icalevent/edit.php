<?php 
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: edit.php 1634 2009-12-09 03:15:40Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C)  2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */
defined('_JEXEC') or die('Restricted access');

if (defined("EDITING_JEVENT")) return;
define("EDITING_JEVENT",1);

global $task,$catid, $mainframe;
$db	=& JFactory::getDBO();
$editor =& JFactory::getEditor();

// clean any existing cache files
$cache =& JFactory::getCache(JEV_COM_COMPONENT);
$cache->clean(JEV_COM_COMPONENT);
$action = $mainframe->isAdmin()?"index.php":JURI::root()."index.php?option=".JEV_COM_COMPONENT."&Itemid=".JEVHelper::getItemid();

// load any custom fields
$dispatcher	=& JDispatcher::getInstance();
$customfields = array();
$res = $dispatcher->trigger( 'onEditCustom' , array(&$this->row,&$customfields));

// I need $year,$month,$day So that I can return to an appropriate date after saving an event (the repetition ids have all changed so I can't go back there!!)
list($year,$month,$day) = JEVHelper::getYMD();
if (!isset($this->ev_id)){
	$this->ev_id = $this->row->ev_id();
}

if ($this->editCopy){
	$this->old_ev_id=$this->ev_id;
	$this->ev_id=0;
	$this->repeatId=0;
	$this->rp_id=0;
	unset($this->row->_uid);
	$this->row->id(0);
}

$catid = $this->row->catid();
if ($catid==0 && $this->defaultCat>0){
	$catid = $this->defaultCat;
}

?>

<style>
/* overriding edit event header logo */
div#toolbar-box div.header.icon-48-jevents {
	background-image: none!important;
	padding-left:1px!important;
	color:#666;
	line-height:48px;
	background-color: #FFF;
}
</style>

<div id="jevents" >
<form action="<?php echo $action;?>" method="post" name="adminForm" enctype='multipart/form-data'>
<?php

// get configuration object
$cfg = & JEVConfig::getInstance();

JHTML::_('behavior.tooltip');
// This causes a javascript error in MSIE 7 if the scripts haven't loaded when the dom is ready!
//JHTML::_('behavior.calendar');
jimport('joomla.html.pane');
$tabs = & JPane::getInstance('tabs');


// these are needed for front end admin
?>
<input type="hidden" name="jevtype" value="<?php global $jevtype;echo $jevtype;?>" />
<div style='width:500px;'>
<?php
if ($this->editCopy){
	$repeatStyle="";
	echo "<h3>".JText::_("You are editing a copy of an Ical event")."</h3>";
}
else if ($this->repeatId==0) {
	$repeatStyle="";
	// Don't show warning for new events
	if ($this->ev_id>0){
		echo JText::_("You are editing an Ical event");
	}
}
else {
	$repeatStyle="style='display:none;'";
	?>
	<h3><?php echo JText::_("You are editing an Ical Repeat");?></h3>
	<input type="hidden" name="cid[]" value="<?php echo $this->rp_id;?>" />
	<?php
}
echo "</div>";


if (isset($this->row->_uid)){
?>
<input type="hidden" name="uid" value="<?php echo $this->row->_uid;?>" />
<?php
}

// need rp_id for front end editing cancel to work note that evid is the repeat id for viewing detail ?>
<input type="hidden" name="rp_id" value="<?php echo isset($this->rp_id)?$this->rp_id:-1;?>" /> 
<input type="hidden" name="year" value="<?php echo $year;?>" /> 
<input type="hidden" name="month" value="<?php echo $month;?>" /> 
<input type="hidden" name="day" value="<?php echo $day;?>" /> 

<input type="hidden" name="state" id="state" value="<?php echo $this->row->state();?>" />
<input type="hidden" name="evid" id="evid" value="<?php echo $this->ev_id;?>" />
<input type="hidden" name="valid_dates" id="valid_dates" value="1"  />
<?php
if ($this->editCopy){
	?>
<input type="hidden" name="old_evid" id="old_evid" value="<?php echo $this->old_ev_id;?>" />
	<?php
}
?>
<script type="text/javascript" language="Javascript">

function submitbutton(pressbutton) {
	if (pressbutton.substr(0, 6) == 'cancel' || !(pressbutton == 'icalevent.save' || pressbutton == 'icalrepeat.save'  || pressbutton == 'icalevent.apply'  || pressbutton == 'icalrepeat.apply')) {
		if (document.adminForm['catid']){
			// restore catid to input value
			document.adminForm['catid'].value=0;
			document.adminForm['catid'].disabled=true;
		}
		submitform( pressbutton );
		return;
	}
	var form = document.adminForm;
	<?php echo $editor->getContent( 'jevcontent' );  ?>
	// do field validation
	if (form.title.value == "") {
		alert ( "<?php echo html_entity_decode( JText::_('JEV_E_WARNTITLE') ); ?>" );
	}
	else if (form.ics_id.value == "0"){
		alert( "<?php echo html_entity_decode( 'MISSING ICAL SELECTION' ); ?>" );
	}
	else if (form.valid_dates.value =="0"){
		alert( "<?php echo JText::_("Invalid dates - please correct" );?>");
	}
	else {
		// sets the date for the page after save
		resetYMD();
		submitform(pressbutton);
	}
}

</script>
<div class="adminform" align="left">
<?php
// if we enter date/time before description then force single pane editing.
if ($cfg->get('timebeforedescription', 0)) {
	$cfg->set('com_single_pane_edit', 1);
}
if (!$cfg->get('com_single_pane_edit', 0)) {
	echo $tabs->startPane( 'jevent' );
	echo $tabs->startPanel( JText::_('JEV_TAB_COMMON'), 'event' );
}

 ?>
    <?php 
    $native=true;
    if ( $this->row->icsid()>0){
    	$thisCal = $this->dataModel->queryModel->getIcalByIcsid( $this->row->icsid());
    	if (isset($thisCal) && $thisCal->icaltype==0){
    		// note that icaltype = 0 for imported from URL, 1 for imported from file, 2 for created natively
    		echo JText::_("JEV IMPORT WARNING");
    		$native=false;
    	}
    	else if(isset($thisCal) && $thisCal->icaltype==1){
    		// note that icaltype = 0 for imported from URL, 1 for imported from file, 2 for created natively
    		echo JText::_("JEV IMPORT WARNING2");
    		$native=false;
    	}
    }
     ?>
    <table cellpadding="5" cellspacing="2" border="0"  class="adminform" id="jevadminform">
		<tr>
        	<td align="left"><?php echo JText::_('JEV_EVENT_TITLE'); ?></td>
            <td>
            	<input type="text" name="title" size="50" maxlength="255" value="<?php echo JEventsHtml::special($this->row->title()); ?>" />
            </td>
            <?php 
            $params =& JComponentHelper::getParams( JEV_COM_COMPONENT );
            $showpriority = $params->getValue("showpriority",0);
            if ($this->setPriority && $showpriority){ ?>
        	<td  align="left"><?php echo JText::_('JEV_EVENT_PRIORITY'); ?>:</td>
            <td >
            	<?php echo $this->priority; ?>
            </td>
            <?php } else { ?>
            <td colspan="2">
            	<input type="hidden" name="priority" value="0" />
            </td>
            <?php } ?>
		</tr>
		<?php if(isset($this->users)){?>
		<tr>
        	<td align="left"><?php echo JText::_('JEV_EVENT_CREATOR'); ?>:</td>
            <td colspan="3">
            	<?php echo $this->users;?>
            </td>
		</tr>			
		<?php }	?>
		<tr>
		<?php
	    if ($native && $this->clistChoice){
			?>
			<td>
			<script type="text/javascript" language="Javascript">
			function preselectCategory(select){
				var lookup = new Array();
				lookup[0]=0;
				<?php
				foreach ($this->nativeCals as $nc) {
					echo 'lookup['.$nc->ics_id.']='.$nc->catid.';';
				}
				?>
				document.adminForm['catid'].value=lookup[select.value];
			}
			</script>
	        <?php
	        echo JText::_("Select Ical (from raw icals)");
			?>
			</td>
			<td colspan="3">
			<?php
	        echo $this->clist;
	        echo "</td>";
	    }
	    else if ($this->clistChoice) {
	    	echo "<td>".JText::_("Select Ical (from raw icals)")."</td>";
	    	echo "<td colspan='3'>".$this->clist."</td>";
	    }
	    else {
	    	echo "<td colspan='4'>".$this->clist."</td>";
	    }
		?>
		</tr>
        <tr>
            <?php
            if ($this->repeatId==0) {
        	?>
        	<td valign="top" align="left"><?php echo JText::_('JEV_EVENT_CATEGORY'); ?></td>
            <td style="width:200px" >
            <?php 
            echo JEventsHTML::buildCategorySelect($catid, '', null, $this->with_unpublished_cat, true,0,'catid',JEV_COM_COMPONENT, $this->excats);
            ?>
            </td>
            <?php
            }
            if (isset($this->glist)) {?>
            <td align="left" class="accesslevel"><?php /* echo JText::_('JEV_EVENT_ACCESSLEVEL'); */?></td>
            <td class="accesslevel"><?php /* echo $this->glist; */ ?></td>
            <?php } 
            else {
            	echo "<td/><td/>\n";
            }
            if ($this->repeatId!=0) {
            	echo "<td/><td/>\n";
            }
		?>
		</tr>
		<?php

		if ( ($cfg->get('com_calForceCatColorEventForm', 0) == 1) && (! $mainframe->isAdmin())){
			$hideColour=true;
		}
		else if ( $cfg->get('com_calForceCatColorEventForm', 0) == 2) {
			$hideColour=true;
		}
		else $hideColour=false;
		if (!$hideColour){
			include_once(JEV_ADMINLIBS."/colorMap.php");
			?>
			<tr>
			<td valign="top" align="left"><?php echo JText::_('JEV_EVENT_COLOR'); ?></td>
			<td colspan="3">
	         <table id="pick1064797275" style="background-color:<?php echo $this->row->color().';color:'.JevMapColor($this->row->color()); ?>;border:solid 1px black;">
	            <tr>	
					<td  nowrap="nowrap">
						<input type="hidden" id="pick1064797275field" name="color" value="<?php echo $this->row->color();?>"/>
						<a id="colorPickButton" name ="colorPickButton" href="javascript:void(0)"  onclick="document.getElementById('fred').style.visibility='visible';"	  style="visibility:visible;color:<?php echo JevMapColor($this->row->color()); ?>;font-weight:bold;"><?php echo JText::_('JEV_COLOR_PICKER'); ?></a>
					</td>
					<td>
	                	<div style="position:relative;z-index:9999;">
						<iframe id="fred" frameborder="0" src="<?php echo JURI::root()."administrator/components/".JEV_COM_COMPONENT."/libraries/colours.html?id=fred";?>" style="position:absolute;width:300px!important;height:250px!important;visibility:hidden;z-index:9999;left:20px;top:-60px;overflow:visible!important;"></iframe>
						</div>
	                </td>
	            </tr>
	        </table>
	        </td></tr>
			<?php
		}

		if ($cfg->get('timebeforedescription', 0)) {
			?><tr><td valign="top" align="left" colspan="4"><?php
			echo $this->loadTemplate("datetime");	
			?></td></tr><?php
		}

        ?>

         <tr>
         	<td valign="middle" align="left">
            <?php  echo JText::_('JEV_EVENT_ACTIVITY'); ?>
            </td>
            <td colspan="3">
            <?php
            if ($cfg->get('com_show_editor_buttons')) {
            	$t_buttons = explode(',', $cfg->get('com_editor_button_exceptions'));
            } else {
            	// hide all
            	$t_buttons = false;
            }
            echo "<div id='jeveditor'>";
            // parameters : areaname, content, hidden field, width, height, rows, cols
            echo $editor->display( 'jevcontent',  JEventsHtml::special($this->row->content()) ,  "100%", 125, '70', '10', $t_buttons) ;
            echo "</div>";
				?>
            </td>
         </tr>
         <tr>
         	<td width="130" align="left"><?php echo JText::_('JEV_EVENT_ADRESSE'); ?></td>
            <td colspan="3">
            <?php
            $res = $dispatcher->trigger( 'onEditLocation' , array(&$this->row));
            if (count($res)==0 || !$res[0]) {
	            ?>
	            <input class="inputbox" type="text" name="location" size="80" maxlength="120" value="<?php echo JEventsHtml::special($this->row->location()); ?>" />
	            <?php
            }
            ?><div style='font-size:9px;'>(<a href="/index.php?option=com_rsform&formId=1&Itemid=99999">submit a new location</a>)</div>
            </td>
         </tr>
         <tr>
            <td align="left"><?php echo JText::_('JEV_EVENT_CONTACT'); ?></td>
            <td colspan="3">
            <input type="text" name="contact_info" size="50" maxlength="120" value="<?php echo JEventsHtml::special($this->row->contact_info()); ?>" /><br />
            <div style='font-size:9px;'>(email address, phone number and/or website where people can find more information)</div>
            </td>
          </tr>
          <!--- adding row for ext under contact info field --->
          <!--- <tr>
            <td align="left"></td>
            <td colspan="3">(email address, phone number and/or website where people can find more information)
            </td>
          </tr> --->
          
          <!---extra info fields --->
<!--        <tr>
            <td align="left" valign="top"><?php /* echo JText::_('JEV_EVENT_EXTRA');  */ ?></td>
            <td colspan="3">
            	<textarea class="text_area" name="extra_info" id="extra_info" cols="50" rows="4" wrap="virtual" ><?php /* echo JEventsHtml::special($this->row->extra_info()); */ ?></textarea>
            </td>
        </tr> -->
         <?php
         foreach ($customfields as $key=>$val) {
         ?>
         <tr style="display:none;">
         	<td valign="top"  width="130" align="left"><?php echo $customfields[$key]["label"]; ?></td>
            <td colspan="3"><?php echo $customfields[$key]["input"]; ?></td>
         </tr>
         	<?php

         }
         ?>
          
    </table>
	<?php
	
	if (!$cfg->get('com_single_pane_edit', 0)) {
		echo $tabs->endPanel();
		echo $tabs->startPanel( JText::_('JEV_TAB_CALENDAR'), 'calendar' );
	}
	if (!$cfg->get('timebeforedescription', 0)) {
		echo $this->loadTemplate("datetime");	
	}

	if (!$cfg->get('com_single_pane_edit', 0)) {
		echo $tabs->endPanel();
	}

// Plugins CAN BE LAYERED IN HERE
global $params;
// append array to extratabs keys content, title, paneid
$extraTabs = array();
$dispatcher->trigger( 'onEventEdit' , array(&$extraTabs,&$this->row,&$params), true );
if (count($extraTabs)>0) {
	foreach ($extraTabs as $extraTab) {
		echo $tabs->startPanel( $extraTab['title'], $extraTab['paneid'] );
		echo  $extraTab['content'];
		echo $tabs->endPanel();
	}
}

	if (!$cfg->get('com_single_pane_edit', 0)) {
		echo $tabs->endPane();
	}
?>
</div>
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="updaterepeats" value="0"/>
<input type="hidden" name="task" value="icalevent.edit" />
<input type="hidden" name="option" value="<?php echo JEV_COM_COMPONENT;?>" />
</form>
</div>