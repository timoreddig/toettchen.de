<?php
/**
 * @sly name         yamlform
 * @sly title        Formular
 * @sly description  Rendert ein in YAML definiertes Formular
 */
if (class_exists('WV30_Form')) {
	$forms    = WV30_Form::getForms();
	$renderer = array();
	foreach ($forms as $formular) {
		foreach ($formular->getRendererKeys() as $key) {
			$renderer[$formular->getID().'/'.$key] = $formular->getName().' ('.$key.')';
		}
	}
	$form_drop = new sly_Form_Select_DropDown('formular', 'Formular auswählen', $values->get('formular'), $renderer);
	$form->add($form_drop);
} else {
	echo '<div class="wvModule">Bitte aktivieren Sie das Addon form evaluation</div>';
}