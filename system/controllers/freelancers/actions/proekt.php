<?php

class actionFreelancersProekt extends cmsAction {
	
	public function run($id = false){
	    if (!$id) { cmsCore::error404(); }
		$user = cmsUser::getInstance();		
		$proekt = $this->model->getproekt($id);
		if (!$proekt) { cmsCore::error404(); }	
		$form = $this->getForm('addproectotvet');
		$is_submitted = $this->request->has('submit');
		$potvet = $form->parse($this->request, $is_submitted);	
          if ($is_submitted){
			if($potvet['content']){
			$errors = $form->validate($this, $potvet);
			   if ($errors){
				  $user->addSessionMessage(LANG_FORM_ERRORS, 'error');
			   }
			   if (!$errors){
			      $potvet['pro_id'] = $id;
			      $potvet['user_id'] = $user->id;
		          $potvet['pubdate'] = date('Y-m-d H:i');
			
			      $this->model->addUpOtvet($potvet);
				     $this->redirectToAction('proekt', array($id));

			   }
			}
		  }
	    $fr1 = $this->model->getuserfreelanc($user->id);
		$frel1 = $this->model->getfreelanc($fr1['id'], $this->options);
        $fr = $this->model->getuserfreelanc($proekt['user_id']);
		$frel = $this->model->getfreelanc($fr['id'], $this->options);
		
		$myprofil = ($user->id == $proekt['user_id']);
          $status ='0';
            if($proekt['hits']=='1' || $user ->id == '0' || !$fr1['id']){
	         $status ='0';	
            }else{
               if($proekt['privat'] == '1' && $fr1['tupe'] == 'f'){
			   
if($frel1['tupe'] == $this->options['tupe3']){$status ='1';}
               }	
               if($proekt['privat'] == '0' && $frel1['hom'] == 'f'){
                     $status ='1';
               }
            }		
		$template = cmsTemplate::getInstance();
        $template->render('proekt', array(
			'proekt' => $proekt,		
			'frel' => $frel,
			'status' => $status,
			'potvet' => $potvet,
			
			'myprofil' => $myprofil,
			'is_admin' => $user->isAdmin,
			'form' => $form,
			'errors' => $errors,
			'proekts' => $this->model->getotvet($id, $this->options),
			'userfreelanc' => $this->model->getuserfreelanc($user->id)
			
		));	
	}
}