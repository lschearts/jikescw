jQuery(document).ready(function($){

	//layui上传封面
	layui.use(['upload','layer'], function(){
  	var $ = layui.jquery;
  	var layer=layui.layer;
  	var uploaded = layui.upload;
  	var urled=$('#blog-url').val()+'/upwork?methoded=picup';
  	uploaded.render({

  		elem: '#uppicthumb',
  		url:urled,
  		field:'picuped',
  		method:'get',
  		multiple: false,
  		size:300,
  		accept:'images',
  		acceptMime:'images',
  		exts:'jpg|png|gif|bmp|jpeg',
  		drag:true,
  		before:function(obj){
  			 layer.load(); //上传loading
  			obj.preview(function(index, file, result){
        	$('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')
      			});
  		},
  		done: function(res, index, upload){
  			 layer.closeAll('loading');
  			
    if(res.code>0){
    	layer.msg(res.msg);
    }else if(res.code==0){
     $('#imgface-url').val(res.data.src);
     //console.log($('#imgface-url').val());
    	layer.msg(res.msg);
    
   }
  },
  		error:function(index, upload){
  			layer.closeAll('loading'); //关闭loading
  			
  },

  	});   //RENDER

});
	
	/*check word*/
	var sTitleNum = $('#DXC-title-num b').html();
	CheckTitleNum( '#DXC-title', sTitleNum, '#DXC-title-num b' );
	
	var sContentNum = $('#DXC-content-num b').html();

	/*CheckContentNum( '#DXC-content', sContentNum, '#DXC-content-num b' );*/


	
	/*check title num*/
	function CheckTitleNum( obj, maxlen, num){
		$(obj).bind("keyup change",function(){
			var v = $(this).val();
			var curlen = v.length;
			if( curlen <= maxlen ){
				var sRemain = maxlen - parseInt(curlen);
				$(num).html(sRemain);
			}else{
			  var sStrSub = v.substring(0,maxlen);
			  $(this).val(sStrSub);
			}    
		})
	}
	
	/*check content num*/
	function CheckContentNum( obj, maxlen, num){
		$(obj).bind("keyup change",function(){
			var v = check_content();
			var curlen = v.length;
			if( curlen <= maxlen ){
				var sRemain = maxlen - parseInt(curlen);
				$(num).html(sRemain);
			}else{
			  var sStrSub = v.substring(0,maxlen);
			  $(this).val(sStrSub);
			}    
		})
	}
	
	/*check url*/
	function CheckUrl(str) {
		var RegUrl = new RegExp();
		RegUrl.compile("^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$");
		if ( RegUrl.test(str) ) {
			return str;
		}
		else if( str == '' ){
			return true;
		}
		else return false;
	}	

	/*ajax submit*/
	$('#DXC-submit').click(function(){
		var sTitle = check_title('#DXC-title');		/*get title*/		
		var sEmail = check_email("#DXC-email");		/*get email*/
		var sContent = check_content();				/*get content*/
		var sTags = $('#DXC-tags').val();			/*get tags*/
		var sUser = $('#DXC-user').val();			/*get user*/
		var sSite = CheckUrl( $('#DXC-site').val() );						/*get site url*/
		var sContent_num = $('#DXC-content-num b').html();
		var wppay_price = $('#wppay_price').val();  //价格
		var wppay_down = $('#wppay_down').val();    //下载地址
		var wppay_down_info = $('#wppay_down_info').val();  //下载密码百度云
		var wppay_info_d = $('#wppay_info_d').val();    //下载文件大小
		var img_face = $('#imgface-url').val();    //封面地址
		/*check data*/
		if(!sTitle){
			layer.msg('标题不能为空！');
		}
		else if(!sUser){
			layer.msg('昵称不能为空！');
		}
		else if(!sEmail){
			layer.msg('email格式不正确！');
		}
		else if( !sSite ){
			layer.msg('站点url格式不正确！');
		}		
		else if(!sContent){
			layer.msg('内容不能为空！');
		}
		else if( sContent.length > sContent_num ){
			layer.msg('内容不能超过'+sContent_num+'字！');
		}
		else if(!wppay_price){
			layer.msg('价格不能为空');
		}
		else if(!wppay_down ){
			layer.msg('下载地址不能为空');
		}else if(!wppay_down_info){
			layer.msg('下载密码不能为空');
		}else if(!wppay_info_d){
			layer.msg('文件大小不能为空');
		}else if(!img_face){
			layer.msg('请上传封面图片');
		}
		else{
			$('#DXC-loading').css('display','block').html('提交中，请稍候...');
			//ajax_get(sTitle,sTags,sEmail,sContent,sUser,sSite);
			ajax_get(sTitle,sTags,sEmail,sContent,sUser,sSite,wppay_price,wppay_down,wppay_down_info,wppay_info_d,img_face);
		}

	});
	
	/*get function*/
	function ajax_get(sTitle,sTags,sEmail,sContent,sUser,sSite,wppay_price,wppay_down,wppay_down_info,wppay_info_d,img_face){
		var sGetUrl = $('#blog-url').val()+'/?DX-Contribute=submit';
		var sMessage = $('#success-message').val();
		var sCat = $('#DXC-cat').val();
		var sEmail = check_email("#DXC-email");		
		var wppay_type = $('#wppay_type').val();
		var wppay_vip_auth = $('#wppay_vip_auth').val();
		var wppay_price = $('#wppay_price').val();
		var wppay_down = $('#wppay_down').val();
		var wppay_down_info = $('#wppay_down_info').val();
		var wppay_info_v = $('#wppay_info_v').val();
		var wppay_info_g = $('#wppay_info_g').val();
		var wppay_info_d = $('#wppay_info_d').val();
		var img_face = $('#imgface-url').val();
		var sUser = $('#DXC-user').val();			/*get user*/
		var sSite = CheckUrl( $('#DXC-site').val() );

		$.get(
			sGetUrl,
			{
				'DXC_title' : sTitle,
				'DXC_tags' : sTags,
				'DXC_email' : sEmail,
				'DXC_content' : sContent,
				'DXC_user' : sUser,
				'DXC_site' : sSite,
				'DXC_cat' : sCat,
				'wppay_type' :wppay_type,
				'wppay_vip_auth' :wppay_vip_auth,
				'wppay_price':wppay_price,
				'wppay_down' :wppay_down,
				'wppay_down_info' :wppay_down_info,
				'wppay_info_v' :wppay_info_v,
				'wppay_info_g' :wppay_info_g,
				'wppay_info_d' :wppay_info_d,
				'img_face':img_face,
			},
			function(data){
				$('#DXC-loading').css('display','none');
				if( data.substr( 0, 4 ) == 'stop' ){
						var sInterval = data.substr( 4 );
						layer.msg('很抱歉，你提交太频繁了，请在 '+sInterval+' 秒后再提交！');
				}
				else if( data ){
					//layer.msg( sMessage );
					layer.alert(sMessage, {
						  icon: 1,
						  time: 2000 //2秒关闭（如果不配置，默认是3秒）
						}, function(){
						 location.reload();
						});   
					
				}
				else layer.msg( 'ERROR!' );
			}
		);
	}
	
	/*check email function*/
	function check_email(obj){
		var search_str = /^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/;
		var email_val = $(obj).val();
		if(!search_str.test(email_val)){
			return false;
		}else{
			return email_val;
		}
	}
	
	/*check title function*/
	function check_title(obj){
		var title = $(obj).val();
		if( title ) return title;
		else return false;
	}
	
	/*check content function*/
	function check_content(){
		if ($("#wp-DXC-content-wrap").hasClass("tmce-active")){
			var sContent = tinyMCE.activeEditor.getContent();
		}else{
			var sContent = $('#DXC-content').val();
		}
		return 	sContent;	
	}
	
});