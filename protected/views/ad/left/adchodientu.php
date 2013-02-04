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
if (isset($result['content'])) {
    ?>
    <div class="block product-cdt">
        <div class="Sbox-title">
            <a rel="nofollow" target="_blank" href="http://chodientu.vn">Sản phẩm Chợđiệntử.vn</a>
        </div>
        <div class="block-content">
            <ul class="lst-product-cdt clearfix">
                <?php
                foreach ($result['content'] as $index => $data) {
                    $link = 'http://chodientu.vn/san-pham/' . $data['id'] . '/' . ExtensionClass::utf8_to_ascii($data['title']) . '.html';
                    ?>
                    <li class="clearfix">
                        <a rel="nofollow" target="_blank" href="<?php echo $link; ?>" class="dispImg"><img src="<?php echo $data['image']; ?>" alt="<?php echo $data['title'] ?>"/></a>
                        <h2><a rel="nofollow" target="_blank" href="<?php echo $link; ?>"><?php echo $data['title'] ?></a></h2>
                        <p class="price"><?php echo GlobalComponents::numberFomat($data['price']); ?> VNĐ</p>
                    </li> 
                    <?php
                }
                ?>          
            </ul>
        </div>
    </div>
    <?php
}
?>