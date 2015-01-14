<?php

class formFreelancersAdduslug extends cmsForm {
	
	public function init(){
		return array(
			array(
				'type' => 'fieldset',
				'title' => LANG_FREELANCERS_ADDCATS,								
				'childs' => array(
					new fieldString('uname', array(
						'title' => LANG_FREELANCERS_NAMECATS,
						'rules' => array(
							array('required'),
							array('max_length', 100),
							array('min_length', 10)
						)
					)),
					new fieldList('cat_id', array(
						'title' => LANG_FREELANCERS_CAT,					
                        'generator' => function($item) {

                            $model = cmsCore::getModel('freelancers');
                            $tree = $model->getCat();
                            if ($tree) {
                                foreach ($tree as $item) {
                                    $items[$item['id']] = $item['name'];
                                }
                            }

                            return $items;

                        }
                    )),
				)
				
			)
			
		);		
		
	}	
	
}