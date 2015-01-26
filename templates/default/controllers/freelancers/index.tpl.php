<?php
	$this->setPageTitle(LANG_FREELANCERS_CONTROLLER);
	$this->addBreadcrumb(LANG_FREELANCERS_CONTROLLER);

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
	
	
	?>
<div class="fcontainer">
   <div class="lnk-block">
        <a href="<?php echo $this->href_to('spez');?>" <?php if($tupe == 'f'){ echo 'class="active"'; } ?>><?php echo LANG_FREELANCERS_CATALOG;?></a>
        <a href="<?php echo $this->href_to('sakaz');?>" <?php if($tupe == 'z'){ echo 'class="active"'; } ?>> <?php echo LANG_ZFREELANCERS_CATALOG;?></a>
        <a href="<?php echo $this->href_to('proektes');?>"><?php echo LANG_FREELANCERS_PROECTS;?></a>
        <div class="clear"></div>
  </div>
  <div class="fl-tab">
        <a href="javascript:void(0)" onclick="$('#filter').slideToggle();"  class="filter">Расширенный поиск</a>
        <div class="clear"></div>
  </div>
    <div id="filter" style="display:none">
      <form method="get" id="spec_search_form" action="<?php echo cmsCore::getInstance()->uri_absolute; ?>">
        <h2><?php echo LANG_FREELANCERS_FILTER;?></h2>

        <label><?php echo LANG_FREELANCERS_CAT;?>: </label>
		<?php echo html_select('cat_id',$cats,'', array("id"=>"cat_id")); ?>
        <br clear="both">
        <label>Выберите услугу: </label>
		<?php echo html_select('uslugi','','', array("id"=>"uslugi")); ?>
	    <script>
		   $('#cat_id').on('change', function(){
			   icms.forms.updateChildList('uslugi', '/freelancers/widget_cats_ajax', $(this).val()); 
		   });
	    </script>	   
        <br clear="both">
        <label><?php echo LANG_FREELANCERS_DOGOVOR;?>: </label>
		<?php echo html_select('predoplata', array(""=>LANG_FREELANCERS_NOU,"да"=>"да","нет"=>"нет")); ?>
        <br clear="both">
        <label><?php echo LANG_FREELANCERS_ORG;?>: </label>
		<?php echo html_select('organisazia', array(""=>LANG_FREELANCERS_NOU,LANG_FREELANCERS_ORGCHP=>LANG_FREELANCERS_ORGCHP,LANG_FREELANCERS_ORGOOO=>LANG_FREELANCERS_ORGOOO,LANG_FREELANCERS_ORGCHL=>LANG_FREELANCERS_ORGCHL)); ?>
        <br clear="both">
        <label>Статус занятости: </label>
		<?php echo html_select('stat', array(""=>LANG_FREELANCERS_NOU,"1"=>LANG_FREELANCER_TEXTSTAT1,"2"=>LANG_FREELANCER_TEXTSTAT2)); ?>		
        <br clear="both">
       <input type="submit" value="Показать" id="submit" >
     </form>
    </div>
    <div class="fl-view-item-block">
	<?php	foreach($freelancers as $freelancer){ ?>
        <div class="fl-view-item">
            <table class="fl-view-table">
                <tr>
                    <td rowspan="2" class="fl-ava">
                        <a href="<?php echo $this->href_to('item', $freelancer['id']); ?>">
						<?php echo html_avatar_image($freelancer['user_avatar'], 'small'); ?>
						</a>
                                              <div 			
<?php if ($tupe == 'f'){
if ($freelancer['tupe'] == $this->controller->options['tupe1']){echo 'class="st-new"';}
if ($freelancer['tupe'] == $this->controller->options['tupe2']){echo 'class="st-spec"';}
if ($freelancer['tupe'] == $this->controller->options['tupe3']){echo 'class="st-profi"';}
}
if ($tupe == 'z'){
if ($freelancer['tupe'] == $this->controller->options['ztupe1']){echo 'class="st-new"';}
if ($freelancer['tupe'] == $this->controller->options['ztupe2']){echo 'class="st-spec"';}
if ($freelancer['tupe'] == $this->controller->options['ztupe3']){echo 'class="st-profi"';}
}
echo '>'.$freelancer['tupe'].'</div> <div ';
if ($freelancer['stat']=='1'){ echo 'class="st-svob"';}
if ($freelancer['stat']=='2'){ echo 'class="st-sanat"';} 
echo '>';
if ($freelancer['stat'] == '1'){echo LANG_FREELANCER_TEXTSTAT1;}
if ($freelancer['stat'] == '2'){echo LANG_FREELANCER_TEXTSTAT2;}
?>
                    </td>
                    <td colspan="2">
                        <div class="u-logins"><a href="<?php echo $this->href_to('item', $freelancer['id']); ?>" ><?php echo $freelancer['user_nickname']; ?></a></div>
                        <div class="u-status"><?php echo $freelancer['statu']; ?></div>
                    </td>
                    <td width="150"><div class="rate"><?php if ($freelancer['user_karma']>'0'){echo '+';}
					if($freelancer['user_karma']<'0'){echo'-';}echo $freelancer['user_karma'];?></div></td>
                </tr>
                <tr>
                    <td class="u-info">
                        <div>
                            <?php echo LANG_CITY;?>: <?php if ($freelancer['city_name']){echo $freelancer['city_name'];}else{echo' Не указан';}?>
                        </div>
                        <div>
                        <?php if ($tupe == 'f'){echo LANG_FREELANCERS_RRPORTFOLIO.': ';}if ($tupe == 'z'){echo LANG_FREELANCERS_PPROECTS.':';} echo $freelancer['portfolio'];?>
                        </div>
                        <div>
                             <?php echo LANG_FREELANCERS_DOGOVOR.': '.$freelancer['predoplata'];?>
                        </div>
                        <div>
                            <?php echo LANG_FREELANCERS_ORG.': '. $freelancer['organisazia'];?>
                        </div>
                        <div>
                            <?php echo LANG_FREELANCERS_DATAREG;?>: <?php echo $freelancer['date_reg'];?>
                        </div>
                        <div>
                            <?php echo LANG_FREELANCERS_ONLINE;?> <?php if ($freelancer['is_online']){echo '<b style="color:#fff;  background: #0f0; padding:0 5px;">'.LANG_FREELANCERS_EONLINE.'</b>';}else{echo $freelancer['date_log'];}?>
                        </div>
                         <div>
                            <?php echo LANG_FREELANCERS_OTZIV;?>/<?php echo LANG_FREELANCERS_POTZIV;?>: <a href="#" onclick="getotziv('<?php echo $freelancer['id'];?>');  return false;" >(<?php echo $freelancer['ot'].'/'.$freelancer['pr'];?>)</a>
                          </div>

                    </td>
                    <td class="u-spec">
                        <?php echo LANG_FREELANCERS_SPES.':';?>
                        <ul>
						<?php
	                        echo'<li><c>'.$freelancer['cname'].'</c></li>';
	                        echo'<li><c>'.$freelancer['uname'].'</c></li>';
						 ?>
                        </ul>
                    </td>
                    <td class="pr">
                        <div class="u-price">
<?php if ($freelancer['minzena'] >'0'){echo LANG_FROM.' '. $freelancer['minzena'].' '.LANG_CURRENCY;}?>
                      
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    

<?php } ?>
</div>
</div>
<?php if($total > $perpage) { ?>
	<?php echo html_pagebar($page, $perpage, $total, $ur); ?>	
<?php } ?>