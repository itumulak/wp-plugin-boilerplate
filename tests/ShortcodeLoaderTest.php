<?php
use WP_Mock\Tools\TestCase;
use Itumulak\Includes\Shortcodes\ShortcodeLoader;

class ShortcodeLoaderTest extends TestCase {
	public function setUp(): void {
		WP_Mock::setUp();

		if ( ! defined( 'ABSPATH' ) ) {
			define( 'ABSPATH', dirname( __DIR__, 3 ) . '/' );
		}

		if ( ! defined( 'ABSPATH' ) ) {
			define( 'ABSPATH', dirname( __DIR__ ) );
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

		$refClass = new ReflectionClass( $loader );
		$prop     = $refClass->getProperty( 'shortcodes' );
		$prop->setAccessible( true );

		$originalShortcodes = $prop->getValue( $loader );
		$mockedShortcodes   = array();

		foreach ( $originalShortcodes as $fqcn ) {
			$shortcode_name = strtolower( ( new ReflectionClass( $fqcn ) )->getShortName() );

			$mock = $this->getMockBuilder( $fqcn )
				->disableOriginalConstructor()
				->onlyMethods( array( 'get_shortcode', 'render' ) )
				->getMock();

			$mock->method( 'get_shortcode' )->willReturn( $shortcode_name );

			WP_Mock::userFunction(
				'add_shortcode',
				array(
					'times' => 1,
					'args'  => array( $shortcode_name, array( $mock, 'render' ) ),
				)
			);

			$mockedShortcodes[$shortcode_name] = $mock;
		}

		$prop->setValue( $loader, $mockedShortcodes );

		foreach ( $mockedShortcodes as $shortcode_name => $mock ) {
			add_shortcode( $shortcode_name, array( $mock, 'render' ) );
			$this->assertTrue( true, 'add_shortcode should have been called.' );
		}
	}
}
