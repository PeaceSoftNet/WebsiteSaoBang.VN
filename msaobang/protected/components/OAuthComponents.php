<?php

Yii::import('application.controllers.JSONProcess');
  class OAuthComponents
  {   
      public function accessToken($query = null){
            $key = '953492c3dbc4fc581bcca1e3350e6ad0050f7c22e'; // fill with your public key 
            $secret = '5e8346578f5ecddba5b5f611cd8645ae'; // fill with your secret key
            $url = "http://Saobang/request_token"; // fill with the url for the oauth service
//            $urlauth = "http://localhost/Saobang/authorize"; // fill with the url for the oauth service
//            $urlau = "http://localhost/Saobang/access_token"; // fill with the url for the oauth service
            $urlcheck = "http://Saobang/check"; // fill with the url for the oauth service
//            $user_id = 31;

            $options = array('consumer_key' => $key, 'consumer_secret' => $secret);
            $store = OAuthStore::instance("2Leg", $options);
            
            $method = "POST";
            $params = null;
//                die('msaobang');
            try
            {
                $request = new OAuthRequester($url, $method, $params);
                $result = $request->doRequest(0);
                $response = $result['body'];
                
                if ($result['code'] != 200) 
                {
//                    echo 'Error!  ' . $response;
//                        header("Location: http://localhost/mSaobang/errorAction");
//                        exit();
                        return false;
                }
                else 
                {
                    parse_str($result['body'], $params);
                    $query = CJSON::decode($query);
                    $k = $query['keyword'] ? '&k='.$query['keyword'] : '';
                    if($query['query'] === 'browse')
                        $k = '&k='.$query['keyword']['idCate']. '&page='.$query['keyword']['page']. '&perPage='.$query['keyword']['perPage'].'&location='.$query['keyword']['location'];
                    $urlcheck .= '?q='. $query['query'] . $k;
                    
                    $authorizeObj = new OAuthRequester($urlcheck, $method, $params);
                    $authorize = $authorizeObj->doRequest();
                    //debug data from saobang
//                    echo $authorize['body'];die;
                    if($authorize['code'] == 200)
                        return  $authorize['body'];
                    else
                        return false;
//                        exit();
                }
            }
            catch(OAuthException2 $e)
            {
//                echo "\n Exception: " . $e->getMessage();
                // header("Location: http://localhost/mSaobang/errorAction");
//                        exit();
                return false;
            }      
      }
      
      public function makeRequest($query){
          $defConfig = array( 'query' => 'index', 'keyword'=>'');
          $accessToken = OAuthComponents::accessToken(CJSON::encode($defConfig)); 
          if($accessToken){ 
              $objJson = new JSONProcess($accessToken);
          }
          else echo 'error access, return error page';
      }
        
  }
?>
