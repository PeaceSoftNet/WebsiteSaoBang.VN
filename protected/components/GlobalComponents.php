<?php

/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
class GlobalComponents {

    /**
     * home menu 
     */
    public static function homepageMenu() {
        return array(
            'items' => array(
                array('label' => 'Đăng nhập', 'url' => array('ad/login'), 'visible' => !self::isLogin()),
                array('label' => 'Đăng ký', 'url' => array('user/register'), 'visible' => !self::isLogin()),                
                array('label' => Yii::app()->session['email'], 'url' => array('home/published'), 'visible' => self::isLogin(), 'itemOptions' => array('class' => '')),
                array('label' => 'Đăng xuất', 'url' => array('user/logout'), 'visible' => self::isLogin()),
            ),
            'htmlOptions' => array(
                'class' => 'flink-thead'
            )
        );
    }

    /**
     * homepage footer menu 
     */
    public static function homepageFooter() {
        return array(
            'items' => array(
                array('label' => 'Giới thiệu', 'url' => array('home/aboutUs')),
                array('label' => 'Liên hệ quảng cáo', 'url' => array('home/contactAd')),
                array('label' => 'Quy chế', 'url' => array('home/regulation')),
                array('label' => 'Quy định đăng tin', 'url' => array('home/publishedRules')),
                array('label' => 'Hướng dẫn đăng tin', 'url' => array('home/help', 'contentCode' => 'dang-tin-rao-vat')),
                array('label' => 'Tìm kiếm rao vặt', 'url' => array('home/seo'), 'itemOptions' => array('style' => "background: transparent;")),
            ),
            'htmlOptions' => array(
                'class' => 'flink-ft clearfix'
            )
        );
    }

    /**
     * homepage footer link menu 
     */
    public static function footerLinkLeft() {
        return '<ul class="list-logo-ft clearfix">
                    <li><a rel="nofollow" class="ftlogo-PS" target="_blank" href="http://peacesoft.net/"></a></li>
                    <li><a rel="nofollow" class="ftlogo-CDT" target="_blank" href="http://chodientu.vn/"></a></li>
                    <li><a rel="nofollow" class="ftlogo-NL" target="_blank" href="https://www.nganluong.vn/"></a></li>
                    <li><a rel="nofollow" class="ftlogo-Adnet" target="_blank" href="http://adnet.vn/"></a></li>
                    <li><a rel="nofollow" class="ftlogo-Naima" target="_blank" href="http://naima.vn/"></a></li>
                </ul>';
    }

    /**
     * homepage footer link menu 
     */
    public static function footerLinkRight() {
        return '<ul class="list-logo-ft">
                    <li><a rel="nofollow" class="ftlogo-IDG" target="_blank" href="http://idgvv.com.vn/"></a></li>
                    <li><a rel="nofollow" class="ftlogo-SoftBank" target="_blank" href="http://softbank.com/"></a></li>
                    <li><a rel="nofollow" class="ftlogo-eBay" target="_blank" href="http://www.ebay.com/"></a></li>
                    <li><a rel="nofollow" class="ftlogo-Paypal" target="_blank" href="https://www.paypal.com/"></a></li>
                </ul>';
    }

