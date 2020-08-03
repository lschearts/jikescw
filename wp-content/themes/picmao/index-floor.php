<div class="lift-nav">
    <ul class="lift">
        <li>1楼</li>
        <li>2楼</li>
        <li>3楼</li>
        <li>4楼</li>
        <li>5楼</li>
        <li>6楼</li>
    </ul>
</div>
<script   src="<?php  echo  get_stylesheet_directory_uri(); ?>/js/LiftEffect.js">
    
<script>

    $(function(){
        LiftEffect({
            "control1": ".lift-nav",                          //侧栏电梯的容器
            "control2": ".lift",                           //需要遍历的电梯的父元素
            "target": [".t1",".t2",".t3",".t4",".t5",".t6"], //监听的内容，注意一定要从小到大输入
            "current": "current"                          //选中的样式
        });

        
    })
</script>