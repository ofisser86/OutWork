<?php

class actionFreelancersStatus extends cmsAction {
	
	public function run($id){
		$user = cmsUser::getInstance();		
		if (!$id) { cmsCore::error404(); }
		$frel = $this->model->getfrel($id);
		if (!$frel) { cmsCore::error404(); }
		if($frel['user_id'] == $user->id){
		if($frel['stat'] == '1'){$st['stat'] = '2';}
		if($frel['stat'] == '2'){$st['stat'] = '1';}		
		$this->model->updatefrelans($id, $st);
		}
		$this->redirectToAction('item', array($id));

	}
	
}
