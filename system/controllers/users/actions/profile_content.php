<?php

class actionUsersProfileContent extends cmsAction {

    public function run($profile, $ctype_name=false, $folder_id=false){

        if (!$ctype_name) { cmsCore::error404(); }

        $user = cmsUser::getInstance();

        $content_controller = cmsCore::getController('content', $this->request);

        $ctype = $content_controller->model->getContentTypeByName($ctype_name);
        if (!$ctype) { cmsCore::error404(); }

        $folders = false;

        if ($ctype['is_folders']){
            $folders = $content_controller->model->getContentFolders($ctype['id'], $profile['id']);
        }

        $content_controller->model->filterEqual('user_id', $profile['id']);

        if ($folders){

            if ($folder_id && array_key_exists($folder_id, $folders)){
                $content_controller->model->filterEqual('folder_id', $folder_id);
            }

            $folders = array('0' => array('id'=>0, 'title'=>LANG_ALL)) + $folders;

        }

        if ($user->id != $profile['id'] && !$user->is_admin){
            $content_controller->model->filterHiddenParents();
        }

        if ($user->id == $profile['id'] || $user->is_admin){
            $content_controller->model->disableApprovedFilter();
			$content_controller->model->disablePubFilter();
        }

        cmsEventsManager::hook("content_before_profile", array($ctype, $profile));

        if ($folder_id){
            $page_url = href_to('users', $profile['id'], array('content', $ctype_name, $folder_id));
        } else {
            $page_url = href_to('users', $profile['id'], array('content', $ctype_name));
        }

        $list_html = $content_controller->renderItemsList($ctype, $page_url);

        return cmsTemplate::getInstance()->render('profile_content', array(
            'id' => $profile['id'],
            'profile' => $profile,
            'ctype' => $ctype,
            'folders' => $folders,
            'folder_id' => $folder_id,
            'html' => $list_html
        ));

    }

}
