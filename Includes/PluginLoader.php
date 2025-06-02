<?php
namespace Itumulak\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

use Itumulak\Includes\Shortcodes\ShortcodeLoader;
use Itumulak\Includes\Routes\RouterLoader;
use Itumulak\Includes\RewriteRules\RewriteRulesLoader;

class PluginLoader {
	public function __construct() {
        $this->initialize_components();
        $this->initialize_components();
    }

    public function load_dependencies() {}

	private function initialize_components() {
        ( new ShortcodeLoader() )->init();
        ( new RouterLoader() )->init();
        ( new RewriteRulesLoader() )->init();
    }
}