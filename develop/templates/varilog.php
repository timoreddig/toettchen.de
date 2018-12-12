<?php
/**
 * @sly name  varilog
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
			<div class="article">
				<h2><?php echo $article->getName(); ?></h2>
				<?php echo $article->getContent('main'); ?>
			</div>
			<div id="comments-holder">
				<?php
					$comments = WV19_Provider::getCount(false, array(), 'article_'.$article->getId());
					if ($comments > 0) {
						echo '<div class="comments">'.$comments.' Kommentar(e) zu "'.$article->getName().'"</div>';
					}
				?>
				<?php
				// printBlogArticle();
				// handleCommentFormSubmission();
				// printCommentForm();
				
				$guestbook = new WV19_Guestbook('article_'.$article->getId());
				$comments  = $guestbook->getEntries();
				
				print '<div id="comments">';
				
				foreach ($comments as $comment) {
					// auf keinen Fall sly_html() vergessen!
					$name = sly_html($comment->getValue('name'));
					$text = sly_html($comment->getValue('text'));
					$date = date('d.m.Y',strtotime($comment->getPosted()));
				?>
				<div class="comment">
					<div class="title"><strong class="autor"><?php echo $name; ?></strong>
					<span class="date"><?php echo $date; ?></span></div>
					<div class="content"><?php echo $text; ?></div>
				</div>
				<?php
					}
				print '</div>';
				?>
			</div>
			<?php
				if (WV32_Provider::isVarilogArticle()) {
					// der aktuelle, aufgerufene Artikel
					$article = WV32_Article::getInstance();
					
					// Kommentare könnten deaktiviert sein
					if (!empty($_POST) && $article->commentsEnabled()) {
						$guestbook = new WV19_Guestbook('article_'.$article->getId());
						$name      = sly_post('name', 'string');
						$email     = sly_post('email', 'string');
						$text      = sly_post('commenttext', 'string');
					
						try {
							// erstelle den Kommentar, 2. Argument ist die IP des Clients, damit
							// das AddOn vor Flooding schützen kann
							
							$entry = $guestbook->post(array(
								'name'  => $name,
								'email' => $email,
								'text'  => $text
							), $_SERVER['REMOTE_ADDR']);
							
							// hier theoretisch noch den Seiteninhaber per Mail benachrichtigen
							// auf Wunsch kann jetzt entweder direkt der Artikel angezeigt oder
							// auf ihn weitergeleitet werden (um doppelte Form Submissions zu
							// vermeiden).
						}
						catch (Exception $e) {
							print '<p>Der Kommentar konnte nicht erstellt werden: '.sly_html($e->getMessage()).'</p>';
						}
					}
				}
			?>
			<div id="guestbook_form">
				<form class="commentform" action="<?php echo $article->getUrl(); ?>" method="post">
					<div class="commentbox">
						<div class="widget">
							<label for="name">Name: *</label>
							<input type="text" id="name" name="name" placeholder="Name" />
						</div>
						<div class="widget">
							<label for="email">E-Mail-Adresse:</label>
							<input type="text" id="email" name="email" placeholder="E-Mail-Adresse eingeben" />
						</div>
						<div class="widget">
							<label for="website">Website:</label>
							<input type="text" id="website" name="website" placeholder="Website eingeben" />
						</div>
						<div class="widget">
							<label for="commenttext">Kommentar: *</label>
							<textarea name="commenttext" id="commenttext" rows="5" cols="5" placeholder="Ihr Kommentar" ></textarea>
						</div>
					</div>
					<div class="footer">
						<p class="notice">* Pflichtangaben</p>
						<input name="send_comment" id="send_comment" class="submit" type="submit" value="Absenden">
					</div>
				</form>
			</div>
		</div>
		<aside>
			<div id="seitenleiste">
				<?php if ($nav): ?>
					<?php print '<div id="nav2">'.$nav.'</div>'; ?>
				<?php endif; ?>
			<?php sly_Service_Factory::getTemplateService()->includeFile('twitter'); ?>
			</div>
		</aside>
	</div>
	
	<?php sly_Service_Factory::getTemplateService()->includeFile('footer'); ?>

</div>
<?php sly_Service_Factory::getTemplateService()->includeFile('piwik'); ?>
<?php
$layout->closeBuffer();
print $layout->render();