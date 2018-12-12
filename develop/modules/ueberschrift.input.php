<?php
/**
 * @sly name  ueberschrift
 * @sly title Überschrift
 */
$items = array("keine" => "keine Formatierung", "h1" => "Überschrift 1", "h2" => "Überschrift 2", "h3" => "Überschrift 3", "h4" => "Überschrift 4", "h5" => "Überschrift 5", "h6" => "Überschrift 6");
$format = new sly_Form_Select_DropDown('format', 'Format', $values->get('format'), $items);
if ($values->get('$format')) {
	$format->setSelected($values->get('$format'));
}
$form->add($format);
$form->addInput('headline', 'Überschrift', $values->get('headline')));