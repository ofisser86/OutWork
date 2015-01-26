<?php

class actionContentItemDelete extends cmsAction {

    public function run(){

        // Получаем название типа контента и сам тип
        $ctype_name = $this->request->get('ctype_name');
        $ctype = $this->model->getContentTypeByName($ctype_name);
        if (!$ctype) { cmsCore::error404(); }

        $id = $this->request->get('id');
        if (!$id) { cmsCore::error404(); }

        $item = $this->model->getContentItem($ctype_name, $id);
        if (!$item) { cmsCore::error404(); }

        // проверяем наличие доступа
        $user = cmsUser::getInstance();
        if (!cmsUser::isAllowed($ctype['name'], 'delete')) { cmsCore::error404(); }
        if (!cmsUser::isAllowed($ctype['name'], 'delete', 'all') && $item['user_id'] != $user->id) { cmsCore::error404(); }

        $is_moderator = $user->is_admin || $this->model->userIsContentTypeModerator($ctype_name, $user->id);
        if (!$item['is_approved'] && !$is_moderator) { cmsCore::error404(); }

        $back_action = '';

        if ($ctype['is_cats'] && $item['category_id']){

            $category = $this->model->getCategory($ctype_name, $item['category_id']);
            $back_action = $category['slug'];

        }

        cmsEventsManager::hook("content_before_delete", array('ctype_name'=>$ctype_name, 'item'=>$item));
        cmsEventsManager::hook("content_{$ctype['name']}_before_delete", $item);

        $this->model->deleteContentItem($ctype_name, $id);

        if (!$item['is_approved']){
            $this->notifyAuthor($ctype_name, $item);
        }

        cmsEventsManager::hook("content_after_delete", array('ctype_name'=>$ctype_name, 'item'=>$item));
        cmsEventsManager::hook("content_{$ctype['name']}_after_delete", $item);

        $back_url = $this->request->get('back');

        if ($back_url){
            $this->redirect($back_url);
        } else {
            if ($ctype['options']['list_on']){
                $this->redirectTo($ctype_name, $back_action);
            } else {
                $this->redirectToHome();
            }
        }

    }

    public function notifyAuthor($ctype_name, $item){

        $users_model = cmsCore::getModel('users');

        $author = $users_model->getUser($item['user_id']);

        $messenger = cmsCore::getController('messages');
        $to = array('email' => $author['email'], 'name' => $author['nickname']);
        $letter = array('name' => 'moderation_refused');

        $messenger->sendEmail($to, $letter, array(
            'nickname' => $author['nickname'],
            'page_title' => $item['title'],
            'date' => html_date_time(),
        ));

    }

}
