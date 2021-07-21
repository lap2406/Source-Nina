<section class="services">
    <div class="container">
        <div class="global-title">
            <h3><?=dichvunoibatcuachungtoi?></h3>
        </div>
        <div class="slick-services mlr-15">
            <?php foreach ($services as $k => $v) { ?>
                <div class="plr-15">
                    <div class="services-items ">
                        <div class="services-img">
                            <a href="<?= $v[$sluglang] ?>">
                                <img onerror="this.src='<?= THUMBS ?>/274x274x1/assets/images/noimage.png';" src="<?= THUMBS ?>/274x274x1/<?= UPLOAD_NEWS_L . $v['photo'] ?>" alt="">
                            </a>
                        </div>
                        <div class="services-content">
                            <h3><a href="<?= $v[$sluglang] ?>"><?= $v['ten' . $lang] ?></a></h3>
                            <p><?= $v['mota' . $lang] ?></p>
                        </div>
                        <div class="view-more">
                            <a href="<?= $v[$sluglang] ?>"><?=xemthem?></a>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>

</section>