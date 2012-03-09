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

/*** jevlocations.css ***/

table.admintable td 					 { padding: 3px; }
table.admintable td.key,
table.admintable td.paramlist_key {
	background-color: #f6f6f6;
	text-align: right;
	width: 140px;
	color: #666;
	font-weight: bold;
	border-bottom: 1px solid #e9e9e9;
	border-right: 1px solid #e9e9e9;
}

table.paramlist td.paramlist_description {
	background-color: #f6f6f6;
	text-align: left;
	width: 170px;
	color: #333;
	font-weight: normal;
	border-bottom: 1px solid #e9e9e9;
	border-right: 1px solid #e9e9e9;
}

table.admintable td.key.vtop { vertical-align: top; }

table.adminform {
	background-color: #f9f9f9;
	border: solid 1px #d5d5d5;
	width: 100%;
	border-collapse: collapse;
	margin: 8px 0 10px 0;
	margin-bottom: 15px;
	width: 100%;
}
table.adminform.nospace { margin-bottom: 0; }
table.adminform tr.row0 { background-color: #f9f9f9; }
table.adminform tr.row1 { background-color: #eeeeee; }

table.adminform th {
	font-size: 11px;
	padding: 6px 2px 4px 4px;
	text-align: left;
	height: 25px;
	color: #000;
	background-repeat: repeat;
}
table.adminform td { padding: 3px; text-align: left; }

table.adminform td.filter{
	text-align: left;
}

table.adminform td.helpMenu{
	text-align: right;
}


fieldset.adminform { border: 1px solid #ccc; margin: 0 10px 10px 10px; }

/** Table styles **/

table.adminlist {
	width: 100%;
	border-spacing: 1px;
	background-color: #e7e7e7;
	color: #666;
}

table.adminlist td,
table.adminlist th { padding: 4px; }

table.adminlist thead th {
	text-align: center;
	background: #f0f0f0;
	color: #666;
	border-bottom: 1px solid #999;
	border-left: 1px solid #fff;
}

table.adminlist thead a:hover { text-decoration: none; }

table.adminlist thead th img { vertical-align: middle; }

table.adminlist tbody th { font-weight: bold; }

table.adminlist tbody tr			{ background-color: #fff;  text-align: left; }
table.adminlist tbody tr.row1 	{ background: #f9f9f9; border-top: 1px solid #fff; }

table.adminlist tbody tr.row0:hover td,
table.adminlist tbody tr.row1:hover td  { background-color: #ffd ; }

table.adminlist tbody tr td 	   { height: 25px; background: #fff; border: 1px solid #fff; }
table.adminlist tbody tr.row1 td { background: #f9f9f9; border-top: 1px solid #FFF; }

table.adminlist tfoot tr { text-align: center;  color: #333; }
table.adminlist tfoot td,
table.adminlist tfoot th { background-color: #f3f3f3; border-top: 1px solid #999; text-align: center; }

table.adminlist td.order 		{ text-align: center; white-space: nowrap; }
table.adminlist td.order span { float: left; display: block; width: 20px; text-align: center; }

table.adminlist .pagination { display:table; padding:0;  margin:0 auto;	 }