    /**
     * user is login 
     * 
     * Yii::app()->session['userId']
     * Yii::app()->session['email']
     */
    public static function isLogin() {
        if (Yii::app()->session['email'] && Yii::app()->session['userId']) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * top right menu administrator 
     */
    public static function topRightMenuAdmin() {
        return array(
            'items' => array(
                array('label' => 'Trang chủ rao vặt', 'url' => array('home/index'), 'linkOptions' => array('target' => '_back')),
                array('label' => 'Tài khoản', 'url' => array('administrator/profile'), 'linkOptions' => array('rel' => 'facebox')),
                array('label' => 'Đổi mật khẩu', 'url' => array('administrator/changePasswd'), 'linkOptions' => array('rel' => 'facebox')),
                array('label' => 'Thoát', 'url' => array('site/logout'), 'itemOptions' => array('class' => 'last')),
            ),
        );
    }

    /**
     * top menu
     */
    public static function topMenu() {
        return array(
            'items' => array(
                array('label' => 'Quản trị website', 'url' => array('administrator/notify'), 'linkOptions' => array('id' => 'notify')),
                array('label' => 'Quản trị hệ thống', 'url' => array('administrator/view'), 'linkOptions' => array('id' => 'administatorManager')),
                array('label' => 'Cấu hình đang tin', 'url' => array('post/site'), 'linkOptions' => array('id' => 'systemManager')),
                array('label' => 'Thuộc tính dữ liệu', 'url' => array('crawler/demand'), 'linkOptions' => array('id' => 'processdemand')),
                array('label' => 'Marketing', 'url' => array('marketing/demand'), 'linkOptions' => array('id' => 'marketing')),
                array('label' => 'Thống kê', 'url' => array('administrator/sms'), 'linkOptions' => array('id' => 'smsStatistic')),
                array('label' => 'Quản lý Shop', 'url' => array('administrator/shopview'), 'linkOptions' => array('id' => 'shopManager')),
            )
        );
    }

    /**
     * category menu function 
     */
    public static function categoryMenu() {
        return array(
            'items' => array(
                array('label' => 'Thêm danh mục', 'url' => array('category/new')),
                array('label' => 'Danh mục', 'url' => array('category/view')),
                array('label' => 'Thêm thuộc tính', 'url' => array('category/AttributesNew')),
                array('label' => 'Thuộc tính', 'url' => array('category/AttributesView')),
                array('label' => 'Thêm nhu cầu', 'url' => array('category/DemandNew')),
                array('label' => 'Nhu cầu', 'url' => array('category/DemandView')),
                array('label' => 'Thêm bộ lọc', 'url' => array('category/FilterNew')),
                array('label' => 'Bộ lọc', 'url' => array('category/FilterView')),
            )
        );
    }

    /**
     * administrator menu function 
     */
    public static function administatorMenu() {
        return array(
            'items' => array(
                array('label' => 'Thêm quản trị', 'url' => array('administrator/new')),
                array('label' => 'Quản trị viên', 'url' => array('administrator/view')),
            )
        );
    }

    /**
     * system menu function 
     */
    public static function systemMenu() {
        return array(
            'items' => array(
                array('label' => 'Thêm tỉnh', 'url' => array('site/LocalityNew')),
                array('label' => 'Danh sách tỉnh', 'url' => array('site/LocalityView')),
            )
        );
    }

    /**
     * number fomat 
     */
    public static function numberFomat($number) {
        return number_format($number, 0, '', '.');
    }

    /**
     * footer link topic 
     */
    public static function footerTopicMenu() {
        return array(
            'items' => array(
                array('label' => 'Tin rao vặt chờ duyệt', 'url' => array('topic/manager')),
                array('label' => 'Tin rao vặt đã duyệt', 'url' => array('topic/PublishedTopic')),
                array('label' => 'Danh sách trang crawler', 'url' => array('site/CrawlerSite')),
            )
        );
    }

    /**
     * footer category menu 
     */
    public static function footerCategoryMenu() {
        return array(
            'items' => array(
                array('label' => 'Danh sách chuyên mục', 'url' => array('Category/view')),
                array('label' => 'Danh sách nhu cầu', 'url' => array('category/DemandView')),
                array('label' => 'Danh sách thuộc tính', 'url' => array('category/AttributesView')),
                array('label' => 'Danh sách bộ lọc', 'url' => array('category/FilterView')),
            )
        );
    }

    /**
     * footer administrator menu 
     */
    public static function footerAdministratorMenu() {
        return array(
            'items' => array(
                array('label' => 'Danh sách quản trị viên', 'url' => array('Administrator/view')),
                array('label' => 'Danh sách thành viên đăng ký', 'url' => array('Administrator/UserView')),
            )
        );
    }

    /**
     * footer system menu 
     */
    public static function footerSystemMenu() {
        return array(
            'items' => array(
                array('label' => 'Danh sách tỉnh', 'url' => array('site/LocalityView')),
            )
        );
    }

    /**
     * footer content 
     */
    public static function footerContent() {
        $footer = '<div id="footer">
                <p>SaoBang.vn là một sản phẩm của Peacesoft</p>
                <p><strong>Liên kết:</strong>
                <a target="_back" href="http://chodientu.vn">ChợĐiệnTử</a> |
                <a target="_back" href="http://ebay.vn">eBay.vn</a> |
                <a target="_back" href="https://www.nganluong.vn/">NgânLượng</a> |
                <a target="_back" href="http://adnet.vn/">Adnet</a>
                </p>
            </div>
        ';
        return $footer;
    }

    /**
     * convert time 
     */
    public static function convertTimeValue($stringTime) {
        $timeVal = strtotime($stringTime);
        $leftTime = time() - $timeVal;
        if ($leftTime < 60) {
            return $leftTime . ' giây trước';
        } else if ($leftTime < (60 * 60)) {
            return round($leftTime / 60) . ' phút trước';
        } else if ($leftTime < (24 * 60 * 60)) {
            return round($leftTime / 3600) . ' giờ trước';
        } else if ($leftTime < (30 * 24 * 60 * 60)) {
            return round($leftTime / (24 * 60 * 60)) . ' ngày trước';
        } else {
            return 'Đăng ngày ' . date('d/m/Y h:s');
        }
    }

    /**
     * @return  Hàm trả về mảng menu cho quản lý tin rao vặt publisher.
     * @author  Chienlv
     */
    public static function publisherMenu() {
        $userId = Yii::app()->session['userId'] ? Yii::app()->session['userId'] : 1;
        return array(
            'items' => array(
//               array('label'=>'Tin đã lưu', 'url'=>array('home/savedTopic')),
                array('label' => 'Tin hết hạn', 'url' => array('home/approvedTopic')),
//                array('label' => 'Tin đã đăng', 'url' => array('home/pendingApprovalTopic')),
                array('label' => 'Tin đã đăng', 'url' => array('home/published')),
                array('label' => 'Tin VIP', 'url' => array('home/vip'), 'linkOptions' => array('id' => 'protopic')),
                array('label' => 'Tài khoản VIP', 'url' => array('home/blog', 'id' => $userId), 'linkOptions' => array('id' => 'viptopic')),
            )
        );
    }

    /**
     * @author  Chienlv
     * @return  Hàm trả về mảng menu Cá nhân của publisher
     */
    public static function accountPublisherMenu() {
        return array(
            'items' => array(
                array('label' => 'Tài khoản', 'url' => array('user/profile')),
                array('label' => 'Đổi mật khẩu', 'url' => array('user/changerPassword')),
            )
        );
    }

    /**
     * content html menu 
     */
    public static function contentHtmlMenu() {
        return array(
            'items' => array(
                array('label' => 'Giới thiệu', 'url' => array('home/aboutUs')),
                array('label' => 'Liên hệ quảng cáo', 'url' => array('home/contactAd')),
                array('label' => 'Quy chế', 'url' => array('home/regulation')),
                array('label' => 'Quy định đăng tin', 'url' => array('home/publishedRules')),
            )
        );
    }

    /**
     * content help menu 
     */
    public static function contentHelpMenu() {
        return array(
            'items' => array(
                array('label' => 'Hướng dẫn đăng ký & đăng nhập', 'url' => array('home/help', 'contentCode' => 'huong-dan-dang-ky-dang-nhap')),
                array('label' => 'Hướng dẫn đăng tin', 'url' => array('home/help', 'contentCode' => 'dang-tin-rao-vat')),
                array('label' => 'Hướng dẫn mua tin VIP', 'url' => array('home/help', 'contentCode' => 'huong-dan-mua-tin-vip')),
                array('label' => 'Quản lý tin rao vặt', 'url' => array('home/help', 'contentCode' => 'quan-ly-tin-rao-vat')),
            )
        );
    }

    /**
     * create snippets 
     * <ul itemscope itemtype=”http://data-vocabulary.org/Breadcrumb”>

      <li><a itemprop=”url” href=”/” title=”Trang chủ”><span itemprop=”title”>Trang chủ</span></a></li>
      <li itemscope itemtype=”http://data-vocabulary.org/Breadcrumb”><a itemprop=”url” href=”/trang1″ title=”Trang 1″><span itemprop=”title”>Trang 1</span></a></li>
      <li itemscope itemtype=”http://data-vocabulary.org/Breadcrumb”><a itemprop=”url” href=”/trang2″ title=”Trang 2″><span itemprop=”title”>Trang 2</span></a></li>
      <li itemscope itemtype=”http://data-vocabulary.org/Breadcrumb”><a itemprop=”url” href=”/trang3″ title=”Trang 3″><span itemprop=”title”>Trang 3</span></a></li>
      </ul>
     * 
     * <div class="main f" itemscope itemtype="http://data-vocabulary.org/Recipe">
     * 
     * <div class="title-c cl nv" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
      <a itemprop="url" rel="nofollow" title="Trang chủ" href="/"><span itemprop="title">Trang chủ</span></a><span class="fl">&raquo;</span>
      <h2 itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" title="Google SEO Việt" href="google-seo-việt"><span itemprop="title">Google SEO</span></a></h2>
      </div>
     */
    public static function createSnippets($title, $description, $currUrl, $breadcrumb = array()) {
        $rateCount = (int) date('Y') . date('m');
        $rateValue = rand(8, 10);
        $content = '<div itemscope itemtype="http://schema.org/Recipe" class="itemscope">';
        $content .= '<span itemprop="name">' . $title . '</span>            
        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
        <span itemprop="ratingValue">' . $rateValue . '</span>
        <span itemprop="bestRating">10</span>
        <span itemprop="ratingCount">' . $rateCount . '</span></div>
        <h2 itemprop="description">' . $description . '</h2></div>';
        return $content;
    }

    public static function createSnippetsSearchPage($title, $description, $currUrl, $breadcrumb = array()) {
        $rateCount = (int) date('Y') . date('m');
        $rateValue = rand(8, 10);
        $content = '<div itemscope itemtype="http://schema.org/Recipe" class="itemscope">';
        $content .= '<span itemprop="name">' . $title . '</span>            
        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
        <span itemprop="ratingValue">' . $rateValue . '</span>
        <span itemprop="bestRating">10</span>
        <span itemprop="ratingCount">' . $rateCount . '</span></div>
        <h2 itemprop="description">' . $description . '</h2></div>';
        return $content;
    }

    /**
     *  snippet topic detail
     */
    public static function createSnippetsDetail($title, $description, $currUrl, $breadcrumb = array(), $dataProviderKeyword) {
        $rateCount = (int) date('Y');
        $rateValue = rand(8, 10);
        $content = '<div itemscope itemtype="http://schema.org/Recipe" class="itemscope">';
        $content .= '<span itemprop="name">' . $title . '</span></div>';
        $content .= '<div class="itemscope" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
        <span itemprop="ratingValue">' . $rateValue . '</span>
        <span itemprop="bestRating">10</span>
        <span itemprop="ratingCount">' . $rateCount . '</span></div>';
        return $content;
    }

    /**
     * process content 
     */
    public static function processContent($content = '') {
        //process image
        preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content, $matches);
        if (isset($matches[1])) {
            foreach ($matches[1] as $key => $img) {
                if (strpos($img, "http") !== FALSE) {
                    $img = trim($img);
//                    $content = str_replace($img, SERVER_MEDIA . Yii::app()->createUrl('external/image', array('code' => base64_encode($img))), $content);
                } else {
                    $content = str_replace('data/images/', 'http://data.saobang.vn/images/', $content);
                }
            }
        }
        $content = str_replace('href', 'target="_blank" rel="nofollow" href', $content);
        $content = str_replace('<pre', '<p', $content);
        $content = str_replace('</pre>', '</p>', $content);
        $content = str_replace('<li', '<p', $content);
        $content = str_replace('</li>', '</p>', $content);
        $content = str_replace(array('<ul>', '</ul>'), '', $content);
        $content = str_replace('src="../http://', 'src="http://', $content);
        $content = str_replace('<img ', '<img style="max-width: 650px;" ', $content);
        //remove all class in content
        $content = preg_replace('/(<[^>]+) class=".*?"/i', '$1', $content);

        $content = strip_tags($content, '<p><a><img><span><strong><br><div><table><tr><td>');
        return $content;
    }

