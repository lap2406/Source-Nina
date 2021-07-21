<div class="container">
   <div class=" row mt-3">
      <div class="col-md-5 col-12 w-clear ">
         <div class="left-pro-detail">
            <a id="Zoom-1" class="MagicZoom w-100" data-options="zoomMode: off; hint: off; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;" href="<?= THUMBS ?>/460x500x2/<?= UPLOAD_PRODUCT_L . $row_detail['photo'] ?>" title="<?= $row_detail['ten' . $lang] ?>"><img onerror="this.src='<?= THUMBS ?>/460x500x2/images/noimage.png';" src="<?= THUMBS ?>/460x500x2/<?= UPLOAD_PRODUCT_L . $row_detail['photo'] ?>" alt="<?= $row_detail['ten' . $lang] ?>"></a>
            <?php if ($hinhanhsp) {
               if (count($hinhanhsp) > 0) { ?>
                  <div class="gallery-thumb-pro">
                     <p class="control-carousel prev-carousel prev-thumb-pro transition"><i class="fas fa-chevron-left"></i></p>
                     <div class="owl-carousel owl-theme owl-thumb-pro">
                        <a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?= THUMBS ?>/460x500x2/<?= UPLOAD_PRODUCT_L . $row_detail['photo'] ?>" title="<?= $row_detail['ten' . $lang] ?>"><img onerror="this.src='<?= THUMBS ?>/460x500x2/assets/images/noimage.png';" src="<?= THUMBS ?>/460x500x2/<?= UPLOAD_PRODUCT_L . $row_detail['photo'] ?>" alt="<?= $row_detail['ten' . $lang] ?>"></a>
                        <?php foreach ($hinhanhsp as $v) { ?>
                           <a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?= THUMBS ?>/460x500x2/<?= UPLOAD_PRODUCT_L . $v['photo'] ?>" title="<?= $row_detail['ten' . $lang] ?>">
                              <img onerror="this.src='<?= THUMBS ?>/460x500x2/assets/images/noimage.png';" src="<?= THUMBS ?>/460x500x2/<?= UPLOAD_PRODUCT_L . $v['photo'] ?>" alt="<?= $row_detail['ten' . $lang] ?>">
                           </a>
                        <?php } ?>
                     </div>
                     <p class="control-carousel next-carousel next-thumb-pro transition"><i class="fas fa-chevron-right"></i></p>
                  </div>
            <?php }
            } ?>
         </div>
      </div>
      <div class="right-pro-detail col-md-7 col-12">
         <h3 class="title-pro-detail"><?= $row_detail['ten' . $lang] ?></h3>
         <div class="social-plugin social-plugin-pro-detail w-clear">
            <div class="addthis_inline_share_toolbox_qj48"></div>
            <div class="zalo-share-button" data-href="<?= $func->getCurrentPageURL() ?>" data-oaid="<?= ($optsetting['oaidzalo'] != '') ? $optsetting['oaidzalo'] : '579745863508352884' ?>" data-layout="1" data-color="blue" data-customize=false></div>
         </div>
         <?php
         echo '<div class="product-prices">';
         if (isset($row_detail['gia']) && $row_detail['gia'] > 0) {
            echo '<span>Giá lẻ: <b>' . $func->format_money($row_detail['gia']) . '</b></span>';
         }
         if (isset($row_detail['giasi']) && $row_detail['giasi'] > 0) {
            echo '<span>Giá sỉ: <b>' . $func->format_money($row_detail['giasi']) . '</b></span>';
         }
         if ($row_detail['gia'] == 0 ) {
            echo '<span >Giá lẻ: <b>Liên hệ</b></span>';
         }
         if ($row_detail['giasi'] == 0 ) {
            echo '<span >Giá sỉ: <b>Liên hệ</b></span>';
         }

         echo '</div>';
         ?>
         <div class="w-clear mb-1">
            <label class="attr-label-pro-detail"><?= luotxem ?>:</label>
            <div class="attr-content-pro-detail"><?= $row_detail['luotxem'] ?></div>
         </div>
         <div class="cart-pro-detail flex-ct-sb">
            <button class="transition addcart" id="add-cart" data-name="<?= $row_detail['ten' . $lang] ?>" data-id="<?= $row_detail['id'] ?>" data-action="addnow">
               <span><i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng</span>
            </button>
            <button class="transition addcart" id="add-cart-now" data-name="<?= $row_detail['ten' . $lang] ?>" data-id="<?= $row_detail['id'] ?>" data-action="buynow">
               <span> <i class="fas fa-shopping-cart"></i> Mua ngay</span>
            </button>
         </div>
         <div class="desc-pro-detail"><?= (isset($row_detail['mota' . $lang]) && $row_detail['mota' . $lang] != '') ? htmlspecialchars_decode($row_detail['mota' . $lang]) : '' ?></div>
      </div>
   </div>
   <div class="tabs-pro-detail pt-2">
      <ul class="ul-tabs-pro-detail w-clear">
         <li class="active transition" data-tabs="info-pro-detail"><?= thongtinsanpham ?></li>
         <li class="transition" data-tabs="commentfb-pro-detail"><?= binhluan ?></li>
      </ul>
      <div class="content-tabs-pro-detail info-pro-detail active"><?= (isset($row_detail['noidung' . $lang]) && $row_detail['noidung' . $lang] != '') ? htmlspecialchars_decode($row_detail['noidung' . $lang]) : '' ?></div>
      <div class="content-tabs-pro-detail commentfb-pro-detail">
         <div class="fb-comments" data-href="<?= $func->getCurrentPageURL() ?>" data-numposts="3" data-colorscheme="light" data-width="100%"></div>
      </div>
   </div>
   <div class="product">
      <div class="tuongtu-title pb-3 ">
         <h5 class="text-uppercase cursor-pointer">Các sản phẩm tương tự</h5>
      </div>
      <?php if (count($product) > 0) { ?>
         <div class="row mlr-10">
            <?php foreach ($product as $k => $v) {
               $func->showProduct($v, $options = array('class' => 'col-xl-3 col-md-3 col-sm-4 col-6 mb-3 plr-10'), $k);
            } ?>
         </div>
      <?php } else { ?>
         <div class="alert alert-warning w-100" role="alert">
            <strong><?= khongtimthayketqua ?></strong>
         </div>
      <?php } ?>
   </div>
</div>