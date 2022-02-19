<?php 

$url = $_POST['blogurl'];
$url = rtrim($url, '/') . '/';


require "library/BlogspotClass.php";
$blogspot = new BlogspotClass();
$allfeedurl =$blogspot->GetAllFeedURL($url);
if (!$allfeedurl['status']) die(json_encode($allfeedurl));
$response = $allfeedurl['response'];

$html = '
<div class="input-style-1">
<label class="c-field__label">
Results Feed URLs
</label>
<textarea onclick="select()" readonly="" name="result" rows="10">'.$response.'</textarea>
</div>
';

die(json_encode([
	'status' => true,
	'response' => $html
]));