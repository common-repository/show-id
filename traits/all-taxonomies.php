<?php
namespace WB_SPTI\traits;
/**
* Trait for List All Taxonomies
*/
trait Taxonomy_list
{
	
	/**
	 * Get all Taxonomies
	 */	
	protected function list_taxonomies(){
		$args = array(
       				'_builtin' => false
				);
		$all_taxonomies = array(
						array(
							'name' => 'Categories',
							'slug' => 'category'
						),
						array(
							'name' => 'Tags',
							'slug' => 'post_tag'
						),
					);
		$get_taxonomies = get_taxonomies($args, 'object', 'and');
		foreach ($get_taxonomies as $key ) {
			$all_taxonomies[] = array(
								'name' => $key->labels->singular_name,
								'slug' => $key->name
							);
		}
		return $all_taxonomies;
	}
}