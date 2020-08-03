<?php
$current_user = wp_get_current_user(); 
						$user_id=$current_user->ID;

if(is_single()){ 

		
	?>
	
	<a class="post-collect  " href="javascript:;" data-action="shoucang" data-id="<?php  echo get_the_ID();  ?>"  style="width:400px;height: 100px;background: red;color:#fff;"><?php  $res=get_collect_datas($user_id,get_the_ID()); 
		if($res['statused']==2){
							echo '已收藏';
								}else
								{
							echo '收藏';
								}
	  ?></a>  
	

		






<?php  }    ?>

<script>
	
  jQuery(document).ready(function($){

		$('.post-collect').click(function(){

				<?php   
				if($user_id==0){  ?>

					window.location.href="<?php echo  home_url('Login.html'); ?>";

				<?php   }  ?>	


				var data={

						post_id:$('.post-collect').data('id'),
						user_id:<?php  echo  $user_id;  ?>,
						post_action:$('.post-collect').data('action'),

						};
						
				
				$.post("<?php echo get_template_directory_uri() ?>/action/shouc.php",data,function(res){
						res=JSON.parse(res);
						console.log(res);
						 if(res.status==2){

							$(".post-collect").text("已收藏");

						}
							
						


				});//post







		});	});






	



</script>	

