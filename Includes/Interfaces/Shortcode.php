<?php
namespace Itumulak\Includes\Interfaces;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

interface Shortcode {
    public function render( array $atts ): string|false;
    public function scripts(): void;
}
