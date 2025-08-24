<?php
use PHPUnit\Framework\TestCase;
use Brain\Monkey;
use Brain\Monkey\Functions;
use Itumulak\Includes\RewriteRules\RewriteRulesLoader;

class RewriteLoaderTest extends TestCase {
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
		parent::tearDown();
		Monkey\tearDown();
	}

	public function testRegistersRewriteRules() {
		$loader = new RewriteRulesLoader();

		$ref_class = new ReflectionClass( $loader );
		$prop      = $ref_class->getProperty( 'rules' );
		$prop->setAccessible( true );

		$rules = $prop->getValue( $loader );

		$loader->register();

		foreach ( $rules as $fqcn ) {
			$instance = new $fqcn();

			self::assertNotFalse(
				has_action( 'init', array( $instance, 'rewrite_rules' ) ),
				"Rewrite rule class {$fqcn} is missing the rewrite_rules() method."
			);

			Functions\expect( 'add_rewrite_rule' )
				->once()
				->with( Mockery::type( 'string' ), Mockery::type( 'string' ), Mockery::type( 'string' ) );

			$instance->rewrite_rules();

			self::assertNotFalse(
				has_filter( 'query_vars', array( $instance, 'query_vars' ) ),
				"Rewrite rule class {$fqcn} is missing the query_vars() method."
			);
		}
	}
}
