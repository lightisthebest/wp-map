<?php


namespace App\Model;

use Throwable;

class AdminMenu {
	public $page_title;
	public $menu_title;
	public $capability;
	public $menu_slug;
	public $submenus = [];

	/**
	 * AdminMenu constructor.
	 *
	 * @param $page_title
	 * @param $menu_title
	 * @param $capability
	 * @param $menu_slug
	 * @param string $function
	 * @param string $icon_url
	 * @param string $position
	 */
	public function __construct($page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null) {
		$this->page_title = $page_title;
		$this->menu_title = $menu_title;
		$this->capability = $capability;
		$this->menu_slug = $menu_slug;

		add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	}

	/**
	 * @param null $menu_title
	 * @param null $menu_slug
	 * @param string $function
	 * @param null $page_title
	 * @param null $capability
	 * @param string $position
	 *
	 * @return AdminMenu
	 */
	public function addSubmenu($menu_title = null, $menu_slug = null, $function = '', $page_title = null, $capability = null, $position = null) {
		try {
			if (is_null($menu_title)) $menu_title = $this->menu_title;
			add_submenu_page(
				$this->menu_slug,
				$page_title ?? $menu_title,
				$menu_title,
				$capability ?? $this->capability,
				$menu_slug ?? $this->menu_slug,
				$function,
				$position
			);
			$this->submenus[] = $menu_slug ?? $this->menu_slug;
		} catch ( Throwable $e) {
		}
		return $this;
	}

	/**
	 * @param string $string
	 *
	 * @return $this
	 */
	public function removeSubmenu( string $string ) {
		try {
			if (in_array($string, $this->submenus) || $string === $this->menu_slug) {
				remove_submenu_page($this->menu_slug, $string);
			}
		} catch (Throwable $e) {		}
		return $this;
	}

	/**
	 * @return $this
	 */
	public function removeMainSubmenu() {
		return $this->removeSubmenu($this->menu_slug);
	}
}