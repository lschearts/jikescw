<!--阅读全文按钮-->
                <div class="readall_box" >
                        <div class="read_more_mask"></div>
                            <a class="read_more_btn" target="_self" >阅读全文</a>
                    </div>

<style type="text/css">
                .readall_box {position: relative;z-index: 9999;padding: 0 0 25px;margin-top: -200px;text-align: center;}
.readall_box .read_more_mask {height: 200px;background: -moz-linear-gradient(bottom,rgba(255,255,255,0.1),rgba(255,255,255,0));background: -webkit-gradient(linear,0 top,0 bottom,from(rgba(255,255,255,0)),to(#fff));background: -o-linear-gradient(bottom,rgba(255,255,255,0.1),rgba(255,255,255,0))}
.read_more_btn{cursor:pointer;font-size: 16px;color: #de686d;background: #fff;border-radius: 4px;border: 1px solid #de686d;line-height: 30px;padding:5px 10px;}
.read_more_btn:hover{background:#de686d;color:#fff;}
            </style>
             
            <script type="text/javascript">
                $(function(){
                var widHeight = $(window).height();
                var artHeight = $('article').height();
    if(artHeight>(widHeight*1.5)){
        $('article').height(widHeight*1.5-285).css({'overflow':'hidden'});
        var article_show = true;
        <?php  if(!is_user_logged_in()) { ?>
        

         $('.read_more_btn').on('click',function(){

            window.location.href="<?php echo home_url('/login'); ?>";
         });
  <?php } ?>




     
    }else{
        article_show = true;
        $('.readall_box').hide().addClass('readall_box_nobg');
    }
    function bindRead_more(){
        if(!article_show){
            $('article').height(widHeight*1.5).css({'overflow':'hidden'});
            $('.readall_box').show().removeClass('readall_box_nobg');
            article_show = true;
        }else{
            $('article').height("").css({'overflow':'hidden'});
            $('.readall_box').show().addClass('readall_box_nobg');
            $('.readall_box').hide().addClass('readall_box_nobg');
            article_show = false;
        }
    }
});
            </script>