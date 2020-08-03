<?php 
/**
 * template name: 用户中心(已购买记录)
 */
date_default_timezone_set('Asia/Shanghai');
if(!is_user_logged_in()){
	header("Location:".home_url('login'));
	exit();
}
get_header();
global $wpdb, $wppay_table_name, $current_user;
wp_get_current_user();
$user_title = '会员中心';

 function user_avatar_left($user_email){
 	?>
 	<div class="user-usermeta-avatar">
		<div class="inner">
			<form action="<?php echo get_bloginfo('template_url');?>/action/avatar.php" method="post" class="" role="form" name="AvatarForm" id="AvatarForm"  enctype="multipart/form-data">
				<span><?php echo _get_user_avatar( $user_email, true, 100); ?></span>

				<p>
					<a class="btn btn-default btn-sm upload" href="javascript:void(0)"><span id="udptips">修改头像</span>
					<input type="file" name="addPic" id="addPic" accept=".jpg, .gif, .png" resetonclick="true">
					</a>
				</p>
			</form>
		</div>
		<script src="<?php echo get_bloginfo('template_url');?>/js/jquery.form.js"></script>
	</div>
 	<?php
 }

?>

<!-- <?php _the_focusbox( '', $user_title,'您的个人信息和历史购买记录' ); ?> -->
<div class="user-nav">
	<ul>
		<li><a href="?action=order" class="order <?php if($_GET['action'] == 'order') echo 'active';?>" etap="order">我的订单</a></li>
		<li><a href="?action=shouc" class="info <?php if($_GET['action'] == 'shouc') echo 'active';?>" etap="vip">我的收藏</a></li>
      	<li><a href="<?php echo home_url('/author/').$current_user->ID  ?>"  etap="worksede">我的作品</a></li>
      	<?php if(current_user_can('administrator')|| current_user_can('sjoneadminer') ) { ?>
      	<li><a href="?action=seller" class="info <?php if($_GET['action'] == 'seller') echo 'active';?>" etap="vip">我的销售</a></li>
      	<?php  } ?>
		<li><a href="?action=vip" class="info <?php if($_GET['action'] == 'vip') echo 'active';?>" etap="vip">会员特权</a></li>
		<li><a href="?action=info" class="info <?php if($_GET['action'] == 'info') echo 'active';?>" etap="info">我的信息</a></li>
		<li><a href="?action=password" class="info <?php if($_GET['action'] == 'password') echo 'active';?>" etap="password">修改密码</a></li>
		<!-- <li><a href="<?php echo wp_logout_url(home_url()); ?>" etap="logout">退出</a></li> -->
	</ul>
</div>

