<?php

class actionFreelancersItem extends cmsAction {
	
	public function run($id = false){
		
		if (!$id) { cmsCore::error404(); }
		$user = cmsUser::getInstance();		
		$frel = $this->model->getfreelanc($id, $this->options);
		$myprofil = ($user->id == $frel['user_id']);
		if (!$frel) { cmsCore::error404(); }
		if($myprofil){
		$form = $this->getForm('addportfolio');
		$uform = $this->getForm('upportfolio');
		$is_submitted = $this->request->has('submit');
		$portf = $form->parse($this->request, $is_submitted);	
		$uportf = $uform->parse($this->request, $is_submitted);
		
		    if ($is_submitted){
			if($uportf['portfolio_id']){
			$uerrors = $form->validate($this, $uportf);
			if ($uerrors){
			//	cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');
			}
			//if (!$uerrors){
			if(!$uportf['title']){$uportf['title']=LANG_FREELANCERS_MYPORTFOLIO;}
			$uportf['user_id'] = $user->id;
			$this->model->addUpPortfolio($uportf);
				     $this->redirectToAction('item', array($id));

			//}
			}else{
			$errors = $form->validate($this, $portf);
			
			if ($errors){
				cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');
			}
			
			if (!$errors){
			$portf['spezid'] = $id;
			$portf['user_id'] = $user->id;
			$this->model->addPortfolio($portf);
		    $this->redirectToAction('item', array($id));
			}
		    }
			}
			}
		$template = cmsTemplate::getInstance();
		
		//$user = cmsUser::getInstance();
		//$this->model->wereuser($frel['user_id']);
		$template->render('item', array(
			'frel' => $frel,
			'myprofil' => $myprofil,
			'is_admin' => $user->isAdmin,
			'form' => $form,
			'errors' => $errors,
			'uform' => $uform,
			'uerrors' => $uerrors,
			'proekts' => $this->model->getproekts($user->id),
			'portfolios' => $this->model->getportf($id),			
            'userfreelanc' => $this->model->getuserfreelanc($user->id)
		));
		
	}
	
}