<?php

namespace RtclDiviAddons\Helpers;

class Functions {
	public static function get_listing_taxonomy( $parent = 'all', $taxonomy = '' ) {
		$args = [
			'taxonomy'   => rtcl()->category,
			'fields'     => 'id=>name',
			'hide_empty' => true,
		];

		if ( ! empty( $taxonomy ) ) {
			$args['taxonomy'] = sanitize_text_field( $taxonomy );
		}

		if ( 'parent' === $parent ) {
			$args['parent'] = 0;
		}

		$terms = get_terms( $args );

		$category_dropdown = [];

		/*$category_dropdown = [
			'all' => 'All',
		];*/

		foreach ( $terms as $id => $name ) {
			$category_dropdown[ $id ] = $name;
		}

		return $category_dropdown;
	}

	public static function get_image_sizes_select() {

		global $_wp_additional_image_sizes;

		$intermediate_image_sizes = get_intermediate_image_sizes();

		$image_sizes = array();
		foreach ( $intermediate_image_sizes as $size ) {
			if ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
				$image_sizes[ $size ] = array(
					'width'  => $_wp_additional_image_sizes[ $size ]['width'],
					'height' => $_wp_additional_image_sizes[ $size ]['height']
				);
			} else {
				$image_sizes[ $size ] = array(
					'width'  => intval( get_option( "{$size}_size_w" ) ),
					'height' => intval( get_option( "{$size}_size_h" ) )
				);
			}
		}

		$sizes_arr = [];
		foreach ( $image_sizes as $key => $value ) {
			$sizes_arr[ $key ] = ucwords( strtolower( preg_replace( '/[-_]/', ' ', $key ) ) ) . " - {$value['width']} x {$value['height']}";
		}

		$sizes_arr['full'] = __( 'Full Size', 'rtcl-divi-addons' );

		return $sizes_arr;
	}

	public static function get_order_options() {
		$order_by = [
			'title' => esc_html__( 'Title', 'rtcl-divi-addons' ),
			'date'  => esc_html__( 'Date', 'rtcl-divi-addons' ),
			'ID'    => esc_html__( 'ID', 'rtcl-divi-addons' ),
			'price' => esc_html__( 'Price', 'rtcl-divi-addons' ),
			'views' => esc_html__( 'Views', 'rtcl-divi-addons' ),
			'none'  => esc_html__( 'None', 'rtcl-divi-addons' ),
		];

		return apply_filters( 'rtcl_divi_listing_order_by', $order_by );
	}

	public static function divi_get_user_selected_terms( $category_includes ) {
		// available categories.
		$available_cat = self::get_listing_taxonomy( 'parent' );
		// sort be key asc order.
		ksort( $available_cat );
		// filter only selected cat keys
		$includes_keys = array_filter(
			$category_includes,
			function ( $cat ) {
				if ( $cat === 'on' ) {
					return $cat;
				}
			}
		);
		// available terms
		$available_terms = array_keys( $available_cat );
		$selected_terms  = array();

		// push user's selected terms
		foreach ( $includes_keys as $key => $value ) {
			array_push( $selected_terms, $available_terms[ $key ] );
		}

		// return implode(',', $selected_terms);
		return $selected_terms;
	}
}