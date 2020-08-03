<?php get_header(); ?>
<style>
  
    html,body{
        width: 100%;
        height: 100%;
    }
    .qt-error{
        width: 100%;
        height: 100%;
        background: #fff;
        padding-top: 110px;
    }
    .error-box{
        width:500px;
        position: relative;
        margin: 0 auto;
    }
    .error-box img{
        display: block;
        width: 100%;
    }
    .error-btn{
        background-image: -webkit-linear-gradient(left,#ff9000 0,#FF8B2E 100%);
	    background-image: -o-linear-gradient(left,#ff9000 0,#FF8B2E 100%);
	    background-image: linear-gradient(to right,#ff9000 0,#FF8B2E 100%);
	    background-repeat: repeat-x;
	    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffff9000', endColorstr='#ffff5000', GradientType=1);
        border-radius: 40px;
        width: 140px;
        height: 40px;
        line-height: 40px;
        display: block;
        position: absolute;
      	top: 470px;
        left: 170px;
        text-align: center;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        animation: myfirst 0.7s linear 1s infinite alternate;
    }
    /* @keyframes myfirst
    {
        from {
            background: -webkit-linear-gradient(left, #32E696 , #00BE6E);
            background: -o-linear-gradient(left, #32E696, #00BE6E);
            background: -moz-linear-gradient(left, #32E696, #00BE6E);
            background: linear-gradient(left, #32E696, #00BE6E);
            box-shadow: 0 0 0 0 rgba(50,230,176,0.5);
        }
        to {
            background-image: -webkit-gradient(linear, left top, right top, from(#32e6b0), to(#00be85));
            background-image: -webkit-linear-gradient(left, #32e6b0, #00be85);
            background-image: linear-gradient(to right, #32e6b0, #00be85);
            box-shadow: 0 0 20px 4px rgba(50,230,176,0.7);
        }
    } */
</style>
<body>
    <div class="qt-error">
        <div class="error-box">
            <a href="<?php echo esc_url(site_url()); ?>" class="error-img" title="回到首页">
                <img src="<?php  echo  get_stylesheet_directory_uri(); ?>/img/error/fzf.png" alt="回到首页">
            </a>
            <a href="<?php echo esc_url(site_url()); ?>" class="error-btn" title="回到首页">
                返回首页
            </a>
        </div>
    </div>
</body>
</html>

<?php global $wp; $current_url = home_url(add_query_arg(array(),$wp->request)); ?>

<?php get_footer(); ?>