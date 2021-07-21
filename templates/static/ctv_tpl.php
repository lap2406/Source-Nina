<div class="static">
	<div class="container">
		<div class="clearfix">
			<div class="global-title">
				<h3><?= $static['ten' . $lang] ?></h3>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-6 col-12">
				<div class="ctv-img">
					<img onerror="this.src='<?= THUMBS ?>/567x420x1/assets/images/noimage.png';" src="<?= THUMBS ?>/567x420x1/<?= UPLOAD_NEWS_L . $static['photo'] ?>" alt="">
				</div>
			</div>
			<div class="col-xl-6 col-12">
				<?php include TEMPLATE . LAYOUT . "newsletter.php"; ?>
			</div>
		</div>
		<div class="share">
			<b><?= chiase ?>:</b>
			<div class="social-plugin w-clear">
				<div class="addthis_inline_share_toolbox_qj48"></div>
				<div class="zalo-share-button" data-href="<?= $func->getCurrentPageURL() ?>" data-oaid="<?= ($optsetting['oaidzalo'] != '') ? $optsetting['oaidzalo'] : '579745863508352884' ?>" data-layout="1" data-color="blue" data-customize=false></div>
			</div>
		</div>
	</div>
</div>

</div>
<div class="clearfix"></div>