<?php defined('BASEPATH') OR exit('no direct script access allowed');
if ($_POST) {
	include "modules/allfeedurl/process.php";
}else{
	include "modules/allfeedurl/index.php";
}
?>