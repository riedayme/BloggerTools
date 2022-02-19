<?php 

function base_url($uri = false)
{

	$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	$base_url .= "://" . $_SERVER['HTTP_HOST'];
	$full_path = $base_url . explode('?', $_SERVER['REQUEST_URI'], 2)[0];
	$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

	if ($uri)
	{
		$base_url = $full_path.$uri;
	}

	return $base_url;
}