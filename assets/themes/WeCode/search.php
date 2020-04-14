<?php get_header(); ?>
<div class="wrapper" id="main">

	<div id="content" class="search-result">
		<?php 
		$allsearch = new WP_Query("s=$s&showposts=-1");
		$count = $allsearch->post_count;
		$keywords = wp_specialchars($s, 1);
		?>
		<?php if ($count==0) : ?>
		<div class="error-wrapper">
			<h1>搜索结果</h1>
			<div class="error">
				<p>没有找到相关内容！</p>
			</div>			
		</div>
		
		<?php else : ?>
		<div class="header article">
			<h1>搜索结果</h1>
			<p><?php echo '共找到含有“' . $keywords . '”的文章' . $count . '篇'; ?></p>
		</div>
		<?php get_template_part( 'content', '' ); ?>
		<?php endif; ?>
	</div>		


	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>
	
</div>
<?php get_footer(); ?>
