<?php
namespace Itumulak\Includes\Models\Data;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class SampleNotes {
	public function __construct(
		private int $user_id,
		private string $note,
		private string $note_created
	) {}

	public function get_user_id(): int {
		return $this->user_id;
	}

	public function get_note(): string {
		return $this->note;
	}

	public function get_note_created(): string {
		return $this->note_created;
	}
}
