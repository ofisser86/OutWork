<?php
	$this->setPageTitle($frel['user_nickname']);
	$this->addBreadcrumb(LANG_FREELANCERS_CONTROLLER, $this->href_to(''));
	$this->addBreadcrumb($frel['user_nickname']);
	$user = cmsUser::getInstance();
	$this->addJS('templates/default/controllers/freelancers/js/freelancers.js');
	if (!$myprofil && $userfreelanc){
        $this->addToolButton(array(
			'class' => 'profile',
			'title' => LANG_FREELANCERS_MYF,
			'href' => $this->href_to('item', $userfreelanc['id'])
		));
	}
	if (!$userfreelanc && $user->id){
	 $this->addToolButton(array(
			'class' => 'add',
			'title' => LANG_FREELANCERS_ADD,
			'href' => $this->href_to('add')
		));
	}
	if ($myprofil){
	    if ($frel['stat'] == '1'){$tstatus = LANG_FREELANCERS_ZSTATUS;}
        if ($frel['stat'] == '2'){$tstatus = LANG_FREELANCERS_SSTATUS;}
		$this->addToolButton(array(
			'class' => 'edit',
			'title' => $tstatus,
			'href' => $this->href_to('status', $frel['id'])
		));
	}
	if ($myprofil || $user->is_admin){
	
		$this->addToolButton(array(
			'class' => 'edit',
			'title' => LANG_FREELANCERS_EDIT,
			'href' => $this->href_to('edit', $frel['id'])
		));
		$this->addToolButton(array(
			'class' => 'delete',
			'title' => LANG_FREELANCERS_DELETE,
			'href' => $this->href_to('deletefreelancer', $frel['id'])
		));
	}	
?>
<div class="fcontainer">
   <div class="lnk-block">
        <a href="<?php echo $this->href_to('spez');?>" {if $freelancer.hom == 'f'}class="active"{/if}><?php echo LANG_FREELANCERS_CATALOG;?></a>
        <a href="<?php echo $this->href_to('sakaz');?>" {if $freelancer.hom == 'z'}class="active"{/if}> <?php echo LANG_ZFREELANCERS_CATALOG;?></a>
        <a href="<?php echo $this->href_to('proektes');?>"><?php echo LANG_FREELANCERS_PROECTS;?></a>
    </div>
	 <div class="fl-view-item-block">
        <div class="fl-view-item">
            <table class="fl-view-table">
                <tr>
                    <td rowspan="2" class="fl-ava">
                        <a href="<?php echo href_to('users', $frel['user_id']); ?>">
						<?php echo html_avatar_image($frel['user_avatar'], 'small'); ?>
						</a>						
                        <div 			
