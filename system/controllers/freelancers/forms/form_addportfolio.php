<?php

class formFreelancersAddportfolio extends cmsForm {
	
	public function init(){
	
		return array(
		
			array(
				'type' => 'fieldset',
				'childs' => array(
									
					new fieldString('title', array(
						'title' => LANG_FREELANCERS_TITLEPORTFOLIO,
						'rules' => array(
							array('required'),
							array('max_length', 150),
							array('min_length', 10)
						)
					))
 					
				)
				
			)
			
		);		
		
	}	
	
}