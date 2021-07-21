<div class="wrap-content clearfix">
	<div class="container">
		<div class="clearfix">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12">
					<div class="wrap-cart box_cart clearfix no-flex" id="box-shopcart">
						<form name="form1" class="frm-cart " method="post">
							<?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
								<div class="top-cart full-width">
									<input type="hidden" name="pid" />
									<input type="hidden" name="command" />
									<p class="title-cart">Giỏ hàng của bạn:</p>
									<div class="list-procart">
										<div class="item-procart item-procart-label">
											<div class="pic-procart"><?= hinhanh ?></div>
											<div class="info-procart"><?= tensanpham ?></div>
											<div class="quantity-procart">
												<p><?= soluong ?></p>
												<p><?= thanhtien ?></p>
											</div>
											<div class="price-procart"><?= thanhtien ?></div>
										</div>
										<?php foreach ($_SESSION['cart'] as $k => $v) {

											$code  = $k;
											$pid   = $v['productid'];
											$quantity     = $v['qty'];
											$mau = $v['color'];
											$size  = $v['size'];

											$proinfo = $cart->get_product_info($pid);
											$pro_price = $proinfo['gia'];
											$pro_price_new = $proinfo['giamoi'];
											$pro_price_qty = $pro_price * $quantity;
											$pro_price_new_qty = $pro_price_new * $quantity;
											if ($quantity == 0)
												continue;
										?>
											<div class="item-procart item-procart-<?= $pid . $mau . $size . $control ?>">
												<div class="pic-procart">
													<a href="<?= $proinfo[$sluglang] ?>" target="_blank" title="<?= $pname ?>"><img onerror="this.src='<?= THUMBS ?>/85x85x2/assets/images/noimage.png';" src="<?= THUMBS ?>/85x85x1/<?= UPLOAD_PRODUCT_L . $proinfo['photo'] ?>" alt="<?= $proinfo['ten' . $lang] ?>"></a>
													<a class="del-procart" data-code="<?= $code ?>">
														<i class="fa fa-times-circle"></i>
														<span><?= xoa ?></span>
													</a>
												</div>
												<div class="info-procart">
													<h3 class="name-procart"><a href="?=$proinfo[$sluglang]?>" target="_blank" title="<?= $proinfo['ten' . $lang] ?>"><?= $proinfo['ten' . $lang] ?></a></h3>

													<div class="properties-procart">
														<?php if ($mau) {
															$maudetail = $d->rawQueryOne("select ten$lang from #_product_mau where type = ? and id = ? limit 0,1", array($proinfo['type'], $mau)); ?>
															<p>Màu: <strong><?= $maudetail['ten' . $lang] ?></strong></p>
														<?php } ?>
														<?php if ($size) {
															$sizedetail = $d->rawQueryOne("select ten$lang from #_product_size where type = ? and id = ? limit 0,1", array($proinfo['type'], $size)); ?>
															<p>Size: <strong><?= $sizedetail['ten' . $lang] ?></strong></p>
														<?php } ?>
													</div>
												</div>
												<div class="quantity-procart">
													<div class="price-procart price-procart-rp">

														<?php if ($proinfo['giamoi']) { ?>
															<p class="price-new-cart load-price-new-<?= $code ?>">
																<?= $func->format_money($pro_price_new_qty) ?>
															</p>
															<p class="price-old-cart load-price-<?= $code ?>">
																<?= $func->format_money($pro_price_qty) ?>
															</p>
														<?php } else { ?>
															<p class="price-new-cart load-price-<?= $code ?>">
																<?= $func->format_money($pro_price_qty) ?>
															</p>
														<?php } ?>


													</div>
													<div class="quantity-counter-procart quantity-counter-procart w-clear">
														<span class="counter-procart-minus counter-procart" data-code="<?= $code ?>" data-id="<?= $pid ?>">-</span>
														<input type="number" class="quantity-procat" min="1" value="<?= $quantity ?>" data-pid="<?= $pid ?>" data-code="<?= $code ?>" name="product[<?= $code ?>]" />
														<span class="counter-procart-plus counter-procart" data-code="<?= $code ?>" data-id="<?= $pid ?>">+</span>
													</div>
													<div class="pic-procart pic-procart-rp">
														<a href="<?= $proinfo[$sluglang] ?>" target="_blank" title="<?= $pname ?>"><img onerror="this.src='<?= THUMBS ?>/85x85x2/assets/images/noimage.png';" src="<?= THUMBS ?>/85x85x1/<?= UPLOAD_PRODUCT_L . $proinfo['photo'] ?>" alt="<?= $proinfo['ten' . $lang] ?>"></a>
														<a class="del-procart" data-code="<?= $code ?>">
															<i class="fa fa-times-circle"></i>
															<span><?= _xoa ?></span>
														</a>
													</div>

												</div>
												<div class="price-procart">
													<?php if ($proinfo['giamoi']) { ?>
														<p class="price-new-cart load-price-new-<?= $code ?>">
															<?= $func->format_money($pro_price_new_qty) ?>
														</p>
														<p class="price-old-cart load-price-<?= $code ?>">
															<?= $func->format_money($pro_price_qty) ?>
														</p>
													<?php } else { ?>
														<p class="price-new-cart load-price-<?= $code ?>">
															<?= $func->format_money($pro_price_qty) ?>
														</p>
													<?php } ?>

												</div>
											</div>
										<?php } ?>
									</div>
									<div class="money-procart">

										<div class="total-procart">
											<p>Tổng tiền:</p>
											<p id="load-total" class="total-price load-price-total"><?= $func->format_money($cart->get_order_total()) ?></p>
										</div>

									</div>
									<button class="checkout button" type="button" onclick="window.location = 'thanh-toan'"><?= thanhtoan ?></button>

									<button class="checkout button" type="button" onclick="window.location = 'san-pham'"><?= muatiep ?></button>

								</div>

							<?php } else { ?>
								<a href="" class="empty-cart">
									<i class="fa fa-cart-arrow-down"></i>
									<p>Không tồn tại sản phẩm trong giỏ hàng...!</p>
									<span>Về trang chủ</span>
								</a>
							<?php } ?>
						</form>

					</div>
				</div>


			</div>
		</div>
	</div>
</div>