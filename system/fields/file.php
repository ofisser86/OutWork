<?php

class fieldFile extends cmsFormField {

    public $title = LANG_PARSER_FILE;
    public $sql   = 'text';

    public function getOptions(){
        $max_size = files_convert_bytes(ini_get('post_max_size')) / 1048576;
        return array(
            new fieldList('show_name', array(
                'title' => LANG_PARSER_FILE_LABEL,
                'default' => 1,
                'items' => array(
                    0 => LANG_PARSER_FILE_LABEL_GET,
                    1 => LANG_PARSER_FILE_LABEL_NAME,
                )
            )),
            new fieldString('extensions', array(
                'title' => LANG_PARSER_FILE_EXTS,
                'hint' => LANG_PARSER_FILE_EXTS_HINT
            )),
            new fieldNumber('max_size_mb', array(
                'title' => LANG_PARSER_FILE_MAX_SIZE,
                'hint' => sprintf(LANG_PARSER_FILE_MAX_SIZE_PHP, $max_size)
            )),
            new fieldCheckbox('show_size', array(
                'title' => LANG_PARSER_FILE_SHOW_SIZE,
            )),
        );
    }

    public function parse($value){

        $file = is_array($value) ? $value : cmsModel::yamlToArray($value);

        if (!$file){ return; }

        $name = $this->getOption('show_name') ? $file['name'] : LANG_PARSER_FILE_LABEL_GET;

        $size_info = $this->getOption('show_size') ? '<span class="size">' . files_format_bytes($file['size']).'</span>' : '';

        return '<a href="'.$this->getDownloadURL($file).'">'.$name.'</a> ' . $size_info;

    }

    public function getStringValue($value){

        $file = is_array($value) ? $value : cmsModel::yamlToArray($value);

        if (!$file){ return false; }

        $name = $this->getOption('show_name') ? $file['name'] : LANG_PARSER_FILE_LABEL_GET;

        return $name;

    }

    public function getDownloadURL($file){

        return href_to('files', 'download', array($file['id'], $file['url_key']));

    }

    public function store($value, $is_submitted, $old_value=null){

        $config = cmsConfig::getInstance();

        $files_model = cmsCore::getModel('files');

        if ($value){
            $file = cmsModel::yamlToArray($old_value);
            $path = $config->upload_path . $file['path'];
            @unlink($path);
            $files_model->deleteFile($file['id']);
            $old_value = null;
        }

        $uploader = new cmsUploader();

        if (!$uploader->isUploaded($this->name)){
            return $old_value;
        }

        $allowed_extensions = $this->getOption('extensions');
        $max_size_mb = $this->getOption('max_size_mb');

        if (!trim($allowed_extensions)) { $allowed_extensions = false; }
        if (!$max_size_mb) { $max_size_mb = 0; }

        $result = $uploader->upload($this->name, $allowed_extensions, $max_size_mb * 1048576);

        if (!$result['success']){
            $uploader->remove($result['path']);
            cmsUser::addSessionMessage($result['error'], 'error');
            return null;
        }

        $file = $files_model->registerFile($result['url'], $result['name']);

        return array(
            'id' => $file['id'],
            'url_key' => $file['url_key'],
            'name' => $result['name'],
            'size' => $result['size'],
            'path' => $result['url']
        );

    }

    public function getFilterInput($value=false) {

        return html_checkbox($this->name, (bool)$value);

    }

    public function applyFilter($model, $value) {
        return $model->filterNotNull($this->name);
    }

}
