<?php
$context = array(
	'the_loop'   => RH_Archive_Items::render_items_from_wp_query(),
	'pagination' => RH_Pagination::render_from_wp_query(),
);
Sprig::out( 'index.twig', $context );
