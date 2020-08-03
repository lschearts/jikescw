<?php 

//update option datas
if( $_POST['submit'] ){
	$val = array(
		'title-num' => $_POST[ 'DXC-title-num' ],
		'textarea-num' => $_POST[ 'DXC-textarea-num' ],
		'textarea-rows' => $_POST[ 'DXC-textarea-rows' ],
		'css' => $_POST[ 'DXC-css' ],
		'category' => $_POST[ 'DXC-category' ],
		'user' => $_POST[ 'DXC-user' ],

		'success' => $_POST[ 'DXC-success' ],
		'interval' => $_POST[ 'DXC-interval' ],
		'meta-on' => $_POST[ 'DXC-meta-on' ],
		'mail' => $_POST[ 'DXC-mail' ],
		'metapo' => $_POST['DXC-metapo'],
		'select-cat' => $_POST['DXC-select-cat'],
		'exclude-cat' => $_POST['DXC-exclude-cat']
	);
	update_option( 'DX-Contribute-options', $val );
}

//get option datas
$DXC_options = get_option( 'DX-Contribute-options' );

?>

<style type="text/css">
#DX-Contribute{
	width:700px;
	background-color:#f7f7f7;
	border:1px solid #ccc;
	margin-top:20px;
	padding:10px;
}
#DX-Contribute form label{
	width:100px;
	display:inline-block;
}
textarea#DXC-css{
	width:95%;
	height:300px;
	margin-top:10px;
}
textarea#DXC-success{
	width:95%;
	height:50px;
	margin-top:10px;
}
.help{
	color:gray;
}
.daxiawp-contact{
	margin:10px 0;
	border:1px dotted #ccc;
	background-color:#f7f7f7;
	width:700px;
	padding:10px;
	color:gray;
}
#DX-Contribute span.des{
	color:#999;
	margin-left:10px;
}
</style>

<div class="wrap">

	<div id="icon-options-general" class="icon32"><br></div><h2>投稿设置选项</h2>

	<div id="DX-Contribute">
	<form action="" method="post">
		
		<p>
			<label for="DXC-title-num">标题字数：</label>
			<input type="text" name="DXC-title-num" id="DXC-title-num" class="DXC-input" value="<?php echo $DXC_options[ 'title-num' ]; ?>"/>
		</p>
		
		<p>
			<label for="DXC-textarea-num">内容字数：</label>
			<input type="text" name="DXC-textarea-num" id="DXC-textarea-num" class="DXC-input" value="<?php echo $DXC_options[ 'textarea-num' ]; ?>"/>
		</p>
		
		<p>
			<label for="DXC-textarea-rows">文本框行数：</label>
			<input type="text" name="DXC-textarea-rows" id="DXC-textarea-rows" class="DXC-input" value="<?php echo $DXC_options[ 'textarea-rows' ]; ?>"/>
		</p>
		
		<p>
			<label for="DXC-category">指定分类：</label>
			<?php wp_dropdown_categories( array( 'hierarchical'=>true, 'selected'=>$DXC_options['category'], 'id'=>'DXC-category', 'name'=>'DXC-category', 'hide_empty'=>false ) ); ?>
			<span class="des">(选择让投稿文章发布到指定的分类。)</span>
		</p>
		
		<p>
			<label for="DXC-select-cat">选择分类：</label>
			<input type="checkbox" name="DXC-select-cat" id="DXC-select-cat" value="on" <?php checked( 'on', $DXC_options['select-cat'] ); ?>/> 是 
			<span class="des">(勾选则可让投稿者选择分类.)</span>
		</p>
		<?php 
			$style = ($DXC_options['select-cat']=='on') ? 'display:block;' : 'display:none;';
		?>
		<p class="DXC-exclude-cat" style=" <?php echo $style; ?>">
			<label for="DXC-exclude-cat">排除分类ID：</label>
			<input type="text" name="DXC-exclude-cat" id="DXC-exclude-cat" value="<?php echo $DXC_options['exclude-cat'] ?>" size="40"/>
			<span class="des">(多个分类用英文逗号分隔，例： 3,10,16 )</span>
		</p>
		
		<p>
			<label for="DXC-user">匿名用户：</label>
			<?php wp_dropdown_users( array( 'id'=>'DXC-user', 'selected'=>$DXC_options['user'], 'name'=>'DXC-user' ) ); ?>
		</p>
		
		<p>
			<label for="DXC-interval">限制时间：</label>
			<input type="text" name="DXC-interval" id="DXC-interval" class="DXC-input" value="<?php echo $DXC_options[ 'interval' ]; ?>"/> 秒
		</p>
		
		<p>
			<label for="DXC-meta-on">文章页用户信息：</label>
			<input type="checkbox" name="DXC-meta-on" id="DXC-meta-on" value="on" class="DXC-checkbox" <?php checked( 'on', $DXC_options[ 'meta-on' ] ); ?>/> 显示
			<select name="DXC-metapo">
				<option value="head" <?php selected( 'head', $DXC_options[ 'metapo' ] ); ?>>头部</option>
				<option value="foot" <?php selected( 'foot', $DXC_options[ 'metapo' ] ); ?>>底部</option>
			</select>
		</p>				
		
		<p>
			<label for="DXC-success">投稿成功通知：</label>
			<textarea name="DXC-success" id="DXC-success" class="DXC-textarea"><?php echo stripslashes( $DXC_options[ 'success' ] ); ?></textarea>		
		</p>
		
		<p>
			<label for="DXC-mail">发送email：</label>
			<input type="checkbox" name="DXC-mail" id="DXC-mail" value="send" class="DXC-checkbox" <?php checked( 'send', $DXC_options[ 'mail' ] ); ?>/> 发送
			<span class="des">(勾选则文章审核通过将发e-mail通知投稿者。)</span>
		</p>		
		
		<p>
			<label for="DXC-css" class="DXC-css-label" >投稿页面css：</label>
			<textarea name="DXC-css" id="DXC-css" class="DXC-textarea"><?php echo stripslashes( $DXC_options[ 'css' ] ); ?></textarea>
		</p>		
		
		<?php submit_button(); ?>	
				
	</form>
	
	<p class="help">使用方法：新建一页面，将以下代码粘贴进去：<span>[DX-Contribute]</span></p>
	
	</div>
	
	<div style="clear:both;"></div>
	
	<!-- <?php do_action( 'DXC_form_bottom' ); ?> -->

</div>

<script type="text/javascript">
jQuery(document).ready(function($){
	/*show secect cat*/
	$('#DXC-select-cat').change(function(){
		var sSelectCat = $(this).attr('checked');
		if( sSelectCat=='checked' ){
			$('.DXC-exclude-cat').css('display','block');
		}
		else{
			$('.DXC-exclude-cat').css('display','none');
		}
	});	
});
</script>