<?php
// Register menu items

use App\Model\AdminMenu;
use App\Model\Page;

global $page;
$page = new Page();

if ( is_admin() ) {
	add_action( 'admin_menu', function () {
		global $page;
		$menu = new AdminMenu(
			'Карта Google',
			'Карта Google',
			'administrator',
			'google-map',
			[ $page, 'emptyPage' ],
			'',
			'55'
		);

		$menu->addSubmenu('Карта', 'map-map', [ $page, 'map' ])
		->addSubmenu('Вкладки', 'map-tabs', [$page, 'tabs'])
		->removeMainSubmenu();
	} );
}

// End register menu items
