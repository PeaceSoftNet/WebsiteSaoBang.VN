<?php
  class MobileController extends Controller
{
    /**
     * Declares class-based actions.
     */
     
//    public $layout = 'HomePage';
    public $_assetsUrl;
    public $_rawProvinceData;       // data list tinh thanh pho
    public $_rawContentData;       // data content page
    public $_rawSearchData;
    public $_rawTopicDetailData;
    public $_rawPathway;          // data pathway
    public $_maxCss = 0;
    public $arrProvince;

    public function actionIndex()
    {
        $assetsPath = $this->getAssetsUrl();
        $this->_assetsUrl = $assetsPath ;
        $this->layout = 'HomePage';
        $dataReturn = CJSON::decode(JSONProcess::$jsonData);
//        var_Dump($dataReturn); die;
        $renderProvince = $this->actionDrawProvince($dataReturn['province']);
        $dataMainContent = $dataReturn['main']['rawData'];
        $renderMainContent = $this->actionDrawIndexContent($dataMainContent);
        $renderPathway = $this->actionDrawPathway('Danh mục', 0);
        $this->_rawPathway = $renderPathway;
        $this->_rawProvinceData = $renderProvince; 
        $this->render('Index', array('content'=>$renderMainContent));
    }  
    
    public function actionDetail()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';    
        
        if($id === '') $this->redirect('mobile/index');
        $requestData = array('query'=>'detail', 'keyword'=>$id);
        
        $assetsPath = $this->getAssetsUrl();
        $this->_assetsUrl = $assetsPath ;
        $this->layout = 'HomePage';     
        
