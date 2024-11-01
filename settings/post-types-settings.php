<?php
namespace WB_SPTI\settings\post;
require_once('/../traits/all-post-types.php');
/**
* 
*/
class PostTypeSettings
{
	use \WB_SPTI\traits\PostTypes;
	public function register_post_visibility_section(){
		add_settings_section(
			'column_visibility_on_posts',
			esc_html__('Post\'s ID visibility'),
			array( $this, 'column_visibility_on_post' ),
			'reading'
		);
		add_settings_field(
			'column_visibility_post_fields',
			esc_html__('Post Type\'s'),
			array( $this, 'column_visibility_post_settings_field' ),
			'reading',
			'column_visibility_on_posts'
		);
		register_setting( 'reading', 'column_visibility_post_field' );
	}

	public function column_visibility_on_post(){
		echo 'Choose on which post type\'s you want to show the ID column';
	}

	public function column_visibility_post_settings_field(){
		$showing_post_types = get_option('column_visibility_post_field', true);
		foreach( $this->list_post_types() as $key ){
			$slug = $key['slug'];
			echo sprintf(
				'<p><label><input type="checkbox" name="%1$s" value="%2$s" %4$s >%3$s (%2$s)</label></p>',
				"column_visibility_post_field[$slug]",
				$slug,
				$key['name'],
				isset( $showing_post_types[$slug] ) ? checked( $showing_post_types[$slug], $slug, false) : ''
			);
		}
	}
}