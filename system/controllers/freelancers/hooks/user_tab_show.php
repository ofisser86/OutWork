<?php

class onFreelancersUserTabShow extends cmsAction {

    public function run($profile, $tab_name){

        $user = cmsUser::getInstance();
        $template = cmsTemplate::getInstance();
        $fr = $this->model->getuserfreelanc($profile['id']);
		if($fr){$frelans = $this->model->getfreelanc($fr['id'], $this->options);}
	   return $template->renderInternal($this, 'profile_tab', array(
            'user' => $user,
            'profile' => $profile,
			'myprofile' => $profile['id'] == $user->id,
            'frel' => $frelans
        ));

    }

}
