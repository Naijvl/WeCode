<?php
/*
Template Name: 个人中心
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
				<li><a href="<?php echo site_url() . '/ucenter' ?>" class="active">我的资料</a></li>
				<li><a href="<?php echo site_url() . '/myfollow' ?>">我的关注</a></li>
				<li><a href="<?php echo site_url() . '/myfans' ?>">我的粉丝</a></li>
				<li><a href="">我的收藏</a></li>
				<li><a href="">我的文章</a></li>
			</ul>
		</div>

		<div class="content-block">
			<?php 
	            global $current_user;                                
	            echo "<div class='photo'>" . get_avatar($current_user->user_email, 30, 30 ) ."</div>" . $current_user->display_name;
	        ?>
		</div>		
	</div>

</div>
<?php get_footer(); ?>