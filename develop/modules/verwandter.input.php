<?php
/**
 * @sly name  verwandter
 * @sly title Verwandter
 */
$form->addMedia('image', 'Bild auswählen', $values->get('image'));
$form->addInput('name', 'Name', $values->get('name'));
$editor = new sly_Form_Wymeditor('text', 'Fließtext', $values->get('text'), '<p>Text</p>');
$form->add($editor);