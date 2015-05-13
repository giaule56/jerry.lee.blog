<?php
/*
 * Template for displaying comments.
 * 
 * @package Profound
 */
?>

<div id="comments" class="comments-section grid-col-12 clearfix">

<?php if (post_password_required() ): ?>
      <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments', 'profound' ) ?></p>
      </div>
<?php return; ?>
<?php endif; ?>


      <?php if ( have_comments() ): ?>

            <div id="comments-title" class="comments-title"><?php
                      printf( _n( 'Comments', '%1$s Comments', get_comments_number(), 'profound' ),
                      number_format_i18n( get_comments_number() ) );
            ?></div>

            <div class="commentslist clearfix">
                <ol>
                    <?php wp_list_comments( array( 'callback' => 'profound_comment_callback' ) ); ?>
                </ol>
            </div>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                  <div class="comment-navigation">
                       <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments <span class="meta-nav">&rarr;</span>', 'profound' ) ); ?></div>
                       <div class="nav-next"><?php next_comments_link( __( '<span class="meta-nav">&larr;</span> Newer Comments', 'profound' ) ); ?></div>
                  </div> <!-- .navigation -->
            <?php endif; ?>

      <?php endif; ?>

	  <?php if ( !comments_open() && !is_page() ) : ?>
            <p class="nocomments"><?php _e( 'Sorry, Comments are closed.', 'profound' ); ?></p>
      <?php endif; ?>

      <?php comment_form(); ?>

</div>