<?php
namespace Itumulak\Includes\Interface;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

interface DBTable {
    public function create(): void;
}