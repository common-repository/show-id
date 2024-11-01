<?php
/**
* 
*/
namespace WB_SPTI\CommentsAndUsers;
/**
* 
*/
class CommentsAndUsers
{
	
	public function add_id_columns(){
		$assigned_options = array();
		$all_options =  array(
							array(
								'slug' => 'comments',
								'name' => 'Comments'
							),
							array(
								'slug' => 'users',
								'name' => 'Users'
							),
						);
		
		$showing_options = get_option('column_visibility_comment_user_field', true);
		if( !empty($showing_options) ){
			foreach( $all_options as $key ){
				$option = $key['slug'];
				if( is_array($showing_options) && in_array( $option, $showing_options) ){
					if( $option == 'comments' ){
						add_filter("manage_edit-comments_columns", array($this, 'set_custom_id_columns') );
						add_filter("manage_comments_custom_column", array($this, 'comment_custom_id_column'), 10, 2 );
						//add_filter( 'manage_edit-comments_sortable_columns', array($this, 'sortable_id_column') );
					}else if( $option == 'users' ) {
						add_filter("manage_users_columns", array($this, 'set_custom_id_columns') );
						add_filter('manage_users_custom_column', array($this, 'user_custom_id_column'), 10, 3 );
						//add_filter( 'manage_users_sortable_columns', array($this, 'sortable_id_column') );
					}
				}
			}
		}
	}

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

	function user_custom_id_column( $val, $column_name, $id ) {
	    switch ($column_name) {
	        case 'wb_spti_id' :
	            return $id;
	            break;
	    }
	}

	function comment_custom_id_column( $column_name, $id ) {
	    if( $column_name == 'wb_spti_id' ) {
	        echo $id;
	    }
	}

	function sortable_id_column( $columns ) {
	    $columns['wb_spti_id'] = 'ID'; 
	    return $columns;
	}
}

