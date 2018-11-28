<?php

//菜单
register_nav_menus();
// 边栏

//最新文章
function recent_posts($limit=10, $count=32) {
	$category_id = '';
	if (is_single() ) {
		$categories = get_the_category();
		foreach ($categories as $category) {
		$category_id = $category->term_id;
		}
	}
	$new_posts = get_posts('numberposts=' . $limit .'&orderby=post_date&category=' . $category_id);
	foreach( $new_posts as $post ) {
		$first_img = '';
		ob_start();
		ob_end_clean();
		$img_num = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img = $matches [1] [0];

		 
		if(empty($first_img)){ 
			$first_img = get_bloginfo("siteurl")."/wp-content/themes/Frontend/default.jpg";
			// $first_img = "wp-content/../../default.jpg";
		}
		echo '<li><a href="' . get_permalink($post->ID) . '" rel="bookmark">' . '<div class="article_img" style='.'background-image:url('
			.$first_img .')></div><p class="article_title">'. $post->post_title .'</p></a></li>';
	}
}
//最新评论
function recent_comments($limit=10, $count=28, $avatarsize=26) {
	global $wpdb;
	$sql = "SELECT ID, comment_ID, comment_content, post_title, comment_date, comment_author_email, comment_author FROM $wpdb->posts, $wpdb->comments WHERE $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'  AND comment_type = ''";
	$sql .= "AND comment_approved = '1' ORDER BY $wpdb->comments.comment_date DESC LIMIT $limit";
	$comments = $wpdb->get_results($sql);
	$output = '';
	foreach ($comments as $comment) {
		$comment_author = stripslashes($comment->comment_author);
		$comment_excerpt = mb_strimwidth(strip_tags(apply_filters('the_comment', $comment->comment_content)), 0, $count, "...");
		$permalink = get_permalink($comment->ID)."#comment-".$comment->comment_ID;
		$output .= '<li><div class="author">' .get_avatar($comment, $avatarsize) . '<p>' . $comment_author . '</p></div><p class="comment"><a href="' . $permalink . '" title="点击杳看' . $comment_author . '在文章“' . $comment->post_title . '”中的评论">' . $comment_excerpt . '</a></p></li>';
	}
	echo $output;
}
//热评文章$sort='DESC' 冷评文章$sort='ASC'
function most_commented_post($limit=10, $count=100, $days=365, $sort='DESC') {
	global $wpdb;
	$sql = "SELECT ID , post_title , comment_count , post_author
	FROM $wpdb->posts
	WHERE post_status = 'publish' AND post_type = 'post' AND post_type != 'page' AND post_title != '' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days
	ORDER BY comment_count $sort LIMIT 0 , $limit ";
	$posts = $wpdb->get_results($sql);
	$output = '';

	foreach ($posts as $key => $post){
		$output .= '<li><div class="author-pic">' . get_avatar($post->post_author) . '</div><p class="text"><span class="author-name">' . get_user_by('id', $post->post_author)->display_name . '</a>：</span><a href="' . get_permalink($post->ID) . '" rel="bookmark">' . mb_strimwidth($post->post_title,0,$count) . '</a></p></li>';
	}

	echo $output;
}


// 边栏

function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('~<img [^\>]*\ />~', $post->post_content, $matches);
	 
	//获取文章中第一张图片的路径并输出
	$first_img = $matches [0] [1];
	 
	//如果文章无图片，获取自定义图片
	$lazy = " class='lazy' width='90' height='90' ";
	if(empty($first_img)){ //Defines a default image
		$first_img = '<img src="http://hexiboy.com/wp-content/themes/WeCode/images/post-random/default.png" />';
	 
	//请自行设置一张default.png图片
	}
	
	echo insertToStr(str_replace("src", "data-original", $first_img),4,$lazy); 			 

}
function catch_all_image($num) {
	global $post, $posts;

	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('~<img [^\>]*\ />~', $post->post_content, $matches);
	$img_num = count($matches[0]);
	for($i = 0;$i < $img_num;$i++){
		echo $matches[0][$i]; 
	}	

}
function catch_all_lazy_image($num) {
	global $post, $posts;

	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('~<img [^\>]*\ />~', $post->post_content, $matches);
	$lazy = " class='lazy' width='90' height='90' ";
	$img_num = count($matches[0]);
	for($i = 0;$i < $img_num;$i++){
		echo insertToStr(str_replace("src", "data-original", $matches[0][$i]),4,$lazy); 
	}	

}
function insertToStr($str, $i, $substr){
    //指定插入位置前的字符串
    $startstr="";
    for($j=0; $j<$i; $j++){
        $startstr .= $str[$j];
    }
    
    //指定插入位置后的字符串
    $laststr="";
    for ($j=$i; $j<strlen($str); $j++){
        $laststr .= $str[$j];
    }
    
    //将插入位置前，要插入的，插入位置后三个字符串拼接起来
    $str = $startstr . $substr . $laststr;
    
    //返回结果
    return $str;
}


