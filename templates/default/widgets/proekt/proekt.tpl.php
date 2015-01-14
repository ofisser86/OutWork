  <?php 
  	$this->addCSS('templates/default/controllers/freelancers/styles.css'); 
	?>
	
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
