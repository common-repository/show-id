<?php
/**
* 
*/
namespace WB_SPTI\Taxonomy;
require_once('/../traits/all-taxonomies.php');
class ShowOnTaxonomy
{
	use \WB_SPTI\traits\Taxonomy_list;
	/**
	 * add custom column
	 */	
	public function add_id_columns(){
		$assigned_taxonomies = array();
		$all_taxonomies = $this->list_taxonomies();
		
		$showing_taxonomies = get_option('column_visibility_taxonomy_field', true);
		if( !empty($showing_taxonomies) ){
			foreach( $all_taxonomies as $key ){
				$taxonomy = $key['slug'];
				if( is_array($showing_taxonomies) && in_array( $taxonomy, $showing_taxonomies) ){					
					add_filter("manage_edit-{$taxonomy}_columns", array($this, 'set_custom_id_columns') );
					add_filter("manage_{$taxonomy}_custom_column", array($this, 'custom_id_column'), 10, 3 );
				}
			}
		}
	}

	/**
	 * add custom column
	 */	
	public function set_custom_id_columns( $columns ){
		foreach ( $columns as $key => $value) {
			if( array_key_exists( "cb", $columns) ){
				if( $key == 'cb' ){
					$custom_columns[$key] = $value;
					$custom_columns['wb_spti_id'] = __( 'ID', 'show-post-and-term-ids' );
				}else{
					$custom_columns[$key] = $value;
				}
			}else{
				$custom_columns[$key] = $value;
			}
		}
    	return $custom_columns;
	}

	/**
	 * show ID to custom column
	 */	
	public function custom_id_column( $column, $column_name, $term_id ){
		if( 'wb_spti_id' == $column_name ){
			$content = $term_id;
		}
		return $content;
	}
}