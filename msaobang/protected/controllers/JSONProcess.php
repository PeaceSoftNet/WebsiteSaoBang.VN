<?php
/**
*       Model get, set json data
*   @author linhnt
*   @since 01/2013 
*/
class JSONProcess extends Controller
{
    static $jsonData;
                      
    public function __construct($dataJson){
        self::$jsonData = $dataJson;
        //debug content json nhan dc
//        echo ($dataJson);                 
    }
                                            
    //public function actionProcessData(){
//        $dataReturn = CJSON::encode($this->jsonData);
//        return $dataReturn;
//    }
}

?>