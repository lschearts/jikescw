<?php

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	
	return 'rizhuti';
}


/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'face' => 'yahei',
		'style' => 'normal',
		'color' => '#383121' );
		
	$typography_content = array(
		'size' => '13px',
		'face' => 'yahei',
		'style' => 'normal',
		'color' => '#000000' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	// $options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}



	$options_linkcats = array();
	$options_linkcats_obj = get_terms('link_category');
	foreach ( $options_linkcats_obj as $tag ) {
		$options_linkcats[$tag->term_id] = $tag->name;
	}



	// If using image radio buttons, define a directory path
	$adsdesc =  '可添加任意广告联盟代码或自定义代码';

	$options_cate_url=array();

	$qrcode[1] = get_template_directory_uri().'/img/qrcode/weixin.png';
	$qrcode[2] = get_template_directory_uri().'/img/qrcode/zhifubao.png';
	$qrcode[3] = get_template_directory_uri().'/img/qrcode/qrcode.png';
	$imgurl = get_template_directory_uri() . '/img/';
	//$logo = get_stylesheet_directory_uri() . '/img/logo.png';
	$logo = get_template_directory_uri().'/img/logo.png';
	$login_bg_img = 'http://wx2.sinaimg.cn/large/006y3zrPly1g2g48mpxcbj31z418gnhp.jpg';
	$oauth_qq_domain = get_stylesheet_directory_uri() . '/oauth/qq/callback.php';
	
	$admin_url = admin_url();

	$options = array();


	


	
		




	
	$options[] = array(
		'name' => '基本',
		'type' => 'heading');


	$options[] = array(
		'name' => '导航栏白色风格',
		'id' => 'theme_nav_skin',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');
	$options[] = array(
		'name' => '网站开启(用于维护系统)',
		'id' => 'weihu_net',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启');
	$options[] = array(
		'name' => '网站维护不显示IP',
		'id' => 'no_weihu_ip',
		'desc' => '网站开启维护，这个IP用户依然能看到网站',
		'type' => 'text',
		'class' => 'mini');
	// $options[] = array(
	// 	'id' => 'theme_skin_custom',
	// 	'std' => "",
	// 	'desc' => '不喜欢上面提供的颜色，你好可以在这里自定义设置，如果不用自定义颜色清空即可（默认不用自定义）',
	// 	'type' => "color");



	$options[] = array(
		'name' => 'Logo ',
		'id' => 'logo_src',
		'desc' => 'Logo 最大高：40px；建议尺寸：180*40px 格式：png',
		'std' => $logo,
		'type' => 'upload');

	$options[] = array(
		'name' => '登录页面Logo ',
		'id' => 'login_logo_src',
		'desc' => 'Logo 最大高：40px；建议尺寸：180*40px 格式：png',
		'std' => $logo,
		'type' => 'upload');

	$options[] = array(
		'name' => '登陆注册页面背景图片',
		'id' => 'login_bg_img',
		'desc' => '建议尺寸：1920*1080px',
		'std' => $login_bg_img,
		'type' => 'upload');

	$options[] = array(
		'name' => '全站连接符',
		'id' => 'connector',
		'desc' => '一经选择，切勿更改，对SEO不友好，一般为“-”或“_”',
		'std' => _hui('connector') ? _hui('connector') : '/',
		'type' => 'text',
		'class' => 'mini');

	// $options[] = array(
	// 	'name' => 'PC端导航栏登录注册'.'(v0.8+)',
	// 	'id' => 'sign_s',
	// 	'type' => "checkbox",
	// 	'std' => false,
	// 	'desc' => '开启');

	$options[] = array(
		'name' => 'JS文件托管（可大幅提速JS加载）',
		'id' => 'js_outlink',
		'std' => "no",
		'type' => "radio",
		'options' => array(
			'no' => '不托管',
			//'baidu' => '百度'
		));

	// $options[] = array(
	// 	'name' => '导航栏暗黑风格'.'(v0.8+)',
	// 	'id' => 'nav_dark_style',
	// 	'type' => "checkbox",
	// 	'std' => true,
	// 	'desc' => '开启');

	$options[] = array(
		'name' => '分类url去除category字样',
		'id' => 'no_categoty',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启'.'（该功能和no-category插件作用相同，可停用no-category插件）');

	$options[] = array(
		'name' => '上传文件重命名',
		'id' => 'newfilename',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启'.'（该功能会针对上传的文件和图片重命名，如：2ab6537935def43.jpg）');

	
	$options[] = array(
		'name' => '自动将文章中上传的第一张图片缩略图设为特色图像',
		'id' => 'set_postthumbnail',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启'.'（如果没有添加文章缩略图，将自动获取文章中的第一张图片的缩略图设置为特色图像，开启后只在保存和发布文章时有效）');

	$options[] = array(
		'name' => '自动将文章中的第一张图片设为特色图像',
		'id' => 'thumb_postfirstimg_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启'.'（如果文章没有缩略图，自动将文章中的第一张图片设为特色图像）');

	$options[] = array(
		'id' => 'thumb_postfirstimg_lastname',
		'std' => '',
		'desc' => '自动缩略图后缀将自动加入文章第一张图的地址后缀之前。比如：文章中的第一张图地址是“aaa/bbb.jpg”，此处填写的字符是“-266x330”，那么缩略图的实际地址就变成了“aaa/bbb-266x330.jpg”。默认为空。',
		'type' => 'text');

	


	



	

	

	












	
	$options[] = array(
		'name' => 'SEO',
		'type' => 'heading');


	$options[] = array(
		'name' => '首页关键字(keywords)',
		'id' => 'keywords',
		'std' => 'picmao中国原创,原创,原创作品,创意,design,designer,平面设计,UI设计,GUI,网页设计,网站设计,插画,动漫,摄影,插画,摄影,经验,教程,矢量素材,素材下载,素材,png图标,高清图片,设计素材,图片,商业图片,picmao,图片库,摄影图片,插画素材,图麦多,矢量插画,创意图片',
		'desc' => '关键字有利于SEO优化，建议个数在5-10之间，用英文逗号隔开',
		'settings' => array(
			'rows' => 4
		),
		'type' => 'textarea');

	$options[] = array(
		'name' => '首页描述(description)',
		'id' => 'description',
		'std' => 'picmao提供专业优秀的设计素材和设计软件所需高效插件，以及丰富设计教程正版请咨询QQ243574967',
		'desc' => '描述有利于SEO优化，建议字数在30-70之间',
		'settings' => array(
			'rows' => 4
		),
		'type' => 'textarea');

	$options[] = array(
		'name' => '网站自动添加关键字和描述',
		'id' => 'site_keywords_description_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启'.'（开启后所有页面将自动使用主题配置的关键字和描述，具体规则可以自行查看页面源码得知）');

	$options[] = array(
		'name' => '文章关键字和描述自定义',
		'id' => 'post_keywords_description_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启'.'（开启后你需要在编辑文章的时候书写关键字和描述，如果为空，将自动使用主题配置的关键字和描述；开启这个必须开启上面的“网站自动添加关键字和描述”开关）');









	




	$options[] = array(
		'name' => '列表',
		'type' => 'heading');


	$options[] = array(
		'name' => "列布局",
		'desc' => '检测到本站缩略图尺寸为：'. get_option('thumbnail_size_w') .' x '. get_option('thumbnail_size_h') .'，请根据缩略图尺寸（设置-多媒体中可设置）合理选择列布局',
		'id' => "list_cols",
		'std' => "4",
		'type' => "radio",
		'options' => array(
			//'5' => '5列布局（建议缩略图宽小于300）',
			'4' => '4列布局（建议缩略图宽介于300-399之间）',
			//'3' => '3列布局（建议缩略图宽介于400-619之间）',
			//'2' => '2列布局（建议缩略图宽大于620）',
		)
	);

	$options[] = array(
		'name' => '列布局：图文一体',
		'id' => 'list_imagetext',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启 （开启后文字会显示在图片上方）');

	$options[] = array(
		// 'name' => '列布局：小部件触显',
		'id' => 'list_hover_plugin',
		'type' => "checkbox",
		'std' => false,
		'desc' => 'PC端开启小部件触显 （开启后鼠标触发的时候显示小部件）');

	$options[] = array(
		'name' => '列布局：小部件开启',
		'id' => 'post_plugin',
		'std' => array(
			'view' => 1,
			'like' => 0,
			'comm' => 0
		),
		'type' => "multicheck",
		'options' => array(
			'view' => ' 阅读量（无需安装插件） ',
			// 'like' => ' 点赞（无需安装插件） ',
			'comm' => ' 评论数 '
		));

	$options[] = array(
		'name' => '智能热门',
		'id' => 'excerpt_hot_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启（开启后如果文章满足以下智能热门限制就会在列表的最前展示）');

	$options[] = array(
		'name' => '智能热门限制多少天内的文章',
		'id' => 'excerpt_hot_date',
		'std' => 7,
		'desc' => '默认：7，指限制为7天内发布的文章',
		'type' => 'text');

	$options[] = array(
		'name' => '智能热门限制文章数',
		'id' => 'excerpt_hot_items',
		'std' => 2,
		'desc' => '默认：2，指限制为最多2个文章',
		'type' => 'text');

	$options[] = array(
		'name' => '智能热门限制文章阅读量',
		'id' => 'excerpt_hot_minviews',
		'std' => 200,
		'desc' => '默认：200，指限制文章阅读量大于200',
		'type' => 'text');
	$options[] = array(
		'name' => '手机端使用新闻列表',
		'id' => 'phone_list_news',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启');

	$options[] = array(
		'name' => '列表图片鼠标触发放大效果',
		'id' => 'list_thumb_hover_action',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');


	$options[] = array(
		'name' => '默认文章缩略图',
		'id' => 'post_default_thumb',
		'std' => get_stylesheet_directory_uri() . '/img/thumb.png',
		'desc' => '用于：文章默认缩略图的展示。图片尺寸为：'. get_option('thumbnail_size_w') .' x '. get_option('thumbnail_size_h'),
		'type' => 'upload');


	$options[] = array(
		'name' => '新窗口打开列表文章',
		'id' => 'target_blank',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');

	

	$options[] = array(
		'name' => 'picmao分页模式',
		'id' => 'paging_type',
		'std' => "multi",
		'type' => "radio",
		'options' => array(
			//'next' => ' 上一页 和 下一页',
			'multi' => ' 显示页码，如：上一页 1 2 3 4 5 下一页'
		));

	

	$options[] = array(
		'name' => 'PC端分页无限加载',
		'id' => 'ajaxpager_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启');

	$options[] = array(
		'name' => '手机端分页无限加载',
		'id' => 'ajaxpager_s_m',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启');

	$options[] = array(
		'name' => '分页无限加载页数',
		'id' => 'ajaxpager',
		'std' => 10,
		'desc' => '为0时表示不开启分页无限加载功能，默认为10',
		'type' => 'text');





	


	













	
	$options[] = array(
		'name' => '首页+布局模块',
		'type' => 'heading');


	$options[] = array(
		'name' => '首页顶部风格',
		'id' => 'home_header_style',
		'desc' => '选择风格后保存，则会出现该风格的设置选项',
		'options' => array(
			'style_0' => '幻灯片布局',
			//'style_1' => 'Banner+搜索框'
		),
		'std' => 'style_0',
		'type' => "radio"
	);

	//header用户登录展开VIP广告画面
	 $options[] = array(
	        'id' => 'header_vip_img',
	        'name'=>'导航用户登录展开VIP广告画面',
	        'desc' => '图片，建议尺寸：'.'245*118',
	        'std' => 'http://img-bg.sjoneone.com/dsadasasdasdasdaswewre88dasdas989872.jpg',
	        'type' => 'upload');
	 ////首页搜索器下热词搜索
	

		$options[] = array(
	        'name' => '搜索的热词',
	        'id' => 'hot-search-box',
	        'desc' => '请用英文-来链接词语8个',
	        'std' => 'C4D-鼠年-园林-标示牌-背景墙-海报-电商',
	        'type' => 'text');
		

	
	// 幻灯片设置选项
		$sider_url[1]='www.sjoneone.com';
		$sider_url[2]='https://bufu.taobao.com/category.htm?spm=a1z10.1-c-s.w5001-18229804102.5.55cd23fckJ8tu0&search=y&scene=taobao_shop';//定制淘宝设计
		$sider_url[3]='www.qq.com';
		$home_slide['1'] = 'http://wx2.sinaimg.cn/large/006y3zrPly1g3deht8txfj31hc0egwho.jpg';
		$home_slide['2'] = 'http://wx4.sinaimg.cn/large/006y3zrPly1g3dw748lolj31hc0egtj0.jpg';
		$home_slide['3'] = 'http://wx1.sinaimg.cn/large/006y3zrPly1g2sh5gazr8j31hc0d2gy3.jpg';

	if (_hui('home_header_style','style_0') =="style_0") {
		$options[] = array(
        'name' => '幻灯片排序',
        'id' => 'focusslide_sort',
        'desc' => '默认：1 2 3(设置1 3 5 则按顺序123，数字用空格隔开)',
        'std' => '1 2 3',
        'type' => 'text');
		
		for ($i=1; $i <= 3; $i++) {    
	    $options[] = array(
	        'name' => '幻灯片-图'.$i,
	        'id' => 'focusslide_title_'.$i,
	        'desc' => '标题',
	        'std' => '设计1+1',
	        'type' => 'text');

	    $options[] = array(
	        'id' => 'focusslide_desc_'.$i,
	        'desc' => '描述',
	        'std' => '设计1+1提供专业优秀的设计素材和设计软件所需高效插件,以及丰富设计教程,欢迎来到设计内容平台,这是最纯洁的分享',
	        'type' => 'text');

	    $options[] = array(
	        'id' => 'focusslide_href_'.$i,
	        'desc' => '链接',
	        'std' => $sider_url[$i],
	        'type' => 'text');

	    $options[] = array(
	        'id' => 'focusslide_blank_'.$i,
	        'std' => true,
	        'desc' => '新窗口打开',
	        'type' => 'checkbox');
	    
	    $options[] = array(
	        'id' => 'focusslide_src_'.$i,
	        'desc' => '图片，建议尺寸：'.'1920*600/1906*520',
	        'std' => $home_slide[$i],
	        'type' => 'upload');
		}
	}

	//搜索设置选项
	if (_hui('home_header_style','style_0') =="style_1") {
	
	    $options[] = array(
	        'name' => '搜索大标题',
	        'id' => 'focusslide_seracht',
	        'desc' => '标题',
	        'std' => '设计从这里开始',
	        'type' => 'text');

	    $options[] = array(
	        'id' => 'focusslide_serachimg',
	        'desc' => '图片，建议尺寸：'.'1920*600',
	        'std' => 'https://s2.ax1x.com/2019/02/17/ksXy90.jpg',
	        'type' => 'upload');
	}

	
	$options[] = array(
		'name' => '顶部专题推荐&darr;',
        'id' => 'home_special',
        'std' => true,
        'desc' => '启用后保存设置，即可以看到选择专题分类选项',
        'type' => 'checkbox');

	// 专题设置
	$options_cate_url[1]='www.baidu.com';
	$options_cate_url[2]='www.qq.com';
	$options_cate_url[3]='www.163.com';
	$options_cate_url[4]='http://wpa.qq.com/msgrd?v=3&uin=243574967&site=qq&menu=yes';


	$home_special_img_url[1]='http://wx2.sinaimg.cn/large/006y3zrPly1g3bep4g1x3j308a050mxe.jpg';
			$home_special_img_url[2]='http://wx1.sinaimg.cn/large/006y3zrPly1g3c9f3vuekj308a050mz6.jpg';
			$home_special_img_url[3]='http://wx2.sinaimg.cn/large/006y3zrPly1g3bep3x6s1j308a050758.jpg';
			$home_special_img_url[4]='https://wx4.sinaimg.cn/mw1024/006y3zrPly1g3cgbo4d7oj3085050ab3.jpg';

	if (_hui('home_special',true)) {
		
		for ($i=1; $i <= 4; $i++) {
			
			$options[] = array(
	            'name' => '	专题分类->'.$i,
	            'std' =>$options_cate_url[$i],
	            'id' => 'home_special_cat_'.$i,
	            'type' => 'text',
	            'desc' => '链接',
	            
	        );
	       
			
	        $options[] = array(
		        'id' => 'home_special_img_'.$i,
		        'desc' => '背景图片，建议尺寸：'.'300*180',
		        'std' => $home_special_img_url[$i],
		        'type' => 'upload'
		    );
		}

		
	}
	//最新推荐上方课程图标
	$options[] = array(
		'name' => '是否开启课程图标;',
        'id' => 'home_jiaocheng_pic',
        'std' => true,
        'desc' => '启用后保存设置，即可以看到首页课程选项',
        'type' => 'checkbox');
	for($i=1;$i<10;$i++){

		$options[] = array(
	        'name' => '首页教程图片路径-第'.$i.'张',
	        'id' => 'home_jiaocheng_pic_pathed_'.$i,
	        'std' => get_stylesheet_directory_uri().'/img/jiaocheng/'.$i.'.png',
	        'desc' => '建议用90pxX90px的图标',
	        'type' => 'text');
	
		$options[] = array(
	        'name' => '第'.$i.'张--跳转的链接',
	        'id' => 'home_jiaocheng_jump_urled'.$i,
	        'std' => 'http://www.sjoneone.com',
	      
	        'type' => 'text');
		$options[] = array(
	        'name' => '第'.$i.'张--文字标注',
	        'id' => 'home_jiaocheng_desed_'.$i,
	        'std' => 'ps教程',
	        
	        'type' => 'text');
	}
	
	//最新文章排除分类id
	$options[] = array(
		'name' => '首页默认最新文章不显示这些分类的文章',
		'id' => 'notinhome',
		'options' => $options_categories,
		'type' => 'multicheck');

	// CMS 
	$options[] = array(
	        'name' => '显示分类的数量',
	        'id' => 'home_cms_cat_count',
	        'std' => '3',
	        'des'=>'最少为3',
	        'type' => 'text');
	$home_cms_title[1]='设计素材';
	$home_cms_title[2]='设计工具与插件';
	$home_cms_title[3]='优品教程';
	$home_cms_desc[1]='海量素材任意下载,提供矢量图,PS素材,网站素材,PPT素材,设计模板,设计素材,以及电商淘宝素材,网站素材';
	$home_cms_desc[2]='插件让你设计工作省时省力,轻轻松松';
	$home_cms_desc[3]='丰富的教程让你提高技术开拓视野,力争设计先锋';
	if(!empty(_hui('home_cms_cat_count'))){
	for ($i=1; $i <= _hui('home_cms_cat_count'); $i++) {    
		$options[] = array(
			'name' => '首页楼层CMS模块-'.$i,
	        'id' => 'home_cms_'.$i,
	        'std' => true,
	        'desc' => '启用后保持一次设置即可看到详细对应设置选项',
	        'type' => 'checkbox');

		if (_hui('home_cms_'.$i)) {

			$options[] = array(
	        'name' => '主标题'.$i,
	        'id' => 'home_cms_title_'.$i,
	        'std' => $home_cms_title[$i],
	        'type' => 'text');

	        $options[] = array(
	        'name' => '描述'.$i,
	        'id' => 'home_cms_desc_'.$i,
	        'std' => $home_cms_desc[$i],
	        'type' => 'text');


			$options[] = array(
	            'name' => '要显示的分类-'.$i.'',
	            'std' => 1,
	            'id' => 'home_cms_cat_'.$i,
	            'type' => 'select',
	            'options' => $options_categories
	        );

	        $options[] = array(
	        'name' => '显示文章数量'.$i,
	        'id' => 'home_cms_num_'.$i,
	        'desc' => '默认：12',
	        'std' => '12',
	        'type' => 'text');

		}

	}
}


	/*$options[] = array(
		'name' => '首页底部模块',
		'type' => 'heading');



	$options[] = array(
		'name' => '底部vip推荐模块',
		'id' => 'home_f_cms_vip',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启');

	if (_hui('home_f_cms_vip',true)) {
		
		$options[] = array(
		'name' => '-->主标题',
		'id' => 'home_f_cms_vip_t',
		'std' => 'VIP会员专属特权',
		'type' => 'text');

		$options[] = array(
		'name' => '-->副标题描述',
		'id' => 'home_f_cms_vip_f',
		'std' => '注册账号或第三方登录后加入会员，三种套餐任意选，整站资源随意下',
		'type' => 'text');

		$options[] = array(
		'name' => '-->按钮名称',
		'id' => 'home_f_cms_vip_btn',
		'std' => '加入会员',
		'type' => 'text');

		$options[] = array(
		'name' => '-->链接地址',
		'id' => 'home_f_cms_vip_a',
		'std' => home_url('/user?action=vip'),
		'desc' => '',
		'type' => 'text');


	}
*/


	



	// VIP会员
	// 月费、年费、终身套餐
	// 售后支持
	// 在线支持，高质量售后群
	// 最新资源
	// 一手资源第一时间更新


	$options[] = array(
		'name' => '网站底部“由设计1+1提供”',
		'id' => 'themecopyright',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启');

	$options[] = array(
		'name' => '底部菜单',
		'id' => 'bomnav_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启（开启后可以在外观-菜单中创建新的菜单并选择菜单位置为“底部菜单”），注：该菜单不显示二级');

	$options[] = array(
		'name' => '底部备案号',
		'id' => 'beianhao',
		'std' => '',
		'desc' => '你自己的备案号',
		'type' => 'text');

$options[] = array(
		'name' => '首页最新推荐',
		'type' => 'heading');
for($i=1;$i<7;$i++){

	$options[] = array(
		'name' => '对应的字段'.$i,
		'id' => 'hot-selected-field'.$i,
		'std' => 'ppt',
		'desc' => '英文的不要留空格的文字',
		'type' => 'text');

	$options[] = array(
		'name' => '显示在按钮上的文字'.$i,
		'id' => 'hot-selected-cat-name'.$i,
		'std' => '自定义分类',
		'desc' => '不要留空格的文字',
		'type' => 'text');
	$options[] = array(
		'name' => '分类ID',
		'id' => 'hot-selected-id'.$i,
		'std' => '10',
		'desc' => '在后台分类目录里看tag_ID',
		'type' => 'text');	

}



	// 商城模块

	$options[] = array(
		'name' => '商城+支付',
		'type' => 'heading');

	// 购买信息是否发送邮件
	$options[] = array(
		'name' => '付款成功发送邮件订单消息',
		'desc' => '启用后用户付款成功，订单消息将发送到用户邮箱，需要自行在辅助功能设置好（SMTP服务），免登录用户暂无法接收',
		'id' => 'is_sened_paymail',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => '免登录购买',
		'desc' => '是否启用免登录购买下载',
		'id' => 'no_loginpay',
		'std' => '0',
		'type' => 'checkbox');


	$options[] = array(
		'name' => '免登录购买临时KEY',
		'id' => 'pay_key',
		'std' => 'zhutunetcomq2ed-key',
		'desc' => '填写一个密钥，用于免登录购买用户',
		'type' => 'text');

	$options[] = array(
		'name' => '免登录购买后有效期天数(纯数字)',
		'id' => 'pay_days',
		'std' => '7',
		'type' => 'text');

	$options[] = array(
		'name' => '会员月费价格（31天）',
		'id' => 'vip_price_31',
		'std' => '12',
		'desc' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '会员年费价格（365天）',
		'id' => 'vip_price_365',
		'std' => '98',
		'desc' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '会员终身价格（3600天）',
		'id' => 'vip_price_3600',
		'std' => '299',
		'desc' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '包月会员每天下载次数',
		'id' => 'vip_downtimeed_31',
		'std' => '10',
		'desc' => '每天允许下载的次数(出去免费下载的之外)',
		'type' => 'text');
	$options[] = array(
		'name' => '包年会员每天下载次数',
		'id' => 'vip_downtimeed_365',
		'std' => '18',
		'desc' => '每天允许下载的次数(出去免费下载的之外)',
		'type' => 'text');
	$options[] = array(
		'name' => '终身会员每天下载次数',
		'id' => 'vip_downtimeed_3600',
		'std' => '无限制',
		'desc' => '每天允许下载的次数(出去免费下载的之外)',
		'type' => 'text');	

	
	if (!_hui('is_mianqian','0')) {
	// 支付宝
	$options[] = array(
		'name' => '支付宝-扫码支付',
		'desc' => '请在您的支付宝商户生成您的密钥',
		'id' => 'alpay',
		'std' => '1',
		'type' => 'checkbox');


	$options[] = array(
		'name' => '支付宝应用appid',
		'id' => 'alipay_appid',
		'std' => '',
		'desc' => '蚂蚁金服开放平台APPID https://open.alipay.com 账户中心->密钥管理->开放平台密钥，填写添加了电脑网站支付的应用的APPID',
		'type' => 'text');
	$options[] = array(
		'name' => '支付宝私钥privatekey',
		'id' => 'alipay_privatekey',
		'std' => '',
		'desc' => '商户私钥，填写对应签名算法类型的私钥，如何生成密钥参考：https://docs.open.alipay.com/291/105971和https://docs.open.alipay.com/200/105310',
		'type' => 'textarea');
	$options[] = array(
		'name' => '支付宝公钥publickey',
		'id' => 'alipay_publickey',
		'std' => '',
		'desc' => '支付宝公钥，账户中心->密钥管理->开放平台密钥，找到添加了支付功能的应用，根据你的加密类型，查看支付宝公钥',
		'type' => 'textarea');


	// 微信支付
	$options[] = array(
		'name' => '微信-扫码支付',
		'desc' => '请在您的微信商户设置扫码回调链接：'.get_stylesheet_directory_uri() . '/shop/payment/weixin/notify.php',
		'id' => 'weixinpay',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => '微信支付商户号',
		'id' => 'weixinpay_mchid',
		'std' => '',
		'desc' => '微信支付商户号 PartnerID 通过微信支付商户资料审核后邮件发送',
		'type' => 'text');
	$options[] = array(
		'name' => '公众号或小程序APPID',
		'id' => 'weixinpay_appid',
		'std' => '',
		'desc' => '公众号APPID 通过微信支付商户资料审核后邮件发送',
		'type' => 'text');
	$options[] = array(
		'name' => '微信支付API密钥',
		'id' => 'weixinpay_apikey',
		'std' => '',
		'desc' => 'https://pay.weixin.qq.com 帐户设置-安全设置-API安全-API密钥-设置API密钥',
		'type' => 'text');

	}  //end

	// 免签约支付 is_mianqian for zlkbcodepay
	$options[] = array(
		'name' => '（NEW）使用收款宝免签约支付',
		'desc' => '开启此免签约后，企业支付无法并用，只能走免签约通道，二选一选择，适合没有接口的用户,如果想换回企业支付，请关闭免签功能，然后保存刷新即可出现企业支付设置选项',
		'id' => 'is_mianqian',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => '（NEW）收款宝AppID',
		'id' => 'zlkb_appid',
		'std' => '',
		'desc' => '前往https://codepay.zlkb.net登录查看',
		'type' => 'text');

	$options[] = array(
		'name' => '（NEW）收款宝AppSecret',
		'id' => 'zlkb_secret',
		'std' => '',
		'desc' => '前往https://codepay.zlkb.net登录查看',
		'type' => 'text');

	$options[] = array(
		'name' => '分类',
		'type' => 'heading');
	
	//给指定分类开启多条件
	for ($i=1; $i<4;$i++) { 
		
	
	$options[] = array(
		'name' => $i.'.'.'分类ID',
		'id' => 'designates_cate_'.$i,
		'std' => '',
		'desc' => '左边菜单>文章>分类目录就能看到分类ID.比如：12',
		'type' => 'text');
	//格式
   
	$options[] = array(
		'id' => 'cate_type_'.$i,
		'name' => '最高分类ID开启格式',
		'std' => '',
		'desc' => '文件格式请用英文-隔开，例如PSD-AI-CDR-EPS-PNG-JPG-MAX-DWG-C4D-SKP-AEP-PPTX-DOCX-XLS-MP4-MOV-AVI-WMF',
		'type' => 'text');

	//颜色
	/*$options[] = array(
		'name' => '开启颜色分类',
		'id' => 'is_color_img'.$i,
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');*/
	//阅读付费
	/*$options[] = array(
		'name' => '开启阅读付费',
		'id' => 'is_read_more'.$i,
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');
	
	//会员权限
	$options[] = array(
		'name' => '开启会员权限',
		'id' => 'is_member_more'.$i,
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');*/
	}
	//////////////////////////////////
	$options[] = array(
		'name' => '文章',
		'type' => 'heading');


	$options[] = array(
		'name' => '文章页顶部图像风格',
		'id' => 'single_header_img',
		'desc' => '',
		'options' => array(
			//'style_0' => '自动获取文章缩略图或第一张图片',
			'style_1' => '固定一张',
			//'style_2' => '多张图片随机获取'
		),
		'std' => 'style_1',
		'type' => "radio"
	);


	$options[] = array(
		'name' => '固定一张',
		'id' => 'single_header_img_style_1',
		'desc' => '建议尺寸（1920x600）',
		'std' => 'https://s2.ax1x.com/2019/02/17/ksjCgf.jpg',
		'type' => 'upload');
	
	$options[] = array(
			'name' => '多张图片随机获取',
			'desc' => '将多张图片地址用英文 , 隔开 (图片地址1,图片地址2,图片地址3)隔开,建议尺寸（1920x600）',
			'id' => 'single_header_img_style_2',
			'std' => '图片地址1,图片地址2,图片地址3',
			'settings'=>array('rows'=>6),
			'type' => 'textarea');


	$options[] = array(
		'name' => '文章中图片自动增加alt和title属性',
		'id' => 'post_alt_title_s',
		'type' => "checkbox",
		'std' =>true,
		'desc' => '开启，开启后自动给文章中所有的图片增加alt和title（不论之前有无alt或title），alt为文章标题，title为文章标题+网站标题');


	$options[] = array(
		'name' => '文章来源',
		'id' => 'post_from_s',
		'type' => "checkbox",
		'std' =>false,
		'desc' => '开启');
	
	$options[] = array(
		'id' => 'post_from_h1',
		'std' => '来源：',
		'desc' => '文章来源显示字样',
		'type' => 'text');

	$options[] = array(
		'id' => 'post_from_link_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => '文章来源加链接');



	$options[] = array(
		'name' => '文章阅读数',
		'id' => 'post_post_views',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");


	$options[] = array(
		'name' => '文章页尾版权',
		'id' => 'post_copyright_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');

	$options[] = array(
		'name' => '文章页尾版权：提示字符',
		'id' => 'post_copyright',
		'std' => '特别说明：本站所有资源仅供学习与参考，请勿用于商业用途,如有侵犯您的版权，请及时发邮件联系我们（243574967@qq.com），我们将尽快处理。',
		'type' => 'text');


	// $options[] = array(
	// 	'name' => '全屏查看相册模式',
	// 	'id' => 'full_gallery',
	// 	'desc' => '开启',
	// 	'std' => true,
	// 	'type' => "checkbox");


	// $options[] = array(
	// 	'name' => '全屏查看图片模式',
	// 	'id' => 'full_image',
	// 	'desc' => '开启',
	// 	'std' => true,
	// 	'type' => "checkbox");



	$options[] = array(
		'name' => '文章标签',
		'id' => 'post_tags_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");



	$options[] = array(
		'name' => '公众号',
		'id' => 'post_wechats_s',
		'desc' => '开启',
		'std' => false,
		'type' => "checkbox");

	$options[] = array(
		'name' => '公众号：二维码',
		'id' => 'post_wechat_1_image',
		'desc' => '',
		'std' => $qrcode[3],
		'type' => 'upload');

	$options[] = array(
		'name' => '公众号：标题',
		'id' => 'post_wechat_1_title',
		'std' => '微信公众号：这是个测试',
		'type' => 'text');

	$options[] = array(
		'name' => '公众号：描述',
		'id' => 'post_wechat_1_desc',
		'std' => '关注我们，每天分享更多有趣的事儿，有趣有料！',
		'type' => 'text');

	$options[] = array(
		'name' => '公众号：关注数',
		'id' => 'post_wechat_1_users',
		'std' => '163060人已关注',
		'type' => 'text');







	$options[] = array(
		'name' => '打赏',
		'id' => 'post_rewards_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");

	$options[] = array(
		'name' => '打赏：显示文字',
		'id' => 'post_rewards_text',
		'std' => '赞赏支持',
		'type' => 'text');

	$options[] = array(
		'name' => '打赏：弹出层标题',
		'id' => 'post_rewards_title',
		'std' => '觉得文章有用就支持一下文章作者',
		'type' => 'text');

	$options[] = array(
		'name' => '打赏：支付宝收款二维码',
		'id' => 'post_rewards_alipay',
		'desc' => '',
		'std' => $qrcode[2],
		'type' => 'upload');

	$options[] = array(
		'name' => '打赏：微信收款二维码',
		'id' => 'post_rewards_wechat',
		'desc' => '',
		'std' => $qrcode[1],
		'type' => 'upload');


	$options[] = array(
		'name' => '点赞',
		'id' => 'post_like_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");


	$options[] = array(
		'name' => '上一篇和下一篇文章',
		'id' => 'post_prevnext_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");


	$options[] = array(
		'name' => '相关文章+',
		'id' => 'post_related_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');

	$options[] = array(
		'name' => '相关文章：显示风格',
		'id' => 'post_related_style',
		'desc' => '',
		'options' => array(
			'style_0' => '带缩略图',
			//'style_1' => '简洁标题'
		),
		'std' => 'style_0',
		'type' => "radio"
	);


	$options[] = array(
		'name' => '相关文章：标题',
		'id' => 'related_title',
		'std' => '猜你喜欢',
		'type' => 'text');

	$options[] = array(
		'name' => '相关文章：显示数量',
		'id' => 'post_related_n',
		'std' => 8,
		'type' => 'text');


	






	$options[] = array(
		'name' => '页面',
		'type' => 'heading');

	// $options[] = array(
	// 	'name' => '全屏查看相册模式',
	// 	'id' => 'page_full_gallery',
	// 	'desc' => '开启',
	// 	'std' => true,
	// 	'type' => "checkbox");

	// $options[] = array(
	// 	'name' => '全屏查看图片模式',
	// 	'id' => 'page_full_image',
	// 	'desc' => '开启',
	// 	'std' => true,
	// 	'type' => "checkbox");

	$options[] = array(
		'name' => '点赞',
		'id' => 'page_like_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");

	$options[] = array(
		'name' => '页面模板：7天热门',
		'id' => 'page_week_count',
		'std' => 50,
		'desc' => '显示数量',
		'type' => "text");

	$options[] = array(
		'name' => '页面模板：30天热门',
		'id' => 'page_month_count',
		'std' => 50,
		'desc' => '显示数量',
		'type' => "text");


	$options[] = array(
		'name' => '页面模板：点赞排行',
		'id' => 'page_lieks_count',
		'std' => 50,
		'desc' => '显示数量',
		'type' => "text");

	$options[] = array(
		'name' => '页面模板：热门标签',
		'id' => 'page_tags_count',
		'std' => 50,
		'desc' => '显示数量',
		'type' => "text");


	// $options[] = array(
	// 	'name' => '页面模板：友情链接 链接分类',
	// 	'id' => 'page_links_cat',
	// 	'options' => $options_linkcats,
	// 	'type' => 'multicheck');


$options[] = array(
		'name' => '活动相关',
		'type' => 'heading');
$options[] = array(
		'name' => '首页活动遮罩开启',
		'id' => ' activity_end_open',
		'type' => "checkbox",
		'std' => false,
		'desc' => '开启');
	$options[] = array(
		'name' => '活动截止时间',
		'id' => 'activity_end_time',
		'desc' => '活动截止时间格式2019-12-13 22:06:00(24小时制)',
		'type' => 'text',
		'class' => 'mini');
$options[] = array(
		'name' => '活动图片',
		'id' => 'activity_piced_up',
		'std' => get_stylesheet_directory_uri() . '/img/zhezhao-adv.png',
		'desc' => '用于遮罩活动主图',
		'type' => 'upload');
$options[] = array(
		'name' => '活动期间终身会员价格',
		'id' => 'activity_price',
		'desc' => '活动期间终身会员的价格',
		'type' => 'text',
		'class' => 'mini');









	$options[] = array(
		'name' => '分享',
		'type' => 'heading');

	$options[] = array(
		'name' => '文章内容底部分享模块',
		'id' => 'post_share_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");

	$options[] = array(
		'name' => '页面内容底部分享模块',
		'id' => 'page_share_s',
		'desc' => '开启',
		'std' => true,
		'type' => "checkbox");

	$options[] = array(
		'name' => '排序',
		'id' => 'share_sort',
		'std' => '1 2 5',
		'desc' => '将以下序号填入其中，使用空格隔开即可排序，默认：1 2 3 4 5 6 7
			<div class="optionsframework-ols">
				<ol>
					<li>微信</li>
					<li>微博</li>
					<li>腾讯微博</li>
					<li>QQ</li>
					<li>QQ空间</li>
					<li>人人网</li>
					<li>豆瓣网</li>
					<li>Line</li>
					<li>Twitter</li>
					<li>Facebook</li>
				</ol>
			</div>
		',
		'type' => 'text');



	$options[] = array(
		'name' => '被分享时优先选择文章特色图像',
		'id' => 'share_post_image_thumb',
		'type' => "checkbox",
		'std' => true,
		'desc' => '开启');

	$options[] = array(
		'name' => '被分享时的默认图片',
		'id' => 'share_base_image',
		'desc' => '主要用于：分享。建议图片尺寸为：200*200',
		'type' => 'upload');

	

	








	$options[] = array(
		'name' => '社交+登录',
		'type' => 'heading');

	$options[] = array(
		'name' => 'QQ社交登录',
		'id' => 'is_oauth_qq',
		'std' => true,
		'desc' => '开启',
		'type' => 'checkbox');

	$options[] = array(
		'name' => 'qq id',
		'id' => 'oauth_qqid',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => 'qq key',
		'id' => 'oauth_qqkey',
		'std' => '',
		'type' => 'text',
		'desc' => 'QQ域名回调地址为：'.$oauth_qq_domain);


	

	$options[] = array(
		'name' => '在线咨询QQ号码',
		'id' => 'ac_qqhao',
		'desc' => '用于：网站在线咨询按钮的qq号，下载信息右上角展示',
		'std' => '243574967',
		'type' => 'text');

	$options[] = array(
		'name' => '微信二维码',
		'id' => 'ac_weixin',
		'desc' => '用于：网站顶部社交账号区域的微信展示。建议图片尺寸为：200*200',
		'std' => $qrcode[3],
		'type' => 'upload');


	






	
	$options[] = array(
		'name' => '评论',
		'type' => 'heading');

	$options[] = array(
		'name' => '评论标题',
		'id' => 'comment_title',
		'std' => '说点什么',
		'type' => 'text');

	$options[] = array(
		'name' => '评论框默认字符',
		'id' => 'comment_text',
		'std' => '点评是一种鼓励',
		'type' => 'text');

	$options[] = array(
		'name' => '评论提交按钮字符',
		'id' => 'comment_submit_text',
		'std' => '评论',
		'type' => 'text');















	$options[] = array(
		'name' => '广告位',
		'type' => 'heading' );

	$ads = array(
		'ad_list_header' => '列表头部',
		'ad_list_footer' => '列表底部',
		'ad_post_header' => '文章内容上',
		'ad_post_footer' => '文章内容下',
		'ad_post_comment' => '文章评论上',
		'ad_page_header' => '页面内容上',
		'ad_page_footer' => '页面内容下',
	);

	foreach ($ads as $key => $adtit) {
		$options[] = array(
			'name' => $adtit,
			'id' => $key.'_s',
			'std' => false,
			'desc' => '开启',
			'type' => 'checkbox');
		$options[] = array(
			'desc' => '非手机端'.' '.$adsdesc,
			'id' => $key,
			'std' => '<a href="http://www.baidu.com" target="_blank"><img   src="http://img-bg.sjoneone.com/006y3zrPly1g3dkzp2pmwj30yq02sjsg.jpg" /></a>',
			'settings'=>array('rows'=>6),
			'type' => 'textarea');
		$options[] = array(
			'id' => $key.'_m',
			'std' => '',
			'desc' => '手机端'.' '.$adsdesc,
			'settings'=>array('rows'=>6),
			'type' => 'textarea');
	}













	
	/*$options[] = array(
		'name' => '自定义代码',
		'type' => 'heading' );


	$options[] = array(
		'name' => '首页弹窗公告',
		'desc' => '开启自定义弹窗公告',
		'id' => 'iscustomnote',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => '自定义弹窗公告',
		'desc' => '写入html代码',
		'id' => 'customnotehtml',
		'std' => '',
		'type' => 'textarea');


	$options[] = array(
		'name' => '自定义CSS样式',
		'desc' => '位于&lt;/head&gt;之前，直接写样式代码，不用添加&lt;style&gt;标签',
		'id' => 'csscode',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => '自定义头部代码',
		'desc' => '位于&lt;/head&gt;之前，这部分代码是在主要内容显示之前加载，通常是CSS样式、自定义的<meta>标签、全站头部JS等需要提前加载的代码',
		'id' => 'headcode',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => '自定义底部代码',
		'desc' => '位于&lt;/body&gt;之前，这部分代码是在主要内容加载完毕加载，通常是JS代码',
		'id' => 'footcode',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => '网站统计代码',
		'desc' => '位于底部，用于添加第三方流量数据统计代码，如：Google analytics、百度统计、CNZZ、51la，国内站点推荐使用百度统计，国外站点推荐使用Google analytics',
		'id' => 'trackcode',
		'std' => '',
		'type' => 'textarea');





*/

	$options[] = array(
		'name' => '辅助功能+',
		'type' => 'heading' );

	$options[] = array(
		'name' => '分类页面开启多功能筛选栏',
		'desc' => '根据价格，类型，分类筛选',
		'id' => 'is_filters_cat',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => '筛选--分类',
		'desc' => '更加详细的多级分类',
		'id' => 'filters_cat_is',
		'std' => '1',
		'type' => 'checkbox');
	$options[] = array(
		'name' => '筛选--标签',
		'desc' => '显示与当前分类有关联的标签',
		'id' => 'is_filters_tag_is',
		'std' => '1',
		'type' => 'checkbox');



	$options[] = array(
		'name' => 'SMTP服务',
		'desc' => '是否启用SMTP服务',
		'id' => 'mail_smtps',
		'std' => '0',
		'type' => 'checkbox');
	$options[] = array(
		'name' => '发信人',
		'desc' => '请填写发件人姓名',
		'id' => 'mail_name',
		'std' => 'YouName',
		'type' => 'text');
	$options[] = array(
		'name' => '邮件服务器',
		'desc' => '请填写SMTP服务器地址',
		'id' => 'mail_host',
		'std' => 'smtp.qq.com',
		'type' => 'text');
	$options[] = array(
		'name' => '服务器端口',
		'desc' => '请填写SMTP服务器端口',
		'id' => 'mail_port',
		'std' => '465',
		'type' => 'text');
	$options[] = array(
		'name' => '邮箱帐号',
		'desc' => '请填写邮箱账号',
		'id' => 'mail_username',
		'std' => '88888888@qq.com',
		'type' => 'text');
	$options[] = array(
		'name' => '邮箱密码',
		'desc' => '请填写邮箱密码',
		'id' => 'mail_passwd',
		'std' => '123456789',
		'type' => 'text');
	$options[] = array(
		'name' => '启用SMTPAuth服务',
		'desc' => '是否启用SMTPAuth服务',
		'id' => 'mail_smtpauth',
		'std' => '1',
		'type' => 'checkbox');
	$options[] = array(
		'name' => 'SMTPSecure设置',
		'desc' => '若启用SMTPAuth服务则填写ssl，若不启用则留空',
		'id' => 'mail_smtpsecure',
		'std' => 'ssl',
		'type' => 'text');
	
	$options[] = array(
		'name' => '百度主动推送',
		'desc' => '开启 <a href="https://zhanzhang.baidu.com/linksubmit/index" target="_blank">查看主动推送效果</a>',
		'id' => 'baidu_sitemap_api',
		'std' => false,
		'type' => 'checkbox');

	// $options[] = array(
	// 	'name' => '百度主动推送api接口',
	// 	'desc' => '在百度站长平台获取主动推送接口地址，比如：http://data.zz.baidu.com/urls?site=域名&token=一组字符, <a class="button-primary" rel="nofollow" href="http://zhanzhang.baidu.com/linksubmit/index" target="_blank">主动推送接口地址</a>',
	// 	'id' => 'baidu_sitemap_api_url',
	// 	'std' => '',
	// 	'type' => 'text');




		
	return $options;
}