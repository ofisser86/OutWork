<?php
class widgetNevfreelancers extends cmsWidget {

    public function run(){
        $freelancers_model = cmsCore::getModel('freelancers');
         $freelancers_model->filterEqual('name', 'freelancers');

        $options = $freelancers_model->getFieldFiltered('controllers', 'options');

        if ($options){
            $options = cmsModel::yamlToArray($options);
        }
        $freelancers_model->limitPage(1, $this->getOption('count'));		
		$freelancers = $freelancers_model->getfreelancers($options, $this->getOption('home'));
		
        return array('freelancers' => $freelancers,'tupe' => $this->getOption('home'),'options'=>$options);

    }

}
