<header id="header">
	<div class="wrap-top">
		<div class="header-top">
			<div class="container">
				<div class="header-top-content">
					<h2><?= $slogan['ten' . $lang] ?></h2>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="header-main ">
				<div class="hd-logo">
					<a href="" title="Home"><img onerror="this.src='<?= THUMBS ?>/166x133x1/assets/images/noimage.png';" src="<?= UPLOAD_PHOTO_L . $logo['photo'] ?>" /></a>
				</div>
				<div class=" search-box-main ">
					<form id="form-xsearch" method="GET" action="" enctype="multipart/form-data">
						<div class="search-box">
							<input type="text" class="keyword" placeholder="Nhập từ khóa..." value="" required>
							<button type="submit"><i class="fal fa-search"></i></button>
						</div>
					</form>
				</div>
				<div class="cart-desktop">
					<div class="cart-img">
						<a href="gio-hang">
							<img src="./assets/images/cart.png" alt="">
						</a>
					</div>
					<a href="gio-hang">
						<div class="cart-right">
							<span>Giỏ hàng</span>
							<a href="gio-hang">
								<?php echo count($_SESSION['cart'])  ?> sản phẩm
							</a>
						</div>
					</a>
				</div>
				<div class="hd-main-end">
					<div class="hd-main-end-img">
						<img src="./assets/images/hotline.png" alt="">
					</div>
					<span>Hotline</span>
					<div class="contact-hd">
						<p><?= $optsetting['hotline1'] ?></p>
						<p><?= $optsetting['hotline2'] ?></p>
					</div>
					<div class="social-hd">
						<?php //foreach ($social as $k => $v) { 
						?>
						<!-- <div class="social-hd-img">
								<a href="<?= $v['link'] ?>"><img onerror="this.src='<?= THUMBS ?>/30x30x1/assets/images/noimage.png';" src="<?= UPLOAD_PHOTO_L . $v['photo'] ?>" alt="<?= $v['ten' . $lang] ?>"></a>
							</div> -->
						<?php //} 
						?>
					</div>
				</div>

			</div>
		</div>
	</div>
	<?php include TEMPLATE . "layout/menu.php" ?>
</header>