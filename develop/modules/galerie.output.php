<?php
/**
 * @sly name  gallery
 * @sly title Bildergalerie
 */
$resize = sly_Util_AddOn::isAvailable('sallycms/image-resize');
$images = $values->getMedia('images');
$be     = sly_Core::isBackend();
$size   = $be ? 162 : 162;
$prefix = $resize ? sprintf('imageresize/c%dw__c%dh__', $size, $size) : 'data/mediapool/';
$rel    = 'gallery_'.uniqid();
if ($be) {
	$prefix = '../'.$prefix;
} else {
	$layout = FrontendHelper::getLayout();
	$layout->addCSSFile('assets/css/jquery.fancybox.css');
	$layout->addJavascriptFile('assets/js/jquery.fancybox.pack.js');
	$registry = sly_Registry_Temp::getInstance();
	if (!$registry->get('galerie', false))
		$layout->addJavascript('
			jQuery(function($) {
				$(\'.galerie a\').fancybox({
					prevEffect: \'none\',
					nextEffect: \'none\'
				});
			});
		');
	$registry->set('galerie', true);
}
?>
<?php if ($images): ?>
	<ul class="galerie">
	<?php
		$i = 0;
		foreach($images as $image):
		$filename  = $image->getFilename();
		$title     = sly_html($image->getTitle());
		$source    = $prefix.$filename;
		++$i;
		?>
		<li<?php echo ($i % 3) ? '' : ' class="letzte"' ?>>
			<?php if ($image->getWidth() >= $image->getHeight()): ?>
			<a href="imageresize/c900w__c600h__<?php print $filename ?>" title="<?php echo $title; ?>" rel="<?php echo $rel; ?>">
			<?php else: ?>
			<a href="imageresize/c450w__c600h__<?php print $filename ?>" title="<?php echo $title; ?>" rel="<?php echo $rel; ?>">
			<?php endif; ?>
		<img src="<?php echo $source; ?>" alt="<?php echo $title; ?>" width="162" height="162" /></a>
		</li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>