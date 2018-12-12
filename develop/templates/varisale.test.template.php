<?php
/**
 * @sly name  varisale
 * @sly title varisale Testseite
 * @sly slots []
 */

setlocale(LC_ALL, 'german');
sly_Util_Session::start();
Varisale::init();

define('_VARISALE_DEVELOP', SLY_DEVELOPFOLDER.'/varisale/');

// ?action auswerten
include _VARISALE_DEVELOP.'actions.php';

$layout = FrontendHelper::getLayout();
$layout->openBuffer();
?>
<div id="container">

	<?php sly_Service_Factory::getTemplateService()->includeFile('header'); ?>
	
	<div id="nav"><?php echo FrontendHelper::getNavigationHTML(); ?></div>
	<div id="main-wrapper">
		<div id="haupt" role="main">
			<?php echo $article->getContent('main'); ?>	
			<?php include _VARISALE_DEVELOP.'products.phtml'; ?>
		</div>
	</div>
	<?php sly_Service_Factory::getTemplateService()->includeFile('footer'); ?>
</div>
<?php
$layout->closeBuffer();
print $layout->render();