<?php

class actionFreelancersAddotziv extends cmsAction {
	
	public function run($fid){
		$user = cmsUser::getInstance();
		echo $fid;
		
		if (!$fid || !$this->request->has('text') || !$this->request->has('tupe') || !$user->id) { return; }
		$dats['f_id'] = $fid;
		$dats['user_id'] = $user->id;
		$dats['text'] = $this->request->get('text');
		$dats['tupe'] = $this->request->get('tupe');
		$dats['pubdate'] = date('Y-m-d H:i');
		$this->model->addotziv($dats);
		return true;
	}
}