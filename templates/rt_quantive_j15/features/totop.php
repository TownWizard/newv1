<?php
/**
 * @package   Quantive Template - RocketTheme
 * @version   1.5.0 March 31, 2010
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2010 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Rockettheme Quantive Template uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureToTop extends GantryFeature {
    var $_feature_name = 'totop';

	function init() {
		global $gantry;
		
		if ($this->get('enabled')) {
			$gantry->addScript($gantry->gantryUrl.'/js/gantry-totop.js');
		}
	}
	
	function render($position="") {
	    ob_start();
	    ?>
		<a href="#" id="gantry-totop"><span><?php echo $this->get('text'); ?></span></a>
		<?php
	    return ob_get_clean();
	}
}