<?php
namespace App\Model;

class Page {
	public function emptyPage() {
		return '';
	}

	public function __call($name, $args) {
		$content = view($name);
		if (empty($content)) {
			return view("admin.$name");
		}
		return $content;
	}
}