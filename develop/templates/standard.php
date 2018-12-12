<?php
/**
 * @sly name  standard
 * @sly slots {main: Hauptbereich}
 */
$layout = FrontendHelper::getLayout();
$layout->openBuffer();
$currentArticle = sly_Core::getCurrentArticle();
$category       = $currentArticle->getCategory();
$parentId       = $currentArticle->getParentId();
if ($parentId != null) {
	$baseCats = sly_Util_Category::findById($parentId)->getChildren($ignoreOfflines = true);
	$nav      = new sly_Util_Navigation(1, false, true, $baseCats);
} elseif ($category) {
	$baseCats = $category->getChildren($ignoreOfflines = true);
	if (!empty($baseCats)) {
		$nav = new sly_Util_Navigation(1, false, true, $baseCats);
	} else {
		$nav = '';
	}
} else {
	$nav     = '';
}
?>
<div id="container">

	<?php sly_Service_Factory::getTemplateService()->includeFile('header'); ?>

	<div id="nav"><?php echo FrontendHelper::getNavigationHTML(); ?></div>
	<div id="main-wrapper">
		<div id="haupt" role="main">
			<?php echo $article->getContent('main'); ?>
		</div>
		<aside>
			<div id="seitenleiste">
				<?php if($nav): ?>
					<?php print '<div id="nav2">'.$nav.'</div>'; ?>
				<?php endif; ?>
			</div>
		</aside>
	</div>
	
	<?php sly_Service_Factory::getTemplateService()->includeFile('footer'); ?>

</div>
<?php
$layout->closeBuffer();
print $layout->render();