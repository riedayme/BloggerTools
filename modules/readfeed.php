<?php defined('BASEPATH') OR exit('no direct script access allowed');
if ($_POST) {
	include "modules/readfeed/process.php";
}else{
	include "modules/readfeed/index.php";
}
?>