<?php

class actionFreelancersAdd extends cmsAction {
	
	public function run(){
		$user = cmsUser::getInstance();
		if (!$user->id){ cmsCore::error404(); }
		
		$errors = false;
		
		$form = $this->getForm('add', array('add'));
		
		$is_submitted = $this->request->has('submit');
		
		$frel = $form->parse($this->request, $is_submitted);
		
		if ($is_submitted){
			
			$errors = $form->validate($this, $frel);
			if ($errors){
				cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');
			}
			if (!$errors){
	                 $frelans['cat_id'] = $frel['cat_id'];						  
	                 $frelans['uslugi'] = $frel['uslugi'];
					 if(!$frel['uslugi']){$frelans['uslugi'] =' ';}
					 $frelans['user_id'] = $user->id;
					 $frelans['stat'] = '1';					 
					 $frelans['tupe'] = $frel['tupe']; 
					 $frelans['predoplata'] = $frel['predoplata']; 
					 $frelans['organisazia'] = $frel['organisazia']; 
					 $frelans['minzena'] = $frel['minzena']; 
					 $frelans['messag'] = $frel['messag']; 
					 
				     $frel_id = $this->model->addFreelancers($frelans);
				     $this->redirectToAction('item', array($frel_id));
			    }
		    }
		
		$template = cmsTemplate::getInstance();
		
		$template->render('add', array(
			'do' => 'add',
			'form' => $form,
			'errors' => $errors,
			'frel' => $frel
		));
		
	}
	
}