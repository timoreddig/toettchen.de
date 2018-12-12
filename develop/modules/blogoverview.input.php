<?php
/**
 * @sly name  blogoverview
 * @sly title Blogübersicht
 */

$articles = WV32_Provider::getArticles(
	true,            // nur Beiträge, die online sind
	'updatedate',    // sortiert nach Aktualisierungsdatum
	'DESC'           // absteigend sortiert
);

print '<p style="padding:5px">Dieses Modul listet alle Blogeinträge auf.</p>';
print '<ul>';

foreach ($articles as $article) {
	$url  = $article->getUrl();
	$name = sly_html($article->getName());
	print '<li><a href="../'.$url.'">'.$name.'</a></li>';
}

print '</ul>';