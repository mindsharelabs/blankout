<?php
/**
 * carousel.php
 *
 * @created   12/18/12 3:53 PM
 * @author    Mindshare Studios, Inc.
 * @copyright Copyright (c) 2013
 * @link      http://www.mindsharelabs.com/documentation/
 *
 */

$slide_query = new WP_Query('post_type=carousel');

if($slide_query->have_posts()) : ?>

	<div id="carousel" class="flexslider">
		<ul class="slides">
			<?php while($slide_query->have_posts()) : $slide_query->the_post(); ?>
				<?php if(has_post_thumbnail() && function_exists('mapi_thumb')) : ?>
					<li class="item">
						<?php
						$img_src = mapi_image(mapi_get_attachment_image_src(),
							array(
								'width'   => 1170,
								'height'  => 480,
								'quality' => 90
							)
						);
						?>
						<img src="<?php echo $img_src; ?>" class="attachment-full wp-post-image" alt="<?php echo mapi_get_attachment_image_title(); ?>" />


						<?php if(function_exists('mapi_excerpt') && (mapi_excerpt() != '')) : ?>
							<div class="flex-caption hidden-sm hidden-xs">
								<?php the_content(); ?>
							</div>
						<?php endif; ?>
					</li>
				<?php endif; ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>
	</div>
<?php endif; ?>
