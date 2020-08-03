<?php 
$is_cat_= single_cat_title('', false);
$_is_top_cate_id_=category_top_parent_id(get_cat_ID($is_cat_));//当前分类的顶级分类 
$key_type_info=$_is_top_cate_id_==2?'学习':'下载';
/////////////////////////////新增
$p_meta = _hui('post_plugin');
$price = get_post_meta($post->ID,'wppay_price',true);
$vip = get_post_meta($post->ID,'wppay_vip_auth',true);
//封面加视频
if(is_category()||is_home()||is_search()):

        echo "<script> $('iframe').css({'width':'268px','height':'160px'});</script>";
    endif;
$cols = _hui('list_cols', 5);
if( _hui('list_imagetext') ){
    $cols .= ' excerpt-combine';
}

if( _hui('list_hover_plugin') ){
    $cols .= ' excerpt-hoverplugin';
}

$p_like = _get_post_like_data(get_the_ID());


echo '<article class="excerpt excerpt-c'.$cols.'">';
if (!has_post_format( 'video')):
if(preg_match('/<iframe.*\/iframe>/i', $post->post_content,$m)){

                echo '<div class="excerpt-smalled-video" style="position:absolute;top:8px;overflow:hidden;border-radius:8px 8px 8px 8px;z-index:10000;">'.$m[0].'</div>';

        }
        endif;
       
echo '<div class="heise-zhezhao-down" style="display:none;width:100%;height:100%;">
<a style="width:201px;height:46px;background:#ff8b2e;position:absolute;bottom:24%;right:43px;border-radius:30px;font-size:18px;color:#ffffff;text-align:center;line-height:46px;z-index:101;" href="'.get_permalink().'" target="_blank">立即'.$key_type_info.'</a>

<a style="width:100%;height:100%;border-radius:8px;position:absolute;bottom:0;right:0;z-index:100;background:rgba(0,0,0,0.1); " href="'.get_permalink().'" target="_blank"></a>


    </div>';

////////////////////////////////////////新增
    if($price!=0 || $vip==4){
    echo '<a'. _target_blank() .' class="vipsign"  href="'.home_url('/user?action=vip').'"  title="VIP免费"><p>免费</p></a>';}
   
    /*echo '<a'. _target_blank() .' class="thumbnail" href="'.get_permalink().'">'._get_post_thumbnail().'</a>';*/
    if(is_search()){
        echo '<a'. _target_blank() .' class="thumbnail" href="'.get_permalink().'">'._search_get_post_thumbnail().'</a>';
    }else{
        echo '<a'. _target_blank() .' class="thumbnail" href="'.get_permalink().'">'._get_post_thumbnail().'</a>';
    }
    echo '<h2><a'. _target_blank() .' href="'.get_permalink().'">'.get_the_title().'</a></h2>';

    echo '<footer>';
        if( $vip && $vip != 0 ){
            //echo '<span class="post-price"><i class="iconfont">&#xe63f;</i></span>';
        }
        if( $price && $price != 0 ){
            //echo '<span class="post-price"><i class="iconfont">&#xe628;</i> '.$price.'</span>';
        }

        if( isset($is_hotposts) ){
            echo '<time class="hot"><i class="iconfont">&#xe6f5;</i></time>';
        }else{
            echo '<time>'._get_post_time().'</time>';
        }

        if( $p_meta && $p_meta['view'] ){
            echo '<span class="post-view"><i class="iconfont">&#xe611;</i> '._get_post_views().'</span>';
        }

        if( $p_meta && $p_meta['comm'] ){
            echo '<span class="post-comm">'._get_post_comments().'</span>';
        }

    echo '</footer>';
    
echo '</article>';