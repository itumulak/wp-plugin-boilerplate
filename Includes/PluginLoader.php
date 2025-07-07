<?php
namespace Itumulak\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

use Itumulak\Includes\Shortcodes\ShortcodeLoader;
use Itumulak\Includes\Routes\RouterLoader;
use Itumulak\Includes\Roles\RoleLoader;
use Itumulak\Includes\RewriteRules\RewriteRulesLoader;
use Itumulak\Includes\Blocks\BlockLoader;

class PluginLoader {
	public function __construct() {
		$this->load_dependencies();
		$this->initialize_components();
	}

	public function load_dependencies() {}

	private function initialize_components() {
		( new ShortcodeLoader() )->init();
		( new RouterLoader() )->init();
		( new RoleLoader() )->init();
		( new RewriteRulesLoader() )->init();
		( new BlockLoader() )->init();
	}
}
