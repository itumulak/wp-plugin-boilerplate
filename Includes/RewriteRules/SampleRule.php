<?php
namespace Itumulak\Includes\RewriteRules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\RewriteRule;

class SampleRule implements RewriteRule {
	private string $slug   = 'sample';
	private string $id_var = 'id';

	public function rewrite_rules(): void {
		add_rewrite_rule(
			sprintf( '^%s/([0-9]+)/?$', $this->slug ),
			sprintf(
				'index.php?pagename=%s&%s=$matches[1]',
				$this->slug,
				$this->id_var
			),
			'top'
		);
	}

	public function query_vars( array $vars ): array {
		return array( $this->id_var );
	}
}
