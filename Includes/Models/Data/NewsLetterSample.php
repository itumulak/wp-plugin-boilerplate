<?php
namespace Itumulak\Includes\Models\Data;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class NewsLetterSample {
    public function __construct(
        private string $email,
        private bool $is_subscribed,
        private string $date_added
    ) {}

    public function get_email(): string {
        return $this->email;
    }

    public function get_is_subscribed(): bool {
        return $this->is_subscribed;
    }

    public function get_date_added(): string {
        return $this->date_added;
    }
}