<?php defined('BASEPATH') OR exit('no direct script access allowed');
if ($_POST) {
	include "modules/validator/process.php";
}else{
	include "modules/validator/index.php";
}
?>