function delete_html($str) {
	$str = strip_tags($str,''); 
	$str = ereg_replace('\t','',$str); 
	$str = ereg_replace('\r\n','',$str); 
	$str = ereg_replace('\r','',$str); 
	$str = ereg_replace('\n','',$str); 
	$str = ereg_replace(' ','',$str); 
	return trim($str); 
}
//摘要
function content_excerpt($count=200, $string='') {
	global $post;
	$content = apply_filters('the_content', $post->post_content);
	$content_text = delete_html($content);
	return wp_trim_words($content_text, $count, $string);
}


//分页
function page_navigation($range=10) {
	global $paged, $wp_query;
	$range = ceil($range/2)*2;
	if ( !$max_page ) $max_page = $wp_query->max_num_pages;

	if($max_page > 1) {
	if(!$paged) $paged = 1;

	function pageNum($range, $max_page, $paged) {
	if($max_page > $range) {
	if($paged < $range) {
	for($i = 1; $i <= $range; $i++) {
	$page_num[$i] = $i;
	}
	} elseif($paged >= ($max_page - ($range/2) ) ) {
	for($i = $max_page - $range+1; $i <= $max_page; $i++) {
	$page_num[$i] = $i;
	}
	} elseif($paged >= $range && $paged < ($max_page - ($range/2) ) ) {
	for($i = ($paged - $range/2+1 ); $i <= ($paged + ($range/2) ); $i++) {
	$page_num[$i] = $i;
	}
	}
	} else {
	for($i = 1; $i <= $max_page; $i++) {
	$page_num[$i] = $i;
	}
	}
	return $page_num;
	}
	$page_num = pageNum($range, $max_page, $paged);

	echo '<div class="page-nav"><span class="total-page">' . sprintf(__('共有%s页', 'enterprise-themes'), $max_page) . '</span>';
	if($paged != 1) echo '<a href="' . get_pagenum_link(1) . '" class="first-page">' . __('首页', 'enterprise-themes') . '</a>';
	previous_posts_link(__('上一页', 'enterprise-themes') );
	foreach($page_num as $num) {
	echo '<a href="' . get_pagenum_link($num) . '"';
	if($num==$paged) echo ' class="current-page"';
	echo '>' . $num . '</a>';
	}
	next_posts_link(__('下一页', 'enterprise-themes') );
	if($paged != $max_page) {
	echo '<a href="' . get_pagenum_link($max_page) . '" class="last-page">' . __('末页', 'enterprise-themes') . '</a>';
	}
	echo '</div>';
	}
}


