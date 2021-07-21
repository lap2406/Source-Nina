<div class="static">
    <div class="container">
        <div class="global-title">
            <h3><?= (@$title_cat != '') ? $title_cat : @$title_crumb ?></h3>
            <div class="row">
                <?php if (count($news) > 0) {
                    for ($i = 0; $i < count($news); $i++) { ?>
                        <div class="col-xl-4 col-6 mb-3">
                            <a href="<?= $news[$i][$sluglang] ?>" title="<?= $news[$i]['ten' . $lang] ?>"><img onerror="this.src='<?= THUMBS ?>/480x360x2/assets/images/noimage.png';" src="<?= THUMBS ?>/480x360x1/<?= UPLOAD_NEWS_L . $news[$i]['photo'] ?>" alt="<?= $news[$i]['ten' . $lang] ?>" /></a>
                            <h5 class="name-album text-split"><?= $news[$i]['ten' . $lang] ?></h5>
                        </div>
                    <?php }
                } else { ?>
                    <div class="alert alert-warning" role="alert">
                        <strong><?= khongtimthayketqua ?></strong>
                    </div>
                <?php } ?>
                <div class="clear"></div>
                <div class="pagination-home"><?= (isset($paging) && $paging != '') ? $paging : '' ?></div>
            </div>
        </div>
    </div>
</div>