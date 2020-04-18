<?php
the_post();

$context = array(
	'the_title'   => apply_filters( 'the_title', get_the_title() ),
	'the_content' => apply_filters( 'the_content', $post->post_content ),
);
Sprig::out( 'single.twig', $context );
