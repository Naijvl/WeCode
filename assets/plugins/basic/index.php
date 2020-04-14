<?php
/**
 * @package basic
 * @version 1.0
 */
/*
Plugin Name: 基础库
Plugin URI:
Description:
Author: Gin
Version: 1.0
Author URI:
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


define( 'WC_PATH', dirname( __FILE__ ) . "/" );

define( 'WC_DIR_URI', plugin_dir_url( __FILE__ ) . 'assets/' );



/**
 * 统一返回静态资源（CSS、JS、图片）的 URL。
 *
 * @param string $path
 *
 * @return string
 */
function wc_asset( $path = '' )
{
	return 'http://static.' . WC_URL_BASE . ( empty( $path ) ? $path : '/' . $path );
}




/**
 * 定制后台风格。
 */
function wc_theme_admin()
{
	wp_enqueue_style( 'wc-admin-style', wc_asset('press/admin/css/admin.css' ) );
	wp_enqueue_style( 'wc-button-style', wc_asset( 'press/admin/css/button.css' ) );
	wp_enqueue_script( 'wc-admin-script', wc_asset( 'press/admin/js/wc-admin.js' ), [ 'jquery' ], false, true );
}

add_action( 'admin_enqueue_scripts', 'wc_theme_admin', 1 );



/**
 * 定制登录页。
 */
function wc_theme_login()
{
	wp_enqueue_style( 'wc-login-css', wc_asset( 'press/admin/css/login.css' ) );
}

add_action( 'lost_password', 'wc_theme_login', 1 );
add_action( 'login_form', 'wc_theme_login', 1 );
add_action( 'register_form', 'wc_theme_login', 1 );



/**
 * 去掉Wordpress LOGO
 */
function wc_remove_logo( $wp_toolbar ) {
	$wp_toolbar->remove_node( 'wp-logo' );
	$wp_toolbar->remove_node( 'view-site' );
}

add_action( 'admin_bar_menu', 'wc_remove_logo', 999 );



require_once 'inc/update-policy.php';
require_once 'inc/template-helper.php';
