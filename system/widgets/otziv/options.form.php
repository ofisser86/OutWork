<?php

class formWidgetOtzivOptions extends cmsForm {

    public function init() {

        return array(

            array(
                'type' => 'fieldset',
                'title' => LANG_OPTIONS, 
                'childs' => array(

                   new fieldNumber('options:count', array(
						'title' => 'Количество',
					))
                )
            ),

        );

    }

}
