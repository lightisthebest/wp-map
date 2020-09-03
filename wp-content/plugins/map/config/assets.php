<?php
//Enable scripts


if (is_admin()) {
	add_action('admin_footer', 'enqueue_scripts');
} else {
	add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
}

function enqueue_scripts() {
	wp_enqueue_script( 'vue', 'https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js', [], '2.5.17', true );
	wp_enqueue_script( 'axios', 'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js', [], false, true );
	wp_enqueue_script( 'map-main',  '/wp-content/plugins/map/assets/js/map-main.js', ['vue', 'axios'], '1.0', true );
}


