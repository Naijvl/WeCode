const mix = require('laravel-mix');

let path = '../static';
let ASSET_URL = '//static.wecode.local/';


/**
 * 用传统文件名方式强制更新浏览器缓存。启用时注意：
 * 1. browserSync 会失效。
 * 2. 部署维护麻烦。需要先删除服务器上的旧版文件，而不能简单替换。
 */
if (mix.inProduction()) {
//     mix.webpackConfig({
//         output: {
//             filename: '[name]-[hash:6].js'
//         }
//     });
    path = '../../dist/static';
	ASSET_URL = '//static.wecode.com/';
}

mix.setPublicPath(path);


mix.webpackConfig({
	module: {
		rules: [
			{
				test: /fatwp.*login\.scss$/,
				use: [
					{
						loader: "sass-loader",
						options: {
							implementation: require("sass"),
							functions: {
								// 为 scss 提供一个函数来处理资源 URL 的问题
								// 参见 https://itnext.io/sharing-variables-between-js-and-sass-using-webpack-sass-loader-713f51fa7fa0
								"asset_url($keys)": function(keys) {
									let result = keys;
									result.setValue("url(" + ASSET_URL + keys.getValue() + ")");
									return result;
								}
							}
						}
					}
				]
			}
		]
	}
});


mix.options({
        processCssUrls: false
    });


// mix.sass('assets/themes/la/assets/sass/app.scss', path + '/press/css')
// 	.copy('assets/themes/la/assets/js/app.js', path + '/press/js')
// ;


if (mix.inProduction()) {
    mix.version();
}

