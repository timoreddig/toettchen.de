<?php
/**
 * @sly name  teaser
 * @sly title Teaser
 */
$image    = $values->get('image');
$headline = $values->get('headlline');
$text     = $values->get('text');
$article  = $values->get('article');
$linktext = $values->get('linktext');
?>
<div class="spalte">
	<?php if ($image): ?>
	<div class="bild">
		<?php echo $article ? '<a href="'.sly_Util_Article::findById($article)->getURL().'">' : '' ?>
		<img src="<?php echo sly_Core::isBackend() ? '../' : '' ?>imageresize/c<?php echo $imagewidth ?>w__c<?php echo $imageheight ?>h__<?php echo $image; ?>" width="<?= $imagewidth ?>" height="<?= $imageheight ?>" alt="<?php echo sly_Util_Medium::findByFilename($image)->getTitle() ?>" />
		<?php echo $article ? '</a>' : '' ?>
	</div>
	<?php endif; ?>
	<div class="inhalt">
		<?php echo $headline ? '<h1>' : '' ?><?php echo $article ? '<a href="'.sly_Util_Article::findById($article)->getURL().'">' : '' ?><?php echo $headline ? $headline : '' ?><?php echo $article ? '</a>' : '' ?><?php echo $headline ? '</h1>' : '' ?>
		<?php echo $text ? $text : '' ?>
		<?php echo $article ? '<p class="link"><a href="'.sly_Util_Article::findById($article)->getURL().'">' : '' ?><?php echo $linktext ? $linktext : '' ?><?php echo $article ? '</a></p>' : '' ?>
	</div>
</div>