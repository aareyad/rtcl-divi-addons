<?php

namespace RtclDiviAddons\Modules\ListingCategories;

use Rtcl\Helpers\Functions;

class ListingCategories extends Settings {

	/**
	 * Widget result.
	 *
	 * @param [array] $data array of query.
	 *
	 * @return array
	 */
	public function widget_results( $data ) {

		$args = array(
			'taxonomy'     => rtcl()->category,
			'parent'       => 0,
			'orderby'      => ! empty( $data['rtcl_orderby'] ) ? $data['rtcl_orderby'] : 'name',
			'order'        => ! empty( $data['rtcl_order'] ) ? $data['rtcl_order'] : 'asc',
			'hide_empty'   => ! empty( $data['rtcl_hide_empty'] ) && 'on' === $data['rtcl_hide_empty'],
			'include'      => ! empty( $data['rtcl_cats'] ) ? $data['rtcl_cats'] : array(),
			'hierarchical' => false,
		);
		if ( 'custom' === $data['rtcl_orderby'] ) {
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = '_rtcl_order'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
		}
		$terms = get_terms( $args );
		if ( ! empty( $data['rtcl_category_limit'] ) ) {
			$number = $data['rtcl_category_limit'];
			$terms  = array_slice( $terms, 0, $number );
		}

		return $terms;
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
		$settings = $this->props;
		$terms    = $this->widget_results( $settings );

		$this->render_css( $render_slug );

		$style = isset( $settings['rtcl_cats_style'] ) ? sanitize_text_field( $settings['rtcl_cats_style'] ) : 'style-1';

		$template_style = 'listing-cats/' . $style;

		$data = [
			'template'      => $template_style,
			'style'         => $style,
			'settings'      => $settings,
			'terms'         => $terms,
			'template_path' => rtcl_divi_addons()->get_plugin_template_path(),
		];

		$data = apply_filters( 'rtcl_divi_filter_listing_categories_data', $data );

		return Functions::get_template_html( $data['template'], $data, '', $data['template_path'] );
	}

	protected function render_css( $render_slug ) {
		$wrapper              = '.et-db .et-l %%order_class%% .rtcl-listings-wrapper';
		$title_color          = $this->props['rtcl_title_color'];
		$title_hover_color    = $this->get_hover_value( 'rtcl_title_color' );
		$title_font_weight    = explode( '|', $this->props['title_font'] )[1];
		$meta_color           = $this->props['rtcl_meta_color'];
		$meta_icon_color      = $this->props['rtcl_meta_icon_color'];
		$category_color       = $this->props['rtcl_meta_category_color'];
		$category_hover_color = $this->get_hover_value( 'rtcl_meta_category_color' );
		$price_color          = $this->props['rtcl_price_color'];

		// Title
		if ( ! empty( $title_color ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				[
					'selector'    => '.et-db .et-l %%order_class%% .rtcl-listings-wrapper .rtcl-listing-title a',
					'declaration' => sprintf( 'color: %1$s;', $title_color ),
				]
			);
		}
		if ( ! empty( $title_hover_color ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				[
					'selector'    => '.et-db .et-l %%order_class%% .rtcl-listings-wrapper .rtcl-listing-title a:hover',
					'declaration' => sprintf( 'color: %1$s;', $title_hover_color ),
				]
			);
		}
		if ( ! empty( $title_font_weight ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '.et-db .et-l %%order_class%% .rtcl-listings-wrapper .rtcl-listing-title',
					'declaration' => sprintf( 'font-weight: %1$s;', $title_font_weight ),
				)
			);
		}
		// Meta
		if ( ! empty( $meta_color ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				[
					'selector'    => '.et-db .et-l %%order_class%% .rtcl-listings-wrapper .rtcl-listing-meta-data',
					'declaration' => sprintf( 'color: %1$s;', $meta_color ),
				]
			);
		}
		if ( ! empty( $meta_icon_color ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				[
					'selector'    => '.et-db .et-l %%order_class%% .rtcl-listings-wrapper .rtcl-listing-meta-data i',
					'declaration' => sprintf( 'color: %1$s;', $meta_icon_color ),
				]
			);
		}
		if ( ! empty( $category_color ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				[
					'selector'    => '.et-db .et-l %%order_class%% .rtcl-listings-wrapper .listing-cat',
					'declaration' => sprintf( 'color: %1$s;', $category_color ),
				]
			);
		}
		if ( ! empty( $category_hover_color ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				[
					'selector'    => '.et-db .et-l %%order_class%% .rtcl-listings-wrapper .listing-cat a:hover',
					'declaration' => sprintf( 'color: %1$s;', $category_hover_color ),
				]
			);
		}
		// Price
		if ( ! empty( $price_color ) ) {
			\ET_Builder_Element::set_style(
				$render_slug,
				[
					'selector'    => '.et-db .et-l %%order_class%% .rtcl-listings-wrapper .item-price .rtcl-price',
					'declaration' => sprintf( 'color: %1$s;', $price_color ),
				]
			);
		}
	}

	public static function get_content( $args = [] ) {
		$term_args = [
			'taxonomy'     => rtcl()->category,
			'parent'       => 0,
			'orderby'      => ! empty( $args['rtcl_orderby'] ) ? $args['rtcl_orderby'] : 'name',
			'order'        => ! empty( $args['rtcl_order'] ) ? $args['rtcl_order'] : 'asc',
			'hide_empty'   => ! empty( $args['rtcl_hide_empty'] ) && 'on' === $args['rtcl_hide_empty'],
			'include'      => ! empty( $args['rtcl_cats'] ) ? $args['rtcl_cats'] : [],
			'hierarchical' => false,
		];

		if ( 'custom' === $args['rtcl_orderby'] ) {
			$term_args['orderby']  = 'meta_value_num';
			$term_args['meta_key'] = '_rtcl_order'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
		}

		$terms = get_terms( $term_args );

		if ( ! empty( $args['rtcl_category_limit'] ) ) {
			$number = $args['rtcl_category_limit'];
			$terms  = array_slice( $terms, 0, $number );
		}

		return $terms;
	}
}