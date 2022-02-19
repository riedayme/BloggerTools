<?php 

$url = $_POST['feedurl'];

require "library/BlogspotClass.php";
$blogspot = new BlogspotClass();
$readfeed =$blogspot->ReadFeed($url);
if (!$readfeed['status']) die(json_encode($readfeed));
$response = $readfeed['response'];

$html = '
<div class="input-style-1">
<label class="c-field__label">
Results Feeds
</label>
<textarea onclick="select()" readonly="" name="result" rows="10">'.$response.'</textarea>
</div>
';

die(json_encode([
	'status' => true,
	'response' => $html
]));