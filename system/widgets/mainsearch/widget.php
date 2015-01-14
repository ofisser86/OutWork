<?php
class widgetMainsearch extends cmsWidget {

    public function run (){

        $this->is_title = false;
        $this->css_class = 'mainsearch';
        $this->setWrapper('wrapper_plain');

        return array();


    }


}