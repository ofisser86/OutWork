<?php

class formFreelancersOptions extends cmsForm {
	
	public function init(){
		
		return array(
		
			array(
				'type' => 'fieldset',
				'childs' => array(
					
					new fieldList('home', array(
						'title' => LANG_FREELANCERS_LOAD,
						'items' => array(
							'f' => LANG_FREELANCERS_CATALOG,
							'z' => LANG_ZFREELANCERS_CATALOG,
						)
					)),
					
					new fieldNumber('perpage', array(
						'title' => LANG_FREELANCERS_PPEGE,
						'default' => 10
					)), 
					new fieldNumber('pperpage', array(
						'title' => LANG_PFREELANCERS_PPEGE,
						'default' => 10
					)), 
					new fieldString('tupe1', array(
						'title' => LANG_PFREELANCERS_TUPE1,
						'default' => 'новичок',
						'rules' => array(
							array('required'),
							array('max_length', 100),
							array('min_length', 3)
						)
					)),
					new fieldString('tupe2', array(
						'title' => LANG_PFREELANCERS_TUPE2,
						'default' => 'спец',
						'rules' => array(
							array('required'),
							array('max_length', 100),
							array('min_length', 3)
						)
					)),
					new fieldNumber('counttupe2', array(
						'title' => LANG_PFREELANCERS_COUNTTUPE2,
						'default' => '5'
					)),
					new fieldString('tupe3', array(
						'title' => LANG_PFREELANCERS_TUPE3,
						'default' => 'профи',
						'rules' => array(
							array('required'),
							array('max_length', 100),
							array('min_length', 3)
						)
					)),
					new fieldNumber('counttupe3', array(
						'title' => LANG_PFREELANCERS_COUNTTUPE3,
						'default' => '10'
					)),
					new fieldString('ztupe1', array(
						'title' => LANG_PFREELANCERS_ZTUPE1,
						'default' => 'новичок',
						'rules' => array(
							array('required'),
							array('max_length', 100),
							array('min_length', 3)
						)
					)),
					new fieldString('ztupe2', array(
						'title' => LANG_PFREELANCERS_ZTUPE2,
						'default' => 'спец',
						'rules' => array(
							array('required'),
							array('max_length', 100),
							array('min_length', 3)
						)
					)),
					new fieldNumber('zcounttupe2', array(
						'title' => LANG_PFREELANCERS_ZCOUNTTUPE2,
						'default' => '5'
					)),
					new fieldString('ztupe3', array(
						'title' => LANG_PFREELANCERS_ZTUPE3,
						'default' => 'профи',
						'rules' => array(
							array('required'),
							array('max_length', 100),
							array('min_length', 3)
						)
					)),
					new fieldNumber('zcounttupe3', array(
						'title' => LANG_PFREELANCERS_ZCOUNTTUPE3,
						'default' => '10'
					))
				)
				
			)
			
		);
		
	}
	
}
