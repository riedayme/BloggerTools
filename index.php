<?php define('BASEPATH', true); // protect script from direct access

require "includes/helper.php";
require "includes/config.php";

switch (@$_GET['module']) {	

	case 'checker':
	include "modules/checker.php";
	break;

	case 'allfeedurl':
	include "modules/allfeedurl.php";
	break;	
	
	case 'readfeed':
	include "modules/readfeed.php";
	break;	

	case 'validator':
	include "modules/validator.php";
	break;	

	case 'sitemapextractor':
	include "modules/sitemapextractor.php";
	break;	


	default:
	include "modules/dashboard.php";
	break;
}
?>