//面包屑导航,当前位置
function current_path() {
	global $cat, $s, $post;
	echo '<div id="path"><a href="' . get_bloginfo('url') . '">首页</a>';
	if((is_single() || is_category() ) && !is_attachment() ) {
		$categorys = get_the_category();
		$category = $categorys[0];
		$category_id = $category->term_id;
		if(is_category() ) $category_id = $cat;
		$category_name = get_category_parents($category_id, false, ',');
		$category_name_group = explode(',', $category_name);
		foreach ($category_name_group as $cat_name) {
			if($cat_name) {
				$cat_ID = get_cat_ID($cat_name);
				$cat_url = get_category_link( $cat_ID );
				if(is_single() || (is_category() && $cat_ID != $cat) ) echo '&gt; <a href="' . $cat_url . '">' . $cat_name . '</a>';
				if(is_category() && $cat_ID == $cat) echo "&gt; ".$cat_name; 
			}
		}
		// if(is_single() || is_date() ) echo  "&gt; ".the_title_attribute('echo=0') ;
	}
	if(is_page() ) {
		if ($post->post_parent) {
			$ancestors = array_reverse(get_post_ancestors($post->ID) );
			foreach ( $ancestors as $ancestor ) {
				$page_name = get_the_title($ancestor);
				$page_url = get_permalink($ancestor);
				echo '&gt; <a href="' . $page_url . '">' . $page_name . '</a>';
			}
		}
		echo  "&gt; ".the_title('', '', false) ;
	}
	if (is_search() ) echo  "&gt; ".$s . '"的搜索结果';
	if(is_tag() ) echo  "&gt; ".single_tag_title('', false) ;
	if(is_404() ) echo '&gt; 404页面';
	if(is_attachment() ) echo '&gt; 附件' . the_title_attribute('echo=0') ;
	echo '</div>';
}

//随机文章
function random_posts($limit=10, $count=32) {
	$rand_posts = get_posts('numberposts=' . $limit .'&orderby=rand');
	foreach( $rand_posts as $post ) {
		echo '<li><a href="' . get_permalink($post->ID) . '" rel="bookmark">' . wp_trim_words($post->post_title,$count,'') . '</a></li>';
	}
}

//设置特色图像
add_theme_support( 'post-thumbnails' );

//友情链接
add_filter('pre_option_link_manager_enabled','__return_true'); 

//register 小工具
register_sidebar( array(
 'name' => __( '默认右侧边栏', 'right_sidebar' ),//侧边的名字
 'id' => 'widget_default',//侧边栏的 ID，注册多个侧边栏的时候不要重复
 'description' => __( '右侧边栏的描述', 'right_sidebar' ),//侧边栏的描述，会在后台显示
 'before_widget' => '<div class="widget %2$s">',//侧边栏里的小工具的开头代码，可以在里边使用 %2$s 来调用小工具的 ID，实现给每个小工具添加不同的样式
 'after_widget' => '</div>',//侧边栏里的小工具的结尾代码
 'before_title' => '<h3 class="widget-title">',//侧边栏里的小工具的标题的开头代码
 'after_title' => '</h3>'//侧边栏里的小工具的标题的结尾代码
) );
register_sidebar( array(
 'name' => __( '底部导航', 'bottom_nav' ),//侧边的名字
 'id' => 'widget_default1',//侧边栏的 ID，注册多个侧边栏的时候不要重复
 'description' => __( '底部导航', 'bottom_nav' ),//侧边栏的描述，会在后台显示
 'before_widget' => '<div class="widget %2$s">',//侧边栏里的小工具的开头代码，可以在里边使用 %2$s 来调用小工具的 ID，实现给每个小工具添加不同的样式
 'after_widget' => '</div>',//侧边栏里的小工具的结尾代码
 'before_title' => '<h3 class="widget-title">',//侧边栏里的小工具的标题的开头代码
 'after_title' => '</h3>'//侧边栏里的小工具的标题的结尾代码
) );
register_sidebar( array(
 'name' => __( '顶部导航', 'top_nav' ),//侧边的名字
 'id' => 'widget_default2',//侧边栏的 ID，注册多个侧边栏的时候不要重复
 'description' => __( '顶部导航', 'top_nav' ),//侧边栏的描述，会在后台显示
 'before_widget' => '<div class="widget %2$s">',//侧边栏里的小工具的开头代码，可以在里边使用 %2$s 来调用小工具的 ID，实现给每个小工具添加不同的样式
 'after_widget' => '</div>',//侧边栏里的小工具的结尾代码
 'before_title' => '<h3 class="widget-title">',//侧边栏里的小工具的标题的开头代码
 'after_title' => '</h3>'//侧边栏里的小工具的标题的结尾代码
) );



