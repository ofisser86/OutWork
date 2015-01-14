<?php

class formWidgetFreelancerscatsOptions extends cmsForm {

    public function init($options=false) {

        return array(

            array(
                'type' => 'fieldset',
                'title' => LANG_OPTIONS, 
                'childs' => array(

                   new fieldList('options:home', array(
						'title' => 'Кого показывать',
						'items' => array(
							'f' => 'Разделы фрилансеров',
							'z' => 'Разделы работодателей',
							'p' => 'Разделы проектов'						
						)
					)),
					new fieldList('options:style', array(
						'title' => 'Выпадание меню',
						'items' => array(
							'r' => 'Вправо',
							'l' => 'Влево',
						)
					))
                )
            ),

        );

    }

}
