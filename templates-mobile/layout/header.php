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


				<div class="title-rpmenu">
					<div class="wrap">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="hd-logo">
					<a href="" title="Home"><img onerror="this.src='<?= THUMBS ?>/166x133x1/assets/images/noimage.png';" src="<?= UPLOAD_PHOTO_L . $logo['photo'] ?>" /></a>
				</div>
				<div class="cart-desktop">
					<a href="gio-hang">
						<div class="cart-img">
							<img src="./assets/images/cart.png" alt="">
						</div>
						<p><?php echo count($_SESSION['cart']);  ?></p>
					</a>
				</div>

				
			</div>
			<div class=" search-box-main ">
				<form id="form-xsearch" method="GET" action="" enctype="multipart/form-data">
					<div class="search-box">
						<input type="text" class="keyword" placeholder="Nhập từ khóa..." value="" required>
						<button type="submit"><i class="fal fa-search"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include TEMPLATE . "layout/menu.php" ?>
</header>