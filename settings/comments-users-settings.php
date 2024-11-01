<?php
/**
* 
*/
namespace WB_SPTI\settings\CommentsAndUsers;
class CommentsAndUserSettings
{
	
	public function register_comments_and_user_section(){
		add_settings_section(
			'column_visibility_on_comments_users',
			esc_html__('Other\'s visibility'),
			array( $this, 'column_visibility_on_comment_user' ),
			'reading'
		);
		add_settings_field(
			'column_visibility_comment_user_fields',
			esc_html__('Other\'s'),
			array( $this, 'column_visibility_comment_user_settings_field' ),
			'reading',
			'column_visibility_on_comments_users'
		);
		register_setting( 'reading', 'column_visibility_comment_user_field' );
	}

	public function column_visibility_on_comment_user(){  }

	public function column_visibility_comment_user_settings_field(){
		$showing_comments_users = get_option('column_visibility_comment_user_field', true);
?>
		<p>
			<label>
				<input type="checkbox" name="column_visibility_comment_user_field[comments]" value="comments" <?php echo isset($showing_comments_users['comments']) ? checked( $showing_comments_users['comments'] , 'comments', false ) : '' ?> >
				Comments
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" name="column_visibility_comment_user_field[users]" value="users" <?php echo isset($showing_comments_users['users']) ? checked( $showing_comments_users['users'] , 'users', false ) : '' ?> >
				Users
			</label>
		</p>
<?php
	}
}