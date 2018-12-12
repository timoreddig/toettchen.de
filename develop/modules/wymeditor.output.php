<?php
/**
 * @sly name  wymeditor
 * @sly title Texteditor
 */

$html = $values->get('mytext');

if ($html) {
	$html = FrontendHelper::processWymeditor($html);
	printf('<div class="wymeditor">%s</div>', $html);
}