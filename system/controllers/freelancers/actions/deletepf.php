<?php

class actionFreelancersDeletepf extends cmsAction {
	public function run($pfid=false){
		if (!$pfid) { cmsCore::error404(); }
		//if (!cmsUser::isAdmin()) { cmsCore::error404(); }
		$photo = $this->model->getPortfolioPhoto($pfid);
		$this->model->deletePortfolioPhoto($pfid);
		$portfolio = $this->model->getPortfolio($photo['portfolio_id']);
		$this->redirectToAction('item', array($portfolio['spezid']));
	}
}