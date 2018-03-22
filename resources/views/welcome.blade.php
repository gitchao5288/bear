<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>自由跳动的字体</title>
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript" src="/welcome/jquery.beattext.js"></script>
<script type="text/javascript" src="/welcome/easying.js"></script>

<script type="text/javascript">

$(document).ready(function() {
/*
 *  参数详解:
 *  upTime          上移的时间
 *  downTime        下落的时间
 *  beatHeight      上移高度
 *  isAuth          是否自动
 *  isRotate        是否旋转
*/
$('p#beatText').beatText({isAuth:false,isRotate:false});
$('p#rotateText').beatText({isAuth:false,isRotate:true});
$('p#autoText').beatText({isAuth:true,beatHeight:"3em",isRotate:false});
$('p#roloadText').beatText({isAuth:true,beatHeight:"1em",isRotate:false,upTime:100,downTime:100});
$('p#autoRotateText').beatText({isAuth:true,upTime:700,downTime:700,beatHeight:"3em",isRotate:true});

});

</script>
<style>
*{
    padding:0px;
    margin:0px;
    background:#333;
    color:#fff;
    font-size:30px;
}

.container{
    margin:50px auto;
    width:1100px;
    position:relative;
}
.container p{
    text-align:center;
    padding:10px auto;
}
/*下面两个是核心样式*/
.beat-char {
    line-height: 3.4em;
    position: relative;
    display: inline-block;
    background: transparent;

}

.rotate{
    transform:rotate(360deg) ;
    -ms-transform:rotate(360deg);   /* IE 9 */
    -moz-transform:rotate(360deg);  /* Firefox */
    -webkit-transform:rotate(360deg); /* Safari 和 Chrome */
    -o-transform:rotate(360deg);
    -webkit-transition-duration: 0.7s;

}
</style>
</head>
<body>

<div class="container">
    <p id="beatText">我是懒熊</p>
    <p id="rotateText">不知道你是从何得知,这个神奇的链接</p>
    <br>
    <br>
    <p id="autoText">那么现在请你记住!懒是一种态度!</p>
    <p id="roloadText">因为懒,所以无所畏惧.</p>
    <br>
    <br>
    <a href="/admins/index"><p id="autoRotateText">点击进入--懒熊后台</p></a>
</div>

</body>
</html>