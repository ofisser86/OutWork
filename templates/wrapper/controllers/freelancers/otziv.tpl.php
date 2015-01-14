    <div id="form-tabs" class="tabs-menu">
        <ul>
                    <li id="ot1"><a href="#tab-1"><?php echo LANG_FREELANCERS_OTZIV;?></a></li>
                    <li><a href="#tab-2"><?php echo LANG_FREELANCERS_POTZIV;?></a></li>
	    </ul>
		<div id="tab-1" class="otab">
		  <div class="fl-tab">
		  <?php if($user->id&&$user->id!=$prf['user_id']){?>
            <a href="#" onclick="addotziv('<?php echo $fid;?>', 'o'); return false;" class="filter"><?php echo LANG_FREELANCERS_ADDOTZIV;?></a>
          <?php } ?>
          </div>
          <div class="add-otzivo"></div>
<?php   if($otziv){
        foreach ($otziv as $us) {
	      if($us['tupe'] == 'o'){?>
		  <div class="fs-item" >
            <table class="fl-table">
                <tr>
                    <td rowspan="0" class="fs-ava2"  style="  width: 75px;">
                       <?php echo html_avatar_image($us['user_avatar'], 'small');?>                         
                    </td>
                    <td>
					    <div class="fl-item-info">
                             <span><?php echo $us['user_nickname'];?></span>|
                             <span> <?php echo $us['dates'];?></span>
                        </div>
                        <div class="fl-desc">
                            <?php echo $us['text'];?>
                        </div>
                    </td>
                </tr>
            </table>
            
         </div>
<?php
			}	
		}
		}
		?>
		</div>
		<div id="tab-2" class="otab">
		  <div class="fl-tab">
		  <?php if($user->id&&$user->id!=$prf['user_id']){?>		  
               <a href="#" onclick="addotziv('<?php echo $fid;?>', 'p'); return false;" class="filter"><?php echo LANG_FREELANCERS_ADDPOTZIV;?></a>
          <?php } ?>
          </div>
          <div class="add-otzivp"></div>
		<?php   if($otziv){
        foreach ($otziv as $us) {
	      if($us['tupe'] == 'p'){?>
		  <div class="fs-item" >
            <table class="fl-table">
                <tr>
                    <td rowspan="0" class="fs-ava2"  style="  width: 75px;">
                       <?php echo html_avatar_image($us['user_avatar'], 'small');?>                         
                    </td>
                    <td>
					    <div class="fl-item-info">
                             <span><?php echo $us['user_nickname'];?></span>|
                             <span> <?php echo $us['dates'];?></span>
                        </div>
                        <div class="fl-desc">
                            <?php echo $us['text'];?>
                        </div>
                    </td>
                </tr>
            </table>
            
         </div>
<?php
			}	
		}
		}
		?>
		</div>
		</div>
		<script>

                $('#form-tabs .otab').hide();
                $('#form-tabs #tab-1').show();
                $('li #ot1').addClass('active');

                $('#form-tabs ul li a').click(function(){
                    $('#form-tabs li').removeClass('active');
                    $(this).parent('li').addClass('active');
                    $('#form-tabs .otab').hide();
                    $('#form-tabs '+$(this).attr('href')).show();
                    return false;
                });

        </script>