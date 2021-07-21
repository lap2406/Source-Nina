<!-- Css Files -->
<?php
$css->setCache("cached");
$css->setCss("./assets/css/animate.min.css");
$css->setCss("./assets/bootstrap/bootstrap.css");
$css->setCss("./assets/fontawesome512/all.css");
$css->setCss("./assets/fancybox3/jquery.fancybox.css");
$css->setCss("./assets/fancybox3/jquery.fancybox.style.css");
$css->setCss("./assets/jQuery.filer-1.3.0/css/jquery.filer.css");
$css->setCss("./assets/jQuery.filer-1.3.0/css/themes/jquery.filer-dragdropbox-theme.css");
$css->setCss("./assets/bootstrapvalidator-0.5.2/dist/css/bootstrapValidator.min.css");
$css->setCss("./assets/css/member.css");
$css->setCss("./assets/login/login.css");
$css->setCss("./assets/css/product.css");
$css->setCss("./assets/photobox/photobox.css");
$css->setCss("./assets/slick/slick.css");
$css->setCss("./assets/slick/slick-theme.css");
$css->setCss("./assets/slick/slick-theme.css");
$css->setCss("./assets/owlcarousel2/owl.carousel.css");
$css->setCss("./assets/owlcarousel2/owl.theme.default.css");
$css->setCss("./assets/simplyscroll/jquery.simplyscroll.css");
$css->setCss("./assets/magiczoomplus/magiczoomplus.css");
$css->setCss("./assets/css/cart.css");
// $css->setCss("./assets/css/rp-menu.css");
// $css->setCss("./assets/css/responsive.css");
$css->setCss("./assets/fotorama/fotorama.css");
$css->setCss("./assets/fotorama/fotorama-style.css");
$css->setCss("./assets/css/bonus.css");
$css->setCss("./assets/css/style.css");

echo $css->getCss();
?>

<!-- Background -->
<?php
$bgbody = $d->rawQueryOne("select hienthi, options, photo from #_photo where act = ? and type = ? limit 0,1", array('photo_static', 'background'));

if ($bgbody['hienthi']) {
    $bgbodyOptions = json_decode($bgbody['options'], true)['background'];
    if ($bgbodyOptions['loaihienthi']) {
        echo '<style type="text/css">body{background: url(' . UPLOAD_PHOTO_L . $bgbody['photo'] . ') ' . $bgbodyOptions['repeat'] . ' ' . $bgbodyOptions['position'] . ' ' . $bgbodyOptions['attachment'] . ' ;background-size:' . $bgbodyOptions['size'] . '}</style>';
    } else {
        echo ' <style type="text/css">body{background-color:#' . $bgbodyOptions['color'] . '}</style>';
    }
}
?>

<!-- Js Google Analytic -->
<?= htmlspecialchars_decode($setting['analytics']) ?>

<!-- Js Head -->
<?= htmlspecialchars_decode($setting['headjs']) ?>