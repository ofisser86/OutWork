<?php

class actionFreelancersProektes extends cmsAction {
	
    public function run(){
        $cats = array();
        $cats = array(0 => LANG_FREELANCERS_OPENCAT);	
        if($this->model->getCat()){		
           foreach ($this->model->getCat() as $cat) {
              $cats[$cat['id']] = $cat['name'];
           }
		}	
	    $page = $this->request->get('page', 1);		
		$perpage = $this->options['pperpage'];
		$ur ='/freelancers/proektes?1=1';
		if($cat_id = $this->request->get('cat_id')){
		    $this->model->filterEqual('i.cat_id', $cat_id);
			$ur .="&cat_id=$cat_id";
		}
        if($uslugi = $this->request->get('uslugi')){
		    $this->model->filterEqual('i.uslugi', $uslugi);
			$ur .="&uslugi=$uslugi";
		}		
		if($privat = $this->request->get('privat')){
		   if($privat == '2'){$privat = '0';}
		    $this->model->filterEqual('i.privat', $privat);
			$ur .="&privat=$privat";
		}
		$total = $this->model->getcountproekts();
		$this->model->limitPage($page, $perpage);
	cmsTemplate::getInstance()->render('proektes', array(
			'proekts' => $this->model->getproekts(),
			'total' => $total,
			'page' => $page,
			'perpage' => $perpage,
			'cats' => $cats,	
			'ur' => $ur,									
			'userfreelanc' => $this->model->getuserfreelanc(cmsUser::getInstance()->id)
		));
	
	}
	
}