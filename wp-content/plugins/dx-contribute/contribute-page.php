<script type="text/javascript" src="<?php echo plugins_url( 'layui/layui.js', __FILE__ ); ?>"></script>

<?php 
//header("Access-Control-Allow-Origin: *");

	if(!is_user_logged_in())
{
	echo '<script>

window.location.href="'.home_url('/login').'";
</script>';

exit();
}

if(!current_user_can('sjoneadminer') ){
	include __DIR__.'/upwords.php';
	exit;
}
	//setting and data
	global $current_user;
	$DXC_options = get_option( 'DX-Contribute-options' );
?>
<link rel="stylesheet" media="all" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ ); ?>" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo plugins_url( 'layui/css/layui.css', __FILE__ ); ?>" /> 
 


<?php if( $DXC_options['css'] ) echo '<style type="text/css">'.stripslashes( $DXC_options['css'] ).'</style>'; ?>


  <legend>上传步骤说明</legend>
  <div>
    
    <a type="button" class="layui-btn layui-btn-normal" target="_blank"  href="https://pan.baidu.com/s/13u7pCc5AlBAMWrXW2F1nOw">上传步骤</a>
    <a type="button" class="layui-btn layui-btn-normal" href="https://pan.baidu.com/s/1WKP5LaxFHrjDIgrdtnoK6g" target="_blank">作品样机下载</a>
   
  </div>
<br />
 <legend>上传作品</legend>

<div id="DX-Contribute">

	<p>
		<label for="DXC-title">标题:</label>
		<input name="DXC-title" id="DXC-title" class="DXC-input" /><?php echo $asterisk; ?>
		<span class="asterisk">*</span>
		<span id="DXC-title-num">还剩<b><?php echo $DXC_options['title-num']; ?></b>字</span>
	</p>
	
	
		<!-- <label for="DXC-user">昵称：</label> -->
		<input name="DXC-user" id="DXC-user" class="DXC-input" type="hidden" maxlength="40" value="<?php echo '设计1+1设计师'; ?>" />
	 
	
	 
		<!-- <label for="DXC-email">e-mail：</label> -->
		<input name="DXC-email" id="DXC-email"  type="hidden"  class="DXC-input" maxlength="40" value="<?php echo 'sjoneone@sjoneone.com'; ?>" />
	
	 
		<!-- <label for="DXC-site">站点url：</label> -->
		<input name="DXC-site" id="DXC-site" class="DXC-input" type="hidden" maxlength="40" value="<?php echo 'https://www.sjoneone.com'; ?>" />
	
	<?php if( $DXC_options['select-cat']=='on' ): ?>
	<p>
		<label for="DXC-cat">分类:</label>
		<br/>
		<?php 
			$args = array(
				'hide_empty' => false,
				'hierarchical' => true,
				'selected' => $DXC_options['category'],
				'id' => 'DXC-cat',
				'name' => 'DXC-cat',
				'exclude_tree' => $DXC_options['exclude-cat']
			);
			wp_dropdown_categories( $args );?>
	</p>
	<?php endif; ?>
	
	<p>
		<label for="DXC-tags">作品标签:</label>
		<input name="DXC-tags" id="DXC-tags" class="DXC-input" maxlength="20" placeholder="多个用英文逗号分隔" />
		
	</p>	
	
	<p>
		<label for="DXC-content">作品内容:</label>
		<br/>
		<?php
			$content = '';
			$editor_id = 'DXC-content';
			$settings = array(
				'textarea_rows' => $DXC_options[ 'textarea-rows' ]
			);
			wp_editor( $content, $editor_id, $settings );
		?>
		<span id="DXC-content-num">字数不能超过<b><?php echo $DXC_options['textarea-num']; ?></b></span>
	</p>
	<p>
	<label for="wppay_type">资源类型:</label>
	<br/>
	 
		
		<select name="wppay_type"  id="wppay_type">
		 <!--  <option value ="0" >不启用</option>
		  <option value ="1">全部内容</option>
		  <option value ="2">部分内容</option> -->
		  <option value="3"  selected>收费下载</option>
		  <option value="4">免费下载</option>
		</select>

</p>
<p>
	<label for="wppay_vip_auth">VIP:</label>
	<br/>
	<select name="wppay_vip_auth" id="wppay_vip_auth">
		<option value="1"  selected>VIP免费</option>
	</select>
