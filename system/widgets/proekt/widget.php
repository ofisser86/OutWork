<?php
class widgetProekt extends cmsWidget {

    public function run(){
        cmsCore::loadControllerLanguage('freelancers');
        $freelancers_model = cmsCore::getModel('freelancers');
        $freelancers_model->limitPage(1, $this->getOption('count'));		
        
        return array('proekts' => $freelancers_model->getproekts());

    }

}
