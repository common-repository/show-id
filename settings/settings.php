<?php
namespace WB_SPTI\settings;

require_once('/../traits/all-post-types.php');

class Settings{
	
	public function __construct()
	{
		add_action('admin_init', array(new post\PostTypeSettings(), 'register_post_visibility_section') );
		add_action('admin_init', array(new taxonomy\TaxonomyTypeSettings(), 'register_taxonomy_visibility_section') );
		add_action('admin_init', array(new CommentsAndUsers\CommentsAndUserSettings(), 'register_comments_and_user_section') );
	}

}