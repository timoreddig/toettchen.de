<?php
/**
 * @sly name  blogoverview
 * @sly title Blogübersicht
 */

$articles = WV32_Provider::getArticles(false, 'updatedate', 'DESC');

// $articles ist keine Liste von sly_Model_Article-Objekten, sondern eine
// Liste von WV32_Article-Objekten. Das sind spezielle Wrapper um die eigentlichen
// Artikel und bieten Zusatzfunktionen zum Abrufen der Tags und dergleichen.

foreach ($articles as $article) {
	$url     = $article->getUrl();
	$date    = $article->getCreateDate('%d. %m. %Y');
	$name    = sly_html($article->getName());
	$content = $article->getArticleModel()->getContent();;
	
	// Hier findet die Integration mit dem Gästebuch statt. Für jeden
	// varilog-Beitrag gibt es potenziell ein Gästebuch namens 'article_X'
	// (X ist die Artikel-ID), das die Kommentare enthält. Wir wollen hier nur
	// die Gesamtanzahl von Kommentaren ermitteln.
	
	// Der Name des Gästebuchs (article_X) muss mit der Konfiguration des
	// Gästebuch-AddOns (develop/guestbook.yml) übereinstimmen!
	$comments = WV19_Provider::getCount(false, array(), 'article_'.$article->getId());
	
	?>
	<div class="post">
		<h2><?php echo $name; ?></h2>
		<?php
		print $content;
		/*if ($comments > 0) {
			echo '<div class="comments"><a href="'.$url.'">'.$comments.' Kommentar(e)</a></div>';
		}*/
		?>
	</div>
	<?php
}