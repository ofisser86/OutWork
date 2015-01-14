<?php
class widgetOtziv extends cmsWidget {

    public function run(){
        $freelancers_model = cmsCore::getModel('freelancers');
        $freelancers_model->limitPage(1, $this->getOption('count'));		
        
        return array('otzivs' => $freelancers_model->getallotziv());

    }

}
