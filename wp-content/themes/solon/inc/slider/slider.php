<?php

	
	function solon_slider_scripts() {
		if ( get_theme_mod('slider_display') ) {
			
			wp_enqueue_style( 'flex-style', get_template_directory_uri() . '/inc/slider/flexslider.css' );
		
			wp_enqueue_script( 'flex-script', get_template_directory_uri() .  '/inc/slider/js/jquery.flexslider-min.js', array( 'jquery' ), true );
			
			wp_enqueue_script( 'slider-init', get_template_directory_uri() .  '/inc/slider/js/slider-init.js', array(), true );
			
			//Slider speed options
			if ( ! get_theme_mod('slideshowspeed') ) {
				$slideshowspeed = 4000;
			} else {
				$slideshowspeed = absint(get_theme_mod('slideshowspeed'));
			}			
			if ( ! get_theme_mod('animationspeed') ) {
				$animationspeed = 400;
			} else {
				$animationspeed = absint(get_theme_mod('animationspeed'));
			}			
			$slider_options = array(
				'slideshowspeed' => $slideshowspeed,
				'animationspeed' => $animationspeed,
			);			
			wp_localize_script('slider-init', 'sliderOptions', $slider_options);			
		}		
	}
	add_action( 'wp_enqueue_scripts', 'solon_slider_scripts' );
	
	function solon_slider_template() {
		$cat = absint(get_theme_mod('slider_cat'));
		if (get_theme_mod('slider_number')) {	
			$number = absint(get_theme_mod('slider_number'));
		} else {
			$number = 6;
		}
		$args = array(
			'posts_per_page' => $number,
			'cat' => $cat
		);
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) {
		
		?>
		<div class="flexslider loading">
			<ul class="slides">	
				<?php
				while ( $query->have_posts() ) : $query->the_post(); ?>	
					<?php if ( has_post_thumbnail() ) : ?>	
						<li class="slide">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'slider-image' ); ?></a>
							<div class="slide-info">
								<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
								<span class="entry-meta"><?php solon_posted_on(); ?></span>
							</div>
							<div class="entry-summary">
								<?php echo wp_trim_words( get_the_content(), 30, '[...]' ); ?>
							</div>
						</li>
					<?php endif; ?>
				<?php endwhile; ?>	
			</ul>
		</div>
		<?php }
		
		wp_reset_postdata();
	}