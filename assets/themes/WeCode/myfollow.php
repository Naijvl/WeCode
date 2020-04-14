<?php
/*
Template Name: 我的关注
*/
?>
<?php get_header(); ?>
<div class="wrapper" id="main">
	<div class="ucenter-wrapper">
		<div class="uheader">
			<h3>个人中心</h3>
		</div>
		
		<div class="nav-panel">
			<ul>
				<li><a href="<?php echo site_url() . '/ucenter' ?>">我的资料</a></li>
				<li><a href="<?php echo site_url() . '/myfollow' ?>" class="active">我的关注</a></li>
				<li><a href="<?php echo site_url() . '/myfans' ?>" >我的粉丝</a></li>
				<li><a href="">我的收藏</a></li>
				<li><a href="">我的文章</a></li>
			</ul>
		</div>

		<div class="content-block">
			<div class="mf-wrapper">
				<?php echo getMyFollow(); ?>
			</div>
			
		</div>		
	</div>

</div>
<?php get_footer(); ?>