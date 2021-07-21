<?php
/* Config type - Group */


/* Config type - Product */
require_once LIBRARIES . 'type/config-type-product.php';

/* Config type - Tags */
require_once LIBRARIES . 'type/config-type-tags.php';

/* Config type - Newsletter */
require_once LIBRARIES . 'type/config-type-newsletter.php';

/* Config type - News */
require_once LIBRARIES . 'type/config-type-news.php';

/* Config type - Static */
require_once LIBRARIES . 'type/config-type-static.php';

/* Config type - Photo */
require_once LIBRARIES . 'type/config-type-photo.php';

/* Seo page */
$config['seopage']['page'] = array(
    "gioi-thieu" => "Giới thiệu",
    "san-pham" => "Sản phẩm",
    "khuyenmai" => "Khuyến mãi",
    "tin-tuc" => "Tin tức",
    "lien-he" => "Liên hệ"
);
$config['seopage']['width'] = 300;
$config['seopage']['height'] = 200;
$config['seopage']['thumb'] = '300x200x1';
$config['seopage']['width-banner'] = 1366;
$config['seopage']['height-banner'] = 255;
$config['seopage']['thumb-banner'] = '1366x255x1';
$config['seopage']['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

/* Setting */
$config['setting']['diachi'] = true;
$config['setting']['dienthoai'] = true;
$config['setting']['worktime'] = true;
$config['setting']['hotline'] = true;
$config['setting']['hotline1'] = true;
$config['setting']['hotline2'] = true;
$config['setting']['zalo'] = true;
$config['setting']['oaidzalo'] = true;
$config['setting']['email'] = true;
$config['setting']['website'] = true;
$config['setting']['fanpage'] = true;
$config['setting']['toado'] = true;
$config['setting']['toado_iframe'] = true;

/* Quản lý import */
$config['import']['images'] = true;
$config['import']['thumb'] = '100x100x1';
$config['import']['img_type'] = ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF";

/* Quản lý export */
$config['export']['category'] = true;

/* Quản lý thông báo đẩy */
$config['onesignal'] = false;
/* Quản lý địa điểm */
// $config['places']['active'] = true;

/* Quản lý giỏ hàng */
$config['order']['active'] = true;
$config['order']['search'] = true;
$config['order']['excel'] = false;
$config['order']['word'] = false;
$config['order']['excelall'] = false;
$config['order']['wordall'] = false;
$config['order']['thumb'] = '100x100x1';
