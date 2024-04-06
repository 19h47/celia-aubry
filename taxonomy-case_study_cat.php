<?php // phpcs:ignore
/**
 * Taxonomy: Case Study Cat
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage TrueStory
 * @since 0.0.0
 */

use Timber\{ Timber };

$queried_object = get_queried_object();
$templates      = array( 'pages/taxonomy-case-study-cat.html.twig' );
$categories     = Timber::get_terms(
	array(
		'taxonomy'   => 'case_study_cat',
		'hide_empty' => false,
	)
);

$data          = Timber::context();
$data['term']  = Timber::get_term( $queried_object );
$data['posts'] = Timber::get_posts(
	array(
		'post_type' => 'case_study',
		'tax_query' => array( // phpcs:ignore
			array(
				'taxonomy' => 'case_study_cat',
				'terms'    => $queried_object->term_id,
			),
		),
	)
);

$next     = 0;
$previous = 0;

foreach ( $categories as $key => $cat ) :
	if ( $queried_object->term_id === $cat->term_id ) :
		$next     = $key + 1;
		$previous = $key - 1;
		break;
	endif;
endforeach;

$data['next_term']     = Timber::get_term( $categories[ $next === count( $categories ) ? 0 : $next ] );
$data['previous_term'] = Timber::get_term( $categories[ $previous < 0 ? count( $categories ) - 1 : $previous ] );

Timber::render( $templates, $data );
