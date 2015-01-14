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
        <a href="<?php echo $this->href_to('spez');?>"><?php echo LANG_FREELANCERS_CATALOG;?></a>
        <a href="<?php echo $this->href_to('sakaz');?>"> <?php echo LANG_ZFREELANCERS_CATALOG;?></a>
        <a href="<?php echo $this->href_to('proektes');?>" class="active"><?php echo LANG_FREELANCERS_PROECTS;?></a>
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
        <label><?php echo LANG_FREELANCERS_TUPEPROECTS;?>: </label>
		<?php echo html_select('privat', array(""=>LANG_FREELANCERS_NOU, "2" =>LANG_FREELANCERS_OPENPROECTS,"1"=>LANG_FREELANCERS_CLOSEPROECTS)); ?>
        <br clear="both">
		<input type="submit" value="Показать" id="submit" >
     </form>
    </div>

    <div class="fl-view-item-block">
<?php	 if($proekts){
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
			   '.LANG_FREELANCERS_SPES.': '.$proekt['cname'].' -> '.$proekt['uname'].'
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
}?>
</div>
</div>
<?php if($total > $perpage) { ?>
	<?php echo html_pagebar($page, $perpage, $total, $ur); ?>	
<?php } ?>
