<section class="about">
    <div class="container">
        <div class="about-main">
            <div class="row">
                <div class="col-12 about-left">
                    <div class="about-title">
                        <h3><?= $about['ten' . $lang] ?></h3>
                        <p><?= $about['mota' . $lang] ?></p>
                        <span>KÍNH CHÀO QUÝ KHÁCH ĐÃ ĐẾN VỚI CHÚNG TÔI !</span>
                    </div>
                    <div class="about-content">
                        <?= $func->cutString(htmlspecialchars_decode($about['noidung' . $lang]),700) ?>
                    </div>
                    <div class="view-more">
                        <a href="gioi-thieu">Xem thêm [<i class="fal fa-plus"></i>]</a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="about-img">
                    <img onerror="this.src='<?= THUMBS ?>/274x274x1/assets/images/noimage.png';" src="<?= THUMBS ?>/521x385x1/<?= UPLOAD_NEWS_L . $about['photo'] ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>