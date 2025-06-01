<?php
namespace Itumulak\Includes\Interface;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

interface Router {
    public function register_routes(): void;
}