<?php

$action     = sly_request('action', 'string', '');
$exception  = null;
$successmsg = null;
$params     = array();

try {
	switch ($action) {
		/************************************************************************\
		* FrontendUser: Login & Logout                                           *
		\************************************************************************/

		// Login
		case 'login':
			$username   = sly_post('username', 'string');
			$password   = sly_post('password', 'string');
			$user       = WV16_Users::login($username, $password);
			$successmsg = 'Ihr Login war erfolgreich.';
			break;

		// Logout
		case 'logout':
			WV16_Users::logout();
			$successmsg = 'Ihr Logout war erfolgreich.';
			break;

		// Profil aktualisieren oder löschen
		case 'updateuser':
			$user  = Varisale::getCurrentUser();
			$setID = sly_post('set_id', 'int', 0);

			// Profil löschen
			if (!empty($_POST['deleteset'])) {
				$user->deleteSet($setID);
				$successmsg = 'Ihr Profil wurde entfernt.';
			}

			// Profil aktualisieren
			else {
				$user->setSetID($setID);

				foreach ($user->getValues() as $value) {
					$name  = $value->getAttribute()->getName();
					$value = sly_post('attribute_'.$name, 'string', '');

					$user->setValue($name, $value);
				}

				$user->update();
				$params['set_id'] = $setID;
				$successmsg       = 'Ihre Angaben wurden geändert.';
			}

			break;

		// Neues Profil anlegen
		case 'createset':
			$user   = Varisale::getCurrentUser();
			$newSet = $user->createSetCopy();

			$user->setSetID($newSet);

			foreach ($user->getValues() as $value) {
				$name  = $value->getAttribute()->getName();
				$value = sly_post('attribute_'.$name, 'string', '');

				$user->setValue($name, $value);
			}

			$user->update();

			$params['set_id'] = $newSet;
			$successmsg       = 'Ihr neues Profil wurde angelegt.';
			break;

		/************************************************************************\
		* Einkauf abschließen                                                    *
		\************************************************************************/

		// Einkauf abschließen
		case 'checkout':
			$cart = Varisale::getCart();
			$cart->checkout();

			$successmsg = 'Ihre Bestellung war erfolgreich. :-)';
			break;

		/************************************************************************\
		* Warenkorb bearbeiten                                                   *
		\************************************************************************/

		// Produkt in den Warenkorb legen
		case 'addtocart':
			$cart    = Varisale::getCart();
			$ident   = array_map('intval', explode(',', sly_get('ident', 'string')));
			$product = Varisale::getProduct($ident[0], Varisale_Model_Product_Live::ROOT_VARIANT, $ident[1]);
			$item    = $cart->add($product);
			$updated = $item->getQuantity() > 1;

			if ($updated) {
				$successmsg = 'Die gewuenschte Menge des Produkts '.$product->getTitle().' wurde um eins erhoeht.';
			}
			else {
				$successmsg = 'Das Produkt '.$product->getTitle().' wurde ihrem Warenkorb hinzugefuegt.';
			}

			$cart->update();

			break;

		// Änderungen an benutzerdef. Werten / Mengenangaben speichern
		case 'updatecart':
			$cart  = Varisale::getCart();
			$items = $cart->getItems();

			foreach ($items as $item) {
				$itemID = $item->getID();

				foreach ($item->getUserValues() as $attrName => $value) {
					$formValue = sly_post('value_'.$itemID.'_'.$attrName, 'string', '');
					$item->setValue($attrName, $formValue);
				}

				$quantity = abs(sly_post('quantity_'.$itemID, 'int', 1));

				$item->setQuantity($quantity);
				$item->update();
			}

			$cart->update();

			$successmsg = 'Die Produkte im Warenkorb wurden aktualisiert.';
			break;

		// Produkt aus dem Warenkorb entfernen
		case 'remove':
			$cart  = Varisale::getCart();
			$ident = sly_get('ident', 'int');

			$cart->remove($ident);
			$cart->update();

			$successmsg = 'Das Produkt wurde aus Ihrem Warenkorb entfernt.';
			break;

		/************************************************************************\
		* Warenkorb: Liefer- & Rechnungs- Methoden- & Anschriften                *
		\************************************************************************/

		// Liefermethode ändern
		case 'delivery':
			$cart   = Varisale::getCart();
			$id     = sly_get('id', 'int');
			$method = $id == 0 ? null : Varisale_Factory::getDeliveryMethod($id);

			$cart->setDeliveryMethod($method);
			$cart->update();

			$successmsg = 'Die Versandmethode wurde '.($method ? 'auf '.$method->getTitle().' gesetzt.' : 'entfernt.');
			break;

		// Bezahlmethode ändern
		case 'billing':
			$cart   = Varisale::getCart();
			$id     = sly_get('id', 'int');
			$method = $id == 0 ? null : Varisale_Factory::getBillingMethod($id);

			$cart->setBillingMethod($method);
			$cart->update();

			$successmsg = 'Die Bezahlmethode wurde '.($method ? 'auf '.$method->getTitle().' gesetzt.' : 'entfernt.');
			break;

		// Lieferanschrift ändern
		case 'deliveryaddress':
			$cart = Varisale::getCart();
			$id   = sly_get('set_id', 'int');

			$cart->setDeliveryAddress($id);
			$cart->update();

			$successmsg = 'Die Lieferanschrift wurde '.($id ? 'geändert.' : 'entfernt.');
			break;

		// Rechnungsanschrift ändern
		case 'billingaddress':
			$cart = Varisale::getCart();
			$id   = sly_get('set_id', 'int');

			$cart->setBillingAddress($id);
			$cart->update();

			$successmsg = 'Die Rechnungsanschrift wurde '.($id ? 'geändert.' : 'entfernt.');
			break;
	}

	if ($successmsg !== null) {
		$article = sly_Core::getCurrentArticleId();
		$params['successmsg'] = $successmsg;

		WV_Sally::clearOutput();
		WV_Sally::redirect($article, $params);
	}
}
catch (Exception $e) {
	$exception = $e;
}
