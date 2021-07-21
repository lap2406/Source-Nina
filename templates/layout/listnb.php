<?php if (isset($listnb) && count($listnb) > 0) { ?>
    <section class="listnb">
        <div class="container">
            <div class="owl-listnb owl-carousel">
                <?php foreach ($listnb as $k => $v) { ?>
                    <div class="listnb-items">
                        <div class="listnb-img">
                            <a href="<?= $v[$sluglang] ?>">
                                <img onerror="this.src='<?= THUMBS ?>/255x255x2/assets/images/noimage.png';" src="<?= THUMBS ?>/255x255x2/<?= UPLOAD_PRODUCT_L . $v['photo'] ?>" alt="">
                            </a>
                        </div>
                        <div class="listnb-content">
                            <h3><a href="<?= $v[$sluglang] ?>"><?= $v['ten' . $lang] ?></a></h3>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>