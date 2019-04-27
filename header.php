<?php
$context = array(
	'site_url'   => get_site_url(),
	'site_title' => get_bloginfo( 'name' ),
);
Sprig::out( 'header.twig', $context );
