<?php 

$url = $_POST['blogurl'];
$url = rtrim($url, '/') . '/';


require "library/BlogspotClass.php";
$blogspot = new BlogspotClass();
$bloginfo =$blogspot->BlogInfo($url);
if (!$bloginfo['status']) die(json_encode($bloginfo));
$response = $bloginfo['response'];

// category
$categoryhtml = [];
foreach ($response['categories'] as $category) {
	$categoryhtml[] = '<a target="_blank" class="badge bg-dark mb-3 mr-5" href="'.$url.'/search/label/'.$category.'">'.$category.'</a>';
}
$Category = (!empty($categoryhtml)) ? implode('', $categoryhtml) : '-';

$html = '
<table class="table table-bordered">
<tbody>
<tr>
<td class="p-2">Id</td>
<td class="p-2">
'.$response['Id'].'
</td>
</tr>
<tr>
<td class="p-2">Title</td>
<td class="p-2">
'.$response['Title'].'
</td>
</tr>
<tr>
<td class="p-2">Description</td>
<td class="p-2">
'.$response['Description'].'
</td>
</tr>
<tr>
<td class="p-2">Last Update</td>
<td class="p-2">
'.$response['LastUpdate'].'
</td>
</tr>
<tr>
<td class="p-2">Author</td>
<td class="p-2">
<div class="lead">
<div class="lead-image">
<img src="'.$response['Author_picture'].'" alt="Profile">
</div>
<div class="lead-text">
<a class="fs-6" target="_blank" href="'.$response['Author_url'].'">'.$response['Author_name'].'</a>
</div>
</div>
</td>
</tr>
<tr>
<td class="p-2">Total Post</td>
<td class="p-2">
'.$response['TotalPost'].'
</td>
</tr>			
<tr>
<td class="min-width">Total Pages</td>
<td class="min-width">
'.$response['TotalPages'].'
</td>
</tr>															
<tr>
<td class="p-2" colspan="2">Category</td>
</tr>
<tr>
<td class="p-2" colspan="2">
'.$Category.'					
</td>
</tr>
</tbody>
</table>
';

die(json_encode([
	'status' => true,
	'response' => $html
]));