  <div style="overflow: hidden;display: block; padding:5px;">
  <style type="text/css">
 
 .pr-item {
  max-width: 100%; 
  padding: 7px;
  position: relative;
  min-height: 100px;
  margin-bottom: 10px;
  background: #343434;
}
 .pr-item  .pr-title {
	font-size: 16px;
	  color: #fff;
	margin-left:10px;
}
 .pr-item  .pr-img {
	 text-align: center;	
  /*width: 228px;*/
  padding: 4px;
}
 .pr-item  .pr-img img{
  max-width: 100%;
}
.pr-item .pr-price {
  display: inline-block;	
  max-width: 100%;
  text-align: left;
  margin-top:5px;
}
.pr-item .pr-price .pr-ava{
  width: 56px;
  float:left;
  padding-left: 8px;
}
.pr-item .pr-price .pr-ava img{
  width: 48px;
}
.pr-item .pr-price .pr-info{
  max-width: 160px;
  float:left;
  font-size: 12px;
  color: #fff;

}
.pr-item .pr-link {
  display: inline-block;	
  max-width: 100%; 
  float: right;
  margin-top:5px;

}
.pr-item .pr-link a{
  font-size: 12px;
  color: #49ADCD;
  text-decoration: none;	
}
</style>
<?php   if($portfolios){
 foreach ($portfolios as $portfolio) {?>
    <div class="pr-item">
        <div class="pr-title">
            <?php echo $portfolio['ptitle'];?>
        </div>
        <div class="pr-img">
          <a href="/freelancers/item/<?php echo $portfolio['fid'];?>"> 
             <img src="<?php echo html_image_src($portfolio['fileimg'], 'normal', true);?>"/>                         
          </a>
        </div>
        <div class="pr-price">
           <div class="pr-ava">
             <?php echo html_avatar_image($portfolio['user_avatar'], 'normal', true);?>                         
           </div>
           <div class="pr-info">
             <?php echo $portfolio['ftitle'];?>
           </div>
           <div class="pr-link">
              <a href="/freelancers/item/<?php echo $portfolio['fid'];?>">Посмотреть все работы</a>
           </div>
        </div>		
     </div>
<?php }} ?>
        </div>
