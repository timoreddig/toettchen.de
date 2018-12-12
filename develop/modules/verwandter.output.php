<?php
/**
 * @sly name  verwandter
 * @sly title Verwandter
 */
$image  = $values->getMedium('image');
$resize = sly_Util_AddOn::isAvailable('sallycms/image-resize');
$name   = $values->get('name');
$text   = $values->get('text');
$prefix = sly_Core::isBackend() ? '../' : '';
if (!sly_Core::isBackend()) {
	$layout = FrontendHelper::getLayout();
	$layout->addCSSFile('assets/css/jquery.fancybox.css');
	$layout->addJavascriptFile('assets/js/jquery.fancybox.pack.js');
	$registry = sly_Registry_Temp::getInstance();
	if (!$registry->get('fancybox', false))
		$layout->addJavascript('
			jQuery(function($) {
				$(\'.fancybox\').fancybox({
					openEffect  : \'none\',
					closeEffect : \'none\'
				});
			});
		');
	$registry->set('fancybox', true);
}
?>
<div class="verwandter clearfix">
	<?php if ($image): ?>
		<?php if ($resize): ?>
			<a href="imageresize/c900w__c600h__<?php echo $image->getFilename() ?>" class="fancybox"><img src="<?php echo $prefix; ?>imageresize/c204w__c140h__<?php echo $image->getFilename() ?>" alt="<?php echo sly_html($image->getTitle()) ?>" /></a>
		<?php else: ?>
			<a href="data/mediapool/<?php echo $image->getFilename() ?>" class="fancybox"><img src="<?php echo $prefix; ?>data/mediapool/<?php echo $image->getFilename() ?>" alt="<?php echo sly_html($image->getTitle()) ?>" /></a>
		<?php endif ?>
	<?php endif; ?>
	<h2><?php echo $name; ?></h2>
	<?php echo $text; ?>
</div>