<?php
/**
 * Template Name: Portfolio Page 
 * */
get_header();
?>

<section>
	<div class="container">
		<div class="row">

			<?php
			
			$args = array(
			'numberposts' => 10,
			'offset' => 0,
			'category' => 0,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'suppress_filters' => true );

			$recent_posts = wp_get_recent_posts($args, ARRAY_A);
			/*
			echo '<pre>';
			print_r($recent_posts);
			echo '</pre>';
			*/
			//if (have_posts()) 
			{
				//die('1');
				?>

				<?php
				// Start the loop.
				foreach ($recent_posts as $k => $v) {
					$img_src = wp_get_attachment_url( get_post_thumbnail_id($v['ID']) );
					//echo $img_src;
					//the_post();
					//$data = get_post_meta(get_the_ID());
					?>
					<div class="col-lg-4 col-sm-6">
						<a href="#" class="portfolio-box">
							<img src="<?php echo $img_src; ?>" class="img-responsive" alt="">
							<div class="portfolio-box-caption">
								<div class="portfolio-box-caption-content">
									<div class="project-category text-faded">
										<?php echo $v['post_content']; ?>
									</div>
									<div class="project-name">
										<?php
											//echo $v['post_content'];
										?>
									</div>
								</div>
							</div>
						</a>
					</div>

					<?php
					// End the loop.
				}

				// Previous/next page navigation.
				/*
				  the_posts_pagination(array(
				  'prev_text' => __('Previous page', 'twentyfifteen'),
				  'next_text' => __('Next page', 'twentyfifteen'),
				  'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentyfifteen') . ' </span>',
				  ));
				 */
			}
			?>
		</div>
	</div>

</section>

<!--


<section class="no-padding" id="portfolio">
	<div class="container-fluid">
		<div class="row no-gutter">
			<div class="col-lg-4 col-sm-6">
				<a href="#" class="portfolio-box">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/portfolio/1.jpg" class="img-responsive" alt="">
					<div class="portfolio-box-caption">
						<div class="portfolio-box-caption-content">
							<div class="project-category text-faded">
								Category
							</div>
							<div class="project-name">
								Project Name
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4 col-sm-6">
				<a href="#" class="portfolio-box">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/portfolio/2.jpg" class="img-responsive" alt="">
					<div class="portfolio-box-caption">
						<div class="portfolio-box-caption-content">
							<div class="project-category text-faded">
								Category
							</div>
							<div class="project-name">
								Project Name
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4 col-sm-6">
				<a href="#" class="portfolio-box">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/portfolio/3.jpg" class="img-responsive" alt="">
					<div class="portfolio-box-caption">
						<div class="portfolio-box-caption-content">
							<div class="project-category text-faded">
								Category
							</div>
							<div class="project-name">
								Project Name
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4 col-sm-6">
				<a href="#" class="portfolio-box">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/portfolio/4.jpg" class="img-responsive" alt="">
					<div class="portfolio-box-caption">
						<div class="portfolio-box-caption-content">
							<div class="project-category text-faded">
								Category
							</div>
							<div class="project-name">
								Project Name
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4 col-sm-6">
				<a href="#" class="portfolio-box">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/portfolio/5.jpg" class="img-responsive" alt="">
					<div class="portfolio-box-caption">
						<div class="portfolio-box-caption-content">
							<div class="project-category text-faded">
								Category
							</div>
							<div class="project-name">
								Project Name
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4 col-sm-6">
				<a href="#" class="portfolio-box">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/portfolio/6.jpg" class="img-responsive" alt="">
					<div class="portfolio-box-caption">
						<div class="portfolio-box-caption-content">
							<div class="project-category text-faded">
								Category
							</div>
							<div class="project-name">
								Project Name
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>
-->

<!-- jQuery -->
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/jquery.easing.min.js"></script>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/jquery.fittext.js"></script>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/wow.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/creative.js"></script>

</body>

</html>
