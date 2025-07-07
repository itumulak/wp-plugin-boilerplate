<?php
use PHPUnit\Framework\TestCase;
use Brain\Monkey;
use Brain\Monkey\Actions;
use Brain\Monkey\Functions;
use Itumulak\Includes\Routes\RouterLoader;

class RouterLoaderTest extends TestCase {
	protected $wpdb_mock;

	public function setUp(): void {
		parent::setUp();
		Monkey\setUp();

		if ( ! defined( 'ABSPATH' ) ) {
			define( 'ABSPATH', dirname( __DIR__, 3 ) . '/' );
		}

		if ( ! defined( 'WPPB_PATH' ) ) {
			define( 'WPPB_PATH', dirname( __DIR__, 2 ) . '/' );
		}

		global $wpdb;
		$wpdb_mock         = Mockery::mock( 'alias:\wpdb' );
		$wpdb_mock->prefix = 'wp_';
		$wpdb_mock->shouldReceive( '__construct' )->byDefault();
		$wpdb_mock->shouldReceive( 'get_var' )->byDefault()->andReturn( false );
		$wpdb = $wpdb_mock;
	}

	public function tearDown(): void {
		Monkey\tearDown();
		parent::tearDown();

		global $wpdb;
		$wpdb = null;
	}

	public function testRegistersHooksRoutes(): void {
		$loader = new RouterLoader();

		Actions\expectAdded( 'init', array( $loader, 'register' ) );

		$loader->init();
		$this->assertTrue( true, 'RouterLoader should add the "init" hook for its register method.' );
	}

	public function testRegistersRoutes(): void {
		$loader = new RouterLoader();

		$ref_class = new ReflectionClass( $loader );
		$prop      = $ref_class->getProperty( 'routes' );
		$prop->setAccessible( true );

		$route_classes = $prop->getValue( $loader );

		foreach ( $route_classes as $fqcn ) {
			$this->assertTrue(
				method_exists( $fqcn, 'register_routes' ),
				"Route class {$fqcn} is missing the register_routes() method."
			);

			$instance = new $fqcn();

			Functions\expect( 'add_action' )
				->once()
				->with( 'rest_api_init', array( $instance, 'register_routes' ) );

			Functions\when( 'register_rest_route' )->alias(
				function ( $namespace, $route, $args ) use ( $fqcn ) { // phpcs:ignore
					$this->assertIsString( $namespace, "{$fqcn} - First param (namespace) must be a string." );
					$this->assertIsString( $route, "{$fqcn} - Second param (route) must be a string." );
					$this->assertIsArray( $args, "{$fqcn} - Third param must be an array." );

					$allowed_methods = array( 'GET', 'POST', 'PUT', 'PATCH', 'DELETE' );

					$this->assertArrayHasKey( 'methods', $args, "{$fqcn} - Missing 'methods' key." );
					$this->assertContains( $args['methods'], $allowed_methods, "{$fqcn} - Invalid method {$args['methods']}." );

					$this->assertArrayHasKey( 'callback', $args, "{$fqcn} - Missing 'callback' key." );
					$this->assertTrue( is_callable( $args['callback'] ), "{$fqcn} - 'callback' must be callable." );

					$this->assertArrayHasKey( 'permission_callback', $args, "{$fqcn} - Missing 'permission_callback' key." );
					$this->assertTrue(
						is_callable( $args['permission_callback'] ) || is_string( $args['permission_callback'] ),
						"{$fqcn} - 'permission_callback' must be a callable or a string."
					);
				}
			);

			$instance->register_routes();
		}

		$loader->register();
		$this->assertTrue( true, 'RouterLoader should register its routes.' );
	}
}
