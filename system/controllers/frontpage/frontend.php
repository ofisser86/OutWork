<?php

class frontpage extends cmsFrontend {

	public function actionIndex(){

        $mode = cmsConfig::get('frontpage');
		
		$title = cmsConfig::get('hometitle');
		
		if ($title){
			cmsTemplate::getInstance()->setPageTitle($title);
		}

        //
        // Только виджеты
        //
        if (!$mode || $mode == 'none') {

            return false;

        }

        //
        // Профиль / авторизация
        //
        if ($mode == 'profile'){

            $user = cmsUser::getInstance();

            if ($user->is_logged){ $this->redirectTo('users', $user->id); }

            $auth_controller = cmsCore::getController('auth', new cmsRequest(array(
                'is_frontpage' => true
            )));

            return $auth_controller->runAction('login');

        }

        //
        // Контент
        //
        if (mb_strstr($mode, 'content:')){

            list($mode, $ctype_name) = explode(':', $mode);

			$request_data = $this->request->getData();
			
			$request_data['ctype_name'] = $ctype_name;
			$request_data['slug'] = 'index';
			$request_data['is_frontpage'] = true;			
			
            $request = new cmsRequest($request_data);
			
            $content_controller = cmsCore::getController('content', $request);

            return $content_controller->runAction('category_view');

        }

	}

}
