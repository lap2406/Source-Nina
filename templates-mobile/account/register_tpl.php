
<!-- POpup LOGIN-->
<div class="modal modal-popup modal-login " id="popup-login" data-redirect="reload" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header flash-message"></div>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button> 
         <div class="modal-body">
            <div class="bl-logo-title" style="background: url(<?=THUMBS?>/120x100x2/<?=UPLOAD_PHOTO_L.$logo['photo']?>) no-repeat left 0;background-size: 19%; background-position: 0 30%;">Đăng nhập tài khoản với <?=$setting['ten'.$lang]?></div>
            <button class="btn btn-login-fb">Đăng nhập qua Facebook</button> 
            <p class="p-text">-Hoặc đăng nhập bằng email/ số điện thoại-</p>
            <div class="bl-input form-horizontal">
               <div class="row">
                  <form id="form-login" class="form-login">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <div class="bl-div div-phone"> <input type="text" name="acount" class="form-control email-input" value="" placeholder="email@example.com"> </div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <div class="bl-div div-password"> <input data-type="password" type="password" name="password" value="" class="form-control password-input" placeholder="Mật khẩu"> <span class="span-eyes"></span> </div>
                        </div>
                     </div>
                     <div class="col-sm-12 bl-remember">
                        <div class="bl-inline bl-brand">
                           <div class="checkbox bl-checkbox"> <input id="remenber_pass_1" <?php if($_COOKIE['email_user']) echo 'checked' ?> class="requestType" type="checkbox" name="remenber_pass" value="1"> <label for="remenber_pass_1">Ghi nhớ tài khoản</label> </div>
                        </div>
                        <div class="bl-inline pull-right">
                           <p id="forgot-password">Quên mật khẩu?</p>
                        </div>
                     </div>
                     <div class="col-sm-12 bl-button text-center">
                        <input type="hidden" value="dang-nhap" name="act">
                        <div class="form-group"> <button type="submit"  class="btn btn-login" id="login-normal">Đăng Nhập</button> </div>
                     </div>
                     <div class="col-sm-12 text-center">
                        <div class="bl-creat-account"><a href="javascript:void(0);" onclick="$('#popup-login').modal('hide'); $('#popup-signup').modal('show');">Tạo tài khoản mới</a></div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- POpup SIGNUP-->
<div class="modal modal-popup modal-login" id="popup-signup" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="form-register" class="form-register">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button> 
         <div class="modal-body">
            <div class="bl-logo-title" style="background: url(<?=THUMBS?>/120x100x2/<?=UPLOAD_PHOTO_L.$logo['photo']?>) no-repeat left 0;background-size: 19%; background-position: 0 30%;">Đăng ký tài khoản với Propzy</div>
            <div class="bl-user">
               <div class="bl-radio">
                  <div class="row">
                     <div class="col-sm-3">
                        <p>Bạn là?</p>
                     </div>
                     <div class="col-sm-4">
                        <div class="i-radio"> <input type="radio" checked="" id="procedureTypeId1" name="procedureTypeId" class="procedureTypeId" value="0"> <label for="procedureTypeId1">Chủ nhà</label> </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="i-radio"> <input type="radio" id="procedureTypeId2" name="procedureTypeId" class="procedureTypeId" value="1"> <label for="procedureTypeId2">Môi giới</label> </div>
                     </div>
                  </div>
               </div>
            </div>
            <button class="btn btn-register-fb" id="register-facebook">Đăng ký qua Facebook</button> 
            <p class="p-text">-Hoặc đăng ký mới-</p>
            <div class="bl-input form-horizontal">
               <div class="row">

                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="bl-div div-fullname"> <input type="text" name="fullname" id="fullname_register" class="form-control fullname-input" placeholder="Họ và tên" required="required"> </div>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="bl-div div-phone"> <input type="text" name="phone" id="phone_register" class="form-control phone-input" placeholder="Số điện thoại" required="required">  </div>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="bl-div div-email"> <input type="email" name="email" class="form-control email-input" placeholder="Email"> </div>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="bl-div div-password"> <input type="password" name="password" id="password_register" class="form-control password-input" placeholder="Mật khẩu" required="required"> <span class="span-eyes"></span> </div>
                     </div>
                  </div>
                  <div class="col-sm-12 bl-button text-center">
                     <div class="form-group"> <button type="submit" id="register-normal" class="btn btn-login">Đăng Ký</button> </div>
                     <input type="hidden" value="dang-ky" name="act">
                  </div>
                  <div class="col-sm-12 bl-button text-right">
                     <div class="bl-remember">
                        <div class="bl-inline bl-creat-account pull-right"><a href="javascript:;" onclick="$('#popup-signup').modal('hide'); $('#popup-login').modal('show');">Đã có tài khoản</a></div>
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
</div>


