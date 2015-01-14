<style type="text/css">
.u-block {
  border: 1px solid #e6e6e6;
  padding: 5px;
  margin-bottom: 10px;
  position: relative;
  text-align: center;
}
.u-block .u-title {
  font-size: 16px;
  color: #666666;
}
.u-block .u-ava {
  margin: 5px auto;
}
.u-block .u-spec {
  font-size: 12px;
  color: #45aef5;
  padding-bottom: 1px;
}
.u-block .u-desc {
  padding: 0 20px;
  color: #808080;
  font-size: 12px;
  line-height: 14px;
}
.st-profi {
  background: #c70000;
  color: #fff;
  font-size: 14px;
  text-transform: uppercase;
  margin-top:3px;
  padding: 0px 5px;
  line-height: 16px;
}
.st-new {
  background: #238cd1;
  color: #fff;
  font-size: 14px;
  text-transform: uppercase;
  margin-top:3px;
  padding: 0px 5px;
  line-height: 16px;
}
.st-spec {
  background: #ff8100;
  color: #fff;
  font-size: 14px;
  text-transform: uppercase;
  margin-top:3px;
  padding: 0px 5px;
  line-height: 16px;
}
</style>
<?php
echo'<div>';
   foreach ($freelancers as $freelancer) {
?>
<div class="u-block">
                <div class="u-title"><?php echo $freelancer['user_nickname']; ?></div>
                <div class="u-ava">
                    <a href="/freelancers/item/<?php echo $freelancer['id']; ?>">
						<?php echo html_avatar_image($freelancer['user_avatar'], 'small'); ?>
					</a>
					<div
<?php
if ($tupe == 'f'){
if ($freelancer['tupe'] == $options['tupe1']){echo 'class="st-new"';}
if ($freelancer['tupe'] == $options['tupe2']){echo 'class="st-spec"';}
if ($freelancer['tupe'] == $options['tupe3']){echo 'class="st-profi"';}
}
if ($tupe == 'z'){
if ($freelancer['tupe'] == $options['ztupe1']){echo 'class="st-new"';}
if ($freelancer['tupe'] == $options['ztupe2']){echo 'class="st-spec"';}
if ($freelancer['tupe'] == $options['ztupe3']){echo 'class="st-profi"';}
}
echo '>'.$freelancer['tupe'].'</div> ';
?>
 <div class="u-spec"><?php echo $freelancer['cname']; ?>
 <?php echo $freelancer['uname']; ?></div>
                <div class="u-desc">
<?php echo $freelancer['statu']; ?>
                </div>
            </div>
<?php
}		
	echo'</div>';   

