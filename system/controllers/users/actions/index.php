<?php

class actionUsersIndex extends cmsAction {

    public function run($tab='all'){

        $user = cmsUser::getInstance();

        $dataset_name = false;
        $datasets = $this->getDatasets();

        if ($tab && isset($datasets[$tab])) { 
            
            $dataset_name = $tab; 
            $dataset = $datasets[$tab]; 
            
            if (isset($dataset['filter']) && is_callable($dataset['filter'])){
                $this->model = $dataset['filter']($this->model, $dataset);
            }            
            
        } else if ($tab) { cmsCore::error404(); }

        // Сортировка
        if ($dataset_name){
            $this->model->orderBy( $datasets[$dataset_name]['order'][0], $datasets[$dataset_name]['order'][1] );
        }

        // Формируем базовые URL для страниц
        $page_url = array(
            'base'  => href_to($this->name, $dataset_name ? 'index/'.$dataset_name : ''),
            'first' => href_to($this->name, $dataset_name ? 'index/'.$dataset_name : '')
        );

        // Получаем HTML списка записей
        $profiles_list_html = $this->renderProfilesList($page_url, $dataset_name);

        return cmsTemplate::getInstance()->render('index', array(
            'datasets' => $datasets,
            'dataset_name' => $dataset_name,
            'dataset' => $dataset,
            'user' => $user,
            'profiles_list_html' => $profiles_list_html,
        ), $this->request);

    }

}
