<?php
namespace App\Model;

class Page {
	public function emptyPage() {
		return '';
	}

	public function __call($name, $args) {
		$content = view($name);
		if (empty($content)) {
			$content = view("admin.$name");
		}
		echo $content;
	}
}