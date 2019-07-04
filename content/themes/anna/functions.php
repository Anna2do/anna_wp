<?php add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');
function salient_child_enqueue_styles() {

    // wp_enqueue_script('vendors.min', get_theme_file_uri('/js/vendors.min.js'), NULL, '1.0', true);
    wp_enqueue_script('main.min', get_theme_file_uri('/js/main.min.js'), NULL, '1.0', true);
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'));

//     if ( is_rtl() ) 
//    		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
}

function anna(){
  $the_query = new WP_Query(array ('post_type' => 'anna'));
			 
			 // Die Schleife
			 if ($the_query-> have_posts ()) { ?>
			 <form role="search"  method="get" >
			<input type="search"  name="s" id="s" placeholder="suche">
			<button type="submit">test</button>
			 </form>
<input type="text" name="" id="input" placeholder="Input">
				 <ul>
					<?php 
					while ($the_query-> have_posts ()) {
						$the_query->the_post(); ?>
						<div class="item">
							<h2 id="<?php the_title() ?>" class="titel"><?php the_title() ?></h2>
						<p class="titel"><?php echo get_the_content()  ?></p>
              <?php the_post_thumbnail() ?>
							<!-- <div style="height: 300px; width: 100%; background: url(<?php echo the_post_thumbnail_url(); ?>) center no-repeat"></div> -->

          </div>
					<?php } ?>

				</ul>
				<?php

		

				 wp_reset_postdata ();
			 } else { ?>
				 <p>Keine Beiträge gefunden</p>
			<?php }
  }

add_shortcode('anna', 'anna' );