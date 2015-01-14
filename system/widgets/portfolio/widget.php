<?php
class widgetPortfolio extends cmsWidget {
    public function run(){
        $freelancers_model = cmsCore::getModel('freelancers');
        return array('portfolios' => $freelancers_model->getAllPortfolios($this->getOption('count')));
    }
}
