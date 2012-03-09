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

/*** modal.css ***/

.body-overlayed embed, .body-overlayed object, .body-overlayed select
{
	visibility:				hidden;
}

#sbox-window embed, #sbox-window object, #sbox-window select
{
	visibility:				visible;
}

#sbox-overlay
{
	position:				absolute;
	background-color:		#000;
}

#sbox-window
{
	position:				absolute;
	background-color:		#000;
	text-align:				left;
	overflow:				visible;
	padding:				10px;
	-moz-border-radius:		3px;
}

* html #sbox-window
{
	top: 50% !important;
	left: 50% !important;
}

#sbox-btn-close
{
	position:				absolute;
	width:					30px;
	height:					30px;
	right:					-15px;
	top:					-15px;
	background:				url(../images/closebox.png) no-repeat top left;
	border:					none;
}

.sbox-loading #sbox-content
{
	background-image:		url(../images/spinner.gif);
	background-repeat:		no-repeat;
	background-position:	center;
}

#sbox-content
{
	clear:					both;
	overflow:				auto;
	background-color:		#fff;
	height:					100%;
	width:					100%;
}

.sbox-content-image#sbox-content
{
	overflow:				visible;
}

#sbox-image
{
	display:				block;
}

.sbox-content-image img
{
	display:				block;
}

.sbox-content-iframe#sbox-content
{
	overflow:				visible;
}