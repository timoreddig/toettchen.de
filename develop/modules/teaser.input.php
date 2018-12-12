<?php
/**
 * @sly name  teaser
 * @sly title Teaser
 */
$form->addMedia('image', 'Bild auswählen', $values->get('image'));
$form->addInput('headline', 'Überschrift', $values->get('headline'));
$editor = new sly_Form_Wymeditor('text', 'Fließtext', $values->get('text'), '<p>Text</p>');
$form->add($editor);
$form->addLink('article', 'Artikel', $values->get('article'));
$form->addInput('linktext', 'Linktext', $values->get('linktext'));