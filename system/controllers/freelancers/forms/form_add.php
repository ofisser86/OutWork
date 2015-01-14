<?php

class formFreelancersAdd extends cmsForm {
	
	public function init($tupes,$frel=false){
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
			if($tupes == 'add'){
		return array(
			array(
				'type' => 'fieldset',
                'title' => LANG_FREELANCERS_WOIS,				
				'childs' => array(
					new fieldList('tupe', array(
						'items' => array(
							'f' => LANG_FREELANCER,
							'z' => LANG_ZFREELANCER
						)
					)),
					)
				
			),
	 array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_DOGOVOR,
                'childs' => array(	
					new fieldList('predoplata', array(
						'items' => array(
							'да' => LANG_YES,
							'нет' => LANG_NO
						)
					)),
					)
				
			),
	 array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_ORG,
                'childs' => array(	
					new fieldList('organisazia', array(
       					'items' => array(
							LANG_FREELANCERS_ORGCHP => LANG_FREELANCERS_ORGCHP,
							LANG_FREELANCERS_ORGOOO => LANG_FREELANCERS_ORGOOO,
							LANG_FREELANCERS_ORGCHL => LANG_FREELANCERS_ORGCHL							
						)
					)),
					)
				
			),
	 array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_SPES,
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
                'title' => LANG_FREELANCERS_MINZENA,
                'childs' => array(				
                    new fieldNumber('minzena', array(
					'rules' => array(
					        array('required')                        )
                    )),
 					
				)
				
			),
			array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_DOPINFA,
                'childs' => array(				
                    new fieldText('messag', array(
					'rules' => array(
					        array('required')
							),
					)),
 						
				)
			
			)
		);		
		}else{
		return array(
			
	 array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_DOGOVOR,
                'childs' => array(	
					new fieldList('predoplata', array(
						'items' => array(
							'да' => LANG_YES,
							'нет' => LANG_NO
						)
					)),
					)
				
			),
	 array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_ORG,
                'childs' => array(	
					new fieldList('organisazia', array(
       					'items' => array(
							LANG_FREELANCERS_ORGCHP => LANG_FREELANCERS_ORGCHP,
							LANG_FREELANCERS_ORGOOO => LANG_FREELANCERS_ORGOOO,
							LANG_FREELANCERS_ORGCHL => LANG_FREELANCERS_ORGCHL							
						)
					)),
					)
				
			),
	 array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_SPES,
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
                'title' => LANG_FREELANCERS_MINZENA,
                'childs' => array(				
                    new fieldNumber('minzena', array(
					'rules' => array(
					        array('required')
							),
                    )),
 					
				)
				
			),
			array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_DOPINFA,
                'childs' => array(				
                    new fieldText('messag', array(
					'rules' => array(
					        array('required')
							),
					)),
 						
				)
			
			)
		);	
		
		}
	}	
	
}