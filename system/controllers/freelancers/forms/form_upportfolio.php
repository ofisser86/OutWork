<?php

class formFreelancersUpportfolio extends cmsForm {
	
	public function init(){
	
		return array(
		
			array(
				'type' => 'fieldset',
				
				'childs' => array(
 					new fieldString('title', array(
						'title' => LANG_FREELANCERS_TITLEP,
                        'rules' => array(
                            array('max_length', 200)
                        )
					)),
					new fieldHidden('portfolio_id', array()),

					new fieldImage('fileimg', array(
						'title' => LANG_FREELANCERS_FILEP,
						'options' => array(
						   'sizes' => array('normal', 'original')
						),
						'rules' => array(
							array('required')
						)
					)),

					
				)
				
			)
			
		);		
		
	}	
	
}