<?php // phpcs:ignore
/**
 * Archive: Case Study
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage CeliaAubry
 * @since 0.0.0
 */

use Timber\{ Timber };

$templates = array( 'pages/archive-case-study.html.twig' );
$data      = Timber::context();

Timber::render( $templates, $data );
