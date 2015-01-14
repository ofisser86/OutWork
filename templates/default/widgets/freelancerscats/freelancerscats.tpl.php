	<style type="text/css">	

ul#navmenu-v,
ul#navmenu-v li,
ul#navmenu-v ul {
margin: 0;
border: 0 none;
padding: 0;
width: 200px; 
list-style: none;
}

ul#navmenu-v:after {
clear: both;
display: block;
font: 1px/0px serif;
content: ".";
height: 0;
visibility: hidden;
}

ul#navmenu-v li {
float: left; 
display: block !important; 
display: inline; 
position: relative;
z-index: 1000;
}


ul#navmenu-v a {
border-bottom: 1px solid #BAB3A0;

padding: 0 6px;
display: block;
background: #ADA693;
color: #fff;
font: bold 12px/22px Verdana, Arial, Helvetica, sans-serif;
text-decoration: none;
height: auto !important;
height: 1%; 
}


ul#navmenu-v a:hover,
ul#navmenu-v li:hover a,
ul#navmenu-v li.iehover a {
background: #A29C86;
color: #fff;
}

ul#navmenu-v li:hover li a,
ul#navmenu-v li.iehover li a {
background: #A29C86;
color: #fff;
}


ul#navmenu-v li:hover li a:hover,
ul#navmenu-v li:hover li:hover a,
ul#navmenu-v li.iehover li a:hover,
ul#navmenu-v li.iehover li.iehover a {
background: #A29C86;
color: #E0C76A;
}


ul#navmenu-v li:hover li:hover li a,
ul#navmenu-v li.iehover li.iehover li a {
background: #A29C86;
color: #E0C76A;
}


ul#navmenu-v li:hover li:hover li a:hover,
ul#navmenu-v li:hover li:hover li:hover a,
ul#navmenu-v li.iehover li.iehover li a:hover,
ul#navmenu-v li.iehover li.iehover li.iehover a {
background: #A29C86;
color: #FFF;
}


ul#navmenu-v li:hover li:hover li:hover li a,
ul#navmenu-v li.iehover li.iehover li.iehover li a {
background: #A29C86;
color: #BCD6A7;
}


ul#navmenu-v li:hover li:hover li:hover li a:hover,
ul#navmenu-v li.iehover li.iehover li.iehover li a:hover {
background: #A29C86;
color: #FFF;
}

ul#navmenu-v ul,
ul#navmenu-v ul ul,
ul#navmenu-v ul ul ul {
display: none;
position: absolute;
top: 0;
	<?php if($widget->options['style'] == 'l'){echo'left: -200px;';}?>
	<?php if($widget->options['style'] == 'r'){echo'left: 210px;';}?>
}
ul#navmenu-v li:hover {
	width: 210px; 
	<?php if($widget->options['style'] == 'l'){echo'margin-left:-10px;';}?>
}
ul#navmenu-v li li:hover {
	width: 200px; 
	margin:0;
}
ul#navmenu-v li:hover ul ul,
ul#navmenu-v li:hover ul ul ul,
ul#navmenu-v li.iehover ul ul,
ul#navmenu-v li.iehover ul ul ul {
display: none;
}

ul#navmenu-v li:hover ul,
ul#navmenu-v ul li:hover ul,
ul#navmenu-v ul ul li:hover ul,
ul#navmenu-v li.iehover ul,
ul#navmenu-v ul li.iehover ul,
ul#navmenu-v ul ul li.iehover ul {
display: block;
}

</style>
<script >
navHover = function() {
	var lis = document.getElementById("navmenu-v").getElementsByTagName("LI");
	for (var i=0; i<lis.length; i++) {
		lis[i].onmouseover=function() {
			this.className+=" iehover";
		}
		lis[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" iehover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", navHover);
</script >
	<?php
	if($widget->options['home'] == 'p'){$url="/freelancers/proektes?cat_id=";}
	if($widget->options['home'] == 'f'){$url="/freelancers/spez?cat_id=";}
	if($widget->options['home'] == 'z'){$url="/freelancers/sakaz?cat_id=";}
 echo' <div><ul id="navmenu-v" >';
 if($cats){
foreach($cats as $cat){ 
 echo'<li ><a href="'.$url.$cat['id'].'"><span>'.$cat['name'].'</span></a>';
if($cat['uslug']){
echo'<ul>';
foreach($cat['uslug'] as $scon){ 
 echo'<li ><a href="'.$url.$cat['id'].'&uslugi='.$scon['id'].'"><span>'.$scon['name'].'</span></a></li >';
}
 echo'</ul>';
}
echo'</li >';
}
}
echo'</ul></div>';
?>	
	