    /**
     * process icon 
     */
    public static function processIcon($icon) {
        $icon = trim($icon);
        if (strpos($icon, "http") !== FALSE) {
            return $icon; // SERVER_MEDIA . Yii::app()->createUrl('external/image', array('code' => base64_encode($icon)));
        } else {
            $icon = str_replace('/data/images/', 'http://data.saobang.vn/images/', $icon);
            $icon = str_replace('data/images/', 'http://data.saobang.vn/images/', $icon);
            return $icon;
        }
    }

    /**
     * 
     * @param type $id
     * @param type $title
     * @param type $categoryId
     * @param type $childCatId
     * @return type
     */
    public static function topicDetail($id, $title, $categoryId = NULL, $childCatId = NULL) {
        if (!$categoryId && !$childCatId) {
            return Yii::app()->createUrl('home/TopicDetail', array('id' => $id, 'name' => ExtensionClass::utf8_to_ascii($title)));
        } else {
            if ($categoryId == $childCatId) {
                return Yii::app()->createUrl('home/TopicDetail', array('id' => $id, 'name' => ExtensionClass::utf8_to_ascii($title), 'categoryName' => ExtensionClass::getCategoryUrl($categoryId)));
            } else {
                return Yii::app()->createUrl('home/TopicDetail', array('id' => $id, 'name' => ExtensionClass::utf8_to_ascii($title), 'categoryName' => ExtensionClass::getCategoryUrl($categoryId), 'childCatName' => ExtensionClass::getCategoryUrl($childCatId)));
            }
        }
    }

