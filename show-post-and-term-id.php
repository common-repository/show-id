<?php
/**
 Plugin Name: Show ID
 Description: Show ID create a new column to all of your posts, pages, Categories, Tags, Taxonomies, media, custom post types, users and comments column list and let you see the id.
 Version: 1.0
 Author URI: https://profiles.wordpress.org/webbuilder03
 License: GPLv2
 License URI: https://www.gnu.org/licenses/gpl-2.0.html
 Text Domain: show-id
 */

namespace WB_SPTI;

require_once('autoload.php');

/**
* Main Class
*/
class ShowID{
	use traits\PostTypes;
	function __construct()
	{
		add_action('wp_loaded', array( new Post\ShowOnPost(), 'add_id_columns') );
		add_action('wp_loaded', array( new Taxonomy\ShowOnTaxonomy(), 'add_id_columns') );
		add_action('wp_loaded', array( new CommentsAndUsers\CommentsAndUsers(), 'add_id_columns') );
		new settings\Settings();
	}

}


new ShowID();

