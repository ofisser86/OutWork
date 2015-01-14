<?php

class actionFreelancersOtziv extends cmsAction {
	
	public function run($id=false){
		
		if (!$id) { cmsCore::error404(); }		
		$otziv = $this->model->getotziv($id);
        $template = cmsTemplate::getInstance();		
		$user = cmsUser::getInstance();
		$template->render('otziv', array(
			'otziv' => $otziv,
			'fid' => $id,
			'user' => $user,			
			'prf' => $this->model->getfrel($id)
			
		));
		
	}
	
}