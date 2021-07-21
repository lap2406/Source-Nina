<?php if (count($videonb) > 0) { ?>
    <section class="videos">
        <div class="container">
            <div class="global-title mb-4">
                <h3>Video nổi bật</h3>
            </div>
            <div class="row">
                <div class="col-xl-5 wow fadeIn">
                    <div class="feedback-main">
                        <div class="slick-ykien">
                            <?php foreach ($ykien as $k => $v) { ?>
                                <div class="feedback-items">
                                    <div class="feedback-img">
                                        <img onerror="this.src='<?= THUMBS ?>/140x140x1/assets/images/noimage.png';" src="<?= THUMBS ?>/140x140x1/<?= UPLOAD_NEWS_L . $v1['photo'] ?>" alt="<?= $v1['ten' . $lang] ?>">
                                    </div>
                                    <div class="feedback-content">
                                        <p><?= $v['mota' . $lang] ?></p>
                                        <div class="feedback-name">
                                            <img src="./assets/images/ykien-img1.png" alt="">
                                            <h3><?= $v['ten' . $lang] ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7">
                    <div class="video-items wow fadeIn">
                        <?= $addons->setAddons('video-select', 'video-select', 10); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>