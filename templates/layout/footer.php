<footer class="">
   <!-- <div id="particles-js"></div> -->
   <div class="container">
      <div class="row mb-5">
         <div class="col-5 mb-4">
            <div class="footer-global-title text-uppercase cursor-pointer">
               <h3>Thông tin liên hệ</h3>
            </div>
            <div class="footer-left">
               <div class="footer-title text-uppercase cursor-pointer">
                  <h3><?= $footer['ten' . $lang] ?></h3>
               </div>
               <div class="mb-3 mt-4"><?= htmlspecialchars_decode($footer['noidung' . $lang]) ?></div>
            </div>

         </div>
         <div class="col-7">
            <div class="row">
               <div class="col-6 mb-4">
                  <div class="footer-global-title text-uppercase cursor-pointer">
                     <h3>Tổng đài hỗ trợ</h3>
                  </div>
                  <div class="footer-center">
                     <div class="mb-3 mt-5"><?= htmlspecialchars_decode($footer['mota' . $lang]) ?></div>
                  </div>
               </div>
               <div class="col-6 mb-4">
                  <div class="footer-right">
                     <div class="footer-global-title text-uppercase cursor-pointer">
                        <h3>Chính sách khách hàng</h3>
                     </div>
                     <div class="cs mt-5">
                        <?php foreach ($cs as $k => $v) { ?>
                           <a href="<?= $v[$sluglang] ?>"><i class="fas fa-square mr-3"></i> <?= $v['ten' . $lang] ?></a>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <section class="copyright">
      <div class="container">
         <p class="copyright-left">Copyright &copy; 2021 <b><?= $setting['ten' . $lang] ?></b> . All rights reserved. Design by Nina.</p>

      </div>
   </section>
   <?= $addons->setAddons('messages-facebook', 'messages-facebook', 10); ?>
</footer>
<div class="maps">
   <?=$optsetting['toado_iframe']?>
</div>
<div id="gio-hang">
   <div class="cart-desktop">
      <a href="gio-hang">
         <div class="cart-img">
            <img src="./assets/images/cart.png" alt="">
         </div>
         <p><?php echo count($_SESSION['cart'])  ?></p>
      </a>
   </div>
</div>
<a class="btn-zalo btn-frame text-decoration-none" target="_blank" href="https://zalo.me/<?= preg_replace('/[^0-9]/', '', $optsetting['zalo']); ?>">
   <div class="animated infinite zoomIn kenit-alo-circle"></div>
   <div class="animated infinite pulse kenit-alo-circle-fill"></div>
   <i><img src="assets/images/zl.png" alt="Zalo"></i>
</a>
<a class="btn-phone btn-frame text-decoration-none" href="tel:<?= preg_replace('/[^0-9]/', '', $optsetting['hotline']); ?>">
   <div class="animated infinite zoomIn kenit-alo-circle"></div>
   <div class="animated infinite pulse kenit-alo-circle-fill"></div>
   <i><img src="assets/images/hl.png" alt="Hotline"></i>
</a>