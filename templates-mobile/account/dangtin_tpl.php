<div class="wrapuser dang-tin">
   <?php if(!$_SESSION[$login_member]['active']){ ?>
      <div class="bl-choose-title"> 
         <button class="btn active">Chủ Nhà</button> 
         <button id="is-agent" onclick="$('#popup-login').modal('show');" class="btn">Môi Giới</button> 
      </div>
   <?php } ?>

   <h2 class="title-dangtin">Thông tin BĐS</h2>
   <form class="form-horizontal bl-info-credibility form-news"  method="post" id="btnSendNoLogin" enctype="multipart/form-data">
      <div class="row">
         <?php if($_SESSION[$login_member]['type']==1){ ?>
            <div class="col-sm-12">
               <div class="form-group form-group-new">
                  <div class="row">
                     <div class="col-12 col-sm-12 col-ms-12 col-lg-6" id="">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="row">
                                       <div class="col-sm-4">
                                          <div class="row"> <label class="col-sm-12 control-label"> <span class="text">Thông tin môi giới</span> </label> </div>
                                       </div>
                                       <div class="col-sm-3 control-labels">
                                          <div class="bl-checkbox"> <input type="checkbox" id="isOwner" class="isOwner" name="isOwner" value="1"> <label class="label_active" for="isOwner">Chính chủ</label> </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 hidden-feedback-icon">
                                    <div class="form-group">
                                       <div class="row">
                                          <div class="col-md-8 col-sm-8"> <input name="name_agent" id="name_agent" class="form-control-new" autocomplete="no" readonly="" type="text" placeholder="Họ tên" value="<?=$_SESSION[$login_member]['ten']?>"> </div>
                                          <div class="col-md-4 col-sm-4"> <input name="phone_agent" id="phone_agent" class="form-control-new" autocomplete="no" type="text" readonly="" placeholder="Số điện thoại" value="<?=$_SESSION[$login_member]['dienthoai']?>" > </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 hidden-feedback-icon">
                                    <div class="row">
                                       <div class="col-md-12 col-sm-12"> <input name="email_agent" readonly="" id="email_agent" class="form-control-new"  autocomplete="no" type="text" placeholder="Email" value="<?=$_SESSION[$login_member]['email']?>" > </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-sm-12 col-ms-12 col-lg-6" id="infos-owner">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="row">
                                       <div class="col-sm-4">
                                          <div class="row"> <label class="col-sm-12 control-label"> <span class="text">Thông tin chủ nhà</span> </label> </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 hidden-feedback-icon">
                                    <div class="form-group">
                                       <div class="row">
                                          <div class="col-md-8 col-sm-8"> 
                                             <input name="name" autocomplete="no" id="name" class="form-control-new"  type="text" placeholder="Họ tên" value=""> 
                                          </div>
                                          <div class="col-md-4 col-sm-4">
                                             <input name="phone" autocomplete="no" id="phone" class="form-control-new"  type="text" placeholder="Số điện thoại" value=""> 
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 hidden-feedback-icon">
                                    <div class="row">
                                       <div class="col-md-12 col-sm-12"> <input name="email" id="email" class="form-control-new"  type="text" placeholder="Email" value="" > </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php }else{ ?>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               <div class="row">
                  <div class="col-12 col-sm-12 col-ms-12 col-lg-6" id="infos-owner">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <div class="row"> <label class="col-sm-12 control-label"> <span class="text">Thông tin chủ nhà</span> </label> </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-12 hidden-feedback-icon">
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-md-8 col-sm-8"> 
                                          <input name="name" autocomplete="no" id="name" class="form-control-new"  type="text" placeholder="Họ tên" value="<?=$_SESSION[$login_member]['ten']?>"> 
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <input name="phone" autocomplete="no" id="phone" class="form-control-new"  type="text" placeholder="Số điện thoại" value="<?=$_SESSION[$login_member]['dienthoai']?>"> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-12 hidden-feedback-icon">
                                 <div class="row">
                                    <div class="col-md-12 col-sm-12"> <input name="email" id="email" class="form-control-new"   type="text" placeholder="Email" value="<?=$_SESSION[$login_member]['email']?>" > </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php } ?>
         <div class="col-sm-12">
            <div class="row">
               <div class="col-12 col-sm-12 col-ms-12 col-lg-6">
                  <div class="form-group">
                     <div class="row">
                        <label class="col-sm-12 control-label"> <span class="text">Loại hình giao dịch <strong class="color-red">*</strong></span> </label> 
                        <div class="col-sm-12">
                           <div class="row">
                              <div class="col-sm-4">
                                 <div class="bl-radio"> <input type="radio" name="listingType" id="listingType-1"  value="1" class="listingType" checked=""> <label for="listingType-1"> Bán </label> </div>
                              </div>
                              <div class="col-sm-4">
                                 <div class="bl-radio"> <input type="radio" name="listingType" id="listingType-2"  class="listingType" value="2"> <label for="listingType-2"> Cho thuê </label> </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-12 col-ms-12 col-lg-6">
                  <div class="form-group">
                     <div class="row">
                        <label class="col-sm-12 control-label"> <span class="text">Loại bất động sản <strong class="color-red">*</strong></span> </label> 
                        <div class="col-sm-12 propertyType-buy">
                           <div class="row">
                              <div class="col-sm-4">
                                 <div class="bl-radio"> <input class="propertyType" type="radio" name="propertyType" checked="" id="propertyType-1" value="1" buy-value="8"> <label for="propertyType-1"> Chung cư / căn hộ </label> </div>
                              </div>
                              <div class="col-sm-4">
                                 <div class="bl-radio"> <input class="propertyType" type="radio" name="propertyType" id="propertyType-2" value="2" buy-value="11" > <label for="propertyType-2"> Nhà riêng </label> </div>
                              </div>
                              <div class="col-sm-4">
                                 <div class="bl-radio"> <input class="propertyType" type="radio" name="propertyType" id="propertyType-3" value="3" buy-value="13"> <label for="propertyType-3" class="propertyType-13"> Đất nền </label> </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-12 propertyType-rent" style="display: none;">
                           <div class="row">
                              <div class="col-sm-4">
                                 <div class="bl-radio"> <input class="propertyType_rent" type="radio" name="propertyType_rent" checked="" id="propertyType-4" value="8" buy-value="8"> <label for="propertyType-4"> Chung cư / căn hộ </label> </div>
                              </div>
                              <div class="col-sm-4">
                                 <div class="bl-radio"> <input class="propertyType_rent" type="radio" name="propertyType_rent" id="propertyType-5" value="11" buy-value="11" > <label for="propertyType-5"> Nhà riêng </label> </div>
                              </div>

                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="form-group form-group-new">
               <div class="row">
                  <div class="col-12 col-sm-12 col-ms-12 col-lg-6">
                     <div class="form-group">
                        <div class="row">
                           
                           <div class="col-sm-12">
                              <div class="row"> <label class="col-sm-4 control-label"> <span class="text text-price">Tên bds <strong class="color-red">*</strong></span> </label> </div>
                           </div>
                           <div class="col-md-12 col-sm-12 price-fav"> <input id="ten_vi" type="text" name="ten_vi"  class="form-control"  placeholder="Tên bất động sản" value=""> </div>
                           
                        </div>
                        <div class="row">

                           <div class="col-sm-12">
                              <div class="row"> <label class="col-sm-4 control-label"> <span class="text text-price">Giá đề nghị <strong class="color-red">*</strong></span> </label> </div>
                           </div>
                           <div class="col-md-6 col-sm-4 price-fav"> <input id="price" type="text" name="price" class="form-control price"  placeholder="Giá đề nghị" value=""> </div>
                           <div class="col-sm-6 col-rate">
                              <div class="row">
                                 <div class="col-md-6 col-sm-5">
                                    <select class="form-control" id="currency" name="currency">
                                       <option value="VND">VND</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                  </div>
                  <div class="col-12 col-sm-12 col-ms-12 col-lg-6">
                     <div class="form-group">
                        <div class="row">
                           <label class="col-sm-12 control-label"> <span class="text">Địa chỉ BĐS <strong class="color-red">*</strong></span> </label> 
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                       <select class="form-control" name="city" id="city">
                                          <option value="">Chọn Tỉnh/Thành</option>
                                          <?php foreach ($city as $k => $v) {
                                             ?>
                                             <option value="<?=$v['id']?>"><?=$v['ten']?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                    <div class="col-md-4 col-sm-4 select-district-fav">
                                       <select class="form-control" id="district" name="district">
                                          <option value="">Quận/Huyện</option>
                                          <?php foreach ($district as $k => $v) {
                                             ?>
                                             <option value="<?=$v['id']?>"><?=$v['ten']?></option>
                                          <?php } ?>
                                          
                                       </select>
                                    </div>
                                    <div class="col-md-4 col-sm-4 select-ward-fav">
                                       <select class="form-control" id="ward" name="ward">
                                          <option value="">Phường/Xã</option>
                                           <?php foreach ($ward as $k => $v) {
                                             ?>
                                             <option value="<?=$v['id']?>"><?=$v['ten']?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-sm-4"> <input name="houseNumber" id="houseNumber" class="form-control" type="text" placeholder="Số nhà"> </div>
                                    <div class="col-sm-8"> <input name="fullAddress" id="fullAddress" class="form-control" type="text" placeholder="Tên đường" autocomplete="off"> </div>
                                    <div class="form-group">
                                    </div>
                                    <!-- <div class="col-sm-12"> <a id="map-dangtin" class="popup-map-dangtin">Nhập địa chỉ từ bản đồ</a> </div> -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-upload">
            <div class="form-group form-group-new">
               <div class="row">
                  <div class="col-12 col-sm-12 col-ms-12 col-lg-6">
                     <div class="form-group">
                        <label class="control-label"> <span class="text">Hình ảnh nhà</span> (upload tối thiểu 2 hình, kéo thả file hoặc chọn trực tiếp từ máy tính , Dung lượng từ 600kb - &gt;1Mb kích thước tối thiểu đối với ảnh ngang 1714x968, ảnh đứng 968x1714) <strong class="color-red">*</strong> </label> 
                        <div class="">
                           <div class="col-sm-12 images-listing">
                              <div class="ajax-file-upload-container"></div>
                              <div class="pic-upload">
                                 <div id="updatepic">
                                    <div class="ajax-upload-dragdrop col-lg-3 col-md-4 col-sm-6">
                                       <div class="ajax-file-upload image-upload" style="position: relative; overflow: hidden; cursor: default;"> <label for="upload-file" class="img-pointer"> <img id="image_listing" data-lazy-type="image" data-lazy-src="assets/member/img-upload.png" class=" col-upload-img image_listing loaded loaded" alt="submit" src="assets/member/img-upload.png"> </label> <input class="upload-image" type="file" id="upload-file" data-target="#image_listing" name="upload-file" accept="image/*"> </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-sm-12 col-ms-12 col-lg-6">
                     <div class="form-group">
                        <label class="control-label text-photoGcn"> <span class="text">Hình ảnh chi tiết </span> (upload tối thiểu 4 hình, kéo thả file hoặc chọn trực tiếp từ máy tính, Dung lượng từ 600kb -&gt; 1Mb kích thước tối thiểu đối với ảnh ngang 1714x968, ảnh đứng 968x1714) <strong class="color-red">*</strong> </label> 
                        <div class="">
                           <div class="col-sm-12 images-drawing">
                              <div class="ajax-file-upload-container-drawing"></div>
                              <div class="pic-upload">
                                 <div id="updatepic">
                                    <div class="ajax-upload-dragdrop col-lg-12 col-md-12 col-sm-6" >
                                       <div class="ajax-file-upload image-upload" style="position: relative; overflow: hidden; cursor: default;">  <input class="upload-image-drawing" type="file" id="filer_input2" data-target="#image_drawing" name="image_file[]" accept="image/*" multiple=""> </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="form-group">
               <div class="row">
                  <div class="col-12 col-sm-12 col-ms-12 col-lg-6 col-description">
                     <div class="form-group">
                        <div class="row">
                           <label class="col-sm-12 control-label"> <span class="text">Mô tả</span> </label> 
                           <div class="col-sm-12">
                              <div class="hidden-feedback-icon"> <textarea name="description" id="description" class="form-control text-description" placeholder="" rows="4"></textarea> </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-sm-12 col-ms-12 col-lg-6">
                     <div class="form-group">
                        <div class="row">
                           <label class="col-sm-12 control-label"> <span class="text">Nhu cầu khác</span> </label> 
                           <div class="col-sm-12 col-request-type">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="bl-checkbox"> <input type="checkbox" id="request-type-2" class="request-type" name="request-type" value="2"> <label for="request-type-2"> Thẩm định giá bất động sản </label> </div>
                                 </div>
                                 <div class="col-sm-12">
                                    <div class="bl-checkbox"> <input type="checkbox" id="request-type-3" class="request-type" name="request-type" value="3"> <label for="request-type-3"> Cung cấp thông tin quy hoạch </label> </div>
                                 </div>
                                 <div class="col-sm-12">
                                    <div class="bl-checkbox"> <input type="checkbox" id="request-type-4" class="request-type" name="request-type" value="4"> <label for="request-type-4"> Hoàn thiện hồ sơ pháp lý rao bán (Quyền sở hữu, tách thửa, kê khai thừa kế,...) </label> </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="row">
               <div class="remove-icon-bootstrap-validate">
                  <div class="padding-request">
                     <div class="form-group">
                        <div class="col-sm-12">
                           <div class="bl-checkbox bl-checkbox-special"> <input type="checkbox" id="require-post" class="require-post" required="" name="requirePost" value="1"> <label class="label_active" for="require-post">&nbsp;</label> <span id="require-post-text"> Tôi đồng ý với <!-- <a href="javascript:;" data-toggle="modal" data-target="#popup-require-post"> --> điều khoản sử dụng<!-- </a> --> và <span id="price-button"><!-- <a href="javasript:;" data-toggle="modal" data-target="#popup-require-price-buy"> -->biểu phí giao dịch<!-- </a> --></span> </span> </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="form-group form-button">
               <div class="col-sm-6"> <button type="submit"   class="btn btn-send btn-send-no-login">Gửi Thông Tin</button> </div>
            </div>
         </div>
      </div>
   </form>
</div>