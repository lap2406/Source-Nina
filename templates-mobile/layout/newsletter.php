<aside class="newsletter">
    <div class="container">
        <div class="global-title">
            <h3><?= dangkynhantin ?></h3>
            <p><?=$slogan['ten'.$lang]?></p>
        </div>
        <div class="newsletter-bg">
            <div class="newsletter-main wow fadeIn animated">
                <form class="form-newsletter validation-newsletter " novalidate method="post" action="" enctype="multipart/form-data">
                    <div class="row mlr-10">
                        <div class="newsletter-input col-6 plr-10 mb-3">
                            <input type="text" class="" id="hoten-newsletter" name="hoten-newsletter" placeholder="<?= tencuaban ?>" required />
                            <div class="invalid-feedback"><?= vuilongnhaphoten ?></div>
                        </div>
                        <div class="newsletter-input col-6 plr-10 mb-3">
                            <input type="text" class="" id="phone-newsletter" name="phone-newsletter" placeholder="<?= sodienthoai ?>" required />
                            <div class="invalid-feedback"><?= vuilongnhapsodienthoai ?></div>
                        </div>
                        <div class="newsletter-input col-6 plr-10 mb-3">
                            <input type="email" class="" id="email-newsletter" name="email-newsletter" placeholder="<?= email ?>" required />
                            <div class="invalid-feedback"><?= vuilongnhapdiachiemail ?></div>
                        </div>
                        <div class="newsletter-input col-6 plr-10 mb-3">
                            <input type="text" class="" id="diachi-newsletter" name="diachi-newsletter" placeholder="Địa chỉ" required />
                            <div class="invalid-feedback"><?= vuilongnhapdiachi ?></div>
                        </div>
                        <div class="newsletter-textarea col-12 plr-10 mb-3">
                            <textarea class="" name="noidung-newsletter" id="noidung-newsletter" placeholder="<?= noidung ?>" required></textarea>
                            <div class="invalid-feedback"><?= vuilongnhapnoidung ?></div>
                        </div>
                    </div>

                    <div class=" newsletter-end ">

                        <div class="newsletter-button ">
                            <input class=" submit-newsletter-button" type="submit" name="submit-newsletter" value="Đăng ký ngay" disabled>
                            <input type="hidden" name="recaptcha_response_newsletter" id="recaptchaResponseNewsletter">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</aside>