<div class="wrapuser">
   <form class="form-user validation-user" novalidate method="post" action="account/tai-khoan" enctype="multipart/form-data">
      <div class="row">
         <div class="col-12 col-sm-12 col-md-12 col-lg-3">
            <?php include TEMPLATE.account."/left_member_tpl.php"; ?>
         </div>
         <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-right">
            <h3 class="title-info">Thông tin cá nhân</h3>
            <div class="clearfix"></div>
            
            <div class="col-sm-12">
                 <div class="form-group">
               <label class="col-sm-12 control-label">Họ và tên</label> 
               <div class="col-sm-12">
                  <div class="bl-input-new div-fullname"> <input name="ten" id="ten" type="text" class="form-control-new" required="" placeholder="Họ và tên" value="<?=$row_detail['ten']?>" data-bv-field="name"><div class="invalid-feedback"><?=vuilongnhaphoten?></div> </div>

               </div>
           </div>
            </div>
            <div class="col-sm-12">
               <div class="form-group">
                 
                     <label class="col-sm-12 control-label">Giới tính</label> 
                     <div class="col-sm-7">
                        <div class="bl-input-new div-sex">
                           <select name="gioitinh" id="gioitinh" class="form-control-new">
                              <option value="">Giới tính</option>
                              <option value="1" <?=($row_detail['gioitinh']==1)?'selected':''?>>Nam</option>
                              <option value="0" <?=($row_detail['gioitinh']==0)?'selected':''?>>Nữ</option>
                           </select>
                        </div>
                     </div>
                  
               </div>
            </div>
            <div class="col-sm-12">
               <label class="col-sm-12 control-label">Ngày sinh</label> 
               <div class="col-sm-7">
                  <div class="bl-input-new bl-datetime div-birthday"> <input name="ngaysinh" id="ngaysinh" type="date" class="form-control-new"  value="<?=date("Y-m-d",$row_detail['ngaysinh'])?>"> </div>
               </div>
            </div>
          
            <div class="col-sm-12">
               <div class="form-group has-success">
                  
                     <label class="col-sm-12 control-label">Email</label> 
                     <div class="col-sm-12">
                        <div class="bl-input-new div-email"> <input readonly="" name="email" id="email" type="email" class="form-control-new" placeholder="Email" value="<?=$row_detail['email']?>" data-bv-field="email"> </div>
                        
                     </div>
                    <!--  <label class="control-label label-active">Kích hoạt email tại đây</label>  -->
                
               </div>
            </div>
            <div class="col-sm-12">
               <div class="form-group has-success">
                 
                     <label class="col-sm-12 control-label">Số điện thoại</label> 
                     <div class="col-sm-12">
                        <div class="bl-input-new div-phone"> 
                            <input name="dienthoai" id="dienthoai" type="text" class="form-control-new" placeholder="Số điện thoại" value="<?=$row_detail['dienthoai']?>"  data-bv-field="phone"> 
                        </div>
                      

                     </div>
               
               </div>
            </div>
           
            <div class="button-user">
               <div class="col-sm-12">
                  <div class="form-group">
                     <div class="col-12 col-md-12 col-sm-12 col-lg-4"> <button type="submit" class="btn btn-save">Lưu</button> </div>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
   </form>
</div>