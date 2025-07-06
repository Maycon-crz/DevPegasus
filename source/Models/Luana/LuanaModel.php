<?php

namespace source\Models\Luana;

use Source\Models\Lib\Connection;

class LuanaModel extends Connection{
    private $response = array();
    function karaokeModel(){
        $this->response["dados"] = "Karaoke Model";
        return $this->response;
    }
}

?>