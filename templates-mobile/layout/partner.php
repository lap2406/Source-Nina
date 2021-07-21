<?php if (count($doitac) > 0) { ?>
    <section class="partner">
        <div class="partner-main">
            <p class="control-carousel prev-carousel prev-partner transition"><i class="fas fa-chevron-left"></i></p>
            <div class="container">
                <div class="owl-partner owl-carousel">
                    <?php foreach ($doitac as $k => $v) { ?>
                        <div class="partner-img">
                            <a href="<?= $v['link'] ?>">
                                <img src="<?= UPLOAD_PHOTO_L . $v['photo'] ?>" alt="">
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <p class="control-carousel next-carousel next-partner transition"><i class="fas fa-chevron-right"></i></p>
        </div>
    </section>
<?php } ?>