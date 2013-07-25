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
$query = new WP_Query('post_type=carousel');
if($query->have_posts()) : ?>
<div id="carousel" class="carousel slide">
	<div class="carousel-inner">
		<?php while($query->have_posts()) : $query->the_post(); ?>

		<div class="item <?php if($isfirst == TRUE) : echo "active"; endif; $isfirst = FALSE; ?>">
			<?php the_post_thumbnail("full"); ?>
			<div class="carousel-caption">
				<h4><?php the_title(); ?></h4>
				<?php the_content(); ?>
			</div>
		</div>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>
	<a class="carousel-control left" href="#carousel" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#carousel" data-slide="next">&rsaquo;</a>
</div>
<?php endif; ?>
