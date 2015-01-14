<?php
	$this->setPageTitle($frel['user_nickname']);
	$this->addBreadcrumb(LANG_FREELANCERS_CONTROLLER, $this->href_to(''));
	$this->addBreadcrumb($frel['user_nickname']);
	$user = cmsUser::getInstance();
	$this->addJS('templates/default/controllers/freelancers/js/freelancers.js');
	if ($userfreelanc){
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
	if ($myprofil || $user->is_admin){
	if($proekt['hits'] !=1){
	    $this->addToolButton(array(
			'class' => 'edit',
			'title' => LANG_FREELANCERS_CLOSSEPROECTS,
			'href' => $this->href_to('closse', $proekt['id'])
		));
		}
		$this->addToolButton(array(
			'class' => 'edit',
			'title' => LANG_FREELANCERS_EDITPROECTS,
			'href' => $this->href_to('editproekt', $proekt['id'])
		));
		$this->addToolButton(array(
			'class' => 'delete',
			'title' => LANG_FREELANCERS_DELETEPROECTS,
			'href' => $this->href_to('deleteproekt', $proekt['id'])
		));
	}	
?>
<div class="fcontainer">
   <div class="lnk-block">
        <a href="<?php echo $this->href_to('spez');?>" ><?php echo LANG_FREELANCERS_CATALOG;?></a>
        <a href="<?php echo $this->href_to('sakaz');?>" > <?php echo LANG_ZFREELANCERS_CATALOG;?></a>
        <a href="<?php echo $this->href_to('proektes');?>" class="active"><?php echo LANG_FREELANCERS_PROECTS;?></a>
    </div>
	 <div class="fl-view-item-block">

        <div class="fl-view-item">
            <table class="fl-view-table">
                <tr>
                    <td rowspan="2" class="fl-ava">
                        <a href="<?php echo $this->href_to('item', $frel['id']); ?>">
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
							    <?php	if($proekt['hits'] ==1){echo'[Проект решон]<br>';}?>

                          <a href="<?php echo $this->href_to('item', $frel['id']); ?>" ><?php echo $frel['user_nickname']; ?></a></div>
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
                    </td><td></td>
                     <td class="pr">
				<?php if ($proekt['zena']){echo	'<div class="price">'.$proekt['zena'].' '.LANG_CURRENCY.'</div>'; 
				}else{echo '<div class="price-dog">'.LANG_FREELANCERS_NOZENAPROECTS.'</div>';
			    }
				if($proekt['privat'] == '1'){
				echo'<div class="fs-pr">только '.$this->controller->options['tupe3'].'</div>';
				}
				?>
                    </td>
                </tr>
            </table>
        </div>
       </div>   		
 <div class="fs-item">
            <div class="fl-item-info">
               <span>
			   <?php echo LANG_FREELANCERS_SPES.': '.$proekt['cname'];?> -> <?php echo $proekt['uname'];?>
               </span>
            </div>
            <div class="fl-item-info">
			<?php echo '
                <span>Проект - <a  ';
				if ($proekt['privat'] =='0'){echo' class="open"';} 
				if ($proekt['privat'] =='1'){echo'class="clos"';} echo'>';
				if ($proekt['privat'] =='0'){echo LANG_FREELANCERS_OPENPROECTS;}
				if ($proekt['privat'] =='1'){echo LANG_FREELANCERS_CLOSEPROECTS;} echo'</a></span>
                <span>Создан: <a>'.$proekt['pdate'].'</a></span>
                <span class="comm">
                     '.LANG_FREELANCERS_PREDLOGPROECTS.' '.$proekt['coun'].'
                </span>'; ?>
            </div>
        </div>
	   
       <h3><?php echo $proekt['title'];?></h3>

       <div style="width:100%;  float:left;  padding:5px;" />
          <?php echo $proekt['content'];?>
       </div>
          <h3><?php echo LANG_FREELANCERS_PREDLOGSPROECTS.' ('.$proekt['coun'];?>)</h3>
<?php 
 foreach ($proekts as $otvet){ 
 if($otvet){ ?>

    <div class="fl-items">
        <div class="fs-item" >
            <div class="fs-item-date">
                <span class="day"><?php echo $otvet['dya']; ?></span>
                <div class="date"><?php echo $otvet['myar']; ?></div>
            </div>
            <table class="fl-table">
                <tr>
                    <td rowspan="0" class="fs-ava2"  style="  width: 90px;">
						<?php echo html_avatar_image($otvet['user_avatar'], 'small'); ?>
                          <div 
<?php						  
if ($otvet['ftupe'] == $this->controller->options['tupe1']){echo 'class="st-new"';}
if ($otvet['ftupe'] == $this->controller->options['tupe2']){echo 'class="st-spec"';}
if ($otvet['ftupe'] == $this->controller->options['tupe3']){echo 'class="st-profi"';}
echo ' >';
                          echo  $otvet['ftupe']; 
echo ' </div>	<div ';
if ($otvet['fstat']=='1'){ echo 'class="st-svob"';}
if ($otvet['fstat']=='2'){ echo 'class="st-sanat"';} 
echo '>';
if ($otvet['fstat'] == '1'){echo LANG_FREELANCER_TEXTSTAT1;}
if ($otvet['fstat'] == '2'){echo LANG_FREELANCER_TEXTSTAT2;}
?>                     
                    </td>
                    <td>
                        <div class="fl-desc">
                           <?php echo $otvet['content']; ?>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="fl-item-info">
                <span>Автор: <a href="<?php echo $this->href_to('item', $otvet['fid']); ?>"><?php echo $otvet['user_nickname'];?></a></span>|
                <span>Работ в портфолио: <a href="/freelancers/freelanc-{$pro.fid}"><?php echo $otvet['portfolio']; ?></a></span>
            </div>
        </div>
    </div>
<?php }}


if($status == '1' || $myprofil){
$this->renderForm($form, $potvet, array(
		'action' => '',
		'method' => 'post',
		'toolbar' => false
	), $errors); } ?>
       </div>
       <hr>


	 