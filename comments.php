<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spider_Prime
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'spiderprime' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'spiderprime' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'spiderprime' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'spiderprime' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<div class="comments-section">
			<h1><?php esc_html_e('comments','spiderprime'); ?></h1>
			 <ul class="comment-list">
				<?php 
					$args = array(
					  'id_form'           => 'commentform',
					  'id_submit'         => 'submit',
					  'class_submit'      => 'submit',
					  'name_submit'       => 'submit',
					  'title_reply'       => esc_html__( 'Leave a Reply','spiderprime'),
					  'title_reply_to'    => esc_html__( 'Leave a Reply to %s','spiderprime'),
					  'cancel_reply_link' => esc_html__( 'Cancel Reply','spiderprime'),
					  'label_submit'      => esc_html__( 'Post Comment','spiderprime'),
					  'format'            => 'xhtml',
					  'avatar_size'       => 64,
					  'style'             => 'li',
				
					  'comment_field' =>  '<p class="comment-form-comment">
					  <label for="comment">' . esc_html__( 'Comment', 'spiderprime' ) .
					    '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
					    '</textarea></p>',
				
					  'must_log_in' => '<p class="must-log-in">' .
					    sprintf(
					      esc_attr__( 'You must be <a href="%s">logged in</a> to post a comment.','spiderprime' ),
					      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
					    ) . '</p>',
				
					  'logged_in_as' => '<p class="logged-in-as">' .
					    sprintf(
					    esc_attr__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','spiderprime' ),
					      admin_url( 'profile.php' ),
					      $user_identity,
					      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
					    ) . '</p>',
				
					  'comment_notes_before' => '<p class="comment-notes">' .
					    esc_html__( 'Your email address will not be published.','spiderprime' ) . ( $req ? : '' ) .
					    '</p>',
				
					  'comment_notes_after' => '<p class="form-allowed-tags">' .
					    sprintf(
					      esc_attr__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s','spiderprime' ),
					      ' <code>' . allowed_tags() . '</code>'
					    ) . '</p>',
					);
					wp_list_comments('type=comment&callback=spiderprime_comment');
				?>
			 </li>
			</ul>			
		</div><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'spiderprime' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'spiderprime' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'spiderprime' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'spiderprime' ); ?></p>
	<?php endif; ?>		
	<?php

		$args = array(
		  	'comment_notes_after' => '',
		  	'title_reply'=>esc_html__( 'Leave a Comment?', 'spiderprime' ),
			'label_submit' =>esc_html__( 'WRITE COMMENT', 'spiderprime' ),				
			'comment_notes_before' => '',
		);
		
		comment_form($args);	
	?>

</div><!-- #comments -->
