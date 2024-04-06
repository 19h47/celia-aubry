<?php
/**
 * Template Name: About Page
 *
 * @package WordPress
 * @subpackage CeliaAubry
 * @since 0.0.0
 */

use Timber\{ Timber };

$data = Timber::context();

Timber::render( 'pages/about-page.html.twig', $data );
