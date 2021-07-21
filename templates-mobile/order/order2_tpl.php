<div class="wrap-content clearfix">
  <div class="container">
    <div class="clearfix">
      <div class="row">
        <form name="form1" class="frm-cart" method="post">
          <div class="wrap-cart">
            <?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0) { ?>
              <div class="top-cart">
                <input type="hidden" name="pid" />
                <input type="hidden" name="command" /> 
                <p class="title-cart">Giỏ hàng của bạn:</p>
                <div class="list-procart">
                  <div class="item-procart item-procart-label">
                    <div class="pic-procart"><?=hinhanh?></div>
                    <div class="info-procart"><?=tensanpham?></div>
                    <div class="quantity-procart">
                      <p><?=soluong?></p>
                      <p><?=thanhtien?></p>
                    </div>
                    <div class="price-procart"><?=thanhtien?></div>
                  </div>
                  <?php  foreach ($_SESSION['cart'] as $k => $v) {
                    $code  = $k;
                    $pid   = $v['productid'];
                    $quantity     = $v['qty'];
                    $mau = $v['color'];
                    $size  = $v['size'];

                    $proinfo = $cart->get_product_info($pid);
                    $pro_price = $proinfo['gia'];
                    $pro_price_new = $proinfo['giamoi'];
                    $pro_price_qty = $pro_price*$quantity;
                    $pro_price_new_qty = $pro_price_new*$quantity;
                    if ($quantity == 0)
                      continue;
                    ?>
                    <div class="item-procart item-procart-<?=$pid.$mau.$size.$control?>">
                      <div class="pic-procart">
                       <a href="<?=$proinfo[$sluglang]?>" target="_blank" title="<?= $pname ?>"><img onerror="this.src='<?=THUMBS?>/85x85x2/assets/images/noimage.png';" src="<?=THUMBS?>/85x85x1/<?=UPLOAD_PRODUCT_L.$proinfo['photo']?>" alt="<?=$proinfo['ten'.$lang]?>"></a>

                     </div>
                     <div class="info-procart">
                      <h3 class="name-procart"><a href="?=$proinfo[$sluglang]?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><?=$proinfo['ten'.$lang]?></a></h3>

                      <div class="properties-procart">
                        <?php if($mau) { $maudetail = $d->rawQueryOne("select ten$lang from #_product_mau where type = ? and id = ? limit 0,1",array($proinfo['type'],$mau)); ?>
                        <p>Màu: <strong><?=$maudetail['ten'.$lang]?></strong></p>
                      <?php } ?>
                      <?php if($size) { $sizedetail = $d->rawQueryOne("select ten$lang from #_product_size where type = ? and id = ? limit 0,1",array($proinfo['type'],$size)); ?>
                      <p>Size: <strong><?=$sizedetail['ten'.$lang]?></strong></p>
                    <?php } ?>
                  </div>
                </div>
                <div class="quantity-procart">
                  <div class="price-procart price-procart-rp">

                   <?php if($proinfo['giamoi']) { ?>
                    <p class="price-new-cart load-price-new-<?=$code?>">
                      <?=$func->format_money($pro_price_new_qty)?>
                    </p>
                    <p class="price-old-cart load-price-<?=$code?>">
                      <?=$func->format_money($pro_price_qty)?>
                    </p>
                  <?php } else { ?>
                    <p class="price-new-cart load-price-<?=$code?>">
                      <?=$func->format_money($pro_price_qty)?>
                    </p>
                  <?php } ?>
                  

                </div>
                <div class="quantity-counter-procart quantity-counter-procart w-clear tt">
                 <input type="text" class="quantity-procat" min="1" value="<?=$quantity?>"/>
               </div>
               <div class="pic-procart pic-procart-rp">
                 <a href="<?=$proinfo[$sluglang]?>" target="_blank" title="<?= $pname ?>"><img onerror="this.src='<?=THUMBS?>/85x85x2/assets/images/noimage.png';" src="<?=THUMBS?>/85x85x1/<?=UPLOAD_PRODUCT_L.$proinfo['photo']?>" alt="<?=$proinfo['ten'.$lang]?>"></a>

               </div>

             </div>
             <div class="price-procart">
               <?php if($proinfo['giamoi']) { ?>
                <p class="price-new-cart load-price-new-<?=$code?>">
                  <?=$func->format_money($pro_price_new_qty)?>
                </p>
                <p class="price-old-cart load-price-<?=$code?>">
                  <?=$func->format_money($pro_price_qty)?>
                </p>
              <?php } else { ?>
                <p class="price-new-cart load-price-<?=$code?>">
                  <?=$func->format_money($pro_price_qty)?>
                </p>
              <?php } ?>


            </div>
          </div>
        <?php } ?>
      </div>
      <div class="money-procart">
        <div class="total-procart">
          <p>Tổng tiền:</p>
          <p class="total-price load-price-final <?=(isset($_SESSION['coupon']['price']))?'price-line':''?>"><?=$func->format_money($cart->get_order_total())?></p>
        </div>
      </div>
    </div>
    <div class="bottom-cart">
      <div class="section-cart">
        <p class="title-cart"><?=hinhthucthanhtoan?>:</p>
        <div class="information-cart list-httt">
          <?php foreach($httt as $key => $value) { ?>
            <div class="item-httt">
              <label class="label-httt" data-httt="<?=$value['id']?>">
                <input type="radio" name="trans" value="<?=$value['id']?>" required>
                <span><?=$value['ten'.$lang]?></span>
              </label>
              <div class="info-httt info-httt-<?=$value['id']?> transition"><?=str_replace("\n","<br>",$value['mota'.$lang])?></div>
            </div>
          <?php } ?>
        </div>
        <p class="title-cart">Thông tin giao hàng:</p>
        <div class="information-cart">
          <div class="input-cart">
            <input type="text" name="name" placeholder="Họ tên khách hàng" class="inp-cart" required>
            <input type="number" name="phone" placeholder="Điện thoại khách hàng" class="inp-cart" required>
            <input type="email" name="email" placeholder="Email khách hàng " class="inp-cart">
          </div>
          <div class="select-cart">
            <select required name="tinhthanh" id="tinhthanh"  class="sel-cart sel-tinhthanh">
              <option value="">Tỉnh thành</option>
              <?php for($i=0;$i<count($city);$i++) { ?>
                <option value="<?=$tinhthanh[$i]['id']?>"><?=$city[$i]['ten']?></option>
              <?php } ?>
            </select>
            <select required name="quanhuyen" id="quanhuyen" class="sel-cart sel-quanhuyen">
              <option value="">Quận/huyện</option>
            </select>

          </div>
          <textarea name="address" placeholder="Địa chỉ khách hàng" required></textarea>
          <textarea name="noidung" placeholder="Yêu cầu khách hàng"></textarea>
        </div>
        <input type="submit" class="thanhtoan bgcart" name="thanhtoan" value="<?=thanhtoan?>">
      </div>
    </div>
  <?php } else { ?>
    <a href="" class="empty-cart">
      <i class="fa fa-cart-arrow-down"></i>
      <p>Không tồn tại sản phẩm trong giỏ hàng...!</p>
      <span>Về trang chủ</span>
    </a>
  <?php } ?>
</div>
</form>
</div>
</div>
</div>
</div>
