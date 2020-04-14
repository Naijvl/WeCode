<?php

/**
 * 非管理员用户不显示更新提示。
 * ToDo: 尚不完善，不起多少作用。以后要改进
 */
function fatwp_remove_update_nag()
{
	if ( ! current_user_can( 'manage_options' ) ) {
		remove_action( 'init', 'wp_version_check', 2 );
		remove_action( 'admin_notices', 'update_nag', 3 );
		remove_action( 'admin_notices', 'maintenance_nag', 10 );

		// 禁止更新翻译文件。来自 Easy Updates Manager
		add_filter( 'auto_update_translation', '__return_false' );

		// 禁止更新主题 （v3.7+）。来自 Easy Updates Manager
		add_filter( 'auto_update_theme', '__return_false' );

		// 禁止自动更新插件（ v3.7+）。来自 Easy Updates Manager
		add_filter( 'auto_update_plugin', '__return_false' );
	}

	// 禁止更新翻译文件。来自 Easy Updates Manager
	add_filter( 'auto_update_translation', '__return_false' );

	// 禁止更新主题 （v3.7+）。来自 Easy Updates Manager
	add_filter( 'auto_update_theme', '__return_false' );

	// 禁止更新主题 （v3.7+）。来自 Easy Updates Manager
	add_filter( 'auto_update_theme', '__return_false' );

}

add_action('admin_head', 'fatwp_remove_update_nag' );
