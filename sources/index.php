<?php
if (!defined('SOURCES')) die("Error");
$popup = $d->rawQueryOne("select id, photo,hienthi,link from #_photo where type = ? and act = ? limit 0,1", array('popup', 'photo_static'));
$listnb = $d->rawQuery("select ten$lang, tenkhongdau$lang, id, photo from #_product_list where type = ? and noibat > 0 and hienthi > 0 order by stt,id desc", array('san-pham'));
$listshowhome = $d->rawQuery("select ten$lang, tenkhongdau$lang, id, photo from #_product_list where type = ? and noibat > 0 and hienthi > 0 and showhome > 0 order by stt,id desc", array('san-pham'));
$slider = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc", array('slide'));
$product = $d->rawQuery("select ten$lang, tenkhongdau$lang, id from #_product where type = ? and hienthi > 0 order by stt,id desc", array('san-pham'));
$spkm = $d->rawQuery("select ten$lang, tenkhongdau$lang,gia,giasi,photo, id from #_product where type = ? and hienthi > 0 and khuyenmai > 0 order by stt,id desc", array('san-pham'));
$gallery = $d->rawQuery("select photo, ten$lang,mota$lang,tenkhongdauvi, tenkhongdauen, id from #_news where type = ? and noibat > 0 and hienthi > 0 order by id desc ", array('gallery'));
$newsnb = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, ngaytao, id, photo from #_news where type = ? and noibat > 0 and hienthi > 0 order by stt,id desc", array('tin-tuc'));
$tieuchi = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, mota$lang, ngaytao, id, photo from #_news where type = ? and noibat > 0 and hienthi > 0 order by stt,id desc", array('tieu-chi'));
$criteria = $d->rawQuery("select id, ten$lang,tenkhongdauvi, tenkhongdauen, mota$lang, photo from #_news where type = ? and noibat > 0 and hienthi > 0 order by stt,id desc", array('tieu-chi'));
$services = $d->rawQuery("select id, ten$lang,tenkhongdauvi, tenkhongdauen, mota$lang, photo from #_news where type = ? and noibat > 0 and hienthi > 0 order by stt,id desc", array('dich-vu'));
$ykien = $d->rawQuery("select ten$lang, mota$lang, photo from #_news where type = ? and noibat > 0 and hienthi > 0 order by stt,id desc", array('y-kien'));
$videonb = $d->rawQuery("select id,ten$lang,link_video from #_photo where noibat > 0 and type = ? and hienthi > 0", array('video'));
$doitac = $d->rawQuery("select id, ten$lang, link, photo from #_photo where hienthi > 0 and type = ? ", array("doitac"));
$aboutimg = $d->rawQuery("select id, photo from #_photo where hienthi > 0 and type = ? ", array("aboutImg"));


/* SEO */
$seoDB = $seo->getSeoDB(0, 'setting', 'capnhat', 'setting');
$seo->setSeo('h1', $seoDB['title' . $seolang]);
$seo->setSeo('title', $seoDB['title' . $seolang]);
$seo->setSeo('keywords', $seoDB['keywords' . $seolang]);
$seo->setSeo('description', $seoDB['description' . $seolang]);
$seo->setSeo('url', $func->getPageURL());
$img_json_bar = (isset($logo['options']) && $logo['options'] != '') ? json_decode($logo['options'], true) : null;
if ($img_json_bar['p'] != $logo['photo']) {
    $img_json_bar = $func->getImgSize($logo['photo'], UPLOAD_PHOTO_L . $logo['photo']);
    $seo->updateSeoDB(json_encode($img_json_bar), 'photo', $logo['id']);
}
$seo->setSeo('photo', $config_base . THUMBS . '/' . $img_json_bar['w'] . 'x' . $img_json_bar['h'] . 'x2/' . UPLOAD_PHOTO_L . $logo['photo']);
$seo->setSeo('photo:width', $img_json_bar['w']);
$seo->setSeo('photo:height', $img_json_bar['h']);
$seo->setSeo('photo:type', $img_json_bar['m']);
