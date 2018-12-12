<?php

/**
 * Sitemap-Controller
 */
class sly_Controller_Frontend_Sitemap extends sly_Controller_Frontend_Base {

	public function __construct() {
		sly_Core::setCurrentClang(sly_Core::getDefaultClangId()) ;

		$timezone = sly_Core::config()->get('SETUP') ? @date_default_timezone_get() : sly_Core::getTimezone();
		// fix badly configured servers where the get function doesn't even return a guessed default timezone
		if (empty($timezone)) {
			$timezone = sly_Core::getTimezone();
		}
		// set the determined timezone
		date_default_timezone_set($timezone);
		
		sly_Service_Factory::getArticleService();

	}

	public function indexAction() {
		
		$this->setContentType('text/xml', 'UTF-8');
		print '<?xml version="1.0" encoding="UTF-8"?>';
		print '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
 xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
			foreach(self::getLocs() as $loc){
				print '<url>'.$loc.'</url>';
			}
		print '</urlset>';
		
	}
	

	/**
	 * Callback für SLY_FRONTEND_ROUTER
	 *
	 * Fügt dem übergebenen Router die Routen für diesen Controller hinzu.
	 *
	 * @param  array $params    Eventparameter
	 * @return sly_Router_Base  der übergebene Router
	 */
	public static function addRoutes(array $params) {
		$router = $params['subject']; // sly_Router_Base

		$router->addRoute('/sitemap.xml', array(
			'sly_controller' => 'sitemap',
			'action'     => 'index'
		));

		return $router;
	}
	
	private static function getLocs() {
		$locs   = array();
		$filter = new WV_Filter_And(
			new WV_Filter_Article_Online()
		);
		$articles = WV_Sally::filterArticles($filter);
		foreach ($articles as $article) {
			array_push($locs,'<loc>'.sly_Util_HTTP::getAbsoluteUrl($article->getId()).'</loc><lastmod>'.self::lastMod( $article->getUpdatedate() ).'</lastmod><changefreq>'.self::getFrequency( $article->getUpdatedate() ).'</changefreq><priority>0.8</priority>');
		}
		return $locs;
	}
	
	/*private static function getPriority($prio) {
		if ($prio) {
			return key($prio);
		} else {
			if (!class_exists('WV8_Settings')) {
				return '0.5';
			} else {
				return key(WV8_Settings::getValue('project','priority'));
			}
		}
		
	}*/
	
	private static function getFrequency($time){
		$freq = null;
		$diff = time() - $time;
		
		if($diff <= 86400){
			$freq = 'daily';
		}elseif($diff <= 604800){
			$freq = 'weekly';
		}elseif($diff <= 1814400){
			$freq = 'monthly';
		}else{
			$freq = 'yearly';
		}
		return $freq;
	}

	private static function lastMod($time){
		return date('Y-m-d',$time);
	}
	
}