    /**
     * get footer link
     */
    public static function extensionFooterLink() {
        $listRand = array('0' => 'id', '1' => 'title', '2' => 'childCatId', '3' => 'createDate', '4' => 'categoryId', '5' => 'id',);
        $typeRand = array('0' => 'ASC', '1' => 'DESC', '2' => 'ASC');

        $value = time() + 30 * 24 * 60 * 60 - 30 * 60;
        $condition = ' `endDate` >=' . $value . ' AND ';
        $condition .= '`status` = 0';
        $criteria = new CDbCriteria(array(
                    'condition' => $condition,
                    'order' => $listRand[rand(0, 5)] . ' ' . $typeRand[rand(0, 2)],
                ));
        $criteria->limit = 8;
        $duration = 200;
        $value = Yii::app()->cache->get('gl_extensionFooterLink');
        if ($value === false) {
            $dataProvider = new CActiveDataProvider(TopicSlaveModel::model()->cache($duration, NULL), array(
                        'pagination' => array(
                            'pageSize' => 8,
                        ),
                        'criteria' => $criteria,
                    ));
            $value = $dataProvider->getData();
            Yii::app()->cache->set('gl_extensionFooterLink', $value, 60);
        }
        echo 'Có thể bạn quan tâm: ';
        foreach ($value as $key => $data) {
            echo '<span><a href="' . self::topicDetail($data->id, $data->title, $data->categoryId, $data->childCatId) . '">' . $data->title . '</a></span>';
        }
    }

