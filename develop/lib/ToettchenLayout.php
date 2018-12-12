<?php
/*
 * Copyright (c) 2012, webvariants GbR, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

class ToettchenLayout extends sly_Layout_XHTML5 {
	protected $article = null;

	public function __construct() {
		//////////////////////////////////////////////////////////////////
		// Zeitzone sollte auch im Frontend gesetzt werden (PHP 5.1+)

		date_default_timezone_set(sly_Core::getTimezone());

		//////////////////////////////////////////////////////////////////
		// Seitentitel setzen
		
		if (sly_Core::getCurrentArticle()->getMeta('meta_title')) {
			$title = sly_Core::getCurrentArticle()->getMeta('meta_title');
		} else {
			$pathString = FrontendHelper::getNavigation()->getBreadcrumbs();
			$title      = $pathString ? $pathString : sly_Core::getCurrentArticle()->getName();
		}

		$this->setTitle($title);

		//////////////////////////////////////////////////////////////////
		// Meta- und HTTP-Meta-Angaben setzen

		$this->addMeta('description', sly_Core::getCurrentArticle()->getMeta('meta_description'));
		$this->addMeta('viewport', 'width=device-width');

		//////////////////////////////////////////////////////////////////
		// CSS

		$this->addCSSFile('assets/css/stil.less');

		//////////////////////////////////////////////////////////////////
		// JavaScript

		$this->addJavaScriptFile('assets/js/jquery.min.js', 'frameworks');
		
		//////////////////////////////////////////////////////////////////
		// Deployer-Integration

		if (class_exists('WV5_Deployment')) {
			// nicht komprimieren, falls im Entwicklermodus
			$compression = sly_Core::isDeveloperMode() ? WV5_Deployer_JavaScript::COMPRESSION_NONE : WV5_Deployer_JavaScript::COMPRESSION_GOOGLE;

			WV5_Deployment::useTimeStamp(true);
			WV5_Deployment::setCSSIndices(array('default', 'IF lt IE 7'));
			WV5_Deployment::setJSIndices(array('frameworks', 'plugins', 'default'));
			WV5_Deployment::setJSCompressionMode($compression);
		}
	}
}
