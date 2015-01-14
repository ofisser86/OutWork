<?php

class actionFreelancersAddproekt extends cmsAction {
	
	public function run(){
        $user = cmsUser::getInstance();
		if (!$user) { cmsCore::error404(); }
	    $frel = $this->model->getuserfreelanc($user->id);
		if (!$frel) { cmsCore::error404(); }
		if ($frel['tupe'] != 'z') { cmsCore::error404(); }
		$form = $this->getForm('addproect', array($this->options));
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
					 if(!$proekt['uslugi']){$proekts['uslugi']=' ';}
					 $proekts['user_id'] = $user->id;
					 $proekts['title'] = $proekt['title']; 
					 if(!$proekt['zena']){$proekts['zena'] = ' ';}else{$proekts['zena'] = $proekt['zena'];} 
					 $proekts['privat'] = $proekt['privat']; 
					 $proekts['content'] = $proekt['content']; 
					 $proekts['pubdate'] = date('Y-m-d H:i');
					 
				     $frel_id = $this->model->addproekts($proekts);
				     $this->redirectToAction('item', array($frel['id']));
			        }
			
			}
		}

        $template = cmsTemplate::getInstance();		
		$template->render('addproect', array(
			'do' => 'add',
			'form' => $form,
			'errors' => $errors,
			'proekt' => $proekt
		));
		
	}
	
}