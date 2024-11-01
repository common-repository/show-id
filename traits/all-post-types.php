<?php
namespace WB_SPTI\traits;
/**
* Trait for List All Post Types
*/
trait PostTypes
{
	
	/**
	 * Get all post types
	 */	
	protected function list_post_types(){
		$args = array(
       				'_builtin' => false
				);
		$all_post_types = array(
						array(
							'name' => 'Posts',
							'slug' => 'post'
						),
						array(
							'name' => 'Pages',
							'slug' => 'page'
						),
						array(
							'name' => 'Media',
							'slug' => 'attachment'
						),
					);
		$get_post_types = get_post_types($args, 'object', 'and');
		foreach ($get_post_types as $key ) {
			$all_post_types[] = array(
								'name' => $key->labels->singular_name,
								'slug' => $key->name
							);
		}
		return $all_post_types;
	}
}