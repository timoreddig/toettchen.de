<?php
/**
 * @sly name   footer
 * @sly active false
 */
?>
<footer>
	<nav>
		<ul>
			<li><a href="<?php echo sly_Core::getCurrentArticle()->getUrl(); ?>#">nach oben</a></li>
			<li><a href="<?php echo FrontendHelper::getSetting('contact')->getUrl(); ?>">Kontakt</a></li>
			<li><a href="<?php echo FrontendHelper::getSetting('imprint')->getUrl(); ?>">Impressum</a></li>
		</ul>
	</nav>
	<div id="sozial"></div>
</footer>