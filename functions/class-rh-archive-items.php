<?php
/**
 * Handle everything for Archive Items
 */
class RH_Archive_Items {

	/**
	 * Get an instance of this class
	 */
	public static function get_instance() {
		static $instance = null;
		if ( null === $instance ) {
			$instance = new static();
			$instance->setup_actions();
		}
		return $instance;
	}

	/**
	 * Hook into WordPress via actions
	 */
	public function setup_actions() {

	}

	/**
	 * Render an individual archive item
	 *
	 * @param  array  $args Values to pass to the template to render
	 * @return string       HTML of rendered archive item
	 */
	public static function render_item( $args = array() ) {
		$defaults           = array(
			'url'          => '',
			'title'        => '',
			'excerpt'      => '',
			'date'         => '',
			'display_date' => '',
			'machine_date' => '',
		);
		$context            = wp_parse_args( $args, $defaults );
		$context['title']   = apply_filters( 'the_title', $context['title'] );
		$context['excerpt'] = apply_filters( 'the_content', $context['excerpt'] );

		if ( ! empty( $context['date'] ) ) {
			$dates = RH_Helpers::get_date_values( $context['date'] );
			if ( empty( $context['machine_date'] ) ) {
				$context['machine_date'] = $dates->machine_date;
			}
			if ( empty( $context['display_date'] ) ) {
				$context['display_date'] = $dates->display_date;
			}
		}

		return Sprig::render( 'archive-item.twig', $context );
	}

	/**
	 * Render an archive item from post data
	 *
	 * @param  WP_Post|integer $post WP Post object or post ID to get data from
	 * @param  array           $args Values to override what gets rendered
	 * @return string          HTML of rendered archive item
	 */
	public static function render_item_from_post( $post = null, $args = array() ) {
		$post = get_post( $post );
		$args = array(
			'url'     => get_permalink( $post ),
			'title'   => get_the_title( $post ),
			'excerpt' => get_the_excerpt( $post ),
			'date'    => $post->post_date,
		);
		return static::render_item( $args );
	}

	/**
	 * Render archive items from a WP_Query object
	 *
	 * @param  object $the_query A WP_Query object
	 * @return string            HTML of all archive items
	 * @throws Exception         If $the_query isn't a WP_Query object then bail
	 */
	public static function render_items_from_wp_query( $the_query = false ) {
		global $wp_query;
		if ( ! $the_query ) {
			$the_query = $wp_query;
		}
		if ( ! $the_query instanceof WP_Query ) {
			throw new Exception( '$the_query is not a WP_Query object!' );
		}

		$output = [];
		while ( $the_query->have_posts() ) :
			$post     = $the_query->the_post();
			$output[] = static::render_item_from_post( $post );
		endwhile;
		wp_reset_postdata();
		return implode( "\n", $output );
	}
}

RH_Archive_Items::get_instance();
