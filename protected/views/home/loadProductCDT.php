<?php
if (isset($result['content'])) {
    ?>
    <div class="block" style="width: 700px" id="CDTContent">
        <div class="listPrd-CDT jcarousel-skin-tango" id="mycarousel">
            <div id="wrap" class="slidePrd">
                <ul style="left: -165px;" >
                    <?php
                    foreach ($result['content'] as $index => $data) {
                        echo '<li>';
                        echo '<div class="imgPrd"><a target="_blank" rel="nofollow" href="http://chodientu.vn/san-pham/' . $data['id'] . '/' . ExtensionClass::utf8_to_ascii($data['title']) . '.html">' . $data['image'] . '</a></div>';
                        echo '<h4><a target="_blank" rel="nofollow" href="http://chodientu.vn/san-pham/' . $data['id'] . '/' . ExtensionClass::utf8_to_ascii($data['title']) . '.html">' . $data['title'] . '</a></h4>';
                        echo '<p class="red-clr">' . GlobalComponents::numberFomat($data['price']) . ' VNĐ</p>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php
}
?>