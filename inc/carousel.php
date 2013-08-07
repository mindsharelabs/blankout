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

<div id="carousel" class="carousel slide">
	
	<ol class="carousel-indicators">
		<?php while($query->have_posts()) : $query->the_post(); ?>
		<li data-target="#carousel" data-slide-to="<?php echo $n; ?>" class="<?php if($isfirst == TRUE) : echo "active"; endif; $isfirst = FALSE; ?>"></li>
		<?php $n++ ?>
		<?php endwhile; ?>
	</ol>
	
	<?php $isfirst = TRUE; ?>
	
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
	<!-- Controls -->
	<a class="left carousel-control" href="#carousel" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	<a class="right carousel-control" href="#carousel" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>
</div>
<?php endif; ?>
