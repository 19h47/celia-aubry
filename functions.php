<?php
/**
 * Célia Aubry functions and definitions
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

// Autoloader.
require_once get_template_directory() . '/vendor/autoload.php';

Timber\Timber::init();
CeliaAubry\Init::run_services();
