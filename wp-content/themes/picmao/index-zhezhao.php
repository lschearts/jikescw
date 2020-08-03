<?php  

$parseTime=strtotime(_hui('activity_end_time')); 
$dateChazhi=$parseTime-time();
$_days_cz=floor($dateChazhi/86400);
$_hours_cz=floor($dateChazhi%86400/3600);
$_minutes_cz=floor($dateChazhi%86400/60);
$_seconds_cz=floor($dateChazhi%86400%60);
?>

<div class="zhezhao-adv"  style="display: none;" >

	<!--遮罩层广告-->

<div class="zhezhao-adv-all" style="background: url(<?php  echo _hui('activity_piced_up'); ?>)center no-repeat;">

<!--<p class="huodong-time">活动倒计时</p>-->

<div class="huodong-cd-time">

<?php  if($_days_cz>0) {    ?>

<span id="timeover_d" class="time-num">00</span><span>天</span>
<span id="timeover_h" class="time-num">00</span><span>时</span>
<span id="timeover_m" class="time-num">00</span><span>分</span>
<span id="timeover_s" class="time-num">00</span><span>秒</span>
<span id="timeover_ms" class="time-num">00</span>
<?php } else { ?>

<span id="timeover_h" class="time-num">00</span><span>时</span>
<span id="timeover_m" class="time-num">00</span><span>分</span>
<span id="timeover_s" class="time-num">00</span><span>秒</span>
<span id="timeover_ms" class="time-num">00</span>


<?php }  ?>





</div>	

<a class="zhezhao-goshop" href="<?php  echo home_url().'/user?action=vip' ?>">立即购买</a>	 

<div class="zhezhao-adv-closebtn" > </div>



</div>





</div>







<script>

	

     $(function(){

     	

     	

     	 //遮罩广告

			             $('.zhezhao-adv-closebtn').click(function(){

				$.cookie('close_adv_zhezhao','closeded',{expires:1/24*6,path:'/'});

				$('.zhezhao-adv').css('display','none');

			

					

			});//click

			

			if($.cookie('close_adv_zhezhao')=='closeded'){

				$('.zhezhao-adv').css('display','none');	

			}else{

			
				if($(window).width()>=544){
			setTimeout(function(){ $(".zhezhao-adv").css('display','block').animate('slow'); },2000);}else{

				$('.zhezhao-adv').css('display','none');
				$('.zhezhao-adv-all').css('display','none');
			}

			}

			

			///////////////////////倒计时

			function countTime() {

			var date = new Date(); 

			var now = date.getTime(); 

			var endDate = new Date("<?php  echo _hui('activity_end_time');   ?>");//设置截止时间

			var end = endDate.getTime();

			var leftTime = end - now; //时间差 

			var d, h, m, s, ms;

			var timer;

			if(leftTime >= 0) {

			d = Math.floor(leftTime / 1000 / 60 / 60 / 24);

			h = Math.floor(leftTime / 1000 / 60 / 60 % 24);

			m = Math.floor(leftTime / 1000 / 60 % 60);

			s = Math.floor(leftTime / 1000 % 60);

			ms = Math.floor(leftTime % 1000);

			if(ms < 10) {

			ms = "0" + ms;

			}

			if(s < 10) {

			s = "0" + s;

			}

			if(m < 10) {

			m = "0" + m;

			}

			if(h < 10) {

			h = "0" + h;

			}

			//将倒计时赋值到div中

			$("#timeover_d").html(d);

			$("#timeover_h").html(h);

			$("#timeover_m").html(m);

			$("#timeover_s").html(s);

			$("#timeover_ms").html(ms);

			//递归每秒调用countTime方法，显示动态时间效果

			timer = setTimeout(countTime, 50);

			

			} else {

			

			$("#timeover_d").html('d');

			$("#timeover_h").html('h');

			$("#timeover_m").html('结');

			$("#timeover_s").html('束');

			$("#timeover_ms").html('啦');

			}
			
			if($("#timeover_ms").html()=='啦'){

			

				$('.zhezhao-adv').css('display','none');

				

			}

			}

			

			countTime();	

	

	

     	

     	

     	

     	

     	

     	

     	

     	

     	

     	

     	

     	

     	

     	

     	

     });

	

	

	

	

	

	

	

	

	

</script>

