<section class="criteria">
    <div class="criteria-main">
        <p class="control-carousel prev-carousel prev-criteria transition"><i class="fas fa-chevron-left"></i></p>
        <div class="container">
            <div class="owl-criteria owl-carousel">
                <?php foreach ($criteria as $k => $v) { ?>
                    <div class="criteria-items">
                        <div class="criteria-img">
                            <a href="<?= $v[$sluglang] ?>">
                                <img onerror="this.src='<?= THUMBS ?>/274x274x1/assets/images/noimage.png';" src="<?= THUMBS ?>/274x274x1/<?= UPLOAD_NEWS_L . $v['photo'] ?>" alt="">
                            </a>
                        </div>
                        <div class="criteria-content">
                            <h3><a href="<?= $v[$sluglang] ?>"><?= $v['ten' . $lang] ?></a></h3>
                            <p><?= $v['mota' . $lang] ?></p>
                        </div>
                        <div class="view-more">
                            <a href="<?= $v[$sluglang] ?>"><?=xemthem?></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <p class="control-carousel next-carousel next-criteria transition"><i class="fas fa-chevron-right"></i></p>
    </div>
</section>