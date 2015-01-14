<?php

class actionFreelancersEditproekt extends cmsAction {
	
	public function run($id = false){
	    if (!$id) { cmsCore::error404(); }
		$user = cmsUser::getInstance();		
		$proek = $this->model->getproekt($id);
		if (!$proek) { cmsCore::error404(); }	
		$form = $this->getForm('addproect', array($this->options, $proek));
		$is_submitted = $this->request->has('submit');
		$proekt = $form->parse($this->request, $is_submitted);
		if ($is_submitted){
			$errors = $form->validate($this, $proekt);
			if ($errors){
				cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');
			}
			if (!$errors){
			    if(!$proekt['title'] || !$proekt['content']){cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');}	
		         if($proekt['title']&&$proekt['content']){
					 $proekts['cat_id'] = $proekt['cat_id'];						  
	                 $proekts['uslugi'] = $proekt['uslugi'];
					 $proekts['title'] = $proekt['title']; 
					 if(!$proekt['zena']){$proekts['zena'] = ' ';}else{$proekts['zena'] = $proekt['zena'];} 
					 $proekts['privat'] = $proekt['privat']; 
					 $proekts['content'] = $proekt['content']; 
					 
				     $this->model->editproekt($id, $proekts);
				     $this->redirectToAction('proekt', array($id));
			        }
			
			}
		}

		
		$template = cmsTemplate::getInstance();		
		$template->render('addproect', array(
			'do' => 'add',
			'form' => $form,
			'errors' => $errors,
			'proekt' => $proek
		));
	}
}
	