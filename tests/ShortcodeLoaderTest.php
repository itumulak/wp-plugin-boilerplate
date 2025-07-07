<?php
use PHPUnit\Framework\TestCase;
use Brain\Monkey;
use Brain\Monkey\Functions;
use Brain\Monkey\Actions;
use Itumulak\Includes\Shortcodes\ShortcodeLoader;

class ShortcodeLoaderTest extends TestCase {
	public function setUp(): void {
		parent::setUp();
		Monkey\setUp();

		if ( ! defined( 'ABSPATH' ) ) {
			define( 'ABSPATH', dirname( __DIR__, 3 ) . '/' );
		}

		if ( ! defined( 'WPPB_PATH' ) ) {
			define( 'WPPB_PATH', dirname( __DIR__, 2 ) . '/' );
		}
	}

	public function tearDown(): void {
		Monkey\tearDown();
		parent::tearDown();
	}

	public function testRegistersHooksShortcodes(): void {
		$loader = new ShortcodeLoader();

		Actions\expectAdded( 'init', array( $loader, 'register' ) );

		$loader->init();
		$this->assertTrue( true, 'ShortcodeLoader should add the "init" hook for its register method.' );
	}

	public function testRegistersShortcodes(): void {
		$loader = new ShortcodeLoader();

		$ref_class = new ReflectionClass( $loader );
		$prop      = $ref_class->getProperty( 'shortcodes' );
		$prop->setAccessible( true );

		$shortcode_classes = $prop->getValue( $loader );

		foreach ( $shortcode_classes as $fqcn ) {
			$instance = new $fqcn();

			$this->assertTrue(
				method_exists( $fqcn, 'get_shortcode' ),
				"Shortcode class {$fqcn} is missing the get_shortcode() method."
			);

			$this->assertTrue(
				method_exists( $fqcn, 'scripts' ),
				"Shortcode class {$fqcn} is missing the scripts() method."
			);

			$this->assertTrue(
				method_exists( $fqcn, 'render' ),
				"Shortcode class {$fqcn} is missing the render() method."
			);

			$this->assertNotNull(
				$instance->get_shortcode(),
				"Shortcode class {$fqcn} returned null for get_shortcode()."
			);

			Functions\expect( 'add_shortcode' )
				->once()
				->with( $instance->get_shortcode(), array( $instance, 'render' ) );
		}

		$loader->register();
	}
}
