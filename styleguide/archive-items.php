<?php

$basic = RH_Archive_Items::render_item(
	array(
		'title'   => 'Basic Archive Item',
		'excerpt' => 'This is an excerpt to provide more context about what this archive items is all about.',
		'date'    => date( 'Y-m-d' ),
		'url'     => 'https://example.com',
	)
);

$no_date = RH_Archive_Items::render_item(
	array(
		'title'   => 'No Date Archive Item',
		'excerpt' => 'This archive item has no date associated with it.',
		'url'     => 'https://example.com',
	)
);

$no_url = RH_Archive_Items::render_item(
	array(
		'title'   => 'No URL Archive Item',
		'excerpt' => 'You can\'t click the headlines to go somewhere else',
		'date'    => date( 'Y-m-d' ),
	)
);

$context = array(
	'items' => array(
		'Basic'   => $basic,
		'No Date' => $no_date,
		'No URL'  => $no_url,
	),
);
Sprig::out( 'styleguide-archive-items.twig', $context );
