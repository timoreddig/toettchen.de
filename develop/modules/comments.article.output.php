<?php
/**
 * @sly name        comments.article
 * @sly title       Artikel Kommentar
 * @sly description Dieses Modul wird für Die Kommetar funktion genutzt und
 *                  sollte in keinem Artikeltypen verwendet werden.
 * @sly requires    ['webvariants/comments']
 * @sly class       comments
 * @sly fields      ['comment_name', 'comment_email', 'comment_text']
 */

$name     = $values->get('comment_name');
$email    = $values->get('comment_email');
$gravatar = \wv\comments\Helper::getGravatarImg($email, 40);
//should already be clean in database but security is not provided by lazy people
$text     = \wv\comments\Helper::cleanHTML($values->get('comment_text'));
$text     = nl2br($text);
$name     = sly_html($name);
$email    = sly_html($email);


if (sly_Core::isBackend()) {
?>
	<article id="comment-<?php echo $slice->getId() ?>">
		<header class="comment-author">
			<span style="float: left; margin-right: 30px;"><?php echo $gravatar ?></span>
			<span style="float:left; padding-top:4px;">
				<strong><?php echo $name ?></strong>
				&nbsp;
				(<a href="mailto:<?php echo $email ?>"><?php echo $email ?></a>)
				<br />
				<?php echo sly_Util_String::formatDateTime($slice->getCreateDate()) ?>
			</span>
			<div style="clear: both;"></div>
		</header>
		<section class="comment" style="margin-top: 5px;">
			<p class="text"><?php echo $text ?></p>
		</section>
	</article>
<?php
} else {
?>
	<article id="comment-<?php echo $slice->getId() ?>">
		<header class="comment-author">
			<?php echo $gravatar ?>
			<span>
				<strong><?php echo sly_html($name) ?></strong>
				<br />
				<?php echo sly_Util_String::formatDateTime($slice->getCreateDate()) ?>
			</span>
		</header>
		<section class="comment">
			<p class="text"><?php echo $text ?></p>
		</section>
	</article>
<?php
}