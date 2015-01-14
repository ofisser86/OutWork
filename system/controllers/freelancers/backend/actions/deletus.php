<?php

class actionFreelancersDeletus extends cmsAction {

    public function run($us){
        $freelancers_model = cmsCore::getModel('freelancers');
        $field_id = $freelancers_model -> deletUs($us);
        $this->redirectToAction('cats');
    }
}
