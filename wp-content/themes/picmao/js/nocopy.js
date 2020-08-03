1 //禁用右键、文本选择功能、复制按键
 2 $(document).bind("contextmenu",function(){return false;});
 3 $(document).bind("selectstart",function(){return false;});
 4 $(document).keydown(function(){return key(arguments[0])});
 5 //按键时提示警告
 6 function key(e){
 7 var keynum;
 8 if(window.event){
 9 keynum = e.keyCode; // IE
10 }else if(e.which){
11 keynum = e.which; // Netscape/Firefox/Opera
12 }
13 if(keynum == 17){
14 alert(“禁止复制内容！”);
15 return false;
16 }
17 }
18 //禁用右键、文本选择功能、复制按键
19     $(document).bind("contextmenu",function(){return false;});
20     $(document).bind("selectstart",function(){return false;});
21     $(document).keydown(function(){return key(arguments[0])}); 
22  
23  //按键时提示警告
24        function key(e){
25             var keynum;
26             if(window.event) // IE
27               {
28                 keynum = e.keyCode;
29               }
30             else if(e.which) // Netscape/Firefox/Opera
31               {
32                 keynum = e.which;
33               }
34             if(keynum == 17){ alert("禁止复制内容！");return false;}
35         }
36  
37  
38 <script>  
39 //屏蔽鼠标右键、Ctrl+N、Shift+F10、F11、F5刷新、退格键     
40 function   document.oncontextmenu(){event.returnValue=false;}//屏蔽鼠标右键   
41 function   window.onhelp(){return false}       //屏蔽F1帮助   
42 function   document.onkeydown(){   
43     if((window.event.altKey)&&   
44       ((window.event.keyCode==37)||            //屏蔽Alt+方向键←   
45       (window.event.keyCode==39))){            //屏蔽Alt+方向键→
46            alert("不准你使用ALT+方向键前进或后退网页！");   
47            event.returnValue=false;    
48       }         if((event.keyCode==8)||                    //屏蔽退格删除键    
49       (event.keyCode==116)||                   //屏蔽F5刷新键   
50       (event.ctrlKey && event.keyCode==82)){   //Ctrl+R   
51            event.keyCode=0;   
52            event.returnValue=false;   
53       }   
54       if(event.keyCode==122){event.keyCode=0;event.returnValue=false;}    //屏蔽F11   
55       if(event.ctrlKey && event.keyCode==78)event.returnValue=false;      //屏蔽Ctrl+n   
56       if(event.shiftKey && event.keyCode==121)event.returnValue=false;    //屏蔽shift+F10   
57       if(window.event.srcElement.tagName=="A" && window.event.shiftKey)     
58          window.event.returnValue=false;       //屏蔽shift加鼠标左键新开一网页   
59       if((window.event.altKey)&&(window.event.keyCode==115)){             //屏蔽Alt+F4    
60          window.showModelessDialog("about:blank","","dialogWidth:1px;dialogheight:1px");   
61          return false;   
62       }   
63   }   



//禁止查看源码
function noseecode(){
10             //屏蔽键盘事件
11             document.onkeydown = function (){
12                 var e = window.event || arguments[0];
13                 //F12
14                 if(e.keyCode == 123){
15                     return false;
16                 //Ctrl+Shift+I
17                 }else if((e.ctrlKey) && (e.shiftKey) && (e.keyCode == 73)){
18                     return false;
19                 //Shift+F10
20                 }else if((e.shiftKey) && (e.keyCode == 121)){
21                     return false;
22                 //Ctrl+U
23                 }else if((e.ctrlKey) && (e.keyCode == 85)){
24                     return false;
25                 }
26             }
27             //屏蔽鼠标右键
28             document.oncontextmenu = function (){
29                 return false;
30             }
31         }
64 </script>