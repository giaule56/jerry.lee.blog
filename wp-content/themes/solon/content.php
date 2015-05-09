<?php
/**
 * @package Solon
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ): ?>
		<div class="entry-thumb">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
				<?php the_post_thumbnail( ); ?>
			</a>	
		</div>		
	<?php endif; ?>
	
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<div class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php solon_posted_on(); ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'solon' ) );
				if ( $categories_list && solon_categorized_blog() ) :
			?>
				<span class="cat-links">
					<?php echo '<i class="fa fa-folder"></i>&nbsp;' . $categories_list; ?>
				</span>
			<?php endif; ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'solon' ) );
				if ( $tags_list ) :
			?>
				<span class="tags-links">
					<?php echo '<i class="fa fa-tag"></i>&nbsp;' . $tags_list; ?>
				</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><i class="fa fa-comment"></i>&nbsp;<?php comments_popup_link( __( 'Leave a comment', 'solon' ), __( '1 Comment', 'solon' ), __( '% Comments', 'solon' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'solon' ), '<span class="edit-link"><i class="fa fa-edit"></i>&nbsp;', '</span>' ); ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php if ( (get_theme_mod('solon_full_content') == 1) && is_home() ) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>
		<span class="read-more">
			<span class="read-more-icon"><a href="<?php the_permalink(); ?>"><i class="fa fa-plus"></i></a></span>
		</span>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->