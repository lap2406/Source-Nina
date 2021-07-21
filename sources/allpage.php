<?php
    if(!defined('SOURCES')) die("Error");
    /* Query allpage */
    $about = $d->rawQueryOne("select ten$lang, mota$lang,noidung$lang,photo from #_static where type = ? limit 0,1",array('gioi-thieu'));
    $favicon = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? and hienthi > 0 limit 0,1",array('favicon','photo_static'));
    $logo = $d->rawQueryOne("select id, photo from #_photo where type = ? and act = ? limit 0,1",array('logo','photo_static'));
    $socialfooter = $d->rawQuery("select photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc ", array("social-footer"));
    $banner = $d->rawQueryOne("select photo, ten$lang, link from #_photo where type = ? and act = ? limit 0,1",array('banner','photo_static'));
    $social = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('social'));
    $socialft = $d->rawQuery("select photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('social2'));
    $ttll = $d->rawQuery("select ten$lang, mota$lang, photo, link, ten$lang from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('slider-information'));
    $slogan = $d->rawQueryOne("select ten$lang, mota$lang from #_static where type = ? limit 0,1", array('slogan'));
    $social2 = $d->rawQuery("select ten$lang, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('mangxahoi2'));
    $splistmenu = $d->rawQuery("select ten$lang, tenkhongdau$lang, id from #_product_list where type = ? and hienthi > 0 and noibat > 0 order by stt,id desc",array('san-pham'));
    $tktclistmenu = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id from #_news_list where type = ? and noibat > 0 and hienthi > 0 order by stt,id desc",array('tktc'));
    $footer = $d->rawQueryOne("select ten$lang, mota$lang, noidung$lang from #_static where type = ? limit 0,1",array('footer'));
    $cs = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, photo from #_news where type = ? and hienthi > 0 order by stt,id desc",array('chinh-sach'));
    $lienheqr = $d->rawQuery("select id, photo,link from #_photo where hienthi > 0 and type = ? ", array("lienheqr"));
    $product_nb = $d->rawQuery("select ten$lang, tenkhongdauvi, tenkhongdauen, id, photo, gia, giamoi, giakm, type from #_product where type = ? and noibat = ? and hienthi > 0 order by stt,id desc",array('san-pham',1));

     $partner = $d->rawQuery("select ten$lang, link, photo from #_photo where type = ? and hienthi > 0 order by stt, id desc",array('doitac'));
   

    /* Get statistic */
    $counter = $statistic->getCounter();
    $online = $statistic->getOnline();

    /* Newsletter */
    if(!empty($_POST['submit-newsletter']))
    {
        $responseCaptcha = $_POST['recaptcha_response_newsletter'];
        $resultCaptcha = $func->checkRecaptcha($responseCaptcha);
        $scoreCaptcha = (isset($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
        $actionCaptcha = (isset($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
        $testCaptcha = (isset($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;
        if(($scoreCaptcha >= 0.5 && $actionCaptcha == 'Newsletter') || $testCaptcha == true)
        {
            $data = array();
            $data['email'] = (isset($_REQUEST['email-newsletter']) && $_REQUEST['email-newsletter'] != '') ? htmlspecialchars($_REQUEST['email-newsletter']) : '';
            $data['ten'] = (isset($_REQUEST['hoten-newsletter']) && $_REQUEST['hoten-newsletter'] != '') ? htmlspecialchars($_REQUEST['hoten-newsletter']) : '';
            $data['dienthoai'] = (isset($_REQUEST['phone-newsletter']) && $_REQUEST['phone-newsletter'] != '') ? htmlspecialchars($_REQUEST['phone-newsletter']) : '';
            $data['diachi'] = (isset($_REQUEST['diachi-newsletter']) && $_REQUEST['diachi-newsletter'] != '') ? htmlspecialchars($_REQUEST['diachi-newsletter']) : '';
            $data['noidung'] = (isset($_REQUEST['noidung-newsletter']) && $_REQUEST['noidung-newsletter'] != '') ? htmlspecialchars($_REQUEST['noidung-newsletter']) : '';
            $data['company'] = (isset($_REQUEST['company-newsletter']) && $_REQUEST['company-newsletter'] != '') ? htmlspecialchars($_REQUEST['company-newsletter']) : '';
            $data['ngaytao'] = time();
            $data['type'] = 'dangkynhantin'; 
            if($d->insert("newsletter",$data))
            {
                $func->transfer("Đăng ký nhận tin thành công. Chúng tôi sẽ liên hệ với bạn sớm.",$config_base);
            }
            else
            {
                $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.",$config_base, false);
            }
        } 
        
        else
        {
            $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.",$config_base, false);
        }
    }
?>