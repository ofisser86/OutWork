<?php

class backendFreelancers extends cmsBackend {
	
	public $useDefaultOptionsAction = true;
	
	public function actionIndex(){
		$this->redirectToAction('options');
	}
	
	public function getBackendMenu() {
		return array(
			array(
				'title' => LANG_OPTIONS,
				'url' => href_to($this->root_url, 'options')
			),
			array(
				'title' => LANG_FREELANCERS_CATS,
				'url' => href_to($this->root_url, 'cats')
			)			
		);
	}
}

