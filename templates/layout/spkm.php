<?php if (isset($spkm) && count($spkm) > 0) { ?>
    <section class="spkm">
        <div class="container">
            <div class="global-title">
                <h3>Sản phẩm khuyến mãi</h3>
                <p><?=$slogan['ten'.$lang]?></p>
            </div>
            <div class="owl-spkm owl-carousel">
                <?php foreach ($spkm as $k => $v) { 
                    $func->showProduct($v,$options =array('class'=>'spkm-items '),$k);
                } ?>
            </div>
        </div>
    </section>
<?php } ?>