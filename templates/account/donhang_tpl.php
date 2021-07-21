<?php 
   $tab = htmlspecialchars($match['params']['tab']);
 ?>
<div class="wrapuser">
   <form class="form-user validation-user" novalidate method="post" action="account/tai-khoan" enctype="multipart/form-data">
      <div class="row">
         <div class="col-12 col-sm-12 col-md-12 col-lg-3">
            <?php include TEMPLATE.account."/left_member_tpl.php"; ?>
         </div>
         <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-right">
            <h3 class="title-info">Đơn hàng của tôi (<?=$dem_order_new['num']?>)</h3>
            <div class="clearfix"></div>
            <div class="content-order profile-user clearfix">
               <div class="row-desktop-tt ">
                  <div class="ttl-box-profile no">Quản lý đơn hàng</div>
                  <div class="block-control">
                     <ul class="order-tabs">
                        
                        <li class="<?php if($tab=='wait_confirm' ||  $tab=='') echo 'active' ?> " ><a href="account/don-hang/wait_confirm" title="">Đơn hàng mới <?= (($dem_order_new['num']) ? '( '.$dem_order_new['num'].' )':'') ?></a></li>
                         <li class="<?php if($tab=='confirmed') echo 'active' ?>"><a href="account/don-hang/confirmed" title="">Đơn hàng đã xác nhận <?= (($dem_order_xn['num']) ? '( '.$dem_order_xn['num'].' )':'') ?> </a></li>
                        <li class="<?php if($tab=='shipping') echo 'active' ?>"><a href="account/don-hang/shipping" title="">Đơn hàng đang giao hàng <?= (($dem_order_dg['num']) ? '( '.$dem_order_dg['num'].' )':'') ?> </a></li>


                        <li class="<?php if($tab=='finish') echo 'active' ?>"><a href="account/don-hang/finish" title="">Hoàn tất <?= (($dem_order_ht['num']) ? '( '.$dem_order_ht['num'].' )':'') ?> </a></li>


                        <li class="<?php if($tab=='cancel') echo 'active' ?>"><a href="account/don-hang/cancel" title="">Đã hủy <?= (($dem_order_h['num']) ? '( '.$dem_order_h['num'].' )':'') ?> </a></li>
                     </ul>
                  </div>
                  <div class="cont-order-tabs">
                     <?php if(count($order)>0){ ?>
                        <div class="order-tabs-b">
                           <!-- content đơn hàng -->
                           <?php

                           foreach($order as $k=>$v){

                              ?>
                              <div class="user-order-items first-child">
                                 <div class="order-inf1 util-clearfix">
                                    <div class="cols-order-inf">
                                       <div class=" order-code"><span class="hide-mobile">Mã đơn hàng: </span> <a href="account/don-hang/view/<?= $v['madonhang'] ?>" title="Xem chi tiết đơn hàng"><span class="link-oder-detail">#<?= $v['madonhang'] ?></span></a>  <a href="account/don-hang/view/<?= $v['madonhang'] ?>" title="Xem chi tiết đơn hàng"><span class="hide-mobile link-oder-detail"><b>|</b>  Chi tiết</span></a>
                                       </div>
                                       <div>
                                          <span class="hide-mobile">Đặt ngày: </span> <?=date("d/m/Y",$v['ngaytao']) ?>                       </div>
                                       </div>
                                       <div class="cols-order-inf cols-order-name">



                                          <p class="cols-order-inf-name">Người nhận: </p><span> <?= $v['hoten'] ?></span>
                                          <div class="user-inf-add">
                                             <?= $v['diachi'] ?>  - <?= $func->get_places("district",$v['district']) ?>  -<?= $func->get_places("city",$v['city']) ?><br>
                                             <?= $v['dienthoai'] ?>  - <?= $v['email'] ?>                      </div>

                                          </div>
                                          <div class="cols-order-inf cols-total-money"><span>Tổng tiền:</span> <?=$func->format_money($v['tonggia']) ?></div>
                                       </div>
                                       <div class="order-inf2 util-clearfix">
                                          <?php 
                                          $order_detail=$d->rawQueryOne("select id,id_product,id_order from #_order_detail where id_order='".$v['id']."'");

                                          $info  = $cart->get_product_info($order_detail['id_product']);
                                          $pname=$info['ten'.$lang];
                                          $image =THUMBS.'/100x100x1/'.UPLOAD_PRODUCT_L. $info['photo'];


                                          ?>
                                          <div class="order-inf2-lf feedback">
                                             <a target="_blank" href="<?= $info[$sluglang] ?>" title="" class="img"><img onerror="this.src='<?=THUMBS?>/100x100x1/assets/images/noimage.png';" src="<?=$image?>" alt="" class="img-responsive"></a>
                                             <a target="_blank" href="<?= $info[$sluglang] ?>" title="<?= $pname ?>" class="pr-name"><?= $pname ?></a>
                                             
                                             <?php
                                            
                                              if($v['tinhtrang']==5){ 

                                               $cancel_order=$d->rawQueryOne("select ten$lang from #_index where id='".$v['cancel_order']."'");
                                              
                                                ?>
                                                <span class="order-status">Lý do hủy: <?= $cancel_order['ten'.$lang] ?></span>
                                             <?php } ?>
                                             </div>
                                             <div class="order-inf2-rg">
                                                <div class="block-inprogress">
                                                   <div style="min-width: 75px;" class="inner-steps <?= ($v['tinhtrang']==1) ? 'active':'' ?> <?php if($tab=='finish') echo 'active'?>">
                                                      <div class="icon-order"><img src="assets/member/icon9.png" class="img-responsive"></div>
                                                      <p class="not-active  visible-lg"> Chờ xác nhận</p>

                                                   </div>
                                                   <div  style="min-width: 75px;" class="inner-steps <?= ($v['tinhtrang']==2) ? 'active':'' ?> <?php if($tab=='finish') echo 'active'?>">
                                                      <div class="icon-line line"></div>
                                                      <div class="icon-order"><img src="assets/member/icon10.png" class="img-responsive"></div>
                                                      <p class="not-active visible-lg"> Đang xử lý</p>

                                                   </div>
                                                   <div style="min-width: 75px;" class="inner-steps <?= ($v['tinhtrang']==3) ? 'active':'' ?> <?php if($tab=='finish') echo 'active'?>">
                                                      <div class="icon-line"></div>
                                                      <div class="icon-order"><img src="assets/member/icon11.png" class="img-responsive"></div>
                                                      <p class="not-active visible-lg">Đang vận chuyển</p>

                                                   </div>
                                                   <div style="min-width: 75px;" class="inner-steps <?= ($v['tinhtrang']==4) ? 'active':'' ?> <?php if($tab=='finish') echo 'active'?>">
                                                      <div class="icon-line"></div>
                                                      <div class="icon-order"><img src="assets/member/icon12.png" class="img-responsive"></div>
                                                      <p class="not-active visible-lg">Đã giao hàng</p>
                                                   </div>
                                                   <?php if($v['tinhtrang']==5){ ?>
                                                      <div style="min-width: 75px;" class="inner-steps <?= ($v['tinhtrang']==5) ? 'active':'' ?> <?php if($tab=='cancel') echo 'active'?>">
                                                         <div class="icon-line"></div>
                                                         <div class="icon-order"><img src="assets/member/icon12.png" class="img-responsive"></div>
                                                         <p class="not-active visible-lg">Đã hủy</p>
                                                      </div>
                                                   <?php } ?>
                                                </div>
                                             </div>
                                             <div class="clearfix"></div>
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="block-btn-group">
                                             <div class="block-btn-left order-contact">

                                             </div>
                                             <div class="block-btn-right">
                                                 <?php if($v['tinhtrang']!=5 && $v['tinhtrang']!=4 && $v['tinhtrang']!=3){ ?>
                                                <div class="fancy-popup-daotao cancel-order <?= ($v['tinhtrang']==1) ? '':'hide' ?>"><a href="javascript:;" data-id="<?=$v['id']?>" class="popup-option-cancel" data-fancybox  data-src="#popup-option-cancel-order">Hủy</a></div><?php } ?>
                                                <?php if($v['tinhtrang']!=5){ ?>
                                                <div class="bt"><a href="account/don-hang/view/<?= $v['madonhang'] ?>">Theo dõi đơn hàng</a></div>
                                             <?php } ?>
                                             </div>
                                             <div class="clearfix"></div>
                                          </div>
                                       </div>
                                    <?php } ?>
                                    <!-- end đơn hàng -->
                                 </div>

                                 <input type="hidden" value="" id="orderCode">
                              <?php }else{ ?>
                                 <div class="clearfix"></div>
                                 <p class="note-order">Bạn chưa có đơn hàng trong 30 ngày gần đây. <a href="account/don-hang"><span>Xem tất cả đơn hàng của bạn</span></a></p>

                              <?php } ?>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
                  </div>
               </div>
            </form>
         </div>
         <div class="option-cancel-order">
            <div id="popup-option-cancel-order" style="display: none;">
               <div class="panel panel-info">
                  <div class="panel-heading">VÌ SAO BẠN CHỌN HỦY ĐƠN HÀNG</div>
                  <div class="panel-body">
                     <form action="" method="post" id="option-order">
                        <div class="form-group radio">
                           <label class="option-order-cancel"><input type="radio" value="1" name="option-cancel-order" required="">&nbsp;Hàng nhái</label>
                        </div>
                        <input type="hidden" value="" name="email" id="email">
                        <div class="form-group radio">
                           <label class="option-order-cancel"><input type="radio" value="2" name="option-cancel-order" required="">&nbsp;Hàng kém chất lượng</label>
                        </div>
                        <input type="hidden" value="" name="email" id="email">
                        <div class="form-group radio">
                           <label class="option-order-cancel"><input type="radio" value="3" name="option-cancel-order" required="">&nbsp;Đã hủy - Đặt nhầm/ trùng</label>
                        </div>
                        <input type="hidden" value="" name="email" id="email">
                        <div class="form-group radio">
                           <label class="option-order-cancel"><input type="radio" value="4" name="option-cancel-order" required="">&nbsp;Đã hủy - Không muốn mua nữa</label>
                        </div>
                        <input type="hidden" value="" name="email" id="email">
                        <div class="form-group radio">
                           <label class="option-order-cancel"><input type="radio" value="5" name="option-cancel-order" required="">&nbsp;Đã hủy - hàng không đúng như mẫu</label>
                        </div>
                        <input type="hidden" value="" name="email" id="email">


                     </form>
                  </div>   
               </div>
            </div>
         </div>