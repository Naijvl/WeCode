<!DOCTYPE html>
<html  <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="UTF-8">
        <title><?php echo trim(wp_title('',0)); if(!is_home()) echo ' - '; bloginfo( 'name' ); ?></title>

        <link rel="stylesheet" href="<?= wc_asset('press/font/font.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?= wc_asset('press/css/404.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?= wc_asset('press/css/app.css'); ?>" type="text/css" media="screen" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
  
        <header>
            <div class="wrapper">
                <div id="logo">
                    <a href="/"><img src="<?= wc_asset('press/images/logo.png'); ?>" alt=""></a>
                    <span id="logoline"></span>
                </div>

                <div id="nav">
                    <?php  wp_nav_menu($args = array("menu_class" => "nav","container" => "nav","depth" => 1,"walker" => new description_walker()));?>
                </div>

                <div id="search">
                    <?php dynamic_sidebar( 'widget_default2' ); ?>
                    <form method="get" id="global-search" action="<?php bloginfo('home'); ?>">
                        <input type="text" class="input-search" name="s" value="<?php echo wp_specialchars($s, 1); ?>" size="20" placeholder="搜索">
                        <span class="submit-btn"><i class="ico ico-search"></i></span>
                    </form>           
                </div> 

                <div id="login-wrapper">

                    <?php if ( is_user_logged_in() ) : ?>
                    <div class="logined">
                        <?php 
                            global $current_user;                                
                            echo "<div class='photo'>" . get_avatar($current_user->user_email, 30, 30 ) ."</div>" . $current_user->display_name;
                        ?>

                        <div id="menu">
                            <ul>
                                <li><a href="<?= home_url() ?>/ucenter">个人中心</a></li>
                                <?php 
                                    global $current_user;
                                    if(!empty($current_user->roles) && in_array('administrator', $current_user->roles)) {
                                        echo '<li><a href="'. home_url() . '/wp-admin' .'">后台管理</a></li>';
                                    }
                                 ?>
                                <li><a href="<?php echo wp_logout_url( home_url() ); ?>">退出</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php else : ?>
                    <div class="unlogined">
                        
                        <a class="signbtn loginbtn" data-sign="0" href="javascript:void(0)"><?php _e(' 登录','tinection'); ?></a>
                        <a class="signbtn register">注册</a>
                    </div>
                    <?php endif; ?>
                </div>                    
            </div>

        </header>




        <div id="overlay" class="overlay">
            <div class="small-wrapper">
                <div class="close-btn">
                    <i class="ico ico-close"></i>
                </div>
                <div id="tab">
                    <a class="active">登录</a>
                    <a>注册</a>
                    <i class="line"></i>
                </div>
                <div id="message-tips"></div>
                <div class="part loginPart active">
                    <form id="login" action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
                        <div class="form-wrapper">
                            <label class="icon" for="username"><i class="ico ico-user"></i></label>
                            <input class="input-control" id="username" type="text" placeholder="请输入用户名" name="username" required="" aria-required="true">                            
                        </div>
                        
                        <div class="form-wrapper">
                            <label class="icon" for="password"><i class="ico ico-lock"></i></label>
                            <input class="input-control" id="password" type="password" placeholder="请输入密码" name="password" required="" aria-required="true">
                        </div>
                        
                        <div class="form-wrapper">                          
                            <input class="submit part-btn fast-login" type="button" value="登录" name="submit">                                              
                        </div>

                        <div class="form-wrapper">
                            <a class="lost" href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword"><?php _e('忘记密码 ?','tinection'); ?></a>
                        </div>
                        

                        
                    </form>
                </div>

                <div class="part registerPart">
                    <form id="register" action="<?php bloginfo('url'); ?>/wp-login.php?action=register" method="post">
                        
                        <div class="form-wrapper">
                            <label class="icon" for="username1"><i class="ico ico-user"></i></label>
                            <input class="input-control" id="username1" type="text" name="username1" placeholder="账号" aria-required="true">
                        </div>
                        <div class="form-wrapper">
                            <label class="icon" for="useremail1"><i class="ico ico-email"></i></label>
                            <input class="input-control" id="useremail1" type="text" name="useremail1" placeholder="常用邮箱" aria-required="true">
                        </div>
                        <div class="form-wrapper">
                            <label class="icon" for="password1"><i class="ico ico-lock"></i></label>
                            <input class="input-control" id="password1" type="password" name="password1" placeholder="密码最小长度为6" aria-required="true">
                        </div>
                        <div class="form-wrapper">
                            <label class="icon" for="password2"><i class="ico ico-repassword"></i></label>
                            <input class="input-control" type="password" id="password2" name="password2" placeholder="再次输入密码" aria-required="true">
                        </div>
                        <div class="form-wrapper">
                            <input class="submit part-btn fast-register" type="button" value="注册" name="submit">
                        </div>
                    </form>
                </div>                
            </div>

        </div>


     
        <script>
            var ajaxUrl = '<?php echo admin_url('admin-ajax.php')?>';
            var currentUrl = '<?php echo get_current_page_url() ?>';
        </script>