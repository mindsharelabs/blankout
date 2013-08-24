<?php
/**
 * carousel.php
 *
 * @created 12/18/12 3:53 PM
 * @author    Mindshare Studios, Inc.
 * @copyright Copyright (c) 2012
 * @link      http://www.mindsharelabs.com/documentation/
 *
 */

$isfirst = TRUE;
$n = 0;
$query = new WP_Query('post_type=carousel');
if($query->have_posts()) : ?>

<div id="carousel" class="flexslider">
	
	<?php $isfirst = TRUE; ?>
	
	<ul class="slides">
		<?php while($query->have_posts()) : $query->the_post(); ?>

		<li class="item">
			<?php the_post_thumbnail("full"); ?>
			<p class="flex-caption hidden-sm hidden-xs"><?php echo get_the_content(); ?></p>
		</li>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</ul>
</div>
<?php endif; ?>
