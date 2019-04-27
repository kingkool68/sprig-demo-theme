<?php
the_post();

$context = array(
	'the_title'   => get_the_title(),
	'the_content' => apply_filters( 'the_content', get_the_content() ),
);

$dates = RH_Helpers::get_date_values( $post->post_date );
if ( empty( $context['machine_date'] ) ) {
	$context['machine_date'] = $dates->machine_date;
}
if ( empty( $context['display_date'] ) ) {
	$context['display_date'] = $dates->display_date;
}

Sprig::out( 'single.twig', $context );
