<?php
/**
 * Output Dashboard.
 * 
 * @package itumulak/wp-boilerplate
 */

use TMT\HMG\Includes\Shortcodes\Dashboard;

wp_enqueue_style('tailwindcss');
wp_enqueue_style( Dashboard::SCRIPT_HANDLE );
wp_enqueue_script( Dashboard::SCRIPT_HANDLE );
?>
<div id="hmg-dashboard"></div>