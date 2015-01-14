<?php
class widgetFreelancerscats extends cmsWidget {

    public function run(){
                            $freelancers_model = cmsCore::getModel('freelancers');
                            $cats = $freelancers_model->getCat();
							$items = array();
                            if ($cats) {
                                foreach ($cats as $item) {
                                    $item['uslug'] = $freelancers_model->getUslug($item['id']);
									$items[]=$item;
                                }
                            }
        return array('cats' => $items);

    }

}
