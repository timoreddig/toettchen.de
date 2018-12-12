<?php
/**
 * @sly name  varisale.checkout
 * @sly title varisale
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
			<!--<h1>varisale Testseite</h1>-->
			<!--<p><strong>Session-ID:</strong> <?php // print session_id() ?></p>-->
			<?php include _VARISALE_DEVELOP.'messages.phtml'; ?>
			<?php // include _VARISALE_DEVELOP.'languages.phtml'; ?>
	
			<!--<h2>Benutzerverwaltung</h2>-->
			<?php include _VARISALE_DEVELOP.'usermngr.phtml'; ?>
			<?php // include _VARISALE_DEVELOP.'usermngr-sets.phtml'; ?>
			<?php // include _VARISALE_DEVELOP.'usermngr-profile.phtml'; ?>
	
			<!--<h2>varisale</h2>-->
	
			<h3>Warenkorb</h3>
			<?php include _VARISALE_DEVELOP.'cart.phtml'; ?>
	
			<!--<h3>Produktkatalog</h3>-->
			<?php // include _VARISALE_DEVELOP.'products.phtml'; ?>
		</div>
	</div>
	<?php sly_Service_Factory::getTemplateService()->includeFile('footer'); ?>
</div>
<?php
$layout->closeBuffer();
print $layout->render();