<!-- POpup FORGOTPASSWORD-->

<div class="modal fade modal-popup modal-login in" id="popup-forgot-password" tabindex="-1" role="dialog" style="display: none;" aria-hidden="false">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button> 
         <div class="modal-body">
            <div class="bl-logo-title" style="background: url(<?=THUMBS?>/120x100x2/<?=UPLOAD_PHOTO_L.$logo['photo']?>) no-repeat left 0;background-size: 19%; background-position: 0 30%;">Quên Mật Khẩu</div>
            <p class="p-text">Nhập email/sđt để nhận lại mật khẩu mới</p>
            <div class="bl-input form-horizontal">
               <div class="row">
                  <form class="forgotPassword" id="forgotPassword">
                     <div class="col-sm-12">
                        <div id="form-input" class="form-group">
                           <div class="bl-div div-email">
                              <input id="forgot_email" name="forgot_email"  type="text" class="form-control email-input" placeholder="email@example.com"> 
                              <div class="errors_input"></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 bl-button text-center">
                       <input type="hidden" value="quen-mat-khau" name="act">
                       <div class="form-group"> <button id="continue-forgot-password" class="btn btn-login">Tiếp tục</button> </div>
                    </div>
                 </form>
              </div>
           </div>
        </div>
     </div>
  </div>
</div>

<!-- Popup user-change-pass -->
<div class="modal fade modal-popup modal-login " id="popup-user-change-pass" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button> 
         <div class="modal-body">
            <div class="bl-logo-title" style="background: url(<?=THUMBS?>/120x100x2/<?=UPLOAD_PHOTO_L.$logo['photo']?>) no-repeat left 0;background-size: 19%; background-position: 0 30%;">Thay Đổi Mật Khẩu</div>
            <p class="p-text">Nhập mật khẩu mới và xác nhận <br> để thay đổi</p>
            <div class="bl-input form-horizontal">

               <form class="form-user-change-pass" id="form-user-change-pass">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <div class="bl-div div-password"> <input id="user_pass_old" name="user_pass_old" type="password" class="form-control pass_old-input" placeholder="Mật khẩu cũ"> <span class="span-eyes"></span> </div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <div class="bl-div div-password"> <input id="user_pass" name="user_pass" type="password" class="form-control pass_new-input"  placeholder="Mật khẩu mới"> <span class="span-eyes"></span> </div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <div class="bl-div div-password"> <input id="user_repass" name="user_repass" type="password" class="form-control re_pass_new-input" placeholder="Nhập lại mật khẩu mới"> <span class="span-eyes"></span> </div>
                        </div>
                     </div>

                     <div class="col-sm-12 bl-button text-center">
                        <input type="hidden" name="" value="<?=$row_detail['id']?>">
                        <div class="form-group"> <button id="save-user-change-pass" class="btn btn-login">Lưu</button> </div>
                     </div>
                  </div>
               </form>
               
            </div>
         </div>
      </div>
   </div>
</div>
</div>