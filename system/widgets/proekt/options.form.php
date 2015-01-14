<?php

class formWidgetProektOptions extends cmsForm {

    public function init() {

        return array(

            array(
                'type' => 'fieldset',
                'title' => LANG_OPTIONS, 
                'childs' => array(

                   new fieldNumber('options:count', array(
						'title' => 'Количество',
						'rules' => array(
							array('required'),
							array('min_length', 1)
						)
					))
                )
            ),

        );

    }

}
