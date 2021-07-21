<?php if (count($dacsan) > 0) { ?>
    <section class="productnb">
        <div class="container">
            <div class="global-title mb-4 ">
                <h3>Đặc sản con gà</h3>
            </div>
            <div class="slick-thudonnb mlr-10">
                <?php foreach ($dacsan as $key => $value) { ?>
                    <div class="productnb-items plr-10">
                        <div class="pronb-img">
                            <a href="<?=$value[$sluglang]?>">
                                <img onerror="this.src='<?=THUMBS?>/130x130x1/assets/images/noimage.png';" src="<?=THUMBS?>/130x130x1/<?=UPLOAD_PRODUCT_L.$value['photo']?>" alt="<?=$value['ten'.$lang]?>">
                            </a>
                        </div>
                        <div class="productnb-content">
                            <h3><a href="<?=$value[$sluglang]?>"><?=$value['ten'.$lang]?></a></h3>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>