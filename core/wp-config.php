<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

if ( ! defined( 'WECODE_ROOT' ) ) {
    define( 'WECODE_ROOT', dirname( dirname( __FILE__ ) ) );
}

define('WC_URL_BASE', 'wecode.local');


define('WP_CONTENT_DIR', WECODE_ROOT . '/assets');
define('WP_CONTENT_URL', 'http://wecode.local/assets');



// 禁止 WordPress 自动更新
define( 'WP_AUTO_UPDATE_CORE', false );


// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'wecode');

/** MySQL数据库用户名 */
define('DB_USER', 'root');

/** MySQL数据库密码 */
define('DB_PASSWORD', '');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'RKR|;lekNj$CAW Lo1e77@I3`^FYpX~Z9Jwme|I>75%;,uCNaH7EPUu;MW`wjS_]');
define('SECURE_AUTH_KEY',  'lek=/,W:UsV#UzM6`,+4%D5Pyq<EDCK;e ^p_7MRYy C]JY}=+E#H!) AXyyiXz3');
define('LOGGED_IN_KEY',    'W<^Zw.r<,0VWP0E}ou_fKkh<Co7%<4[g?~u0TCSI9|2R?o3Z&RetVmKS*m?~x`C-');
define('NONCE_KEY',        '.&dPkh;BBkUB0DW@Xe&6p3]t{mHdQC!%O!Fb~YkiIyXt3Wy`hCS4@/OJL}}(imRv');
define('AUTH_SALT',        '# MT5nrAR&qnDBY-R&=Ep+t_u )6fS8K(5Jau2}a{XWX[F1-g(>7HI(Xk*^^!NyY');
define('SECURE_AUTH_SALT', '0)]{hcoNw0GO3|u+d&2u-gzC3UD1z|;gW{axC&S#z}5iLZ^$_-ar`SB F):n=#5w');
define('LOGGED_IN_SALT',   '/D9@Twv8G9a|hxufKIM4#Mw+dzxp/@4.i>TX#Ux4ejH?vl;n!(Xnmdq9z2#@Q(8V');
define('NONCE_SALT',       'VP{AV/Lql^u.hUj#+z@^sOra=8y/eW+YmW~:h6gd21fpc)PW!tEA:,uWysk|gfw%');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wc_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

define('WP_SAVEQUERY', true);
define('DISALLOW_FILE_EDIT', true);
// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );

// Disable display of errors and warnings
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', true );

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
