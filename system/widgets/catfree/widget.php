<?php
class widgetCatfree extends cmsWidget {

    public function run () {
        $this->setWrapper('wrapper_plain');
        $this->css_class = 'my.css';
        $this->is_title = false;


        return array();



    }



}