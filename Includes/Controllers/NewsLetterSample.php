<?php
namespace Itumulak\Includes\Controllers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Itumulak\Includes\Models\NewsLetterSample as NewsLetterSampleModel;
use WP_Error;

class NewsLetterSample {
	private NewsLetterSampleModel $model;

	public function __construct() {
		$this->model = new NewsLetterSampleModel();
	}

	public function handle_subscribe( string $email ): int|WP_Error {
		if ( ! is_email( $email ) ) {
			return new WP_Error(
				'invalid_email',
				'Invalid email ',
				array(
					'status' => 400,
					'email'  => $email,
				)
			);
		}

		$recorded = $this->model->does_record_exists( $email );

		if ( $recorded ) {
			return $this->model->update( $email, true );
		} else {
			return $this->model->add( $email );
		}
	}
}
