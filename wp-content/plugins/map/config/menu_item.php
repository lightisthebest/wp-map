<?php
// Register menu items

use App\Model\AdminMenu;
use App\Model\Page;

global $mapPage;
$mapPage = new Page();

if ( is_admin() ) {
	add_action( 'admin_menu', function () {
		global $mapPage;
		$menu = new AdminMenu(
			'Карта Google',
			'Карта Google',
			'administrator',
			'google-map',
			[ $mapPage, 'emptyPage' ],
			'',
			'55'
		);

		$menu->addSubmenu('Карта', 'map-map', [ $mapPage, 'map' ])
		->addSubmenu('Вкладки', 'map-tabs', [$mapPage, 'tabs'])
		->removeMainSubmenu();
	} );
}
// End register menu items
