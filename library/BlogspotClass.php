<?php 

/**
 * BlogspotClass
 */
class BlogspotClass
{
	
	public function BlogInfo($url)
	{
		$prepare_targetURL="{$url}feeds/posts/summary?max-results=0";

		$prepare_xml = @simplexml_load_file($prepare_targetURL);	

		if (!$prepare_xml) {
			return [
				'status' => false,
				'response' => "Can't parse xml, are you sure this valid url ?"
			];
		}

		$BlogInfo['Id'] = explode('blog-', (string)$prepare_xml->id)[1];
		$BlogInfo['Title'] = (string)$prepare_xml->title;
		$BlogInfo['Description'] = (!empty($prepare_xml->subtitle)) ? (string)$prepare_xml->subtitle : '-';
		$BlogInfo['Author_picture'] = (string)$prepare_xml->author->children('gd', true)->image->attributes()->src;
		$BlogInfo['Author_name'] = (string)$prepare_xml->author->name;
		$BlogInfo['Author_url'] = (string)$prepare_xml->author->uri;
		$BlogInfo['TotalPost'] = implode('', $prepare_xml->xpath('openSearch:totalResults'));
		$BlogInfo['LastUpdate'] = (string)$prepare_xml->updated;	
		$BlogInfo['categories'] = [];	
		foreach ($prepare_xml->category as $xmlcategory) 
		{
			$BlogInfo['categories'][] = (string)$xmlcategory['term'];
		}
		/* get pages feed */
		$xmlpages = @simplexml_load_file("{$url}feeds/pages/summary?max-results=0");	
		if ($xmlpages) 
		{
			$BlogInfo['TotalPages'] = implode('', $xmlpages->xpath('openSearch:totalResults'));
		}

		return [
			'status' => true,
			'response' => $BlogInfo
		];
	}

	public function GetAllFeedURL($url,$type = 'posts')
	{

		$TotalPost = $this->CountPost($url);
		if ($TotalPost == false) 
		{
			return [
				'status' => false,
				'response' => "this blog no have post"
			];
		}

		/* create feed url for loop */
		if ($TotalPost > 150) 
		{

			$count_post_bagi = ceil($TotalPost / 150);
			$count_post_kali = $count_post_bagi * 150;
			$count_post_sisa = $TotalPost%150;
			$max_index = 150;
			$index_awal = 0;
			for ($i=1; $i < $count_post_bagi ; $i++) 
			{ 
				$index = $index_awal * $max_index + 1;
				$index_awal++;
				$FeedURL[] = "{$url}feeds/{$type}/default?start-index={$index}&max-results=150";
			}
			if ($count_post_sisa != 0) 
			{
				$last_index = $index+$max_index;
				$FeedURL[] ="{$url}feeds/{$type}/default?start-index={$last_index}&max-results={$count_post_sisa}";
			}

		}else {
			$FeedURL[] ="{$url}feeds/{$type}/default?start-index=1&max-results={$TotalPost}";
		}

		return [
			'status' => true,
			'response' => implode(PHP_EOL,$FeedURL)
		];
	}	

	public function ReadFeed($feedurl)
	{

		$FeedExtract = explode(PHP_EOL, $feedurl);

		/* loop RealTargetURL Feed */
		$ExtractData = [];
		foreach($FeedExtract as $FeedURL) 
		{

			$xml = @simplexml_load_file($FeedURL);	
			if (!$xml) {
				continue;
			}
			$dataxml = $xml->entry;

			foreach($dataxml as $post)
			{

				$id = $post->id;

				/* scrape title, date */
				$title = $post->title;
				$date = $post->published;

				/* scrape post url */
				foreach ($post->link as $link) 
				{
					if ($link['rel'] == 'alternate' ) 
					{
						$url = $link['href'];
					}
				}			

				/* unset category array */
				if (isset($category_arr)) 
				{
					unset($category_arr);
				}

				/* scrape category */
				foreach ($post->category as $get_category) 
				{
					if (!empty($get_category['term'])) 
					{
						$category_arr[] = $get_category['term'];
					}
				}

				if (empty($category_arr)) 
				{
					$category = "Unlabelled";
				}else {					
					$category = @implode('___', array_unique($category_arr));    
				}

				/* get article status */
				if (!empty($post->summary)) 
				{
					$content = ['summary' => htmlspecialchars_decode($post->summary)];
				}else {
					$content = ['full' => htmlspecialchars_decode($post->content)];
				}						

				$BuildData = [
					'id' => (string)$id,				
					'url' => (string)$url,
					'title' => (string)$title,
					'date' => (string)$date,
					'category' => $category,
				];

				$ExtractData[] = array_merge($BuildData,$content);

				if (count($ExtractData) >= 20) break;
				
			}
		}


		if (count($ExtractData) > 0) {
			return [
				'status' => true,
				'response' => json_encode($ExtractData,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
			];
		}

		return [
			'status' => false,
			'response' => "No Post Found, Are you sure this valid feed url ?"
		];
	}

	public function Validator($url)
	{

		$status = false;
		$byfeed = "{$url}/feeds/posts/summary?max-results=0";
		$headers = @get_headers($byfeed);
		$response =  substr($headers[0], 9, 3);

		if ($response == 200) 
		{
			$status = true;
		}else {

            # other method...
		}

		if (!$status) {
			return [
				'status' => false,
				'response' => "URL is not blogspot cms"
			];
		}

		return [
			'status' => true,
			'response' => "URL valid this is blogspot cms"
		];
	}	

	protected function CountPost($url,$type = 'posts')
	{

		$prepare_targetURL="{$url}feeds/{$type}/summary?max-results=0";

		$prepare_xml = @simplexml_load_file($prepare_targetURL);	

		if ($prepare_xml) 
		{
			return implode('', $prepare_xml->xpath('openSearch:totalResults'));
		}else {
			return false;
		}

	}	
}