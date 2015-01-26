<?php

class modelChat extends cmsModel
{

    public function userGet($id) {

        return $this->getItemById('users', $id);

    }
}