//修复菜单右上角显示选项BUG
function Bing_fixed_zh_CN_display_option( $translations, $text, $domain ){
	if( get_locale() == 'zh_CN' && $text == 'To add a custom link, <strong>expand the Custom Links section, enter a URL and link text, and click Add to Menu</strong>' && $domain == 'default' ) $translations = '要添加自定义链接，<strong>展开自定义链接小节，输入URL和链接文本，然后点击添加到菜单</strong>';
	return $translations;
}
add_action( 'gettext', 'Bing_fixed_zh_CN_display_option', 10, 3 );


//wp_nav_menu walker调用的自定义菜单
class description_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth, $args)
	{
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
		$class_names = $value = '';
 
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
 
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
 
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
		$prepend = '<strong>';
		$append = '</strong>';
		$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
 
		if($depth != 0)
		{
			$description = $append = $prepend = "";
		}
 
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
 
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}



//获取用户文章数量
function getPostNumById ($id) {
	global $wpdb;
	$num = $wpdb->get_var( 'SELECT count(*) FROM `' . $wpdb->prefix . 'posts` WHERE post_author = ' . $id );
	echo $num;
}











//ajax登录注册
/* 获取当前页面url
/* ---------------- */
function get_current_page_url(){
	$ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($_SERVER['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port  = $_SERVER['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    return $protocol . '://' . $host . $port . $_SERVER['REQUEST_URI'];
}
 
/* AJAX登录验证
/* ------------- */
add_action( 'wp_ajax_ajax_login', 'ajax_login' );
add_action( 'wp_ajax_nopriv_ajax_login', 'ajax_login' );

function ajax_login() {
	$result = array();
	$creds = array();
	$creds['user_login'] = $_POST['username'];
	$creds['user_password'] = $_POST['password'];
	$creds['remember'] = true;

	$login = wp_signon($creds, false);

	if ( ! is_wp_error( $login ) ){
		$result['status'] = 'success';
	}else{
		$result['status'] = 'fail';
		$result['message']	= '账号或密码错误！';
	}


	header( 'content-type: application/json; charset=utf-8' );
	echo json_encode( $result );
	wp_die();
 
}


add_action( 'wp_ajax_ajax_register', 'ajax_register' );
add_action( 'wp_ajax_nopriv_ajax_register', 'ajax_register' );

function ajax_register() {
	$result	= array();

	$user_login = sanitize_user($_POST['username']);
	$user_pass = $_POST['password'];
	$user_email	= apply_filters( 'user_registration_email', $_POST['email'] );
	$errors	= new WP_Error();

	if( ! validate_username( $user_login ) ){
		$errors->add( 'invalid_username', __( '请输入一个有效用户名','tinection' ) );
	}elseif(username_exists( $user_login )){
		$errors->add( 'username_exists', __( '此用户名已被注册','tinection' ) );
	}elseif(email_exists( $user_email )){
		$errors->add( 'email_exists', __( '此邮箱已被注册','tinection' ) );
	}elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$user_email)){
		$errors->add( 'email_error', __( '邮箱填写错误！','tinection' ) );
	}
	do_action( 'register_post', $user_login, $user_email, $errors );
	$errors = apply_filters( 'registration_errors', $errors, $user_login, $user_email );
	if ( $errors->get_error_code() ){
		$result['success']	= 0;
		$result['message'] 	= $errors->get_error_message();

	} else {
		$user_id = wp_create_user( $user_login, $user_pass, $user_email );
		if ( ! $user_id ) {
			$errors->add( 'registerfail', sprintf( __( '无法注册，请联系管理员','tinection' ), get_option( 'admin_email' ) ) );
			$result['success']	= 0;
			$result['message'] 	= $errors->get_error_message();		
		} else{
			update_user_option( $user_id, 'default_password_nag', true, true ); //Set up the Password change nag.
			wp_new_user_notification( $user_id, $user_pass );	
			$result['success']	= 1;
			$result['message']	= esc_html__( '注册成功','tinection' );

			//自动登录
			// wp_set_current_user($user_id);
			// wp_set_auth_cookie($user_id);
			// $result['loggedin']	= 1;
		}

	}	
	

	header( 'content-type: application/json; charset=utf-8' );
	echo json_encode( $result );
	wp_die();	
}


