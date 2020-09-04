<?php
//Enable scripts


if (is_admin()) {
	add_action('admin_footer', 'enqueue_scripts');
	add_action('admin_footer', 'enqueue_visual_editor');
	add_action('in_admin_header', 'enqueue_styles');
} else {
    add_action( 'wp_enqueue_scripts', 'enqueue_map_script' );
	add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
	add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
}

function enqueue_scripts() {
    //Enable scripts
	wp_enqueue_script( 'vue', 'https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js', [], '2.5.17', true );
	wp_enqueue_script( 'axios', 'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js', [], false, true );
	wp_enqueue_script( 'map-main',  '/wp-content/plugins/map/assets/js/map-main.js', ['vue', 'axios'], '1.0', true );
}

function enqueue_styles() {
    //Enable styles
    wp_enqueue_style('my-bootstrap', '/wp-content/plugins/map/assets/css/bootstrap.min.css');
    wp_enqueue_style('my-map', '/wp-content/plugins/map/assets/css/my-map.css');
}

function enqueue_map_script() {
    $key = json_decode(file_get_contents(app_path(MAP_INFO_FILE)), true)['key'] ?? '';
    wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key='.$key, [], false, true );
}

function enqueue_visual_editor() {
    wp_enqueue_script( 'tiny-mce', '/wp-content/plugins/map/assets/js/tinymce.min.js', [], false, false );
    wp_enqueue_script( 'tiny-mce-init', '/wp-content/plugins/map/assets/js/tinymce.init.js', ['tiny-mce'], false, false );
}


