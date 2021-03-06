<?php

class actionCommentsRate extends cmsAction {

    public function run(){

        if (!$this->request->isAjax()){ cmsCore::error404(); }

        $comment_id = $this->request->get('comment_id');
        $score = $this->request->get('score');

        // Проверяем валидность
        $is_valid = $this->validate_number($comment_id) &&
                    in_array($score, array(-1, 1));

        $template = cmsTemplate::getInstance();

        if (!$is_valid){ $template->renderJSON(array('error' => true)); }

        $user = cmsUser::getInstance();

        $is_can_rate = cmsUser::isAllowed('comments', 'rate');

        if (!$is_can_rate){ $template->renderJSON(array('error' => true)); }

        $is_voted = $this->model->isUserVoted($comment_id, $user->id);

        if ($is_voted){ $template->renderJSON(array('error' => true)); }

        $comment = $this->model->getComment($comment_id);

        if ($comment['user_id'] == $user->id) { $template->renderJSON(array('error' => true)); }

        $success = $this->model->rateComment($comment_id, $user->id, $score);

        $template->renderJSON(array('error' => !$success));

    }

}
