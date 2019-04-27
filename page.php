<?php
$context         = Timber::get_context();
$context['foo']  = 'Bar!';
$context['post'] = Timber::query_post();
var_dump( $context['post'] );
Timber::render( 'twig/page.twig', $context );
