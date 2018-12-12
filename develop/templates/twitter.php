<?php
/**
 * @sly name   twitter
 * @sly active false
 */
?>
<div class="twitter">
	<h2><a href="https://www.twitter.com/toettchen">@toettchen</a></h2>
	<div class="twitter">
	<?php
		$container        = sly_Core::getContainer();
        $twitter_timeline = $container['twitter-timeline'];
        $result           = $twitter_timeline->user_timeline('', 'Toettchen', '3');
        function convert_twitter_links($tweet) {
			//converts URLs to active links
			$tweet = preg_replace('/((http)+(s)?:\/\/[^<>\s]+)/i', '<a href="$0" target="_blank">$0</a>', $tweet );
			//converts mentions (e.g. @stathisg) to active links, pointing to the user's twitter profile
			$tweet = preg_replace('/[@]+([A-Za-z0-9-_]+)/', '<a href="http://twitter.com/$1" target="_blank">$1</a>', $tweet );
			//converts hashtags (e.g. #test) to active links, pointing to a twitter's search URL
			$tweet = preg_replace('/[#]+([A-Za-z0-9-_ÜÖÄüöäß]+)/', '<a href="http://twitter.com/search?q=%23$1" target="_blank">$0</a>', $tweet );
			return $tweet;
		}
		foreach ($result as $index => $tweet) {
			echo "<p>".convert_twitter_links($tweet->text)."</p>";
		}
	?>
	</div>
</div>
