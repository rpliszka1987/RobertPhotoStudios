<div class="fullpage-item">
<?php
if ( post_password_required() ) { ?>
	<p class="nocomments"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'blacksilver' ); ?></p>
	<?php
	return;
}
?>

<!-- You can start editing here. -->
<?php
if ( have_comments() ) :
	?>
	<div class="commentform-wrap entry-content">
		<h2 id="comments">
			<?php
			$commentinfo_nocomment    = blacksilver_get_option_data( 'commentinfo_nocomment' );
			$commentinfo_onecomment   = blacksilver_get_option_data( 'commentinfo_onecomment' );
			$commentinfo_morecomments = blacksilver_get_option_data( 'commentinfo_morecomments' );

			if ( blacksilver_get_option_data( 'commentlabel_override' ) ) {
				echo comments_number( $commentinfo_nocomment, $commentinfo_onecomment, get_comments_number() . ' ' . $commentinfo_morecomments );
			} else {
				echo comments_number( esc_html__( 'No Comments', 'blacksilver' ), esc_html__( 'One Comment', 'blacksilver' ), esc_html( _n( '% Comment', '% Comments', get_comments_number(), 'blacksilver' ) ) );
			}
			?>
		</h2>

		<div class="comment-nav clearfix">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
		<ol class="commentlist">
		<?php
		wp_list_comments( 'avatar_size=64' );
		?>
		</ol>

		<div class="comment-nav clearfix">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
	</div>
	<?php
	else : // this is displayed if there are no comments so far
		if ( ! comments_open() ) :
			$commentinfo_commentclosed = blacksilver_get_option_data( 'commentinfo_commentclosed' );
			if ( blacksilver_get_option_data( 'commentlabel_override' ) ) {
				?>
				<p class="no-comments"><?php echo esc_html( $commentinfo_commentclosed ); ?></p>
				<?php
			} else {
				?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'blacksilver' ); ?></p>
				<?php
			}
		endif;
	endif;

	if ( comments_open() ) :
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ) ? " aria-required='true'" : '';
		$html_req  = ( $req ) ? " required='required'" : '';
		$html5     = ( 'html5' === current_theme_supports( 'html5', 'comment-form' ) ) ? 'html5' : 'xhtml';
		$req_text  = '';
		if ( $req ) {
			$req_text = ' (required)';
		}
		$commentlabel_button       = blacksilver_get_option_data( 'commentlabel_button' );
		$commentlabel_commentfield = blacksilver_get_option_data( 'commentlabel_commentfield' );
		$commentlabel_leavecomment = blacksilver_get_option_data( 'commentlabel_leavecomment' );
		$commentlabel_namefield    = blacksilver_get_option_data( 'commentlabel_namefield' );
		$commentlabel_emailfield   = blacksilver_get_option_data( 'commentlabel_emailfield' );
		$commentlabel_websitefield = blacksilver_get_option_data( 'commentlabel_websitefield' );

		$fields = array();

		if ( blacksilver_get_option_data( 'commentlabel_override' ) ) {
			$fields['author'] = '<div class="clearfix" id="comment-input"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr( $commentlabel_namefield ) . '" size="30"' . $aria_req . $html_req . ' />';
			$fields['email']  = '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr( $commentlabel_emailfield ) . '" size="30" ' . $aria_req . $html_req . ' />';
			$fields['url']    = '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr( $commentlabel_websitefield ) . '" size="30" /></div>';
		} else {
			$fields['author'] = '<div class="clearfix" id="comment-input"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Name' . $req_text, 'blacksilver' ) . '" size="30"' . $aria_req . $html_req . ' />';
			$fields['email']  = '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Email Address' . $req_text, 'blacksilver' ) . '" size="30" ' . $aria_req . $html_req . ' />';
			$fields['url']    = '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Website', 'blacksilver' ) . '" size="30" /></div>';
		}

		if ( blacksilver_get_option_data( 'commentlabel_override' ) ) {
			$comments_args = array(
				'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
				'comment_field'        => '<div id="comment-textarea"><label class="screen-reader-text" for="comment">' . esc_attr( $commentlabel_commentfield ) . '</label><textarea name="comment" id="comment" cols="45" rows="8" required="required" tabindex="0" class="textarea-comment" placeholder="' . esc_attr( $commentlabel_commentfield ) . '"></textarea></div>',
				'title_reply'          => esc_attr( $commentlabel_leavecomment ),
				'title_reply_to'       => esc_attr( $commentlabel_leavecomment ),
				/* translators: Opening and closing link tags. */
				'must_log_in'          => '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a message.', 'blacksilver' ), '<a href="' . wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) . '">', '</a>' ) . '</p>',
				/* translators: %1$s: The username. %2$s and %3$s: Opening and closing link tags. */
				'logged_in_as'         => '<p class="logged-in-as">' . sprintf( esc_html__( 'Logged in as %1$s. %2$sLog out &raquo;%3$s', 'blacksilver' ), '<a href="' . admin_url( 'profile.php' ) . '">' . $user_identity . '</a>', '<a href="' . wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) . '" title="' . esc_attr__( 'Log out of this account', 'blacksilver' ) . '">', '</a>' ) . '</p>',
				'comment_notes_before' => '',
				'id_submit'            => 'submit',
				'label_submit'         => esc_attr( $commentlabel_button ),
			);
		} else {
			if ( is_singular( 'proofing' ) ) {
				$comments_args = array(
					'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
					'comment_field'        => '<div id="comment-textarea"><label class="screen-reader-text" for="comment">' . esc_attr__( 'Message', 'blacksilver' ) . '</label><textarea name="comment" id="comment" cols="45" rows="8" required="required" tabindex="0" class="textarea-comment" placeholder="' . esc_attr__( 'Message...', 'blacksilver' ) . '"></textarea></div>',
					'title_reply'          => esc_html__( 'Leave a message', 'blacksilver' ),
					'title_reply_to'       => esc_html__( 'Leave a message', 'blacksilver' ),
					/* translators: Opening and closing link tags. */
					'must_log_in'          => '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a message.', 'blacksilver' ), '<a href="' . wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) . '">', '</a>' ) . '</p>',
					/* translators: %1$s: The username. %2$s and %3$s: Opening and closing link tags. */
					'logged_in_as'         => '<p class="logged-in-as">' . sprintf( esc_html__( 'Logged in as %1$s. %2$sLog out &raquo;%3$s', 'blacksilver' ), '<a href="' . admin_url( 'profile.php' ) . '">' . $user_identity . '</a>', '<a href="' . wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) . '" title="' . esc_attr__( 'Log out of this account', 'blacksilver' ) . '">', '</a>' ) . '</p>',
					'comment_notes_before' => '',
					'id_submit'            => 'submit',
					'label_submit'         => esc_attr__( 'Post Message', 'blacksilver' ),
				);
			} else {
				$comments_args = array(
					'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
					'comment_field'        => '<div id="comment-textarea"><label class="screen-reader-text" for="comment">' . esc_attr__( 'Comment', 'blacksilver' ) . '</label><textarea name="comment" id="comment" cols="45" rows="8" required="required" tabindex="0" class="textarea-comment" placeholder="' . esc_attr__( 'Comment...', 'blacksilver' ) . '"></textarea></div>',
					'title_reply'          => esc_html__( 'Leave a comment', 'blacksilver' ),
					'title_reply_to'       => esc_html__( 'Leave a comment', 'blacksilver' ),
					/* translators: Opening and closing link tags. */
					'must_log_in'          => '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a message.', 'blacksilver' ), '<a href="' . wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) . '">', '</a>' ) . '</p>',
					/* translators: %1$s: The username. %2$s and %3$s: Opening and closing link tags. */
					'logged_in_as'         => '<p class="logged-in-as">' . sprintf( esc_html__( 'Logged in as %1$s. %2$sLog out &raquo;%3$s', 'blacksilver' ), '<a href="' . admin_url( 'profile.php' ) . '">' . $user_identity . '</a>', '<a href="' . wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) . '" title="' . esc_attr__( 'Log out of this account', 'blacksilver' ) . '">', '</a>' ) . '</p>',
					'comment_notes_before' => '',
					'id_submit'            => 'submit',
					'label_submit'         => esc_attr__( 'Post Comment', 'blacksilver' ),
				);
			}
		}
		?>
	<div class="comments-section-wrap">
		<?php comment_form( $comments_args ); ?>
	</div>
<?php endif; ?>
</div>