        $objOauth = new OAuthComponents();
        $data = CJSON::encode($requestData);
        $accessToken = $objOauth->accessToken($data); 
        $rawSearchData = CJSON::decode($accessToken);
//        var_Dump($rawSearchData); die;
        $renderProvince = $this->actionDrawProvince($rawSearchData['province']);
        $this->_rawProvinceData = $renderProvince;
        //pathway
        foreach($rawSearchData['main']['rawData'] as $k => $value){
            if($value['id'] == $rawSearchData['search']['data']['childCatId']){
                $idPath = $value['id']; 
                $labelPath = $value['name'];
            }
        }
        $renderPathway = $this->actionDrawPathway($rawSearchData['search']['data']['title'], $id, 2, $labelPath, $idPath);
        $this->_rawPathway = $renderPathway;
        $this->_rawTopicDetailData = $rawSearchData['search'];
        $this->render('Detail', array('content'=>$this->_rawSearchData));
    }    
    
    public function actionBrowse()
    {
        $currentPage = $_GET['page'] ? $_GET['page'] : 1;
        $perPage = $_GET['p'] ? $_GET['p']:20;
        $idLocation = Yii::app()->session['location']; 
        $idCate = $_GET['catId'];
        $keywordData = array('idCate'=> $idCate, 'page'=>$currentPage, 'perPage'=>$perPage, 'location'=>$idLocation);
        $requestData = array('query'=>'browse', 'keyword'=>$keywordData);
        
        $objOauth = new OAuthComponents();
        $data = CJSON::encode($requestData);
        $accessToken = $objOauth->accessToken($data); 
        
        $assetsPath = $this->getAssetsUrl();
        $this->_assetsUrl = $assetsPath ;
        $this->layout = 'HomePage';     
        $rawSearchData = CJSON::decode($accessToken);    
        $this->arrProvince = $rawSearchData['province'];
//        var_Dump('show data return from saobang');   
//        var_Dump($rawSearchData); die;
        $renderProvince = $this->actionDrawProvince($rawSearchData['province']);
        $this->_rawProvinceData = $renderProvince;
        
        //draw pathway
        foreach($rawSearchData['main']['rawData'] as $k => $value){
            if($value['id'] == $idCate){
                $idPath = $value['id']; 
                $labelPath = $value['name'];
            }
        }
        $renderPathway = $this->actionDrawPathway($labelPath, $idPath);
        $this->_rawPathway = $renderPathway;
        $this->_rawSearchData = $rawSearchData['search'];
        $this->render('Browse', array('content'=>$this->_rawSearchData));
    }   
    
    public function actionSearch()
    {
        $requestData = array('query'=>'search', 'keyword'=>$_POST['keyword']);
        var_dump($requestData);
        $objOauth = new OAuthComponents();
        $data = CJSON::encode($requestData);
        $accessToken = $objOauth->accessToken($data); 
        
        $assetsPath = $this->getAssetsUrl();
        $this->_assetsUrl = $assetsPath ;
        $this->layout = 'HomePage';     
        $rawSearchData = CJSON::decode($accessToken);
        var_dump('ket qua nhan dc search');
        var_Dump($rawSearchData); die;
        $renderProvince = $this->actionDrawProvince($rawSearchData['province']);
        $this->_rawProvinceData = $renderProvince;
        
        $renderPathway = $this->actionDrawPathway('Tìm kiếm', 0);
        $this->_rawPathway = $renderPathway;
        
        $this->_rawSearchData = $rawSearchData['search'];
        $this->render('Browse', array('content'=>$this->_rawSearchData));
    }    
     
   
    public function getAssetsUrl()
    {
        $path = Yii::getPathOfAlias('application.assets.mobile');
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish($path);
        return $this->_assetsUrl;
    }
    
    public function actionError(){
        $this->render('Browse', array('content'=>'Have error on access' ));
        echo '';
    }
    
    public function actionDrawProvince($jsonData){
            //$html = '<ul>';
//            foreach ($jsonData as $value){
//                $html .= '<li>';
//                $html .= '<a href="">'.$value['name'].'</a>';
//                $html .= '</li>';
//            }
//            $html .= '</ul>';
            $idLocation =   Yii::app()->session['location'];
//            var_Dump($idLocation);
            $html = '<select id="slProvince">';
            if(!$idLocation)
                $html .= '<option value="" selected="selected">Toàn quốc</option>';
            foreach ($jsonData as $value){
                if($value['id'] == $idLocation)
                    $html .= '<option value="'.$value['id'].'" selected="selected">';
                else
                    $html .= '<option value="'.$value['id'].'">';
                $html .= ''.$value['name'];
                $html .= '</option>';
            }
            $html .= '</select>';
            return $html;
   }
   
   public function actionDrawIndexContent($jsonData){
       $html = '';
       $i = 1;
       foreach($jsonData as $index=>$data){
          if(!$data['parentId']){           
                $html .= '<li>';
                $html .= '<span class="corner'.$i.'"></span>';
                $html .= '<a name="labelCate" href="javascript:void(0);"><span>'.$data['name'].'</span></a>';
                $html .= '<ul class="Categlv2" style="display:none">';
                foreach ($jsonData as $key=>$value){
                    if($value['parentId'] == $data['id']){
                        $html .= '<li>';
                        $html .= '<a href="'.Yii::app()->createUrl('mobile/browse', array('catId'=>$value['id'], 'name'=>ExtensionClass::utf8_to_ascii($value['name']))) .'" class=""><span>'.$value['name'].'</span></a>';
                        $html .= '</li>';                      
                    }
                }
                $html .= '</ul></li>';
                $i ++; if($i > 8) $i = 1;
           }
       }
       
       return $html;
   }
   
   public function drawMainContent($arrData){
       $arrProvince = $this->arrProvince;
       
       if(!empty($arrProvince)){
           foreach($arrProvince as $province){
               $listProvince[$province['id']] = $province;
           }
       }
       
       foreach($arrData as $value){
                $titleTopic = $value['title'];
                $desTopic = $value['description'];
                $priceTopic = $value['price'] ? GlobalComponents::numberFomat($value['price']) .' VNĐ' : '';
                $locationTopic = $listProvince[$value['locality']]['name'];
                $domainTopic = $value['domain'];
                $mobileTopic = $value['mobileNumber'];
                $urlTopic =  Yii::app()->createUrl('mobile/Detail', array('id' => $value['id'], 'name' => ExtensionClass::utf8_to_ascii($titleTopic)));
                $html .=  '<li>
                            <h3 class="title-Br-NewsRv">
                                <a href="'. $urlTopic .'">'.$titleTopic . '</a>
                                <span class="Br-price">'.$priceTopic.' </span>
                            </h3>
                            <p class="Br-NewsRv-cont">'. $desTopic .'</span></p>
                            <div class="Navi-Br-NewsRv">
                                <a class="detail-NewsRv" href="'. $urlTopic .'"><i class="gr-icon-expand"></i> <span>Chi tiết</span></a>
                                &nbsp;&nbsp;•&nbsp;&nbsp;
                                <i class="gr-icon-phone"></i> '. $mobileTopic .'
                                &nbsp;&nbsp;•&nbsp;&nbsp;
                                <i class="gr-icon-location"></i>' . $locationTopic.' 
                            </div>
                        </li>' ;
            }
            
            return $html;
   }
   
   public function actionSetProvince(){
        $location = isset($_POST['location']) ? $_POST['location'] : false;
        Yii::app()->session['location'] = $location;
        return $location;
   }
   
   /**
   *    api draw pathway
   * @param $labelLink: label link
   * @param $id: id de create url den danh muc/ tin tuc
   * @param $level: default = 1, neu > 1 thi pathway co nhieu cap cha, con (voi saobang khi level = 2 chi co trang detail)
   * @param $labelParent:  neu pathway > 1 thi truyen vao label cua danh muc cha
   * @param $idParent:    neu pathway > 1 thi truyen vao id cua danh muc cha
   */
   public function actionDrawPathway($labelLink, $id, $level = 1, $labelParent = null, $idParent = null){
       $url = '';
       if($id !== 0){
            if($level == 1)   
                $url = Yii::app()->createUrl('mobile/Browse', array('catId'=>$id, 'name'=>ExtensionClass::utf8_to_ascii($labelLink)));
            else
                $url = Yii::app()->createUrl('mobile/Detail', array('id' => $id, 'name' => ExtensionClass::utf8_to_ascii($labelLink)));
       }
       $html = '<ul class="clearfix"><li class="first"><a href="'.Yii::app()->createUrl('mobile/index').'">Home</a></li>';
       if($level > 1) $html .= '<li><a href="'. Yii::app()->createUrl('mobile/browse', array('catId'=>$idParent, 'name'=>ExtensionClass::utf8_to_ascii($labelParent))) .'">'.$labelParent.'</a></li>'; 
       $html .= '<li><a href="'. $url .'">'.$labelLink.'</a></li></ul>' ;
       
        return $html;
   }
   
}
?>
