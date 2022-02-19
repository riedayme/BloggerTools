<?php defined('BASEPATH') OR exit('no direct script access allowed');
if ($_POST) {
	include "modules/checker/process.php";
}else{
	include "modules/checker/index.php";
}
?>