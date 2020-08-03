
<?php get_header(); ?>
<script>
  //360收录代码
(function(){
var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?5bd1b462a4fcd0028b2c1d7931a3b04c":"https://jspassport.ssl.qhimg.com/11.0.1.js?5bd1b462a4fcd0028b2c1d7931a3b04c";
document.write('<script src="' + src + '" id="sozz"><\/script>');
})();
</script>
<?php get_template_part( 'content', get_post_format() ); ?> 

<?php get_footer(); ?>