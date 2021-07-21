<section>
	<div id="wrap-logo">
		<div class="" id="logo-partne">
			<div class="container">
				<div class="global-title"><h2>
					<?=_logo_doitac?>
				</h2><div class="clearfix"></div>
			</div>
			<ul id="flexiselDemo3">
				<?php
				foreach($partner as $k=>$v){
					echo '<li class="wow fadeInUp" data-wow-offset="100" data-wow-duration="1" data-wow-delay="'.(0.2*$k).'s"><div><div class="inner-target"><a target="_blank"  title="'.$v['ten_'.$lang].'" href="'.$v['link'].'"><img src="'.THUMBS.'/150x120x1/'.UPLOAD_PHOTO_L.$v['photo'].'" onerror="this.src="'.THUMBS.'"/175x95x2/assets/images/noimage.png" /></a></div></div></li>';
				}
				?>
			</ul>    
			<div class="clearfix"></div>
		</div>
	</div>
</div>
</section>
