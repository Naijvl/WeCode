<?php if ( have_posts() ) : ?>
<?php while( have_posts() ) : the_post(); ?>
<div class="article">

	<div class="cover">
			<?php if ( has_post_thumbnail() ) : ?>

				<?php the_post_thumbnail( array(130,100) ); ?>

			<?php else : ?>
				<?php catch_that_image(); ?>
			<?php endif; ?>
	</div>




	<div class="entry-wrapper">
		<h2 class="title<?php if( is_sticky() ) echo " sticky"; ?>">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title_attribute(); ?></a>
		</h2>
		<div class="entry">
            <p class="summary"><?= get_the_excerpt(); ?></p>
		</div>
		<div class="meta">

			<span class="author" title="作者"><i class="ico ico-author"></i><?php the_author(); ?></span>
			<span class="date" title="发表日期"><i class="ico ico-time"></i><?php the_time('Y-m-d'); ?></span>
			<span class="reply"  title="评论">
				<i class="ico ico-reply"></i><?php comments_popup_link('0', '1', '%','replynum'); ?>
			</span>
			<?php the_tags('<span class="tag" title="标签">', ',', '</span>'); ?>
			<span class="category" title="分类"><?php the_category(' ', ''); ?></span>
		</div>
	</div>





</div>
<?php endwhile; ?>
<?php page_navigation(10); ?>
<?php else : ?>
<?php endif; wp_reset_query(); ?>
