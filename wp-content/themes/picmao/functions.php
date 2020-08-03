<?php
//定义斜杠的常量简体  用于linux
define('DS',DIRECTORY_SEPARATOR);
require_once get_stylesheet_directory() . '/inc/pme-picmore.php';
//搜索页面缩略图
function _search_get_post_thumbnail() { 
    return ('video'==get_post_format()?'<span class="thumb-video"><i class="fa">&#xe62e;</i></span>':'').'<img src="'._the_theme_thumb().'" data-src="'. _get_post_thumbnail_url() .'" class="thumb">';
}
require_once get_stylesheet_directory() . '/wpsearch/intelligent-search.php';
 
//本程序由picmore开发，盗版用户出现支付问题一概不负责。正版请联系QQ243574967购买
