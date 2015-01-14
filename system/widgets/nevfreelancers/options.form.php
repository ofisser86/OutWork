<?php

class formWidgetNevfreelancersOptions extends cmsForm {

    public function init() {

        return array(

            array(
                'type' => 'fieldset',
                'title' => LANG_OPTIONS, 
                'childs' => array(

                   new fieldNumber('options:count', array(
						'title' => 'Количество',
					)),
					new fieldList('options:home', array(
						'title' => 'Кого показывать',
						'items' => array(
							'f' => ' фрилансеров',
							'z' => ' работодателей'
							)
					)),
                )
            ),

        );

    }

}
