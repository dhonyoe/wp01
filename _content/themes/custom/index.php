<?php

get_header();
?>


<?php if (have_posts()) { ?>
	<?php
	if (is_front_page()) {
		the_post();
		the_content();
	} else {
		// Start the loop.
		while (have_posts()) {
			the_post();
			$data = get_post_meta(get_the_ID());
			$bg = '';
			if(isset($data['primary-bg']) && !empty($data['primary-bg'][0])) {
				$bg = 'bg-primary';
			}
			?>
			<section class="<?php echo $bg; ?>">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<h2 class="section-heading">
								<?php
								the_title();
								?>
							</h2>
							<hr class="primary">
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<?php
						the_content();
						?>
					</div>
				</div>
			</section>

			<?php
		// End the loop.
		}
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

