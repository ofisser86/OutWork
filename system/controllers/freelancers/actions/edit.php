<?php

class actionFreelancersEdit extends cmsAction {
	
	public function run($id=false){
		if (!$id) { cmsCore::error404(); }
		$frel = $this->model->getfrel($id);
		if (!$frel) { cmsCore::error404(); }
		$user = cmsUser::getInstance();
	
		if($frel['user_id'] != $user->id && !$user->is_admin ){cmsCore::error404();}
		$errors = false;
		$form = $this->getForm('add', array('edit', $frel));
		$is_submitted = $this->request->has('submit');	
		if ($is_submitted){
				$frel = $form->parse($this->request, $is_submitted);			
			    $errors = $form->validate($this, $frel);	
			if (!$errors){
                     $frelans['cat_id'] = $frel['cat_id'];						  
	                 $frelans['uslugi'] = $frel['uslugi'];
					 $frelans['predoplata'] = $frel['predoplata']; 
					 $frelans['organisazia'] = $frel['organisazia']; 
					 $frelans['minzena'] = $frel['minzena']; 
					 $frelans['messag'] = $frel['messag'];  
				    $this->model->updatefrelans($id, $frelans);
				    $this->redirectToAction('item', array($id));
				}
			if ($errors){
				cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');
			}
		}
		$template = cmsTemplate::getInstance();
		$template->render('add', array(
			'do' => 'edit',
			'form' => $form,
			'errors' => $errors,
			'frel' => $frel
		));
		
	}
	
}