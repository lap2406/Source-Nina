<footer class="">
   <!-- <div id="particles-js"></div> -->
   <div class="container">
      <div class="row mb-5">
         <div class="col-12 mb-2">
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

         <div class="col-12 mb-2">
            <div class="footer-global-title text-uppercase cursor-pointer">
               <h3>Tổng đài hỗ trợ</h3>
            </div>
            <div class="footer-center">
               <div class="mb-3 mt-2"><?= htmlspecialchars_decode($footer['mota' . $lang]) ?></div>
            </div>
         </div>
         <div class="col-12 mb-2">
            <div class="footer-right">
               <div class="footer-global-title text-uppercase cursor-pointer">
                  <h3>Chính sách khách hàng</h3>
               </div>
               <div class="cs mt-2">
                  <?php foreach ($cs as $k => $v) { ?>
                     <a href="<?= $v[$sluglang] ?>"><i class="fas fa-square mr-3"></i> <?= $v['ten' . $lang] ?></a>
                  <?php } ?>
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
</footer>

<div class="maps">
   <?=$optsetting['toado_iframe']?>
</div>