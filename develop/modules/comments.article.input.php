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

$form->add(new sly_Form_Input_Text('comment_name', 'Name', $values->get('comment_name')));
$form->add(new sly_Form_Input_Email('comment_email', 'E-Mail', $values->get('comment_email')));
$form->add(new sly_Form_Textarea('comment_text', 'Kommentar', $values->get('comment_text')));