<?php

class formFreelancersAddproectotvet extends cmsForm {
	
	public function init(){
	
		return array(
			array(
                'type' => 'fieldset',
                'title' => LANG_FREELANCERS_ADDPREDLOG,
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