<?php
class redactor extends cmsFrontend {

    public function actionUpload(){

        $config = cmsConfig::getInstance();

        $uploader = new cmsUploader();

        $result = $uploader->upload('file', 'gif,jpg,jpeg,png');

        if (!$result['success']){

            cmsTemplate::getInstance()->renderJSON(array(
                'status' => 'error',
                'msg' => $result['error']
            ));

            $this->halt();

        }

        $path = $uploader->resizeImage($result['path'], array('width'=>640, 'height'=>640, 'square'=>false));
        $src = $config->upload_host . '/' . $path;

        unlink($result['path']);
        unset($result['path']);

        cmsTemplate::getInstance()->renderJSON(array(
            'status' => 'success',
            'filelink' => $src
        ));

        $this->halt();

    }

}
