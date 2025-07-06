<?php

namespace source\Models\Luana;

use Source\Models\Lib\Connection;

class LuanaModel extends Connection{
    private $response = array();
    function karaokeRegisterMusicModel($data){
        $this->response["status"] = "success";
        $this->response["dados"] = $data;
        return $this->response;
    }
}

?>