    /**
     * check user is vip member
     */
    public static function checkVipMember($userId) {
        $timeLimited = time() + 28 * 24 * 60 * 60;
        $string = date('Ym', $timeLimited);
        $key = $string . '_' . $userId;
        $value = Yii::app()->cache->get($key);
        if ($value === false) {
            //check databases
            $model = UserVipModel::model()->find('`userId` = ' . $userId . ' AND `beginDate` <= ' . time() . ' AND `endDate` >= ' . time());
            if ($model) {
                $value = true;
            } else {
                $value = false;
            }
            Yii::app()->cache->set($key, $value);
        }

        return $value;
    }

    /**
     * rank
     */
    public static function rankList() {
        return array(
            '1' => 'rank 1',
            '2' => 'rank 2',
            '3' => 'rank 3',
            '4' => 'rank 4',
            '5' => 'rank 5',
            '6' => 'rank 6',
            '7' => 'rank 7',
            '8' => 'rank 8',
            '9' => 'rank 9',
            '10' => 'rank 10'
        );
    }

    /**
     * ask type menu
     */
    public static function askTypelMenu() {
        return array(
            'items' => array(
                array('label' => 'Cần mua', 'url' => array('ask/view', 'type' => '1', 'name' => 'can-mua')),
                array('label' => 'Đã mua', 'url' => array('ask/view', 'type' => '2', 'name' => 'da-mua')),
                array('label' => 'Tất cả', 'url' => array('ask/view', 'name' => 'tat-ca')),
            ),
            'htmlOptions' => array(
                'class' => 'clearfix fl'
            )
        );
    }

    /**
     * hidden email
     */
    public static function hiddenEmail($email) {
        $email = substr($email, 0, 7);
        return $email . '...';
    }

}