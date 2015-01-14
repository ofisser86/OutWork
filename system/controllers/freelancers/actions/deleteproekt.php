<?php

class actionFreelancersDeleteproekt extends cmsAction {
	public function run($pfid=false){
		if (!$pfid) { cmsCore::error404(); }
		$user = cmsUser::getInstance();
		$proect = $this->model->getproekt($pfid);
		if (!cmsUser::isAdmin()&&$user ->id != $proect['user_id']) { cmsCore::error404(); }
		$this->model->deleteProect($pfid);
		$this->redirectTo('freelancers');
	}
}