add_action( 'wp_ajax_ajax_follow', 'ajax_follow' );
add_action( 'wp_ajax_nopriv_ajax_follow', 'ajax_follow' );

//ajax关注
function ajax_follow () {
	global $current_user; 
	$userid = $_REQUEST['userid'];
	$followid = $current_user->ID;

	$result = [];


	global $wpdb;
	$getNumSql = 'SELECT count(*) FROM follow where userid = ' . $userid . ' and followid = ' . $followid;
	
	$num = $wpdb->get_var( $getNumSql );

	if ($num > 0) {
		$id = $wpdb -> delete("follow", array("userid" => $userid, "followid" => $followid), array("%s", "%s"));
		$result['status'] = '0';
	} else {
		$datetime = date('Y-m-d H:i:s');

		$id = $wpdb -> insert("follow", array("userid" => $userid, "followid" => $followid, "datetime" => $datetime), array("%s", "%s", "%s"));
		$result['status'] = '1';
	}

	header( 'content-type: application/json; charset=utf-8' );
	echo json_encode( $result );
	wp_die();	
}


//判断是否关注
function isFollow ($userid, $followid) {
	global $wpdb;
	$sql = 'SELECT count(*) FROM follow where userid = ' . $userid . ' and followid = ' . $followid;	
	$num = $wpdb->get_var( $sql );

	if ($num > 0) {
		$result = true;
	} else {
		$result = false;
	}

	return $result;
}

//获取关注数量
function getFollowCount ($followid) {
	global $wpdb;
	$sql = 'SELECT count(*) FROM follow where followid = ' . $followid;	
	$num = $wpdb->get_var( $sql );	
	return $num;
}

//获取我的关注
function getMyFollow () {
	global $current_user; 
	$id = $current_user->ID;

	global $wpdb;
	$sql = 'SELECT userid FROM follow where followid = ' . $id . ' order by datetime desc';		
	$vars = $wpdb -> get_results($sql, ARRAY_A);

	$result = '<ul>';
	foreach($vars as $var) {
		$user = get_user_by( id, $var['userid'] );

		$url = site_url() . '/author/' . $user->user_login;

		$result .= '<li>' . get_avatar($var['userid']) . '<div class="content-box"><p class="username">' . $user->display_name . '</p><p class="description">文章：<a href="'.$url.'">'. count_user_posts($var['userid'], array('post'), true) .'</a></p><button type="button" class="mf-btn" data-id="' . $var['userid'] . '">取消关注</button></div></li>';
	}	
	$result .= '</ul>';

	return $result;
}


//获取粉丝数量
function getFansCount ($userid) {
	global $wpdb;
	$sql = 'SELECT count(*) FROM follow where userid = ' . $userid;	
	$num = $wpdb->get_var( $sql );	
	return $num;
}

//获取我的粉丝
function getMyFans () {
	global $current_user; 
	$id = $current_user->ID;

	global $wpdb;
	$sql = 'SELECT followid FROM follow where userid = ' . $id . ' order by datetime desc';		
	$vars = $wpdb -> get_results($sql, ARRAY_A);

	$result = '<ul>';
	foreach($vars as $var) {
		$user = get_user_by( id, $var['followid'] );

		$disabled = '';
		$text = '关注TA';
		if (isFollow($var['followid'], $id)) {
			$disabled = 'disabled="disabled"';
			$text = '已关注';
		}

		$url = site_url() . '/author/' . $user->user_login;

		$result .= '<li>' . get_avatar($var['followid']) . '<div class="content-box"><p class="username">' . $user->display_name . '</p><p class="description">文章：<a href="'.$ur.'">'. count_user_posts($var['followid'], array('post'), true) .'</a></p><button type="button" class="mf-btn" data-id="' . $var['followid'] . '"' . $disabled . '>' . $text . '</button></div></li>';
	}	
	$result .= '</ul>';

	return $result;
}




function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');









//主题设置
require("themesetting.php");



?>