<section class="container">
	<!-- 账户信息 -->
	<?php if (isset($_GET['action']) && $_GET['action'] == 'info') { ?>

		<!-- # info page... -->
		<div class="info-wrap">

			<?php user_avatar_left($current_user->user_email) ?>
			
			<form action="" method="post" class="user-usermeta-form" style="">

				<div class="inner">
					
					<div class="form-group">
						<label class="control-label">用户ID</label>
						<input style="cursor: no-drop;" type="text" class="form-control" name="username" required="" value="<?php echo $current_user->user_login;?>" disabled="disabled">
					</div>
					<div class="form-group">
		                <label class="control-label">用户昵称</label>
						<input type="text" class="form-control" name="nickname" required="" placeholder="请输入用户昵称" value="<?php echo $current_user->nickname;?>">
		            </div>

		            <div class="form-group">
		            	<label class="control-label">邮箱</label>
                		<div class="col-sm-4">
	            			<input type="email" class="form-control" name="user_email" required="" placeholder="" value="<?php echo $current_user->user_email;?>" >
		                </div>
		            </div>
		            <!-- 绑定QQ -->
					<?php if( _hui('is_oauth_qq',false)) { ?>
						<div class="form-group">
			                <div class="col-sm-4">
								<div class="qq-card">
									<i class="iconfont">&#xe81f;</i>
									<?php 
										$open_bind =get_user_meta($current_user->ID, 'open_bind',true );
										$qq_name = get_user_meta($current_user->ID, 'qq_name',true );
										if ($open_bind == '1') {
						                	echo '<span>已绑定（'.$qq_name.'）</span><a href="javascript: void(0);" class="bind-qq" id="unset-bind-qq">解除绑定</a>';
						                }else{
						                	$bind_url = get_stylesheet_directory_uri() . '/oauth/qq?rurl='.home_url().'/user?action=info';
											echo '<a href="'.$bind_url.'" class="bind-qq">绑定</a>';
						                }
					                ?>
									
								</div>
			                </div>
			            </div>
					<?php } ?>
		            
		            <div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input type="hidden" name="action2" value="1">
							<button type="submit" class="btn btn-primary btn-lg ladda-button" id="user-action-info"><span class="ladda-label">提交</span></button>
		                </div>
		            </div>
				</div>

			</form>
		</div>

	<!-- 我的收藏 -->
	<?php } elseif (isset($_GET['action']) && $_GET['action'] == 'shouc') { ?>
			<?php $user_collect=user_center_collect($current_user->ID); ?>
		<div class="excerpts-wrapper" >
 			<div class="excerpts" >
			<?php    
				if($user_collect){
				
					
				

				foreach ($user_collect as $v){
						$postes=get_post($v->postid);
						$title=$postes->post_title;
						$author=$postes->post_author;
						$content=$postes->post_content;
						$category=$postes->post_category;
						$getThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($v->postid),full);
						$getThumbnail_src=$getThumbnail[0];	
						/*格子html*/
			$p_meta = _hui('post_plugin');
$price = get_post_meta($v->postid,'wppay_price',true);
$vip = get_post_meta($v->postid,'wppay_vip_auth',true);
$cols = _hui('list_cols', 5);
if( _hui('list_imagetext') ){
    $cols .= ' excerpt-combine';
}

if( _hui('list_hover_plugin') ){
    $cols .= ' excerpt-hoverplugin';
}

$p_like = _get_post_like_data($v->postid);


echo '<article class="excerpt excerpt-c'.$cols.'">';
    if($price!=0&&$vip==0){
    echo '<a'. _target_blank() .' class="vipsign"  href="'.home_url('/user?action=vip').'"  title="VIP免费"><p>免费</p></a>';}
   /* echo '<a'. _target_blank() .' class="thumbnail" href="'.get_permalink($v->postid).'">'._get_post_thumbnail($v->postid).'</a>';*/
     echo '<a'. _target_blank() .' class="thumbnail" href="'.get_permalink($v->postid).'"><img src='.$getThumbnail_src.'></a>';
    echo '<h2><a'. _target_blank() .' href="'.get_permalink($v->postid).'">'.$title.'</a></h2>';

    echo '<footer>';
        if( $vip && $vip != 0 ){
            echo '<span class="post-price"><i class="iconfont">&#xe63f;</i></span>';
        }
        if( $price && $price != 0 ){
            echo '<span class="post-price"><i class="iconfont">&#xe628;</i> '.$price.'</span>';
        }

        if( isset($is_hotposts) ){
            echo '<time class="hot"><i class="iconfont">&#xe6f5;</i></time>';
        }else{
            echo '<time>'._get_post_time($v->postid).'</time>';
        }

        if( $p_meta && $p_meta['view'] ){
            echo '<span class="post-view"><i class="iconfont">&#xe611;</i> '._get_post_views($v->postid).'</span>';
        }

        if( $p_meta && $p_meta['comm'] ){
            echo '<span class="post-comm">'._get_post_comments($v->postid).'</span>';
        }

    echo '</footer>';
    
echo '</article>';

						/*格子html end*/
				}
				
			}else{
				$empty_html='

				<div style="margin:0 auto ;width:315px;text-align:center;">
				<img style="margin-top:150px;height:222px;" src="'.get_template_directory_uri().'/img/empty-box.png">
				<h3>空空如也~~~</h3>
				</div>



				';
				echo $empty_html ;
			}
			?>
		

			</div>
	 </div>
  
  	<!-- 销售信息 -->
	<?php } elseif (isset($_GET['action']) && $_GET['action'] == 'seller' && (current_user_can('sjoneadminer') || current_user_can('administrator')) ) { ?>
	<link rel="stylesheet"  type="text/css" href="<?php echo  get_stylesheet_directory_uri().'/layui/css/layui.css'; ?>" /> 
 	<script type="text/javascript" src="<?php echo  get_stylesheet_directory_uri().'/layui/layui.js'; ?>"></script>
 	
 	<!-- <div class="order-wrap" style="margin-top: 30px;"> -->
		<?php for($i=1;$i<13;$i++){ ?>
		<a href="<?php echo '?action=seller&monthed='.$i; ?>" class="layui-btn layui-btn-primary"><?php echo $i; ?>月</a>
		<?php }  ?>
	<?php
	$total   = $wpdb->get_var("SELECT COUNT(id) FROM $wppay_table_name WHERE order_type =1");

	$perpage = 20;
	$pages = ceil($total / $perpage);
	$author_id=$current_user->ID;
	$author_name=$current_user->user_login;
	
	$page=isset($_GET['paged']) ?intval($_GET['paged']) :1;
	$offset = $perpage*($page-1);
	if(isset($_GET['monthed']) &&  is_numeric($_GET['monthed']) ){
	$mouthed=$_GET['monthed'];
	$now_year=date('Y',time());
	$sel_time=$now_year.$mouthed;
	$list = $wpdb->get_results("SELECT * FROM $wppay_table_name WHERE  DATE_FORMAT(FROM_UNIXTIME(create_time),'%Y%c')='{$sel_time}'  AND author_order='{$author_name}' AND status=1  ORDER BY create_time DESC limit $offset,$perpage");
	$sum_price = $wpdb->get_var("SELECT SUM(order_price)   FROM $wppay_table_name where  DATE_FORMAT(FROM_UNIXTIME(create_time),'%Y%c')='{$sel_time}' AND author_order='{$author_name}' AND status=1 ");
	}else{
		$list = $wpdb->get_results("SELECT * FROM $wppay_table_name WHERE order_type =1 AND status=1 AND author_order='{$author_name}'  ORDER BY create_time DESC limit $offset,$perpage");
		$sum_price = $wpdb->get_var("SELECT SUM(order_price)  FROM $wppay_table_name where order_type =1 AND author_order='{$author_name}' AND status=1 ");
	}
	
	echo '<h2 style="color:#d66409;margin:15px 0;">销售金额统计:',empty($sum_price)?'0元':0.5*(intval($sum_price)).'元','</h2>' ; 
	?>
	
<div class="wrap">
	
	<table class="wp-list-table widefat fixed striped posts  layui-table">
		<thead>
			<tr>
				<th>订单号</th>
				<th>购买用户</th>	
				<th>商品名称</th>
				<th>价格</th>
				<th>状态</th>
				<th>下单时间</th>
             
              
			</tr>
		</thead>
		<tbody>
	<?php
		if($list) {
			foreach($list as $value){
				echo "<tr id=\"order-info\" data-num=\"$value->order_num\">\n";
				echo "<td>".$value->order_num."</td>";
				if($value->user_id){
					echo "<td>".get_user_by('id',$value->user_id)->user_login."</td>";
				}else{
					echo "<td>游客</td>";
				}
				echo "<td><a target='_blank' href='".get_permalink($value->post_id)."'>".get_the_title($value->post_id)."</a></td>\n";
				echo "<td>".$value->order_price."</td>\n";
				$statusno = ($value->status == 0) ? 'selected="selected"' : '' ;
				$statusyes = ($value->status == 1) ? 'selected="selected"' : '' ;
				echo '<td class="layui-form-item"><select class="select layui-input-block" id="status" name="status" disabled>
				    <option '.$statusno.' value="0">
				        未支付
				    </option>
				    <option '.$statusyes.' value="1">
				        已支付
				    </option>
				</select></td>';
				echo '<td>'.date('Y-m-d h:i:s',$value->create_time).'</td>';
              	
				echo "</tr>";
			}
		}
		else{
			echo '<tr><td colspan="6" align="center"><strong>没有订单</strong></td></tr>';
		}
	?>
	</tbody>
	</table>
   
    <script>
            jQuery(document).ready(function($){

            });

            layui.use('element', function(){
  var element = layui.element;
});
	</script>
</div>


<!-- </div> -->
  	
	<!-- 订阅VIP -->
	<?php } elseif (isset($_GET['action']) && $_GET['action'] == 'vip') { ?>

		<!-- # info page... -->
		<div class="info-wrap">
			<div class="user-usermeta-vip">
				<div class="vip-row">
						<div class="vip-item">
							<h2><i class="iconfont">&#xe66b;</i> <span><?php echo $current_user->user_login;?></span><i class="iconfont">&#xe63f;</i> <span><?php echo vip_type_name();?></span> <i class="iconfont">&#xe61c;</i> <span><span><?php echo vip_time();?> 到期</span></h2>
						</div>
						<div class="vip-item form">

							<label for="type1" class="radio-box v1">
								<div class="tips-box"><span>包月VIP</span></div>
								<div class="dec"><p>0优惠</p><p>售前咨询</p><p>无VIP专属QQ群</p></div>
							    <input type="radio" checked="checked" name="order_type" value="2" id="type1" />
							    <span class="radio-style">包月￥<?php echo _hui('vip_price_31'); ?></span>
							</label>
							<label for="type2" class="radio-box v2">
								<div class="tips-box"><span>包年VIP</span></div>
								<div class="dec"><p>节省82%</p><p>在线售后服务</p><p>及时更新资源</p></div>
							    <input type="radio" name="order_type" value="3" id="type2" />
							    <span class="radio-style">包年￥<?php echo _hui('vip_price_365'); ?></span>
							</label>
							<label for="type3" class="radio-box v3">
								<div class="tips-box"><span>终身VIP</span></div>
								<div class="dec"><p>节省98%</p><p>协助安装使用</p><p>高质量售后群</p></div>
							    <input type="radio" name="order_type" value="4" id="type3" />
							    <span class="radio-style">终身￥<?php 
							    
							     $activityTime=strtotime(_hui('activity_end_time'));
							   
							    if(($activityTime>=time()) && _hui('activity_end_open') && !empty(_hui('activity_price'))){
							    	echo _hui('activity_price');
							    }else{
							    	echo _hui('vip_price_3600');
							    }
							    
							    
							    ?></span>
							</label>

						</div>
	                  
	                  	<div class="vip-item">
							<button class="btn btn-primary" href="javascript:;" id="pay-vip"><?php echo $payBtnName = (vip_type() > 0) ? '续费升级' : '立即开通' ; ?></button>
							<p style="margin-top: 1.8rem;color: #c5c5c5;">开通的等级大于当前等级，到期日期会自动延长</p>
						</div>
							 <div class="vip-item">
							 	<div class="sc sc-faq">
							支付即同意 

								<a target="_blank" href="<?php  echo home_url('agree'); ?>">《用户协议》</a>
								</div>
							 </div>
						<!-- <div class="vip-item">
							<div class="sc sc-faq">
							    <h3 class="sc-hd">
							        <strong>常见问题</strong>
							        <span>FAQ</span>
							    </h3>

							    <div class="sc-bd">
							        <ul class="faq-list" id="R_faqList">
							        	<li class="item">
							                <div class="hd">
							                    <strong>开通VIP的十万个好处？</strong>
							                </div>
							                <div class="bd">开通VIP第99999个好处就是有排面！</div>
							            </li>
							            <li class="item">
							                <div class="hd">
							                    <strong>VIP资源需要单独购买吗？</strong>
							                </div>
							                <div class="bd">本站所有资源，针对不同等级VIP免，可直接下载。</div>
							            </li>
							            <li class="item">
							                <div class="hd">
							                    <strong>VIP会员是否无限次下载资源？</strong>
							                </div>
							                <div class="bd">在遵守VIP会员协议前提下，VIP会员在会员有效期内可以任意下载所有免费和VIP资源。</div>
							            </li>
							            <li class="item">
							                <div class="hd">
							                    <strong>是否可以与他人分享VIP会员账号？</strong>
							                </div>
							                <div class="bd">一个VIP账号仅限一个人使用，禁止与他人分享账号。</div>
							            </li>
							            <li class="item">
							                <div class="hd">
							                    <strong>是否可以申请退款？</strong>
							                </div>
							                <div class="bd">VIP会员属于虚拟服务，付款后不能够申请退款。如付钱前有任何疑问，联系站长处理</a></div>
							            </li>
							        </ul>
							    </div>
							</div> -->
						</div>
					<script>
					$("#R_faqList .item").on("click", function() {
					         $(this).toggleClass("active").siblings().removeClass("active")
					    });
					</script>
                  
				</div>
			</div>

		</div>
	<!-- 修改密码 -->
	<?php } elseif (isset($_GET['action']) && $_GET['action'] == 'password') { ?>
		<!-- # info page... -->
		<div class="info-wrap">

			<?php user_avatar_left($current_user->user_email) ?>
			
			<form action="" method="post" class="user-usermeta-form" style="">
				<div class="inner">
					<div class="form-group">
						<label class="control-label">输入新密码</label>
						<input type="password" class="form-control" placeholder="请输入6位以上密码" required="" minlength="6" name="password">
					</div>
					<div class="form-group">
		                <label class="control-label">重复新密码</label>
						<input type="password" class="form-control" required="" minlength="6" name="password2">
		            </div>

		            <div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input type="hidden" name="action2" value="3">
							<button type="submit" class="btn btn-primary btn-lg ladda-button" id="user-action-paw"><span class="ladda-label">修改</span></button>
		                </div>
		            </div>
				</div>
			</form>
		</div>
	<!-- 订单页面 -->
	<?php }else{ ?>
		<?php 
			$user_id = $current_user->ID;
			$total  = $wpdb->get_var("SELECT COUNT(id) FROM $wppay_table_name WHERE user_id=$user_id");
			
			$list = $wpdb->get_results("SELECT * FROM $wppay_table_name WHERE user_id=$user_id ORDER BY create_time DESC");
		?>
		<!-- # deft order page... -->
		<div class="order-wrap">
			<?php if ($list) { ?>
				<ul class="order-row">
					<?php
					foreach($list as $value){
						if ($value->order_type == 1) {
							$title = get_the_title($value->post_id);
						}elseif ($value->order_type == 2) {
							$title = '月费会员';
						}elseif ($value->order_type == 3) {
							$title = '年费会员';
						}elseif ($value->order_type == 4) {
							$title = '终身会员';
						}else{

						}
						echo '<li class="order-item">';
						echo '<span>订单号：'.$value->order_num.'</span>';
						echo '<h2>'.$title.'</h2>';
						if ($value->status == 1) {
							echo '<h4><dfn>¥ '.$value->order_price.'</dfn>已付款</h4>';
							echo '<a target="_blank" class="btn btn-primary btn-sm" href="'.get_permalink($value->post_id).'">查看</a>';
						}else{
							echo '<h4><dfn>¥ '.$value->order_price.'</dfn>已失效</h4>';
							echo '<button class="btn btn-default" onclick="delOrder('.$value->order_num.')" >删除订单</button>';
						}
						
						echo '<time>'.date('Y-m-d h:i:s',$value->create_time).'</time>';
						echo '</li>';
					}
					?>
				</ul>
			<?php }else{ 

				$empty_html='

				<div style="margin:0 auto ;width:315px;text-align:center;">
				<img style="margin-top:150px;height:222px;" src="'.get_template_directory_uri().'/img/empty-box.png">
				<h3>空空如也~~~</h3>
				</div>



				';
				echo $empty_html ;
				

				}?>
			

		</div>
	<?php } ?>

</section>
<script type="text/javascript">
	
	$(function(){
		var now_timestamp=<?php echo date('YmdHis',time());  ?>;
		var _activityTime=<?php echo date('YmdHis',$activityTime); ?>;
	if(_activityTime==now_timestamp){
		window.Location.reload();
		
	}
		

	});
</script>
<?php get_footer(); ?>
