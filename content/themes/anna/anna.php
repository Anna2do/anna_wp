<?php /* Template Name: Annas Loop */?>

<?php 

get_header(); 
nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);

?>


<div class="container-wrap">
	
	<div class="<?php if($page_full_screen_rows != 'on') echo 'container'; ?> main-content">
		
		<div class="row">

			
			<?php 

			//breadcrumbs
			if ( function_exists( 'yoast_breadcrumb' ) && !is_home() && !is_front_page() ){ yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } 

			 //buddypress
			 global $bp; 
			 if($bp && !bp_is_blog_page()) echo '<h1>' . get_the_title() . '</h1>';
			
			 //fullscreen rows
			 if($page_full_screen_rows == 'on') echo '<div id="nectar_fullscreen_rows" data-animation="'.$page_full_screen_rows_animation.'" data-row-bg-animation="'.$page_full_screen_rows_bg_img_animation.'" data-animation-speed="'.$page_full_screen_rows_animation_speed.'" data-content-overflow="'.$page_full_screen_rows_content_overflow.'" data-mobile-disable="'.$page_full_screen_rows_mobile_disable.'" data-dot-navigation="'.$page_full_screen_rows_dot_navigation.'" data-footer="'.$page_full_screen_rows_footer.'" data-anchors="'.$page_full_screen_rows_anchors.'">';

			
			
			 // Die Abfrage
			$the_query = new WP_Query(array ('post_type' => 'anna'));
			 
			 // Die Schleife
			 if ($the_query-> have_posts ()) { ?>

				 <ul>
					<?php 
					while ($the_query-> have_posts ()) {
						$the_query->the_post(); ?>
						<a href="<?php echo get_permalink() ?>">
							<h2 class="titel"><?php the_title() ?></h2>
							<p class="titel"><?php the_content() ?></p>
							<?php the_post_thumbnail() ?>
							<!-- <div style="height: 300px; width: 100%; background: url(<?php echo the_post_thumbnail_url(); ?>) center no-repeat"></div> -->

						</a>
					<?php } ?>

				</ul>
				<?php

		

				 wp_reset_postdata ();
			 } else { ?>
				 <p>Keine Beiträge gefunden</p>
			<?php }


			
			if($page_full_screen_rows == 'on') echo '</div>'; ?>

		</div><!--/row-->
		
	</div><!--/container-->
	
</div><!--/container-wrap-->

<?php get_footer(); ?>