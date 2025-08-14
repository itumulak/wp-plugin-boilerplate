<?php
namespace Itumulak\Includes\Interfaces;

interface Loader {
	public function init(): void;
	public function register(): void;
	public function load(): void;
}
