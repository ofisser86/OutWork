<?php

class actionFreelancersDeletcat extends cmsAction {

    public function run($catid){
        $freelancers_model = cmsCore::getModel('freelancers');

                 $field_id = $freelancers_model -> deletCat($catid);

            $this->redirectToAction('cats');

    }

}
