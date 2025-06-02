<?php
namespace Itumulak\Includes\Interfaces;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

interface DBTable {
    public function create(): void;
}