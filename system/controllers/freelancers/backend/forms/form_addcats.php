<?php

class formFreelancersAddcats extends cmsForm {
	
	public function init(){
		return array(
			array(
				'type' => 'fieldset',
				'title' => LANG_FREELANCERS_ADDCATS,								
				'childs' => array(
					new fieldString('name', array(
						'title' => LANG_FREELANCERS_NAMECATS,
						'rules' => array(
							array('required'),
							array('max_length', 100),
							array('min_length', 10)
						)
					))
				)
				
			)
			
		);		
		
	}	
	
}