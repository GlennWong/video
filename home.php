<?php
/*
 * Template Name:  首页模板
 *
 * @file           home.php
 * @package        OralHistory
 * @author         Legstrong
 * @copyright      2014 Legstrong
 * @version        Release: 1.0
 */get_header(); ?>
<div class="content container">
	<div class="row">
		<div id="homeslider" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#homeslider" data-slide-to="0" class="active"></li>
		    <li data-target="#homeslider" data-slide-to="1"></li>
		    <li data-target="#homeslider" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <?php $posts = query_posts("cat=1&showposts=3"); ?>
		  <div class="carousel-inner" role="listbox">
		  	<?php while (have_posts()) : the_post(); ?>
		    <div class="item">
				<?php if (has_post_thumbnail()) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('slider-thumb'); ?>
				</a>
				<?php endif;?>
		      <div class="carousel-caption">
		      	<h2><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
				<p><?php the_excerpt();?></p>
		      </div>
		    </div>
		    <?php endwhile; ?>
		  </div>
		  <?php wp_reset_query(); ?>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#homeslider" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#homeslider" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
		<script>jQuery(document).ready(function($){$("#homeslider .carousel-inner .item:first").addClass("active");});</script>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<h2 class="page-header">热门视频 <small> Hotest Videos</small></h2>
		</div>
		<?php $posts = query_posts("cat=1&showposts=3"); ?>
		<?php while (have_posts()) : the_post(); ?>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<?php if (has_post_thumbnail()){ ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('post-thumbnail'); ?>
				</a>
				<?php }else{?>
					<img src="http://placehold.it/360x240" alt="...">
				<?php }?>
				<div class="caption">
					<h3><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h3>
					<p><?php the_excerpt();?></p>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<h2 class="page-header">最新视频 <small> Latest Videos</small></h2>
		</div>
		<?php $posts = query_posts("cat=1&showposts=3"); ?>
		<?php while (have_posts()) : the_post(); ?>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<?php if (has_post_thumbnail()){ ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('post-thumbnail'); ?>
				</a>
				<?php }else{?>
					<img src="http://placehold.it/360x240" alt="...">
				<?php }?>
				<div class="caption">
					<h3><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h3>
					<p><?php the_excerpt();?></p>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</div>
</div>

<?php get_footer(); ?>