<?php if ($frel['hom'] == 'f'){
if ($frel['tupe'] == $this->controller->options['tupe1']){echo 'class="st-new"';}
if ($frel['tupe'] == $this->controller->options['tupe2']){echo 'class="st-spec"';}
if ($frel['tupe'] == $this->controller->options['tupe3']){echo 'class="st-profi"';}
}
if ($frel['hom'] == 'z'){
if ($frel['tupe'] == $this->controller->options['ztupe1']){echo 'class="st-new"';}
if ($frel['tupe'] == $this->controller->options['ztupe2']){echo 'class="st-spec"';}
if ($frel['tupe'] == $this->controller->options['ztupe3']){echo 'class="st-profi"';}
}
echo '>'.$frel['tupe'].'</div> <div ';
if ($frel['stat']=='1'){ echo 'class="st-svob"';}
if ($frel['stat']=='2'){ echo 'class="st-sanat"';} 
echo '>';
if ($frel['stat'] == '1'){echo LANG_FREELANCER_TEXTSTAT1;}
if ($frel['stat'] == '2'){echo LANG_FREELANCER_TEXTSTAT2;}
?>
                 </div>
                    </td>
                    <td colspan="2">
                        <div class="u-logins">
                          <a href="<?php echo href_to('users', $frel['user_id']); ?>" ><?php echo $frel['user_nickname']; ?></a></div>
                        <div class="u-status"><?php echo $frel['statu']; ?></div>
                    </td>
                    <td width="150"><div class="rate"><?php if ($frel['user_karma']>'0'){echo '+';}
					if($frel['user_karma']<'0'){echo'-';}echo $frel['user_karma'];?></div></td>
                </tr>
                <tr>
                    <td class="u-info">
                        <div>
                            <?php echo LANG_CITY;?>: <?php if ($frel['city_name']){echo $frel['city_name'];}else{echo' Не указан';}?>
                        </div>
                         <div>
                        <?php if ($frel['hom'] == 'f'){echo LANG_FREELANCERS_RRPORTFOLIO.': ';}if ($frel['hom'] == 'z'){echo LANG_FREELANCERS_PPROECTS.':';} echo $frel['portfolio'];?>
                        </div>
                        <div>
                             <?php echo LANG_FREELANCERS_DOGOVOR.': '.$frel['predoplata'];?>
                        </div>
                        <div>
                            <?php echo LANG_FREELANCERS_ORG.': '. $frel['organisazia'];?>
                        </div>
                        <div>
                            <?php echo LANG_FREELANCERS_DATAREG;?>: <?php echo $frel['date_reg'];?>
                        </div>
                        <div>
                            <?php echo LANG_FREELANCERS_ONLINE;?> <?php if ($frel['is_online']){echo '<b style="color:#fff;  background: #0f0; padding:0 5px;">'.LANG_FREELANCERS_EONLINE.'</b>';}else{echo $frel['date_log'];}?>
                        </div>
                         <div>
                            <?php echo LANG_FREELANCERS_OTZIV;?>/<?php echo LANG_FREELANCERS_POTZIV;?>: <a href="#" onclick="getotziv('<?php echo $frel['id'];?>');  return false;" >(<?php echo $frel['ot'].'/'.$frel['pr'];?>)</a>
                         </div>
                    </td>
                    <td class="u-spec">
                        <?php echo LANG_FREELANCERS_SPES.':';?>
                        <ul>
						<?php
	                        echo'<li><c>'.$frel['cname'].'</c></li>';
	                        echo'<li><c>'.$frel['uname'].'</c></li>';
						 ?>
                        </ul>
                    </td>
                    <td class="pr">
                        <div class="u-price">
                            <?php if ($frel['minzena'] >'0'){echo LANG_FROM.' '. $frel['minzena'].' '.LANG_CURRENCY;}?>
                        </div>
                    </td>
                </tr>
            </table>
          </div>
            <?php echo $frel['messag'];?>
        </div>
       </div>   		
<hr>
<?php
	if ($frel['hom'] == 'f'){
    if ($myprofil){?>
      <div class="fl-info">
       <div class="fl-fmenu">
         <a href="#" class="fl-add1" onclick="addportfolio();  return false;" ><?php echo LANG_FREELANCERS_ADDPORTFOLIO;?></a>
       </div>
	   <div id="addportfolio" style="display:none">
	   <div class="addportfolio" >
	   <a href="#close" id="close_window" onclick="closewportfolio();  return false;"></a>
	   <h2 class="con_heading"><?php echo LANG_FREELANCERS_ADDPORTFOLIO;?></h2>
	 <?php echo $this->renderForm($form, '', array('action' => '','method' => 'post','toolbar' => false), $errors);?> 
      </div>
	  </div>

	  <?php } ?>
    <h3><?php echo LANG_FREELANCERS_RPORTFOLIO;?>(<?php echo $frel['portfolio'];?>)</h3>
     <hr>
	 <?php
	 if($portfolios ){
	  if ($myprofil){ ?>
	 	<div id="upportfolio"  style="display:none">
	       <div class="addportfolio" >
	         <a href="#close" id="close_window" onclick="closeuportfolio();  return false;"></a>
	         <h2 class="con_heading"><?php echo LANG_FREELANCERS_UPPORTFOLIO;?></h2>
	         <?php $this->renderForm($uform, '', array('action' => '','method' => 'post','toolbar' => false), $uerrors);?> 
           </div>
        </div>   
 <?php }
		foreach ($portfolios as $portfolio) {
	     echo' <div class="fl-info">	';
	     if ($myprofil){?>
       <div class="fl-fmenu">
         <a href="#" class="fl-add1" onclick="adenportfolio('<?php echo $portfolio['id'];?>');  return false;">Добавит работу</a>
       </div>

	   
    <?php } 
          echo ' <h3>'.$portfolio['title'].'('.$portfolio['count'].')';
		  if ($myprofil || $is_admin){ echo'(
		  <a href="'.$this->href_to('deleteportfolio', $portfolio['id']).'">удалить</a>)';}
		  echo '</h3>';
				if($portfolio['portf']){
		foreach ($portfolio['portf'] as $port) {
echo'
<div class="topface topface2"> 
<s id="phid'.$port['id'].'">';
if ($myprofil || $is_admin){
echo'<em class="em_girl" id="pfid'.$port['id'].'" style="display:none;">
<a href="'.$this->href_to('deletepf', $port['id']).'">удалить</a>
</em>';
} ?>
<p href="#"  class="  ps" onclick="portfolio('<?php echo $port['title']; ?>', '<?php echo html_image_src($port['fileimg'], 'original', true);?>');  return false;"
style="background: url('<?php echo html_image_src($port['fileimg'], 'normal', true);?>') no-repeat;">
<span class="pwa"></span>
</p>
<?php echo'
</s> 
<div> 
<a  class="girl">'.$port['title'].'</a>  
</div> 
</div>     
<script type="text/javascript">
$(function(){
$(\'#phid'.$port['id'].'\').hover(
function(){
$(\'#pfid'.$port['id'].'\').fadeOut(500, function(){
        $(\'#pfid'.$port['id'].'\').show();
      });
},
function(){
$(\'#pfid'.$port['id'].'\').fadeOut(300, function(){
        $(\'#pfid'.$port['id'].'\').hide();
      });
}
);
});            
</script>';
         }
		 }
echo'</div><br><hr>';
     }
	 }
}

