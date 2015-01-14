<?php

class actionFreelancersDeleteportfolio extends cmsAction {
	
	public function run($id=false){
		if (!$id) { cmsCore::error404(); }
		$portfolio = $this->model->getPortfolio($id);
		if (!$portfolio) { cmsCore::error404(); }
		$this->model->deletePortfolio($id);
		$this->redirectToAction('item', array($portfolio['spezid']));

	}
	
}