<?php

class actionChatIndex extends cmsAction
{

    public function run()
    {

        $id = $_SESSION['user']['id'];

        if (!$id) {
            cmsCore::error404();
        }

        $userName = $this->model->userGet($id);

        if (!$userName) {
            cmsCore::error404();
        }
        $user2 = cmsUser::getInstance();
        $user2 = $profile['id'];
        $template = cmsTemplate::getInstance();
        $template->render('index', array(
            'id' => $id,
            'userName' => $userName,
            'user2' => $user2,


        ));
    }
}

