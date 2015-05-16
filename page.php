<?php
/*
 * Template Name:  页面模板
 *
 * @file           page.php
 * @package        OralHistory
 * @author         Legstrong
 * @copyright      2014 Legstrong
 * @version        Release: 1.0
 */get_header(); ?>
<?php if(have_posts()):the_post();?>
<div class="title">
	<div class="container">
		<div class="row">
			<h1 class="text-center"><?php the_title();?></h1>
		</div>
	</div>
</div>
<div class="content container">
	<div class="row">
		<?php if(get_post_custom_values('video_iframe')):?>
		<div class="embed-responsive embed-responsive-16by9">
			<?php echo(get_post_custom_values('video_iframe')[0]);?>
		</div>
		<?php endif;?>

		<?php bootstrap_breadcrumb();?>
		<div class="post-content col-sm-9">
			<?php the_content();?>
			<div class="post-comment">
			<?php comments_template('');?>
			</div>
		</div>
		<div class="post-suggest col-sm-3">
			<?php dynamic_sidebar('sidebar-1');?>
		</div>
	</div>
</div>
<?php endif;?>
<?php get_footer(); ?>