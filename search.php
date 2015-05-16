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
					<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_post_thumbnail("medium"); ?></a>
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
	<nav class="text-center">
	  <ul class="pagination">
		<li>
	      <a href="#" aria-label="Previous">
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>
	    <li><a href="#">1</a></li>
	    <li><a href="#">2</a></li>
	    <li><a href="#">3</a></li>
	    <li><a href="#">4</a></li>
	    <li><a href="#">5</a></li>
	    <li>
	      <a href="#" aria-label="Next">
	        <span aria-hidden="true">&raquo;</span>
	      </a>
	    </li>
	  </ul>
	</nav>
</div>
<?php get_footer(); ?>