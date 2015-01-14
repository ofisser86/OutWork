<?php

class actionFreelancersWidgetCatsAjax extends cmsAction {

    public function run(){
		if (!$this->request->isAjax()){ cmsCore::error404(); }
		$ctype_id = $this->request->get('value');
		if (!$ctype_id) { cmsCore::error404(); }
		$cats = $this->model->getUslug($ctype_id);
		$cats_list = array();
		if ($cats){ 
			foreach($cats as $cat){
				$cats_list[$cat['id']] = $cat['name'];
			}
		}
		cmsTemplate::getInstance()->renderJSON($cats_list);
    }
}
