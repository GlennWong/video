<?php if(post_password_required())return;?>

<div class="well">
	<?php if ( have_comments() ) : ?>
		<h3>
			<?php printf( _n( '1个评论', '%1$s个评论', get_comments_number()),number_format_i18n( get_comments_number() ));?>
		</h3>

		<ul class="commentlist media-list">
			<?php wp_list_comments( array( 'avatar_size' => 48,'per_page'=>1 ,'callback'=>'callback_comment' ) ); ?>
		</ul>
		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<ul class="pager">
				<li><?php previous_comments_link( __( '&#8249; 下一页') );?></li>
				<li><?php next_comments_link( __( '上一页 &#8250;') );?></li>
			</ul>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="nocomments">不允许评论</p>
		<?php endif; ?>

	<?php endif; ?>


	<?php
		$args = array(
			'fields' => array(
				'author' => '<div class="form-inline form-group"><div class="form-group">' . '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size=""' . ' class="form-control" placeholder="姓名" />' . '</div>',
				'email'  => '<div class="form-group">' . '<input id="email" name="email" ' . 'type="text"' . ' value="' . esc_attr($commenter['comment_author_email']) . '" size=""' . ' class="form-control" placeholder="Email" />' . '</div>',
				'url'    => '<div class="form-group">' . '<input id="url" name="url" ' . 'type="text"' . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="" class="form-control" placeholder="网站" />' . '</div></div>'),
			'comment_field' => '<div class="form-group">' . 
							'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control" placeholder="添加评论" ></textarea>' . 
							'</div>',
			'comment_notes_after' => '',
			'class_submit' => 'btn btn-primary',

		);
		comment_form($args);
	?>

</div>