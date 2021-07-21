<div class="static">
	<div class="container">
		<div class="global-title">
			<h3><?= $row_detail['ten' . $lang] ?></h3>
		</div>
		<div class="row mlr-10">
			<?php if (count($hinhanhtt) > 0) {
				for ($i = 0; $i < count($hinhanhtt); $i++) { ?>
					<div class="col-xl-3 col-6 plr-10 mb-3">
						<a data-fancybox="images" href="<?= UPLOAD_NEWS_L . $hinhanhtt[$i]['photo'] ?>" rel="group">
							<p class="pic-album scale-img">
								<img onerror="this.src='<?= THUMBS ?>/480x360x2/assets/images/noimage.png';" src="<?= THUMBS ?>/480x360x1/<?= UPLOAD_NEWS_L . $hinhanhtt[$i]['photo'] ?>" alt="" /></p>
						</a>
					</div>
				<?php }
			} else { ?>
				<div class="alert alert-warning" role="alert">
					<strong><?= khongtimthayketqua ?></strong>
				</div>
			<?php } ?>
		</div>
	</div>
</div>