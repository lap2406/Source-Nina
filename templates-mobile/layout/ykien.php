<?php if (isset($ykien) && count($ykien)) { ?>
    <section class="ykien">
        <div class="container">
            <div class="global-title">
                <h3><?=ykienkhachhang?></h3>
                <p><?=$slogan['ten'.$lang]?></p>
            </div>
            <div class="ykien-main">
                <p class="control-carousel prev-carousel prev-ykien transition"><i class="fas fa-chevron-left"></i></p>
                <div class="owl-ykien owl-carousel">
                    <?php foreach ($ykien as $k => $v) { ?>
                        <div class="ykien-items">
                            <div class="ykien-img">
                                <a href="<?= $v[$sluglang] ?>">
                                    <img onerror="this.src='<?= THUMBS ?>/127x127x1/assets/images/noimage.png';" src="<?= THUMBS ?>/127x127x1/<?= UPLOAD_NEWS_L . $v['photo'] ?>" alt="">
                                </a>
                            </div>
                            <div class="ykien-content">
                                <h3><a href="<?= $v[$sluglang] ?>"><?= $v['ten' . $lang] ?></a></h3>
                                <p><?= $v['mota' . $lang] ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <p class="control-carousel next-carousel next-ykien transition"><i class="fas fa-chevron-right"></i></p>
            </div>
        </div>
    </section>
<?php } ?>