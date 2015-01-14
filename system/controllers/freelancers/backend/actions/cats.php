<?php

class actionFreelancersCats extends cmsAction {

    public function run(){
        $freelancers_model = cmsCore::getModel('freelancers');

        $form = $this->getForm('addcats');
        $form2 = $this->getForm('adduslug');

        $is_submitted = $this->request->has('submit');

        if ($is_submitted){

           

            $field = $form->parse($this->request, $is_submitted);
            $field2 = $form2->parse($this->request, $is_submitted);

                // сохраняем категорию
				if($field['name']){
                   $field_id = $freelancers_model -> addCat($field);
                   if ($field_id){ cmsUser::addSessionMessage(sprintf(LANG_CP_FIELD_CREATED, $field['title']), 'success'); }
                   $this->redirectToAction('cats');
                }
				if($field2['uname']&&$field2['cat_id']){
				   $fiel['name']=$field2['uname'];
				   $fiel['cat_id']=$field2['cat_id'];
				   
				   $field_id = $freelancers_model -> addUslug($fiel);
                    $this->redirectToAction('cats');
				}
        }
		   if($freelancers_model -> getCat()){
			foreach($freelancers_model -> getCat() as $cat){
                 $cat['uslug'] = $freelancers_model -> getUslug($cat['id']);
			     $cats[] = $cat;
			}
		   }
        return cmsTemplate::getInstance()->render('backend/cats', array(
            'do' => 'add',
            'field' => $field,
            'form' => $form,
            'form2' => $form2,			
            'errors' => isset($errors) ? $errors : false,
			'cats'  => $cats
        ));

    }

}
