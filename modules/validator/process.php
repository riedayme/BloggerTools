<?php 

$url = $_POST['blogurl'];
$url = rtrim($url, '/') . '/';


require "library/BlogspotClass.php";
$blogspot = new BlogspotClass();
$validate =$blogspot->Validator($url);
$response = $validate['response'];
if (!$validate['status']) {
	$html = '
	<div class="alert-box danger-alert">
	<div class="alert">
	<p class="text-medium">
	'.$response.'
	</p>
	</div>
	</div>
	';	
}else{	
	$html = '
	<div class="alert-box success-alert">
	<div class="alert">
	<p class="text-medium">
	'.$response.'
	</p>
	</div>
	</div>
	';
}

die(json_encode([
	'status' => true,
	'response' => $html
]));