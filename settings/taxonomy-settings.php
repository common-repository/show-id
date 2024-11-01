<?php
namespace WB_SPTI\settings\taxonomy;
require_once('/../traits/all-taxonomies.php');
/**
* 
*/
class TaxonomyTypeSettings
{
	use \WB_SPTI\traits\Taxonomy_list;
	public function register_taxonomy_visibility_section(){
		add_settings_section(
			'column_visibility_on_taxonomy',
			esc_html__('Taxonomies ID visibility'),
			array( $this, 'column_visibility_on_taxonomy' ),
			'reading'
		);
		add_settings_field(
			'column_visibility_taxonomy_fields',
			esc_html__('Taxonomiess'),
			array( $this, 'column_visibility_taxonomy_settings_field' ),
			'reading',
			'column_visibility_on_taxonomy'
		);
		register_setting( 'reading', 'column_visibility_taxonomy_field' );
	}

	public function column_visibility_on_taxonomy(){
		echo 'Choose on which taxonomies you want to show the ID column';
	}

	public function column_visibility_taxonomy_settings_field(){
		$showing_taxonomies = get_option('column_visibility_taxonomy_field', true);
		foreach( $this->list_taxonomies() as $key ){
			$slug = $key['slug'];
			echo sprintf(
				'<p><label><input type="checkbox" name="%1$s" value="%2$s" %4$s > %3$s (%2$s)</label></p>',
				"column_visibility_taxonomy_field[$slug]",
				$slug,
				$key['name'],
				isset( $showing_taxonomies[$slug] ) ? checked( $showing_taxonomies[$slug], $slug, false) : ''
			);
		}
	}
}