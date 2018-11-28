<?php get_header(); ?>
<div class="wrapper" id="main">

	<div id="content">
		<?php while (have_posts()) : the_post(); ?>
		<!-- <?php current_path(); ?> -->
		<div class="post-wrapper">
			<div class="post-header">
				<h1 title="<?php the_title_attribute(); ?>"><?php the_title_attribute(); ?></h1>
				<div class="meta-data">				
					<span class="date"><i class="ico ico-time"></i>&nbsp;<?php the_time('Y-m-d'); ?></span>	
					<span class="comments"><i class="ico ico-reply"></i><?php comments_popup_link('0', '1', '%'); ?>条评论</span>					
					<?php if ( !post_password_required() && comments_open() ) : ?>							
						<?php edit_post_link('编辑', '<span class="edit"><i class="ico ico-edit"></i>&nbsp;', '</span>'); ?>
					<?php endif; ?>	
				</div>					
			</div>
			<div class="content-inner">
				<?php the_content(); ?>
			</div>
		</div>


	
	<?php comments_template( '', true ); ?>

	<div class="tool-wrapper">
		<div class="random">
			<ul><?php random_posts(5,100); ?></ul>
				
		</div>		
	</div>
	





	
	<?php endwhile; ?>
	</div>

	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>



</div>

<?php get_footer(); ?>