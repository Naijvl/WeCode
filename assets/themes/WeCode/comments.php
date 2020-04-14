<?php 
	if ( post_password_required() ) {
	return;
	}
	if( is_single() ) {
		$comment_title = '评论';
	} else {
		$comment_title = '留言';
	}
?>


<div class="comments-wrapper">
	<?php if ( have_comments() ) : ?>
		<div id="comment-list">
			<?php function custom_comment($comment, $args, $depth)
			{ $GLOBALS['comment'] = $comment; ?>
				<li class="comment" id="li-comment-<?php comment_ID(); ?>">
					<div class="comment-body">
						<div class="comment-author">
							<?php if (function_exists('get_avatar') && get_option('show_avatars')) 
								{ echo '<div class="author-pic">'. get_avatar($comment, 80) . '</div>'; } 
							?>
							
						</div>
						<div class="comment-content" id="comment-<?php comment_ID(); ?>">
							<div class="comment-detail">
								<div class="comment-header">
									<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()); ?>
									<div class="comment-meta commentmetadata"><?php echo get_comment_time('Y-m-d'); ?> </div>
								</div>

								<div class="comment-text">
									<?php if ($comment->comment_approved == '0') : ?>
										<span>评论正在审核中！</span><br />
									<?php endif; ?>						
									<?php comment_text(); ?>									
								</div>


								<div class="comment-footer">

									<div class="reply">		
										<?php 
											if ( !is_user_logged_in() ) { 
												echo '<a href="javascript:void(0)" class="tologin-btn">登录后回复</a>';
											}
										?> 								
										<?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','login_text' => '登录并回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>								
									</div>	

																	
								</div>
								
							</div>
						</div>
					</div>
				</li>
			<?php 
			} ?>
			<?php wp_list_comments('type=comment&callback=custom_comment');?>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div id="comment-nav" class="navigation comment-navigation">
				<?php previous_comments_link( '&laquo; 上一页' ); ?>
				<?php next_comments_link( '下一页 &raquo;' ); ?>
			</div>
		<?php endif; ?>

	<?php endif; ?>

	<?php 
	if ( ! comments_open() ) {
		echo '<p>' . $comment_title . '功能已关闭！' . '</p>';
	} else {
		if ( !is_user_logged_in() ) { 
			echo '<div id="respond" class="comment-respond">
			<h3 id="reply-title" class="comment-reply-title">发表评论 <small><a rel="nofollow" id="cancel-comment-reply-link" href="/?p=336#respond" style="display:none;">取消回复</a></small></h3><p class="must-log-in">要发表评论，您必须先<a class="tologin-btn" href="javascript:void(0)">登录</a>。</p>		</div>';
		} else {
			$comments_args = array(
				'id_form' => 'comment-form',
				'id_submit' => 'comment-submit',
				'title_reply' => '发表' . $comment_title,
				'title_reply_to' => '回复',
				'cancel_reply_link' => '取消回复',
				'label_submit' => '提交' . $comment_title,
				'comment_field' => '<p class="comment-form-comment"><textarea placeholder="吐槽" id="comment" name="comment" cols="45" rows="8" required="required"></textarea></p>',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="uinfo"><p class="comment-form-author"><label for="author">昵称&nbsp;&nbsp;</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required="required" /></p>',
				'email' => '<p class="comment-form-email"><label for="email">邮箱&nbsp;&nbsp;</label><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . ( $req ? ' required="required"  placeholder="必填" />' : ' />') . '</p></div>',
				)
				),
			);
			comment_form($comments_args);			
		}
		

	}
	?>
</div>