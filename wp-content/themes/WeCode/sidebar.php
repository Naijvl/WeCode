<?php if ( is_page() || is_single() ) : ?>
<div class="sidebar-box" id="ucenter">
    <div class="sidebar-title">个人资料</div>
    <div class="post-author">
		<div class="profile">
			<?php             
            global $current_user; 
            echo  "<div class='photo'>" . get_avatar(get_the_author_email()) . "</div>";  
            echo  "<div class='meta'>";  
            echo the_author_posts_link();
            echo "</div>";

            $followbtn = '';
            $followbtn .= '<span class="follow-btn" data-userid="' . get_the_author_ID() . '">';
            if ( isFollow(get_the_author_ID(), $current_user->ID) ) {
                $followbtn .= '取消关注</span>'; 
            } else {
                $followbtn .= '关注</span>'; 
            }

            if (get_the_author_ID() != $current_user->ID) {
                echo $followbtn;
            }
            
        	?>

		</div>
        <div class="data-info">
        	<ul>
        		<li><a href="<?php echo site_url() . '/author/' . get_the_author_login() ?>">文章</a><span class="number"><?php echo count_user_posts(get_the_author_ID(), array('post'), true); ?></span></li>
                <li><a href="">评论</a><span class="number">243</span></li>
        		<li><a href="">粉丝</a><span class="number fans-number"><?php echo getFansCount(get_the_author_ID()); ?></span></li>
        		<li><a href="">关注</a><span class="number follow-number"><?php echo getFollowCount(get_the_author_ID()); ?></span></li>
        		
        	</ul>
        </div>
    </div>
  
</div>
<?php endif; ?>


<div class="sidebar-box" id="hot-posts">
	<div class="sidebar-title">热评文章</div>
	<ul><?php most_commented_post(5); ?></ul>
	
</div>




<?php if (is_active_sidebar( 'widget_default')) : ?>
	<div class="sidebar-box">
		<div class="sidebar-title">标签</div>
		<?php dynamic_sidebar( 'widget_default' ); ?>
	</div>	
<?php endif; ?> 







