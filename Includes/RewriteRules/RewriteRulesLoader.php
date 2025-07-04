<?php
namespace Itumulak\Includes\RewriteRules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\Loader;

class RewriteRulesLoader implements Loader {
	public function __construct() {}
	public function init(): void {}
	public function load(): void {}
	public function register(): void {}
}
