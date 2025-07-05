<?php
use WP_Mock\Tools\TestCase;
use Itumulak\Includes\Shortcodes\ShortcodeLoader;

class ShortcodeLoaderTest extends TestCase {
	public function setUp(): void {
		WP_Mock::setUp();

		if ( ! defined( 'ABSPATH' ) ) {
			define( 'ABSPATH', dirname( __DIR__, 3 ) . '/' );
		}

		if ( ! defined( 'WPPB_PATH' ) ) {
			define( 'WPPB_PATH', dirname( __DIR__, 2 ) . '/' ); // Adjust if needed
		}
	}

	public function tearDown(): void {
		WP_Mock::tearDown();
		parent::tearDown();
	}

	public function testRegistersHooksShortcodes(): void {
		$classInstance = new ShortcodeLoader();

		WP_Mock::expectActionAdded( 'init', array( $classInstance, 'register' ) );

		$classInstance->init();

		WP_Mock::assertHooksAdded();
	}

	public function testRegistersShortcodes(): void {
		$loader = new ShortcodeLoader();

		$refClass = new ReflectionClass($loader);
		$prop     = $refClass->getProperty('shortcodes');
		$prop->setAccessible(true);

		$originalShortcodes = $prop->getValue($loader);

		foreach ($originalShortcodes as $fqcn) {
			$class = new $fqcn();

			$this->assertTrue(
				method_exists($class, 'get_shortcode'),
				"Shortcode class {$fqcn} is missing the get_shortcode() method."
			);

			$this->assertTrue(
				method_exists($class, 'scripts'),
				"Shortcode class {$fqcn} is missing the scripts() method."
			);

			$this->assertTrue(
				method_exists($class, 'render'),
				"Shortcode class {$fqcn} is missing the render() method."
			);

			$this->assertNotNull(
				$class->get_shortcode(),
				"Shortcode class {$fqcn} returned null for get_shortcode()."
			);

			WP_Mock::userFunction(
				'add_shortcode',
				array(
					'times' => 1,
					'args'  => array(
						$class->get_shortcode(),
						array( $class, 'render' )
					)
				)
			);
		}

		$loader->register();
		$this->assertTrue(true, 'All shortcodes should have been registered via add_shortcode.');
	}
}