</p>
<p>
		<label for="wppay_price">售价:</label>
		<input name="wppay_price" id="wppay_price" class="DXC-input"  type="number"  placeholder="让价格有竞争优势" />
		
	</p>

	<p>
		<label for="wppay_down">下载地址:</label>
		<input name="wppay_down" id="wppay_down" class="DXC-input"  type="text"  placeholder="例：填写直接下载地址或百度云盘分享地址,例:https://pan.baidu.com/...或http://down.com..." />
		
	</p>		
<p>
		<label for="wppay_down_info">下载密码:</label>
		<input name="wppay_down_info" id="wppay_down_info" class="DXC-input"  type="text"  placeholder="百度云盘分享下载密码（例：Eq76,为空则无密码）" />
		
	</p>

	<p>
		<label for="wppay_info_v">当前版本:</label>
		<input name="wppay_info_v" id="wppay_info_v" class="DXC-input"  type="text" placeholder="例：photoshop cc,凡是有下载文件时必填" />
		
	</p>

	<p>
		<label for="wppay_info_g">文件格式:</label>
		<span class="asterisk" >格式规范：PSD、AI、CDR、EPS、PNG、JPG、MAX、DWG、C4D、SKP、AEP、PPTX、DOCX、XLS、MP4、MOV、AVI、WMF"
		</span>
		<input name="wppay_info_g" id="wppay_info_g" class="DXC-input"  type="text" placeholder="例：psd,凡是有下载文件时必填" />
	
		
	</p>	
	<p>
		<label for="wppay_info_d">文件大小:</label>
		<input name="wppay_info_d" id="wppay_info_d" class="DXC-input"  type="text" placeholder="例：21.6M,凡是有下载文件时必填" />
		
	</p>	
	
 <div class="layui-upload">
  <button type="button" class="layui-btn layui-btn-normal" id="uppicthumb">封面图片上传</button> 
  <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
    预览图:图片尺寸266px*330px，图片大小不能超过300kb
    <div class="layui-upload-list" id="demo2"></div>
 </blockquote>
</div> 

<input type="hidden" name="imgface-url" id="imgface-url" value=""/>

<script type="text/javascript">

</script> 


	
	<p>
		<input name="DXC-submit"  class="layui-btn layui-btn-danger send-btned" id="DXC-submit" type="button" value="提交"/>
	</p>
	<div style="display:none;color:green;font-style:italic;font-size:14px;font-weight:bold;" id="DXC-loading"></div>
	
	<input type="hidden" name="blog-url" id="blog-url" value="<?php bloginfo('url'); ?>"/>
	<input type="hidden" name="success-message" id="success-message" value="<?php echo $DXC_options[ 'success' ]; ?>"/>

</div>
<legend>上传要求</legend>

<ul class="layui-timeline" >
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis"></i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title">素材要求</h3>
      <p style="font-size: 16px;line-height: 30px">
       1.精美或设计具有一定水准的素材，按网站提供的样机来给素材做封面，优质的封面能提高流量转换。
        <br>2.上传必须是设计源文件，和封面内容保持相关性。上传后审核通过即在‘我的作品’里看到。
        <br>3.每天至少上传8个素材，少于要求数量3次则取消签约设计师资格，取消上传功能。
      </p>
    </div>
  </li>
  



 <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis"></i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title">素材类别</h3>
      <p style="font-size: 16px;line-height: 30px">
       1.平时在给别人设计的素材。
        <br>2.在国外素材网搬运的素材或对素材二次加工。
        <br>3.网上找的设计软件的插件或者软件。
        <br>4.设计视频教程。
        <br>5.凡是和设计相关有价值的虚拟产品。
      </p>
    </div>
  </li>

 <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis"></i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title">建议价格</h3>
      <p style="font-size: 16px;line-height: 30px">
       	
		原创素材并且设计感十足： 30-50元

		<br>国外搬运的素材：9元 
		<br>素材二次加工的话：15元
		<br>网上不容易找到的插件:15元
		<br>网上优秀视频教程:10元-15元
      </p>
    </div>
  </li>

</ul>  

<script type="text/javascript" src="<?php echo plugins_url( 'contribute.js', __FILE__ ); ?>"></script>