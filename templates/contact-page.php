<?php
/**
 * Template Name: Contact Page
 *
 * @package WordPress
 * @subpackage CeliaAubry
 * @since 0.0.0
 */

use Timber\{ Timber };

$data = Timber::context();

Timber::render( 'pages/contact-page.html.twig', $data );
