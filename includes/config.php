<?php 

$webconfig = [
'title' => 'BloggerTools',
'description' => 'extract information and feed from blog who hosted in blogger.com'
];

$appinfo = [
'name' => 'BloggerTools',
'version' => 'v1.0',
'creator' => 'FaanTeyki',
'contact' => 'https://fb.com/faanteyki'
];

// start session
session_start();

// set timezone
date_default_timezone_set('Asia/Jakarta');