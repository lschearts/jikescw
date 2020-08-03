<?php



// IN OPTIONS
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
require_once dirname(__FILE__) . '/options-framework.php';
require_once dirname(__FILE__) . '/options.php';



// JPEG QUALITY
function _jpeg_quality($arg)
{
    return 100;
}
add_filter('jpeg_quality', '_jpeg_quality', 10);

// EDITOR STYLE
add_editor_style(get_stylesheet_directory_uri() . '/editor-style.css');

if (!function_exists('_add_editor_buttons')):

    function _add_editor_buttons($buttons)
{
        $buttons[] = 'fontselect';
        $buttons[] = 'fontsizeselect';
        $buttons[] = 'cleanup';
        $buttons[] = 'styleselect';
        $buttons[] = 'del';
        $buttons[] = 'sub';
        $buttons[] = 'sup';
        $buttons[] = 'copy';
        $buttons[] = 'paste';
        $buttons[] = 'cut';
        $buttons[] = 'image';
        $buttons[] = 'anchor';
        $buttons[] = 'backcolor';
        $buttons[] = 'wp_page';
        $buttons[] = 'charmap';
        return $buttons;
    }
    add_filter("mce_buttons", "_add_editor_buttons");

endif;

// MD5 FILENAME
if (_hui('newfilename') && !function_exists('_new_filename')):

    function _new_filename($filename)
{
        $info = pathinfo($filename);
        $ext  = empty($info['extension']) ? '' : '.' . $info['extension'];
        $name = basename($filename, $ext);
        return substr(md5($name), 0, 15) . $ext;
    }
    add_filter('sanitize_file_name', '_new_filename', 10);

endif;

// COMMENT Ctrl+Enter
if (!function_exists('_admin_comment_ctrlenter')):

    function _admin_comment_ctrlenter()
{
        echo '<script type="text/javascript">
                jQuery(document).ready(function($){
                    $("textarea").keypress(function(e){
                        if(e.ctrlKey&&e.which==13||e.which==10){
                            $("#replybtn").click();
                        }
                    });
                });
            </script>';
    };
    add_action('admin_footer', '_admin_comment_ctrlenter');

endif;

// ON THEME INIT
if (isset($_GET['activated'])) {
    // 检测是否有qqid字段，没有添加，为qq登陆提供基础
    global $wpdb, $wppay_table_name;
    $var = $wpdb->query("SELECT qqid FROM $wpdb->users");
    if (!$var) {
        $wpdb->query("ALTER TABLE $wpdb->users ADD qqid varchar(100)");
    }
    // 插入订单表
    if ($wpdb->get_var("show tables like '{$wppay_table_name}'") != $wppay_table_name) {
        $wpdb->query("CREATE TABLE `" . $wpdb->prefix . "wppay_order` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user_id` int(11) DEFAULT NULL COMMENT '用户id',
          `post_id` int(11) DEFAULT NULL COMMENT '关联文章id',
          `order_num` varchar(50) DEFAULT NULL COMMENT '本地订单号',
          `order_price` double(10,2) DEFAULT NULL COMMENT '订单价格',
          `order_type` tinyint(3) DEFAULT '0' COMMENT '订单类型；0为止；1文章；2会员',
          `pay_type` tinyint(3) DEFAULT '0' COMMENT '支付类型；0无；1支付宝；2微信',
          `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
          `pay_time` int(10) DEFAULT NULL COMMENT '支付时间',
          `pay_num` varchar(50) DEFAULT NULL COMMENT '支付订单号',
          `status` tinyint(3) DEFAULT '0' COMMENT '状态；0 未支付；1已支付；2失效',
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COMMENT='订单数据表';");
    }
    // THUMBNAIL SIZE
    if (get_option('thumbnail_size_w') < 266) {
        update_option('thumbnail_size_w', 266);
        update_option('thumbnail_size_h', 330);
    }

    update_option('thumbnail_crop', 1);

    // CREATE PAGES
    $init_pages = array(
        'pages/posts-likes.php' => array('点赞排行', 'likes'),
        'pages/tags.php'        => array('热门标签', 'tags'),
        'pages/sitemap.php'     => array('网站地图', 'sitemap'),
        'pages/login.php'       => array('登录注册', 'login'),
        'pages/user.php'        => array('用户中心', 'user'),
        'pages/agree.php'   => array('用户协议', 'agree'),
        'pages/template-godown.php'   => array('跳转下载', 'gohref'),
        'pages/vip-nologin.php'   => array('VIP信息未登录', 'vipinfo'),
        'pages/findpass.php'   => array('找回密码', 'findpass'),
    );

    foreach ($init_pages as $template => $item) {

        $one_page = array(
            'post_title'  => $item[0],
            'post_name'   => $item[1],
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_author' => 1,
        );

        $one_page_check = get_page_by_title($item[0]);

        if (!isset($one_page_check->ID)) {
            $one_page_id = wp_insert_post($one_page);
            update_post_meta($one_page_id, '_wp_page_template', $template);
        }

    }

    

}

