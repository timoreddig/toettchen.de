<?php
/**
 * @sly name         yamlform
 * @sly title        Formular
 * @sly description  Rendert ein in YAML definiertes Formular
 */
if (class_exists('WV30_Form')) {
	$value = $values->get('formular');
	$value = explode('/', $value);
	if (count($value) != 2) $value = null;
	if ($value) {
		$form = WV30_Form::getForm($value[0], false);
		if ($form) {
			if (sly_Core::isBackend()) {
				print sly_html($form->getName()).' ('.$value[1].')';
			}
			else {
				$form->doProcess();
				print $form->render($value[1]);
			}
		}
	}
}
else {
	throw new Exception('Das Addon "form evaluation" ist nicht aktiviert!');
}