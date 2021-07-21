<section class="gallery">
    <div class="container">
        <div class="global-title mb-4 ">
            <h3><?=hinhanhhoatdong?></h3>
            <p><?= $slogan['ten' . $lang] ?></p>
        </div>
        <?php if (count($gallery) > 0) { ?>
            <div class="owl-gallery owl-carousel">
                <?php foreach ($gallery as $k => $v) {
                    $hinhanhtt = $d->rawQuery("select photo from #_gallery where id_photo = ? and com='news' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc", array($v['id'], "gallery", "gallery"));
                ?>
                    <div class="gallery-main">
                        <div class="gallery-items">
                            <a data-fancybox="images<?= $k ?>" href="<?= UPLOAD_NEWS_L . $v['photo'] ?>" rel="group">
                                <img class="w-100" onerror="this.src='<?= THUMBS ?>/583x368x1/assets/images/noimage.png';" data-thumbs="<?= THUMBS ?>/583x368x1/<?= UPLOAD_NEWS_L . $v['photo'] ?>" src="<?= THUMBS ?>/182x114x1/<?= UPLOAD_NEWS_L . $v['photo'] ?>" alt="<?= $v['ten' . $lang] ?>" />
                            </a>
                            <div class="gallery-content">
                                <h3><a href=""><?= $v['ten' . $lang] ?></a></h3>
                                <p><?= $v['mota' . $lang] ?></p>
                                <div class="view-more">
                                    <a href="<?= $v[$sluglang] ?>"><?=xemthem?></a>
                                </div>
                            </div>
                        </div>
                        <div class="d-none">
                            <?php foreach ($hinhanhtt as $k1 => $v1) { ?>
                                <a data-fancybox="images<?= $k ?>" href="<?= UPLOAD_NEWS_L . $v1['photo'] ?>" rel="group">
                                    <img src="<?= THUMBS ?>/200x100x1/<?= UPLOAD_NEWS_L . $v1['photo'] ?>" alt="">
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>