<?php
/**
 * @sly name  ueberschrift
 * @sly title Überschrift
 */
$format   = $values->get('format');
$headline = $values->get('headline');
if ($format != 'keine') {
	echo '<'.$format.'>'.$headline.'</'.$format.'>';
} else {
	echo '<p>'.$headline.'</p>';
}