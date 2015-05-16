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
		<div class="media col-sm-12">
			<div class="media-left">
				<?php if(has_post_thumbnail()){?>
					<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_post_thumbnail('post-thumbnail',array("class"=>"media_object")); ?></a>
				<?php }else{?>
					<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><img src="http://placehold.it/360x240" class="media-object" alt="..."></a>
				<?php }?>
			</div>
			<div class="media-body">
				<h2 class="media-heading"><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></h2>
				<p><?php the_excerpt();?></p>
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