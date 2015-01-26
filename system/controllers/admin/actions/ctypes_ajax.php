<?php

class actionAdminCtypesAjax extends cmsAction {

    public function run(){

        if (!$this->request->isAjax()) { cmsCore::error404(); }

        $grid = $this->loadDataGrid('ctypes');

        $content_model = cmsCore::getModel('content');

        $content_model->setPerPage(admin::perpage);

        $filter     = array();
        $filter_str = $this->request->get('filter', '');

        if ($filter_str){
            parse_str($filter_str, $filter);
            $content_model->applyGridFilter($grid, $filter);
        }

        $total = $content_model->getContentTypesCount();
        $perpage = isset($filter['perpage']) ? $filter['perpage'] : admin::perpage;
        $pages = ceil($total / $perpage);

        $ctypes = $content_model->getContentTypes();

        cmsTemplate::getInstance()->renderGridRowsJSON($grid, $ctypes, $total, $pages);

        $this->halt();

    }

}
