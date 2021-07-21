<div class="product">
	<div class="container">
		<div class="global-title mb-4">
			<h3><?= (@$title_cat != '') ? $title_cat : @$title_crumb ?></h3>
		</div>
		<div class="row mlr-10">
			<?php if (count($product) > 0) { ?>
				<?php foreach ($product as $k => $v) { 
					$func->showProduct($v,$options =array('class'=>'col-6 plr-10 mb-3 '),$k);
				} ?>
			<?php } else { ?>
				<div class="alert alert-warning w-100" role="alert">
					<strong><?= khongtimthayketqua ?></strong>
				</div>
			<?php } ?>
		</div>
		<div class="clear"></div>
		<div class="pagination-home"><?= (isset($paging) && $paging != '') ? $paging : '' ?></div>
	</div>


</div>