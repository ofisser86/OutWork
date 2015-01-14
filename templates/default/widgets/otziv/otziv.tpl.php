  <div style="overflow: hidden;display: block; padding:5px;">
  <style type="text/css">
 .op-item {
  border: 1px solid #e8e8e8;
  padding: 7px;
  position: relative;
  min-height: 100px;
  margin-bottom: 10px;
}
 .op-item .op-table {
  width: 100%;
}
 .op-item .op-table td {
  vertical-align: top;
}
 .op-item .op-table td.op-ava {
  text-align: center;	
  width: 78px;
  padding: 4px;
}
 .op-item .op-table td.op-ava span{
	 font-size: 18px;
	 color: #3E84A8;
}
 .op-item .op-table td.op-ava span span{
	 color: #962B33;
}
.op-item .op-table td.op-ava img {
  width: 70px;
}
.op-item .op-table td.op-price {
  width: 110px;
  text-align: left;
  padding: 4px;
}
.op-item .op-table td.op-price a{
	  font-size: 14px;
	  color: #4D3F36;
	  text-decoration: none;
}
.op-item .op-table td .price1 {
  display: inline-block;
  background: #238ED2;
  color: #fff;
  padding: 2px 10px;
  font-size: 12px;
  margin-bottom: 10px;
}
.op-item .op-table td .price2 {
  display: inline-block;	
  background: #FE0000;
  color: #fff;
  padding: 2px 10px;
  font-size: 12px;
  margin-bottom: 10px;
}
.op-item .op-table td .op-desc {
  color: #808080;
  font-size: 12px;
  line-height: 15px;
  padding: 5px 0;
  min-height: 30px;
}
.op-item .op-price ul,
.op-item .op-price li {
  list-style: none;
  padding: 0;
  margin: 0;
}
.op-item .op-price ul li c,
.op-item .op-price li li c {
  color: #238cd1;
  text-decoration: none;
  line-height: 14px;
}
</style>
<?php   if($otzivs){
 foreach ($otzivs as $otziv) {?>
        <div class="op-item">
            <table class="op-table">
                <tr>
                    <td class="op-ava">
                        <a href="/freelancers/item/<?php echo $otziv['f_id'];?>" title="<?php echo $otziv['uf_nickname'];?>">
                       <?php echo html_avatar_image($otziv['uf_avatar'], 'small');?>                         
                        </a>
<span> +<?php echo $otziv['ot'];?> <span> -<?php echo $otziv['pr'];?></span></span>
                    </td>
                    <td class="op-price">
                      <a href="/freelancers/item/<?php echo $otziv['f_id'];?>"><?php echo $otziv['uf_nickname'];?></a>
                    </td>
                    <td>
                       <?php if ($otziv['tupe'] == 'o'){ ?>
                          <div class="price1"> Положительный</div>
                        <?php }else{ ?>
                          <div class="price2">Отрицательный</div>
                       <?php }?>
                        
                        <div class="op-desc">
                          <?php echo $otziv['text']; ?>
                        </div>
                        <div class="fl-item-info">
                <span>Автор: <a href="/users/<?php echo $otziv['user_id'];?>"><?php echo $otziv['user_nickname'];?></a> </span> | 
                <span> <?php echo $otziv['dates']; ?></span>

                        </div>
                    </td>
                    
                </tr>
            </table>
           
            </div>
<?php }} ?>
        </div>
