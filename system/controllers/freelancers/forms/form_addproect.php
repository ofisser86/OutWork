<?php

class formFreelancersAddproect extends cmsForm {
	
	public function init($opt,$frel=false){
	    $cats_list = array();
		if (!empty($frel['cat_id'])){
			$content_model = cmsCore::getModel('freelancers');	
		    $cats = $content_model->getUslug($frel['cat_id']);	
			if ($cats){ 
				foreach($cats as $cat){
					$cats_list[$cat['id']] = $cat['name'];
				}
			}
        }
		return array(
		
			array(
				'type' => 'fieldset',
				'title' => LANG_FREELANCERS_NAMEPROECTS,				
				'childs' => array(
									
					new fieldString('title', array(
						'rules' => array(
							array('required'),
							array('max_length', 150),
							array('min_length', 1)
						)
					))
 					
				)
			),
			 array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_CATSPROECTS,
                'childs' => array(				
                        new fieldList('cat_id', array(
                        'title' => LANG_FREELANCERS_CAT,
						'rules' => array(
                            array('required')
                        ),
                        'generator' => function($item) {
                            $freelancers_model = cmsCore::getModel('freelancers');
                            $cats = $freelancers_model->getCat();
							$items = array();
                            $items = array(0 => 'Выберите раздел');														
                            if ($cats) {
                                foreach ($cats as $item) {
                                    $items[$item['id']] = $item['name'];
                                }
                            }
                            return $items;
                        }
                    )),
					new fieldList('uslugi', array(
						'title' => LANG_FREELANCERS_SPES,
						'parent' => array(
							'list' => 'cat_id',
							'url' => href_to('freelancers', 'widget_cats_ajax')
						),
						'items' => $cats_list
					)),
 					
				)
				
			),
			array(
				'type' => 'fieldset',
                'title' => LANG_FREELANCERS_TUPEPROECTS,				
				'childs' => array(
					new fieldList('privat', array(
						'items' => array(
							'0' => LANG_FREELANCERS_OPENPROECTS,
							'1' => LANG_FREELANCERS_CLOSEPROECTS.' ('.LANG_FREELANCERS_T.' '.$opt['tupe3'].')'
						)
					)),
					)
			),
			array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_ZENAPROECTS,
                'childs' => array(				
                    new fieldNumber('zena', array(
                    )),
 					
				)
			),
			array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_DESCPROECTS,
                'childs' => array(				
                    new fieldHtml('content', array(
                        'options' => array(
                            'editor' => 'redactor'
                        )
                    )),
 					
				)
			),
		);		
		
	}	
	
}