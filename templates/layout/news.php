<section class="newsnb">
    <div class="container">
        <?php if (isset($newsnb) && count($newsnb) > 0) { ?>
            <div class="global-title ">
                <h3>Tin tức & sự kiện</h3>
                <p><?=$slogan['ten'.$lang]?></p>
            </div>
            <div class="owl-news owl-carousel">
                <?php foreach ($newsnb as $key => $value) { ?>
                    <div class="newsnb-items">
                        <div class="newsnb-img ">
                            <a href="<?= $value[$sluglang] ?>">
                                <div class="newsnb-images">
                                    <img onerror="this.src='<?= THUMBS ?>/150x110x1/assets/images/noimage.png';" src="<?= THUMBS ?>/150x110x1/<?= UPLOAD_NEWS_L . $value['photo'] ?>" alt="<?= $value['ten' . $lang] ?>">
                                </div>
                            </a>
                        </div>
                        <div class="newsnb-detail ">
                            <div class="new-tilte">
                                <a href="<?= $value[$sluglang] ?>"><?= $value['ten' . $lang] ?></a>
                            </div>
                            <p><?= $value['mota' . $lang] ?></p>
                        </div>

                    </div>
                <?php } ?>
            </div>

        <?php } ?>
</section>