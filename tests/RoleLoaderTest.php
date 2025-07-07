<?php
use PHPUnit\Framework\TestCase;
use Brain\Monkey;
use Brain\Monkey\Functions;
use Brain\Monkey\Actions;
use Itumulak\Includes\Roles\RoleLoader;

class RoleLoaderTest extends TestCase {
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

	public function testRegistersHooksRoles() {
		$loader = new RoleLoader();

		Actions\expectAdded( 'init', array( $loader, 'register' ) );

		$loader->init();
		$this->assertTrue( true, 'RoleLoader should add the "init" hook for its register method.' );
	}

	public function testRegistersRoles() {
		$loader = new RoleLoader();

		$ref_class = new ReflectionClass( $loader );
		$prop      = $ref_class->getProperty( 'roles' );
		$prop->setAccessible( true );

		$role_classes = $prop->getValue( $loader );

		foreach ( $role_classes as $fqcn ) {
			$instance = new $fqcn();

			$this->assertTrue(
				! empty( $instance->get_role() ),
				"Role name should not declared empty in {$fqcn}."
			);

			$this->assertTrue(
				! empty( $instance->get_display_name() ),
				"Role display name should not declared empty in {$fqcn}."
			);

			Functions\expect( 'add_role' )
				->once()
				->with( $instance->get_role(), $instance->get_display_name(), $instance->get_capabilities() );
		}

		$loader->register();
	}
}
