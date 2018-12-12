<?php
/**
 * @sly name  startseite
 * @sly slots {main: Hauptbereich}
 */

$layout = FrontendHelper::getLayout();
$layout->openBuffer();
?>
<div id="container">

	<?php sly_Service_Factory::getTemplateService()->includeFile('header'); ?>

	<div id="nav"><?php echo FrontendHelper::getNavigationHTML(); ?></div><?php
	$moodImage = sly_Core::getCurrentArticle()->getMeta('mood');
	$moodTitle = sly_Util_Medium::findByFilename($moodImage)->getTitle();
?>
<div id="main-wrapper">
	<div id="appetitanreger">
		<div id="auszeichnung"><img src="assets/images/100-prozent-muensterland-toettchen.png" alt="100% Münsterland Töttchen" /></div>
		<img src="imageresize/c944w__c240h__<?php echo $moodImage; ?>" alt="<?php echo $moodTitle ? $moodTitle : '' ?>" />
	</div>

	<div class="row"><?php echo $article->getContent('main'); ?></div>
</div>
	<?php sly_Service_Factory::getTemplateService()->includeFile('footer'); ?>

</div>
<?php
$layout->closeBuffer();
print $layout->render();