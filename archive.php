<?php get_header();?>
<div class="title">
	<div class="container">
		<div class="row">
			<h1 class="text-center"><?php if(have_posts())the_category(' ',' ');?></h1>
		</div>
	</div>
</div>
<div class="content container">
	<div class="row">
		<?php bootstrap_breadcrumb();?>
		
		<?php while(have_posts()):the_post();?>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<?php if(has_post_thumbnail()){?>
					<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_post_thumbnail('post-thumbnail'); ?></a>
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

	</div>
	<!--Paginations-->
	<?php if ($wp_query->max_num_pages > 1) : ?>
	<nav>
		<ul class="pager">
			<li><?php next_posts_link('&#8249; 下一页'); ?></li>
			<li><?php previous_posts_link('上一页 &#8250;'); ?></li>
		</ul>
	</nav>
	<?php endif; ?>
	<!-- end of .navigation -->
</div>
<?php get_footer(); ?>