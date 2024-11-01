<?php
/**
* 
*/
namespace WB_SPTI\Post;
class ShowOnPost
{
	use \WB_SPTI\traits\PostTypes;
	/**
	 * add custom column
	 */	
	public function add_id_columns(){
		$assigned_post_types = array();
		$all_post_types = $this->list_post_types();
		$showing_post_types = get_option('column_visibility_post_field', true);
		if( !empty($showing_post_types) ){
			foreach( $all_post_types as $key ){
				$post_type = $key['slug'];
				if( is_array($showing_post_types) && in_array( $post_type, $showing_post_types) ){
					if( $post_type == 'attachment' ){
						add_filter( 'manage_media_columns', array($this, 'set_custom_id_columns') );
						add_action( 'manage_media_custom_column', array($this, 'custom_id_column'), 10, 2 );
					}else{					
						add_filter("manage_{$post_type}_posts_columns", array($this, 'set_custom_id_columns') );
						add_action("manage_{$post_type}_posts_custom_column", array($this, 'custom_id_column'), 10, 2 );
						add_filter('manage_edit-{$post_type}_sortable_columns', array($this, 'sortable_id_column') );
					}
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
	public function custom_id_column( $column, $post_id ){
		switch ( $column ) {
			case 'wb_spti_id' :
	            echo $post_id; 
	            break;
        }
	}

	public function sortable_id_column( $columns ) {
	    $columns['wb_spti_id'] = 'ID'; 
	    return $columns;
	}
}