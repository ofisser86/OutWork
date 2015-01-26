<?php

class actionChatAuth extends cmsAction
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

                   $template = cmsTemplate::getInstance();
                $template->render('index', array(
                            'id' => $id,
                            'userName' => $userName,


        ));
    }
}
