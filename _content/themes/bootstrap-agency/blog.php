<?php
/*
 * Template Name: Blog
 * 
 */
?>
<?php get_header(); ?>

<!-- Services Section -->

<section id="services">
	<div class="container">
		<div class="row">


			<!-- Header -->
			<?php
			$args = array(
				'numberposts' => 10,
				'offset' => $offset,
				'category' => 0,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'suppress_filters' => true);

			$recent_posts = wp_get_recent_posts($args, ARRAY_A);
//			echo '<pre>';
//			print_r($recent_posts);
//			echo '</pre>';

			foreach ($recent_posts as $post) {
				echo '<div class="col-lg-12 text-center">
						<h2 class="section-heading">' . $post['post_title'] . '</h2>
						<p>' . $post['post_content'] . '</p>
					</div> ';
			}
			?>

			<?php posts_nav_link(); ?> 

		</div>
	</div>
</section>

<?php get_footer(); ?>