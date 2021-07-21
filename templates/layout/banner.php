<section class="banner wow fadeIn">
    <div class="w-100">
        <div class="banner-img">
            <a href="<?= $banner['link'] ?>">
                <img onerror="this.src='<?= THUMBS ?>/1366x414x1/assets/images/noimage.png';" src="<?= THUMBS ?>/1366x414x1/<?= UPLOAD_PHOTO_L . $banner['photo'] ?>" alt="<?=  $banner['ten' . $lang] ?>">
            </a>
        </div>
    </div>
</section>