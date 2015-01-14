<?php

class freelancers extends cmsFrontend {
	    protected $useOptions = true;

    public function actionClosse($id){
	    if (!$id) { cmsCore::error404(); }
        $this->model->editproekt($id, array('hits' => 1));
	    $this->redirectToAction('proekt', array($id));
    }	
	public function actionIndex(){
       $this->getfreelancers($this->options['home']);
    }
	public function actionSakaz(){
       $this->getfreelancers('z');
    }
    public function actionSpez(){
       $this->getfreelancers('f');
    }	
    public function getfreelancers($tupe){
	if(!$tupe){$tupe =$this->options['home'];}
		$page = $this->request->get('page', 1);		
	    $perpage = $this->options['perpage'];
		$template = cmsTemplate::getInstance();
		if($tupe=='f'){$ur ='/freelancers/spez?1=1';}
		if($tupe=='z'){$ur ='/freelancers/sakaz?1=1';}		
		if($cat_id = $this->request->get('cat_id')){
		    $this->model->filterEqual('i.cat_id', $cat_id);
			$ur .="&cat_id=$cat_id";
		}
        if($uslugi = $this->request->get('uslugi')){
		    $this->model->filterEqual('i.uslugi', $uslugi);
			$ur .="&uslugi=$uslugi";
		}		
		if($predoplata = $this->request->get('predoplata')){
		    $this->model->filterEqual('i.predoplata', $predoplata);
			$ur .="&predoplata=$predoplata";
		}
		if($organisazia = $this->request->get('organisazia')){
		    $this->model->filterEqual('i.organisazia', $organisazia);
			$ur .="&organisazia=$organisazia";
		}
		if($stat = $this->request->get('stat')){
		    $this->model->filterEqual('i.stat', $stat);
			$ur .="&stat=$stat";
		}
		$total = $this->model->getcountfreelancers($tupe);
		$this->model->limitPage($page, $perpage);		
		$freelancers = $this->model->getfreelancers($this->options, $tupe);
		$cats = array();
        $cats = array(0 => LANG_FREELANCERS_OPENCAT);	
        if($this->model->getCat()){		
           foreach ($this->model->getCat() as $cat) {
              $cats[$cat['id']] = $cat['name'];
           }
		}
		$template->render('index', array(
			'freelancers' => $freelancers,
			'total' => $total,
			'page' => $page,
			'tupe' => $tupe,			
			'perpage' => $perpage,
			'cats' => $cats,			
			'ur' => $ur,						
			'userfreelanc' => $this->model->getuserfreelanc(cmsUser::getInstance()->id)			
		));
		
	}
	
}