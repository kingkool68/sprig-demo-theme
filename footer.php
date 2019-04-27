<?php
$context = array(
	'year' => date( 'Y' ),
);
Sprig::out( 'footer.twig', $context );
