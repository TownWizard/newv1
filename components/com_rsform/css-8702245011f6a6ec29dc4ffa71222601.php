<?php 
ob_start ("ob_gzhandler");
header("Content-type: text/css; charset: UTF-8");
header("Cache-Control: must-revalidate");
$offset = 60 * 60 ;
$ExpStr = "Expires: " . 
gmdate("D, d M Y H:i:s",
time() + $offset) . " GMT";
header($ExpStr);
                ?>

/*** front.css ***/

.formRed
{
	color: red;
	font-weight: bold;
}

.formError {
	color: #CF4D4D;
	font-weight:bold;
	font-size:10px;
}

.formNoError {
	display:none;
}

.formClr {
	clear:both;
	display: block;
}

fieldset.formFieldset {
	margin-bottom: 10px;
}

fieldset.formFieldset legend {
	padding: 0 2px;
	font-weight: bold;
	font-size: 16px;
}

fieldset.formFieldset ol.formContainer {
	margin: 0;
	padding: 0;
}

fieldset.formFieldset ol.formContainer li {
	background-image: none;
	list-style: none;
	padding: 5px;
	margin: 0;
	clear: both;
}

strong.formRequired {
	font-weight: bold;
	font-style: normal;
	margin-left: 3px;
}

div.formCaption {
	display: block;
	float: left;
	width: 25%;
	height: 12px;
}

div.formCaption {
	display: block;
}


div.formBody {
	display: block;
	float: left;
}

div.formDescription {
	margin-left: 3px;
	padding-left: 3px;
	font-size: 11px;
	font-weight: normal;
}

div.calheader{
	text-align:center !important;
}