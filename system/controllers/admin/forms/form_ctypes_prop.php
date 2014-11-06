<?php
class formAdminCtypesProp extends cmsForm {

    public function init($do) {

        return array(
            'basic' => array(
                'type' => 'fieldset',
                'childs' => array(
                    new fieldString('title', array(
                        'title' => LANG_CP_PROP_TITLE,
                        'rules' => array(
                            array('required'),
                            array('max_length', 100)
                        )
                    )),
                    new fieldCheckbox('is_in_filter', array(
                        'title' => LANG_CP_FIELD_IN_FILTER,
                    )),
                )
            ),
            'group' => array(
                'type' => 'fieldset',
                'title' => LANG_CP_FIELD_FIELDSET,
                'childs' => array(
                    new fieldList('fieldset', array(
                        'title' => LANG_CP_FIELD_FIELDSET_SELECT,
                        'generator' => function($prop) {
                            $model = cmsCore::getModel('content');
                            $fieldsets = $model->getContentPropsFieldsets($prop['ctype_id']);
                            $items = array('');
                            if (is_array($fieldsets)){
                                foreach($fieldsets as $fieldset) { $items[$fieldset] = $fieldset; }
                            }
                            return $items;
                        }
                    )),
                    new fieldString('new_fieldset', array(
                        'title' => LANG_CP_FIELD_FIELDSET_ADD,
                        'rules' => array(
                            array('max_length', 100)
                        )
                    )),
                )
            ),
            'type' => array(
                'type' => 'fieldset',
                'title' => LANG_CP_FIELD_TYPE,
                'childs' => array(
                    new fieldList('type', array(
                        'default' => 'list',
                        'items' => array(
                            'list' => LANG_PARSER_LIST,
                            'string' => LANG_PARSER_STRING,
                            'number' => LANG_PARSER_NUMBER,
                        )
                    )),
                    new fieldCheckbox('options:is_required', array(
                        'title' => LANG_VALIDATE_REQUIRED
                    ))
                )
            ),
            'number' => array(
                'type' => 'fieldset',
                'title' => LANG_PARSER_NUMBER,
                'childs' => array(
                    new fieldString('options:units', array(
                        'title' => LANG_CP_PROP_UNITS,
                    )),
                    new fieldCheckbox('options:is_filter_range', array(
                        'title' => LANG_PARSER_NUMBER_FILTER_RANGE
                    )),
                )
            ),
            'values' => array(
                'type' => 'fieldset',
                'title' => LANG_CP_PROP_VALUES,
                'childs' => array(
                    new fieldText('values', array(
                        'size' => 8,
                        'hint' => LANG_CP_PROP_VALUES_HINT
                    )),
                    new fieldCheckbox('options:is_filter_multi', array(
                        'title' => LANG_PARSER_LIST_FILTER_MULTI
                    ))
                )
            ),
            'cats' => array(
                'type' => 'fieldset',
                'title' => LANG_CP_PROP_CATS,
                'childs' => array(
                    new fieldList('cats', array(
                            'is_multiple' => true,
                            'is_tree' => true,
                            'generator' => function($prop){
                                $content_model = cmsCore::getModel('content');
                                $ctype = $content_model->getContentType($prop['ctype_id']);
                                $tree = $content_model->getCategoriesTree($ctype['name'], false);
                                foreach($tree as $c){
                                    $items[$c['id']] = str_repeat('- ', $c['ns_level']).' '.$c['title'];
                                }
                                return $items;
                            }
                        )
                    )
                )
            ),
        );

    }

}