if ($frel['hom'] == 'z'){
    if ($myprofil ){
     echo' <div class="fl-info">
       <div class="fl-fmenu">
         <a href="'.$this->href_to('addproekt').'" class="fl-add1" >'.LANG_FREELANCERS_ADDPROECTS.'</a>
       </div>
      </div>';
    }
    echo'<h3>'.LANG_FREELANCERS_PROECTS.'('.$frel['portfolio'].')</h3>
     <hr>';
	 if($proekts){
		foreach ($proekts as $proekt) {
echo'
    <div class="fl-items">
        <div class="fs-item">
            <div class="fs-item-date">
                <span class="day">'.$proekt['dya'].'</span>
                <div class="date">'.$proekt['myar'].'</div>
            </div>
            <table class="fl-table">
                <tr>
                    <td>
                        <a href="'.$this->href_to('proekt', $proekt['id']).'" class="fl-title">';
                           if ($proekt['hits']=='1'){echo'[решено]';}
						   echo $proekt['title'].'
                        </a>
                        <div class="fl-desc">
                          '.html_clean($proekt['chtml'], 350).'
                        </div>
                    </td>
                    <td class="fs-price">';
                       if ($proekt['zena']){echo'
                          <div class="price"> '.$proekt['zena'].' <span>'.LANG_CURRENCY.'</span></div>';
                        }else{echo'
                          <div class="price-dog">'.LANG_FREELANCERS_NOZENAPROECTS.'</div>';
                        }
                       if ($proekt['privat'] =='1'){echo'
                        <div class="fs-pr">'.LANG_FREELANCERS_T.' '.$this->controller->options['tupe3'].'</div>';
                       }
					   echo'
                    </td>
                </tr>
            </table>
            <div class="fl-item-info">
                <span>'.LANG_FREELANCERS_SPES.': '.$proekt['cname'].' -> '.$proekt['uname'].'</span>
            </div>
            <div class="fl-item-info">
                <span>Проект - <a  ';
				if ($proekt['privat'] =='0'){echo' class="open"';} 
				if ($proekt['privat'] =='1'){echo'class="clos"';} echo'>';
				if ($proekt['privat'] =='0'){echo LANG_FREELANCERS_OPENPROECTS;}
				if ($proekt['privat'] =='1'){echo LANG_FREELANCERS_CLOSEPROECTS;} echo'</a></span>

                <span class="comm">
                     '.LANG_FREELANCERS_PREDLOGPROECTS.' '.$proekt['coun'].'
                </span>
            </div>
        </div>
    </div>';
}
}
}

	
