<div id="print-ele" class="main-member-order-detail">
	<div class="content" id="donhang-content">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-3">
				<?php include TEMPLATE.account."/left_member_tpl.php"; ?>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-9 col-right">
				<div class="row-desktop-tt row-mobile">
					<?php if($_GET['com']!="kiem-tra-don-hang"){ ?>
						<div class="ttl-box-profile">Quản lý đơn hàng<span> / Chi tiết đơn hàng</span></div><?php }else{ ?>
							<div class="tl">Chào bạn, dưới đây là thông tin đơn hàng của bạn:</div>
						<?php } ?>
						<div class="cont-order-detail">
							<div class="block-info-inprogress">
								<div class="first-block">
									<span><span class="hide-mobile">Mã đơn hàng : </span> <b>#<?= $order['madonhang'] ?></b></span>
									<span class="date-order"><span class="hide-mobile">Đặt hàng : </span> <?= date("d/m/Y",$order['ngaytao']) ?></span>
								</div>
								<div class="block-inprogress">

									<div class="inner-steps detail-order <?= ($order['tinhtrang']==1) ? 'active':'' ?> <?= ($order['tinhtrang']==4) ? 'active':'' ?>">

										<div class="icon-order"><img src="assets/member/icon9.png" class="img-responsive"></div>
										<p class="not-active visible-lg"> Chờ xác nhận</p>

									</div>
									<div class="inner-steps detail-order <?= ($order['tinhtrang']==2) ? 'active':'' ?> <?= ($order['tinhtrang']==4) ? 'active':'' ?>">
										<div class="icon-line"></div>
										<div class="icon-order"><img src="assets/member/icon10.png" class="img-responsive"></div>
										<p class="not-active visible-lg">Đang xử lý</p>

									</div>
									<div class="inner-steps detail-order <?= ($order['tinhtrang']==3) ? 'active':'' ?> <?= ($order['tinhtrang']==4) ? 'active':'' ?>">
										<div class="icon-line"></div>
										<div class="icon-order"><img src="assets/member/icon11.png" class="img-responsive"></div>
										<p class="not-active visible-lg">Đang vận chuyển</p>

									</div>
									<div class="inner-steps detail-order <?= ($order['tinhtrang']==4) ? 'active':'' ?> <?= ($order['tinhtrang']==4) ? 'active':'' ?>">

										<div class="icon-line"></div>
										<div class="icon-order"><img src="assets/member/icon12.png" class="img-responsive"></div>
										<p class="not-active visible-lg">Đã giao hàng</p>
									</div>
									<div class="inner-steps detail-order <?= ($order['tinhtrang']==4) ? 'active':'' ?> <?= ($order['tinhtrang']==4) ? 'active':'' ?>">
										<div class="icon-line"></div>
										<div class="icon-order">	<img src="assets/member/icon14.png" class="img-responsive"></div>
										<p class="not-active visible-lg">Hoàn tất</p>

									</div>
									<?php if($order['tinhtrang']==5){ ?>
										<div class="visible-lg inner-steps detail-order <?= ($order['tinhtrang']==5) ? 'active':'' ?> <?= ($order['tinhtrang']==5) ? 'active':'' ?>">
											<div class="icon-line"></div>
											<div class="icon-order">	<img src="assets/member/icon14.png" class="img-responsive"></div>
											<p class="not-active visible-lg">Đã hủy</p>

											</div><?php } ?>

										</div>
									</div>
									<div class="detail-block">
										<div class="row-mobile">
											
												
												<div class="block-left-detail order-left col-12 col-sm-12 col-md-6 col-lg-6">
													<div class="cols-left-detail ">
														<h3>TÌNH TRẠNG VẬN CHUYỂN</h3>
														<p class="txt-inf">
															<label>Nhà vận chuyển:</label>
															<span class="senpay"><strong><?= $httt['ten'.$lang] ?></strong></span>
														</p>
														<p class="txt-inf">
															<label>Tình trạng:</label>
															<span><strong><?=  $tinhtrang['trangthai'] ?></strong></span>
														</p>
													</div>
													<?php if($order['tinhtrang']==5){ 
														$cancel_order=$d->rawQueryOne("select ten$lang from #_index where id= ? ",array($order['cancel_order']));
														
														?>
														<div class="cols-right-detail">
															<span><?= $cancel_order['ten'.$lang] ?></span>
														</div>
													<?php } ?>
												</div>

												<div class="block-right-detail col-12 col-sm-12 col-md-6 col-lg-6">
													<h3>THÔNG TIN NHẬN HÀNG</h3>
													<div class="address-inf">
														<span class="username"><strong><?= $order['hoten'] ?></strong></span>
														<span class="phone">-  <?= $order['dienthoai'] ?></span>
														<p class="address"><?= $order['diachi'] ?> -<?= $func->get_places("district",$order['district']) ?>  -<?=  $func->get_places("city",$order['city']) ?></p>

													</div>
												</div>
											
												<div class="clearfix"></div>
																					</div>
										<div class="shipment-tracking pc">

											<div class="shipment-status active">
												<div class="shipment-icon">
													<span class="inactive"></span>
												</div>

												<div class="shipment-context">
													<?php if($order['tinhtrang']==5){ ?>
														<div class="shipment-text">Đơn hàng bị hủy</div>
														<div class="shipment-time">
															<div class="time"><?= date("H:s",$order['ngayhuy']) ?></div>
															<div class="date"><?= date("d/m/Y",$order['ngayhuy']) ?></div>
														</div>
													<?php } ?>
												</div>
											</div>
											<div class="shipment-status">
												<div class="shipment-icon">
													<span class="inactive"></span>
												</div>
												<div class="shipment-context">
													<div class="shipment-text">Đơn hàng đã được tạo</div>
													<div class="shipment-time">
														<div class="time"><?= date("H:s",$order['ngaytao']) ?></div>
														<div class="date"><?= date("d/m/Y",$order['ngaytao']) ?></div>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>

										<div class="block-inner-detail">
											<div class="inner-detail">
												
												<p class="txt-inf detail-order-2">
													<label><span class="hide-mobile visible-lg">|   </span>Hình thức thanh toán :</label>
													<span class="senpay"><?=$httt['ten'.$lang]?></span>
												</p>
												<p class="txt-inf detail-order-3">
													<label><span class="hide-mobile visible-lg">|   </span>Trạng thái thanh toán</label>
													<i>:</i>
													<span class="status-payment"><?=  $tinhtrang['trangthai'] ?></span>
												</p>



											</div>
											<div class="rg-detail">
												<table class="tbl-items-list">
													<tbody>
														<tr class="tbl-header hide-mobile visible-lg">
															<th class="hide-mobile visible-lg">Sản phẩm</th>
															<th class="hide-mobile visible-lg">Đơn giá</th>
															<th class="hide-mobile visible-lg">Số lượng</th>
															<th class="hide-mobile visible-lg">Thành tiền</th>
														</tr>
														<?php

														foreach($info_dateil as $k=>$v){ 
															$info  = $cart->get_product_info($v['id_product']);
															
															$image =THUMBS.'/'.UPLOAD_PRODUCT_L."/100x100x1/". $info['photo'];
															?>
															<tr>
																<td data-title="Sản Phẩm">
																	<div class="item-pr">
																		<img onerror="this.src='<?=THUMBS?>/100x100x1/assets/images/noimage.png';" src="<?= $image ?>" alt="">
																		<div class="item-pr-info">
																			<a target="_blank" href="<?= $info[$sluglang] ?>" title="" class="pr-name"><?= $v['ten'] ?></a>
																			<?php if($color['bg_color']){ ?>
																				<p class="size"><span class="title-size">Màu sắc:</span> <span class="display-color-product" style="background-color: <?= $color['bg_color'] ?>;"></span></p>
																			<?php } ?>
																			<?php if($size['ten_'.$lang]){ ?>
																				<p class="size"><span class="title-size">Size:</span> <span class="display-color-product"><?=  $size['ten_'.$lang]?></span></p><?php } ?>


																			</div>
																		</div>
																	</td>
																	<td data-title="Giá" class="price hide-mobile visible-lg"><?= number_format($v['gia'], 0, ',', '.') ?></td>
																	<td data-title="Số lượng" class="numb hide-mobile visible-lg"><?= $v['soluong'] ?></td>

																	<td data-title="Thành tiền" class="total-pr hide-mobile visible-lg"><?= number_format($v['gia'] * $v['soluong'], 0, ',', '.') ?>&nbsp;VNĐ</td>
																</tr>
															<?php } ?>
														</tbody>
													</table>
													<div class="clearfix"></div>
												</div>
												<div class="order-bill">
													<div class="detail-order-bill">
														<div class="row-inf">
									<span class="lbl">Tổng tiền:</span><!--
									<i class="pointer">:</i> -->
									<span class="fee"><?= number_format($order['tonggia'], 0, ',', '.') ?></span>
								</div>
								<?php if($order['phiship']){ ?>
								<div class="row-inf">
									<span class="lbl">Phí vận chuyển:</span><!--
									<i class="pointer">:</i> -->
									<span class="fee">
										<?= number_format($order['phiship'], 0, ',', '.') ?>
									</span>
								</div>
								<?php } ?>
								<?php if($order['cod']!=""){ ?>
								<div class="row-inf hide">
									<span class="lbl">Phí COD:</span>
									<span class="fee">
										<!-- 14,000 đ -->
									</span>
								</div>
								<?php } ?>
								
								<div class="row-inf last-child">
									<span class="lbl"><b>Tổng thanh toán</b></span>
									<span class="fee"><b><?= number_format($order['tonggia']+$order['phiship'], 0, ',', '.') ?></b></span>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="order-btn-group order-contact">
							
							<a href="tel:<?= ($infoshop) ? $infoshop['phone']:$rs_hotline['hotline_'.$lang] ?>" class="btn-phone">
								<i class="show-desktop glyphicon glyphicon-earphone"></i>
								<span class="show-desktop"><?=($infoshop) ? $infoshop['phone']:$rs_hotline['hotline_'.$lang] ?></span>
							</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			<div class="user-address-block">
					<div class="bt-block">
						<a href="account/don-hang"><button class="bt back-order-list">Quay lại danh sách đơn hàng</button></a>
					</div>
				</div>
		</div>
	</div>
</div>

</div>
</div>
